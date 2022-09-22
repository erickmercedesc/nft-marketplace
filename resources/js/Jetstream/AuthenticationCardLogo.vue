<template>
    <Link :href="'/'">
        <img :src="$page.props.appLogoLight" width="400" >
    </Link>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },
    })
</script>
