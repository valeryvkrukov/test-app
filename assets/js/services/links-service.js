import axios from 'axios';

export function fetchLinks() {
    return axios.get('/api/links');
}

export function createLink(sourceUrl) {
    return axios.post('/api/links', {
        sourceUrl: sourceUrl
    }).then((resp) => {
        return axios.get(resp.data['@id']);
    });
}