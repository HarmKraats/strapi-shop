import axios from 'axios';


console.log('process.env', process.env)

const api = axios.create({
  baseURL: `${process.env.VUE_APP_STRAPI_URL}`,
  headers: {
    Authorization: `Bearer ${process.env.VUE_APP_STRAPI_API_AUTH_TOKEN}`
  }
});
export default api;
