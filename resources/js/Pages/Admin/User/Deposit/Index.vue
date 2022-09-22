<template>
    <app-layout :title="`Depositos ${user.name}`">
        <div class="flex justify-start mb-4">
            <button class="text-gray-400" @click="makeDeposit()">Depositar</button>
            
        </div>

        <div class="bg-white border border-gray-100 rounded shadow overflow-x-auto mb-8">
            <div class="p-6">
                <h2 class="text-xl font-bold">All Deposits</h2>
            </div>

            <table class="w-full border border-gray-100">
                <thead class="w-full border border-gray-100">
                    <tr class="px-6 py-2">
                        <th class=" px-4 py-3">ID</th>
                        <th class=" px-4 py-3">Amount</th>
                        <th class=" px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr v-for="deposit in deposits.data" :key="deposit.id" class="px-6 py-4 text-center">
                        <td class="px-4 py-3">{{deposit.id}}</td>
                        <td class="px-4 py-3">{{round(deposit.amount)}}</td>
                        <td class="px-4 py-3 space-x-4">
                            <button @click="deleteDeposit(deposit)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="flex text-gray-500">
            <span v-if="deposits.prev_page_url" @click.prevent="params.page -= 1">Previous</span>
            <span v-if="deposits.next_page_url" @click.prevent="params.page += 1">Next</span>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Link } from '@inertiajs/inertia-vue3';
    import JetInput from '@/Jetstream/Input.vue'
    import Swal from 'sweetalert2'

    export default defineComponent({
        components: {
            AppLayout,
            JetInput,
            Link
        },

        props: {
            user: Object,
            deposits: Object
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
            makeDeposit(){
                Swal.fire({
                    title: 'Deposit Amount',
                    input: 'number',
                    showCancelButton: true
                }).then(res => {
                    if(res.isConfirmed){
                        this.$inertia.post(this.route('admin.users.deposits.store', this.user), {amount: res.value});
                    }
                })
            },

            deleteDeposit(deposit) {
                Swal.fire({
                    title: `Eliminar Deposito?`,
                    showCancelButton: true
                }).then(res => {
                    if(res.isConfirmed){
                        this.$inertia.delete(this.route('admin.deposits.destroy', deposit));
                    }
                });
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
