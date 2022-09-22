<template>
    <app-layout title="Settings">
        <form @submit.prevent="storeSettings()">
            <h3 class="text-2xl text-gray-400 font-bold">News</h3>
            <div class="grid grid-rows">
                <div class="my-2 flex flex-col capitalize text-gray-400">
                    <label>Title</label>
                    <jet-input type="text" class="w-1/2 rounded-md shadow-md" v-model="news_form['news_title']" />
                </div>

                <div class="my-2 flex flex-col capitalize text-gray-400">
                    <label for="">Title</label>
                    <textarea class="w-1/2 bg-gray-700 rounded-md" cols="30" rows="10" v-model="news_form['news_body']"></textarea>
                </div>
            </div>

            <div class="my-4">
                <hr>
            </div>
            
            <h3 class="text-2xl text-gray-400 font-bold">System</h3>

            <div class="flex flex-row space-x-4">
                <button type="button" @click="toggleWithdrawStatus()" :class="[(withdraw_status == '1') ? 'bg-green-500' : 'bg-red-500' ]" class="text-sm px-4 py-2 rounded">
                    <span v-if="(withdraw_status == '1')">Disable Withdraw</span>
                    <span v-else>Enable Withdraw</span>
                </button>

                <button type="button" @click="toggleMiningStatus()" :class="[(mining_status == '1') ? 'bg-green-500' : 'bg-red-500' ]" class="text-sm px-4 py-2 rounded">
                    <span v-if="(mining_status == '1')">Disable Mining</span>
                    <span v-else>Enable Mining</span>
                </button>
            </div>


            <div class="grid grid-cols-2 gap-2">
                <div v-for="(value, name) in settings_form" :key="name" class="my-2 capitalize text-gray-400">
                    <label for="">{{name}}</label>
                    <jet-input type="text" class="w-full rounded-md shadow-md" v-model="settings_form[name]" />
                </div>
            </div>

            <div class="my-4">
                <hr>
            </div>
            
            <h3 class="text-2xl text-gray-400 font-bold">Receive Addresses</h3>
            <div class="grid grid-cols-2 gap-2">
                <div v-for="(value, name) in addresses_form" :key="name" class="my-2 capitalize text-gray-400">
                    <label for="">{{name}}</label>
                    <jet-input type="text" class="w-full rounded-md shadow-md" v-model="addresses_form[name]" />
                </div>
            </div>

            <div class="my-4">
                <hr>
            </div>

            <div class="my-4">
                <button type="submit" class=" bg-blue-400 rounded-md px-6 py-2">Save</button>
            </div>
        </form>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import JetInput from '@/Jetstream/Input.vue'

    export default defineComponent({
        components: {
            AppLayout,
            JetInput
        },

        props: {
            news: Object,
            withdraw_status: String,
            mining_status: String,
            settings: Object,
            addresses: Object,
            plans: Object
        },

        data(){
            return {
                news_form: {
                    ...this.news
                },

                settings_form: {
                    ...this.settings
                },

                addresses_form: {
                    ...this.addresses
                },
                
                plans_form: {
                    ...this.plans
                }
            }
        },

        methods: {
            toggleWithdrawStatus() {
                this.$inertia.put(this.route('admin.settings.toggle_withdraw'), {});
            },

            toggleMiningStatus() {
                this.$inertia.put(this.route('admin.settings.toggle_mining'), {});
            },            

            storeSettings(){
                this.$inertia.post(this.route('admin.settings.store'), { ...this.news_form, ...this.settings_form, ...this.addresses_form, ...this.plans_form });
            }
        },
    })
</script>
