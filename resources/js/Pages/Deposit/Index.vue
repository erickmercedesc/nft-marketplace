<template>
    <app-layout title="Deposits">
        <div class="grid gap-12 md:grid-cols-4">
            <div class="flex flex-col h-64 text-center justify-center bg-white rounded shadow">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="mx-auto mt-6 w-14 h-14 text-gray-400">
                <path d="M4.5 3.75a3 3 0 00-3 3v.75h21v-.75a3 3 0 00-3-3h-15z" />
                <path fill-rule="evenodd" d="M22.5 9.75h-21v7.5a3 3 0 003 3h15a3 3 0 003-3v-7.5zm-18 3.75a.75.75 0 01.75-.75h6a.75.75 0 010 1.5h-6a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3z" clip-rule="evenodd" />
                </svg>

                <div class="my-4">
                    <h2 class="text-gray-800 text-4xl font-semibold">{{currency($page.props.user.balance)}}</h2>
                    <span class="text-gray-400">Available Balance</span>
                </div>

                <hr>
                
                <div class="my-4 mx-4">
                    <jet-button @click="show_deposit_modal = true">Deposit</jet-button>
                </div>
            </div>

            <div class="col-span-3">
                <div class="bg-white border border-gray-100 rounded shadow">
                    <div class="p-6">
                        <h2 class="text-xl font-bold">All Transactions</h2>
                    </div>
                    

                    <table class="w-full border border-gray-100">
                        <thead class="bg-gray-50">
                            <td class="px-6 py-2">ID</td>
                            <td>AMOUNT</td>
                            <td>DATE</td>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            <tr v-for="deposit in deposits.data" :key="deposit.id">
                                <td class="px-6 py-4">{{deposit.id}}</td>
                                <td>{{currency(deposit.amount)}}</td>
                                <td>2022</td>
                            </tr>     
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </app-layout>

    <jet-modal :show="show_deposit_modal" @close="closeModal()">
        <div class="flex justify-end mt-2 mx-6 hover:cursor-pointer" @click="closeModal()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>

        <div class="flex flex-col my-4 mx-4">
            <h2 class="text-2xl font-bold mb-2">Select Deposit Currency</h2>
            <select v-model="deposit_currency" @change="generateAddress($event)" class="w-full rounded shadow border-gray-200" >
                <option value="">Currency</option>
                <option value="btc">BTC</option>
                <option value="eth">ETH</option>
                <option value="trx">TRX</option>
                <option value="trc20-usdt">USDT-TRC20</option>
            </select>

            <div class="text-center mt-4" v-if="deposit_address">
                <QrcodeVue class="mx-auto border-8 border-gray-50" value="deposit_address.address" :size="250" />
                <span class="uppercase font-semibold">{{deposit_currency}} Address </span>
                <span>{{deposit_address}}</span>
                <div class="max-w-sm mx-auto">
                    <button @click="copy(deposit_address)" class="bg-green-800 text-gray-200 text-sm mt-2 mx-auto px-2 py-1">Copy Wallet</button>
                </div>
            </div>

            
        </div>
    </jet-modal>    
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import CurrencyInput from '@/Components/CurrencyInput.vue'    
    import { Link } from '@inertiajs/inertia-vue3'
    import QrcodeVue from 'qrcode.vue'
    import JetModal from '@/Jetstream/Modal.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import axios from 'axios'

    export default defineComponent({
        components: {
            AppLayout,
            CurrencyInput,
            QrcodeVue,
            JetModal,
            Link,
            JetButton
        },

        props: {
            deposits: Object
        },

        data() {
            return {
                show_deposit_modal: false,
                deposit_currency: '',
                deposit_address: false
            }
        },

        methods: {
            closeModal() {
                this.show_deposit_modal = false;
            },

            generateAddress(e) {
                const currency = e.target.value;
                axios.get(this.route('deposits.address', currency))
                .then(res => {
                    this.deposit_address = res.data['address']
                })
                
            }
        }
    })
</script>
