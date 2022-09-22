<template>
    <app-layout title="Users">
        <div class="flex flex-col justify-start mb-4">
            <jet-input v-model="params.name" type="text" class="w-1/4 text-sm rounded-md border-gray-300" placeholder="Name" />
        </div>

        <div class="bg-white border border-gray-100 rounded shadow overflow-x-auto mb-8">
            <div class="p-6">
                <h2 class="text-xl font-bold">All Users</h2>
            </div>

            <table class="w-full border border-gray-100">
                <thead class="w-full border border-gray-100">
                    <tr class="px-6 py-2">
                        <th class=" px-4 py-3">ID</th>
                        <th class=" px-4 py-3">Name</th>
                        <th class=" px-4 py-3">Deposits</th>
                        <th class=" px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr v-for="user in users.data" :key="user.id" class="px-6 py-4 text-center">
                        <td class="px-4 py-3">{{user.id}}</td>
                        <td class="px-4 py-3">{{user.name}}</td>
                        <td class="px-4 py-3">{{currency(user.deposits_sum_amount)}}</td>
                        <td class="px-4 py-3 space-x-4">
                            <Link :href="route('admin.users.deposits.index', user)">
                                <button>DEPOSITS</button>
                            </Link>
                            
                            <button @click="changeBalance(user)">BALANCE</button>
               
                            <button @click="banUser(user)">BANEAR</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <Paginate :data="users.links"></Paginate>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Link } from '@inertiajs/inertia-vue3';
    import JetInput from '@/Jetstream/Input.vue'
    import Paginate from '@/Components/Paginate.vue';
    import Swal from 'sweetalert2'

    export default defineComponent({
        components: {
            AppLayout,
            JetInput,
            Paginate,
            Link
        },

        props: {
            users: Object
        },

        data(){
            return {
                params: {
                    name: '',
                    page: 1
                }
            }
        },

        methods: {
            changeBalance(user){
                Swal.fire({
                    title: 'User Balance',
                    input: 'number',
                    inputValue: user.balance,
                    showCancelButton: true,
                    inputValidator: (value) => {
                        return new Promise((resolve) => {
                            if (value == '') {
                                resolve('You need to select a reason');
                            } else {
                                resolve();
                            }
                        })
                    }
                }).then(res => {
                    if(res.isConfirmed){
                        this.$inertia.put(this.route('admin.users.update', user), {balance: res.value});
                    }
                })
            },

            banUser(user) {
                Swal.fire({
                    title: `Banear Usuario (${user.name})`,
                    showCancelButton: true
                }).then(res => {
                    if(res.isConfirmed){
                        this.$inertia.delete(this.route('admin.users.destroy', user));
                    }
                })                
            }
        },

        watch: {
            params: {
                handler(){
                    this.$inertia.reload({data: this.params, only: ['users']});
                },
                deep: true
            }
        }
    })
</script>
