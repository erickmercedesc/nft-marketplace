<template>
    <Link :href="route('tokens.show', token)">
        <div class="bg-white rounded-md shadow-lg p-4 hover:cursor-pointer mb-4 md:mb-0">
            <div :style="{ 'background-image': 'url('+token.image+')'  }" class="w-full h-64  bg-no-repeat bg-cover bg-center"></div>

            <div class="flex flex-row justify-between items-center py-2 border-b border-b-gray-200 text-gray-600">
                <span class="text-lg font-semibold">{{token.name}} #1353</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                </svg>
            </div>

            <div class="flex flex-col py-2">
                <span class="text-gray-400 font-extralight">Reserved Price</span>
                <span class="font-bold text-gray-800">{{currency(token.price)}}</span>
            </div>
        </div>

    </Link>    
</template>

<script>
    import { defineComponent } from 'vue'
    import {Link} from '@inertiajs/inertia-vue3'


    export default defineComponent({
        components: {
            Link
        },

        props: {
            token: Object,
        }
    })
</script>

