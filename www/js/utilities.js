import {config} from './config.js';

export function buildUrl(route) {
    return config.baseUrl + route;
}