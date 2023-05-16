import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:1337',
  headers: {
    Authorization: `Bearer ${process.env.VUE_APP_API_TOKEN}`
  }
});
export default api;


