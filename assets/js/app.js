/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
//require('/css/app.css');

import ClassicEditor from '@ckeditor/ckeditor5-build-classic';



// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');

require('jquery-mask-plugin');

ClassicEditor
    .create( document.querySelector( '.editor' ), {
        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote','undo','redo']
    })
    .catch( error => {
        console.error( error );
    } );

$(document).ready(function(){
    $('#telNumb').mask('+38(000)000-00-00', {placeholder: "+38(___)___-__-__"});
});



