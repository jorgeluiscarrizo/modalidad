window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });

//Custom scritps

//Custom scritps

//DESCOMENTAR PARA LITHGALLERY FUNCIONE
//window.$ = require('jquery');

//For lightslider
//DESCOMENTAR PARA LITHGALLERY FUNCIONE
//window.jQuery  = require('jquery');
require('lightslider');
require('lightgallery');
//For plugins lightgallery
require('lg-thumbnail');
require('lg-autoplay');
require('lg-video');
require('lg-fullscreen');
require('lg-pager');
require('lg-zoom');
require('lg-hash');
require('lg-share');
require('lg-rotate');


