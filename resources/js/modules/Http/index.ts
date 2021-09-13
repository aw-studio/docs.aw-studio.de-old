import axios from 'axios';

const client = axios.create({
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
    },
});

export { client };
