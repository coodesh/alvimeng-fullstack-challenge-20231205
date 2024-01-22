import axios from 'axios';

export default function setup() {
  console.log("aqui")
  axios.interceptors.request.use(
    (config) => {
      const { access_token } = JSON.parse(localStorage.getItem('token'));
      if (access_token) {
        config.headers.Authorization = 'Bearer ' + access_token;
      }
      return config;
    },
    (error) => {
      return Promise.reject(error);
    }
  );
}
