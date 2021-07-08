import axios from 'axios';
// key : f6e8193c4e6b7c292e82dc836ad54c61f13e0fe9
//base url : https://api-ssl.bitly.com/v4/

export const key = 'f6e8193c4e6b7c292e82dc836ad54c61f13e0fe9';

const api = axios.create({
    baseURL: 'https://api-ssl.bitly.com/v4',
    headers: {
        'Content-type': 'application/json',
        'Authorization': `Bearer ${key}`
    }
})

export default api;