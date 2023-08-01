import axios from "axios";

const server = axios.create({
    baseURL: `${process.env.VUE_APP_SERVER_API_URL}`,
    headers: {
        Authorization:`Bearer ${process.env.VUE_APP_SERVER_API_AUTH_TOKEN}`
      }
  });

  server.defaults.withCredentials = true;
  export default server;
  
