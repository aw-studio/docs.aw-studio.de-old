import { Plugin } from 'vue';
import AppHead from './App/Head.vue';
import NavList from './Docs/NavList.vue';
import NavListItem from './Docs/NavListItem.vue';

const plugin = {
    install(app) {
        /**
         * Docs-Components
         */
        app.component('NavList', NavList);
        app.component('NavListItem', NavListItem);
    },
} as Plugin;

export default plugin;
