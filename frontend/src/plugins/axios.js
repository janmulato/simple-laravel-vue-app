import _ from 'lodash'
// Lib imports
import axios from 'axios'
axios.defaults.baseURL = 'http://localhost:8000/api' //@TODO PROPER ENVIRONMENT
const STATUS_FORBIDDEN = 403;

let client = axios.create ({
  timeout: 30000,
  headers: {
    'Content-Type': 'application/json',
  },
});

client.interceptors.request.use(
  (config) => {
    let token = localStorage.getItem('authtoken');
    if (token) {
      config.headers['Authorization'] = `${ token }`
    }

    return config
  }, (error) => {
    return Promise.reject(error)
  }
);

// Response
client.interceptors.response.use(
  (response) => {
    let data = _.get(response, 'data', {});
    return data
  },
  (error) => {
    let response = _.get(error, 'response', {});
    if (_.get(response, 'status') === STATUS_FORBIDDEN) {
      window.getApp.$emit("APP_LOGOUT", {
        text: 'Session has expired. Please Login.'
      });

    }
    return Promise.reject(error)
  }
);

export default {
  client,
}
