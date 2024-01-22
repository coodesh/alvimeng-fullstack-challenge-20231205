import axios from 'axios';

const API_URL = 'http://127.0.0.1:8000/api/';

class AuthService {
  login(loginData) {
    return axios
      .post(API_URL + 'login', {
        email: loginData.email,
        password: loginData.password
      })
      .then(response => {
        if (response.data.access_token) {
          localStorage.setItem('token', JSON.stringify(response.data.access_token));
        }
        return response.data.access_token;
      });
  }

  register(registerData) {
    return axios
      .post(API_URL + 'register', {
        name: registerData.name,
        email: registerData.email,
        password: registerData.password,
      })
      .then(response => {
        return response;
      });
  }

  logout() {
    localStorage.removeItem('accessToken');
  }
  
}

export default new AuthService();
