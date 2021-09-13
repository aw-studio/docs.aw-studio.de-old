<template>
    <div class="fixed w-60 h-full bg-gray-200 border-r border-gray-300">
        <ul>
            <li v-for="(item, key) in items" :key="key">
                <InertiaLink :href="item.route">
                    {{ item.title }}
                </InertiaLink>
            </li>
        </ul>
    </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue';
import { Item } from '../../modules/Docs/types';
import { Link as InertiaLink } from '@inertiajs/inertia-vue3';

export default defineComponent({
    components: {
        InertiaLink,
    },
    props: {
        items: Array as PropType<Item[]>,
    },
    setup() {
        //
    },
});
</script>
