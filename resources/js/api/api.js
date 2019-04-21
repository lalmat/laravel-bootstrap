import Axios from "axios";
Axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

// Set CRSF Token for Axios
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
  Axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
} else {
  console.log(
    "CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token"
  );
}
export function apiCall(method, action, data = null) {
  return new Promise((resolve, reject) => {
    switch (method) {
      case "POST":
        Axios.post(action, data)
          .then(r => resolve(r.data))
          .catch(e => reject(e.response));
        break;
      case "GET":
        Axios.get(action)
          .then(r => resolve(r.data))
          .catch(e => reject(e.response));
        break;
      default:
        reject("Unkown method");
    }
  });
}
