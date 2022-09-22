<template>
    <div class="flex flex-row space-x-4">
        <Link replace as="button" :href="link.url" :class="[ link.active ? 'bg-gray-100' : 'bg-white' ]" class="px-2 py-2 rounded-md shadow" v-for="link in data" :key="link.label" v-html="link.label"></Link>
    </div>
</template>
  
<script>
import { defineComponent } from 'vue'
import { Link } from '@inertiajs/inertia-vue3';

export default defineComponent({
    props: {
        data: Object
    },

    components: {
        Link
    }
})
</script>