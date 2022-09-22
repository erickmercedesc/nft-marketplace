<template>
    <app-layout title="My Token's">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div v-for="token in tokens.data" :key="token.id" >
                <Token :token="token" />
            </div>
            

            <Paginate class="col-span-3" :data="tokens.links"></Paginate>
        </div>

    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Token from '@/Components/Token.vue'
    import Paginate from '@/Components/Paginate.vue'

    export default defineComponent({
        components: {
            AppLayout,
            Token,
            Paginate
        },
        
        props: {
            tokens: Object
        }
    })
</script>
<style scoped>
    .hide-scroll-bar {
    -ms-overflow-style: none;
    scrollbar-width: none;
    }
    .hide-scroll-bar::-webkit-scrollbar {
    display: none;
    }
</style>