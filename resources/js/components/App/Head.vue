<template>
    <Head :title="title ? `${title} - AW-Studio Docs` : 'AW-Studio Docs'">
        <slot />
    </Head>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue';
import { Head } from '@inertiajs/inertia-vue3';
export default defineComponent({
    components: {
        Head,
    },
    props: {
        title: {
            type: String as PropType<string>,
            default: null,
        },
    },
});
</script>
