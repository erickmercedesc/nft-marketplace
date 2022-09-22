<template>
    <app-layout :title="token.name">
        <div class="grid md:grid-cols-3 md:gap-12 mt-12 ">
            <div>
                <img :src="'/'+token.image" alt="">
            </div>

            <div class=" col-span-2 py-8">
                <div class="flex justify-end space-x-2">
                    <div class="p-2 bg-gray-300 text-white rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                        <path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                        </svg>
                    </div>

                    <div class="p-2 bg-gray-300 text-white rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                        <path fill-rule="evenodd" d="M15.75 4.5a3 3 0 11.825 2.066l-8.421 4.679a3.002 3.002 0 010 1.51l8.421 4.679a3 3 0 11-.729 1.31l-8.421-4.678a3 3 0 110-4.132l8.421-4.679a3 3 0 01-.096-.755z" clip-rule="evenodd" />
                        </svg>
                    </div>                    
                </div>

                <div class="border-b border-b-gray-300 py-2">
                    <h3 class="text-2xl text-gray-800 font-bold mb-4">{{token.name}}</h3>
                    <h4 class="text-xl font-bold text-purple-500">{{currency(token.price)}}</h4>
                </div>

                <button @click="purchaseToken()" class="bg-purple-400 hover:bg-purple-500 rounded font-bold mt-8 p-4">PURCHASE</button>
            </div>
        </div>
    </app-layout>      
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import {Link} from '@inertiajs/inertia-vue3'
    import JetModal from '@/Jetstream/Modal.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import Swal from 'sweetalert2'

    export default defineComponent({
        components: {
            AppLayout,
            Link,
            JetModal,
            JetButton
        },

        props: {
            token: Object,
        },

        methods: {
            purchaseToken() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Want to buy this token?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.$inertia.post(this.route('tokens.purchase', this.token));
                    }
                })                
            }
        }
    })
</script>
