import axios from 'axios';

export default function setup() {
  axios.interceptors.request.use(
    (config) => {
      const token = JSON.parse(localStorage.getItem('token'));
      if (token) {
        config.headers.Authorization = 'Bearer ' + token;
      }
      return config;
    },
    (error) => {
      return Promise.reject(error);
    }
  );
}
