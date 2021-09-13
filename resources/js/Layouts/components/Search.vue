<template>
    <div>
        <input name="search" :value="query" @input="update" />
        <div>
            <a
                v-for="(result, key) in results"
                :key="key"
                class="p-2 border border-gray-700 block"
                :href="result.route"
            >
                <div>{{ result.breadcrump }}</div>
                <div class="text-sm bg-gray-600">{{ result.content }}</div>
                <div>{{ result.path }}</div>
            </a>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import debounce from 'lodash.debounce';
import { getResults } from '../../modules/Docs';
import { AxiosResponse } from 'axios';

export default defineComponent({
    components: {},
    props: {},
    setup() {
        let query = ref<string>('');
        let results = ref<object[]>([]);

        let update = debounce(e => {
            query.value = e.target.value;

            if (query.value == '') {
                return;
            }

            getResults(query.value).then((request: AxiosResponse) => {
                results.value = request.data.data;
            });
        }, 100);

        return { query, update, results };
    },
});
</script>
