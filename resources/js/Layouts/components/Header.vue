<template>
    <div class="w-full bg-gray-400 border-b border-gray-500">
        <div class="flex">
            <h2 class="leading-10 mr-4">AW Docs</h2>
            <div class="py-2">
                <Search />
            </div>
        </div>
        <ul class="flex">
            <li v-for="(item, key) in menueItems" :key="key">
                <InertiaLink :href="item.route" class="py-4 px-6 first:pl-0">
                    {{ item.title }}
                </InertiaLink>
            </li>
        </ul>
    </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue';
import { Link as InertiaLink } from '@inertiajs/inertia-vue3';
import Search from './Search.vue';

export default defineComponent({
    components: {
        InertiaLink,
        Search,
    },
    props: {
        menueItems: Array as PropType<
            Array<{
                title: String;
                item: String;
            }>
        >,
    },
    setup() {
        //
    },
});
</script>
