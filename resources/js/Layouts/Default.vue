<template>
    <AppHead />
    <Header :menue-items="categories" />

    <Container>
        <Sidebar :items="page.pages" />
        <ContentWrapper>
            <slot />
        </ContentWrapper>
    </Container>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue';
import AppHead from '../components/App/Head.vue';
import Header from './components/Header.vue';
import Sidebar from './components/Sidebar.vue';
import Container from './components/Container.vue';
import ContentWrapper from './components/ContentWrapper.vue';
import { Page } from '../modules/Docs/types';

export default defineComponent({
    components: {
        AppHead,
        Header,
        Sidebar,
        Container,
        ContentWrapper,
    },
    props: {
        page: Object as PropType<Page>,
        categories: Array,
    },
    setup() {
        //
    },
});
</script>
