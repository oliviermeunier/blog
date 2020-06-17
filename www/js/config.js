export const config = {};

const url = new URL(window.location.href);

config.baseUrl = url.origin;

switch (url.host) {
    case 'localhost':
    case '127.0.0.1':
    case '87rgr87r8th.ngrok.io':
        config.baseUrl += '/web-developer/greta-live-share/blog/www';
        break;
}