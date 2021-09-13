<template>
    <InertiaLink :href="link" class="px-10 py-4 bg-gray-500">
        <div class="flex justify-center pb-4">
            <slot name="icon" />
        </div>
        <div class="text-center">
            <slot name="title" />
        </div>
    </InertiaLink>
</template>

<script>
import { defineComponent } from 'vue';
import { Link as InertiaLink } from '@inertiajs/inertia-vue3';

export default defineComponent({
    components: {
        InertiaLink,
    },
    props: {
        link: String,
    },
    setup() {
        //
    },
});
</script>

<style></style>
