<template>
    <app-layout title="NFT Marketplace">
        <div class="grid md:grid-cols-4 ">
            <div class="hidden md:block">
                <h3 class="text-gray-800 font-bold text-2xl">Search</h3>
                <input type="text" placeholder="Search products..." class="bg-gray-200 border-gray-400  py-2 px-4 rounded-md">
            </div>

            <div class="w-[90%] md:w-full mx-auto md:col-span-3">
                <div class="mb-6 flex justify-between items-center ">
                    <span class="text-gray-600 text-sm font-extralight" >Showing {{tokens.from}}–{{tokens.to}} of {{tokens.total}} results</span>
                    <Link v-if="$page.props.user.is_admin" :href="route('tokens.create')">
                        <jet-button>Create</jet-button>
                    </Link>
                    
                </div>
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div v-for="token in tokens.data" :key="token.id" >
                        <Token :token="token" />
                    </div>
                    

                    <Paginate class="col-span-3" :data="tokens.links"></Paginate>
                </div>

                
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
    import Token from '@/Components/Token.vue'
    import Paginate from '@/Components/Paginate.vue'

    export default defineComponent({
        components: {
            AppLayout,
            Link,
            JetModal,
            JetButton,
            Token,
            Paginate
        },

        props: {
            tokens: Object,
        }
    })
</script>
