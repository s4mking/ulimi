/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
 const $ = require('jquery');

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');

document.querySelector('#increase').addEventListener('click',function(){
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById('number').value = value;
})
document.querySelector('#decrease').addEventListener('click',function(){
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    value--;
    document.getElementById('number').value = value;
})

document.querySelector('#file').addEventListener('click',function(){
    sweetAlert({ title: 'Ma fiche bienfait',
    imageUrl: '/files/bienfaitconcombre.png',
    // imageWidth: 400,
    // imageHeight: 200,
    imageAlt: 'Custom image',
    animation: false});
})
