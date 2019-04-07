import Axios  from 'axios';
Axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Set CRSF Token for Axios
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    Axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.log('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

export default {
  me() {
    return new Promise((resolve, reject) => {
      Axios.get('/users/me').then((response) => {
        resolve(response.data);
      })
    })
  },

  logout() {
    Axios.post('/logout').finally(() => {
      window.location.href = '/login';
    })
  }
}