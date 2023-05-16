import axios from "axios";

const server = axios.create({
    baseURL: 'http://localhost/01-own/strapi-vue-2/server/',
    headers: {
        Authorization: "Bearer BANANA"
      }
  });

  server.defaults.withCredentials = true;
  export default server;
  
