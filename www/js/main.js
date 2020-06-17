// Imports
import {FormContact} from './class/FormContact.js';


// Code principal exécuté au chargement du DOM
document.addEventListener('DOMContentLoaded', function() {


    const form = document.querySelector('.form-contact');

    if (form != null) {
        const formContact = new FormContact(form);
    }
});
