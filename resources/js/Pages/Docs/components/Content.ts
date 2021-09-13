import { h, defineComponent, PropType } from 'vue';
import { Page } from '../../../modules/Docs/types';

interface Props {
    page: Page
}

const Content = ({ page }: Props, context: any) => {
    const anonymousComponent = defineComponent({
        template: `<div>${page.content}</div>`,
        props: {
            page: Object as PropType<Page>
        }
    });

    return h(anonymousComponent, { page });
}

Content.props = ['page'];

export default Content;