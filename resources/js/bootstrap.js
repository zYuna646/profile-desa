import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Import animations
import './animations.js';

// Import page load animations
import './page-load-animations.js';