/*
    Focus Default Theme JS
*/

console.log("Focus Default Theme JS");

import Alpine  from 'alpinejs';
import Cookies from 'js-cookie';
import * as jQuery  from 'jquery';
import PhotoSwipe from '@node/photoswipe';
import PhotoSwipeLightbox from '@node/photoswipe/dist/photoswipe-lightbox.esm.js';


window.Alpine = Alpine;
window.$ = window.jQuery = jQuery;
window.Cookies = Cookies;
window.PhotoSwipe = PhotoSwipe;
window.PhotoSwipeLightbox = PhotoSwipeLightbox;
window.Cookies = Cookies;

Alpine.start();

import './ps.js';


console.log('theme.js loaded');

import '../css/theme.css';


