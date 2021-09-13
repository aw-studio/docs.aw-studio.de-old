import { client } from '../Http';

function getResults(query: string) {
    return client.get(`/_search/${query}`);
}

export { getResults }