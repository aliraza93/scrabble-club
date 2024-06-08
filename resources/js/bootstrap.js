import axios from 'axios';

// Set up axios globally
window.axios = axios;

// Set default headers for all axios requests
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Retrieve the CSRF token from the meta tag
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Set the CSRF token as a default header for all axios requests
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
