import axios from "axios";

const server = axios.create({
    baseURL: 'http://localhost/1-own-projects/strapi-shop/server/',
    headers: {
        Authorization: "Bearer BANANA"
      }
  });

  server.defaults.withCredentials = true;
  export default server;
  
