// import Echo from 'laravel-echo';

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
    wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
    wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
    wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

let people_id= window.peopleId;
let User_id= window.UserId;
console.log(people_id);
// PrivateChannel('chat-'.$chat->people_id;
// PrivateChannel('chat-'.$chat->people_id
// window.Echo.private('chat-'+ people_id)
//     .listen('.event-'+ people_id, (e) => {
//         console.log('Message received:', e);
//             if(!(User_id == e.chat.user_identifier)){
//                 displayMessage(e.chat.message, e.chat.user_identifier, e.chat.user_name, e.chat.created_at, e.chat.filename);
//             }



//     });

//     console.log('Bootstrap.js loaded successfully');



window.peopleIds.forEach(function(personId) {
    window.Echo.private('chat-' + personId)
        .listen('.event-' + personId, (e) => {
            console.log('Message received:', e);
            if (UserId !== e.chat.user_identifier) {
                let newIndicator = document.getElementById(`new-indicator-${personId}`);
                if (newIndicator) {
                    newIndicator.style.display = 'inline';
                }
            }
        });
});

console.log('People blade JS loaded successfully');