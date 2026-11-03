import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "pusher",
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
});
