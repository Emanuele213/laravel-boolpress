/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const { default: Axios } = require('axios');
window.axios = require('axios');

require('bootstrap');

require('./bootstrap');


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });

const eleOverlay = document.querySelector('.overlay');
if (eleOverlay) {
    const btnsDelete = document.querySelectorAll('.btn-delete-me');
    btnsDelete.forEach(btn => {
        btn.addEventListener('click', function () {
            eleOverlay.classList.remove('d-none');
            let url = 'http://localhost:8000/admin/';
            if(eleOverlay.querySelector('form').classList.contains('post')) {
                url += 'posts/';
            }else if (eleOverlay.querySelector('form').classList.contains('category')) {
                url += 'categories/';
            }
            eleOverlay.querySelector('form').setAttribute('action', url + this.dataset.id)
        })
    })

    const eleBtnClose = eleOverlay.querySelector('.btn-close-me');

    eleBtnClose.addEventListener('click', function() {
        eleOverlay.classList.add('d-none');
    })
}

const inputTitle = document.querySelector('[data-sluger=title]');
const inputSlug = document.querySelector('[data-sluger=slug]');
const btnGetSlug = document.querySelector('[data-sluger=button]');

if (inputTitle && inputSlug && btnGetSlug) {
    inputTitle.addEventListener('focusout', function() {
        if(inputSlug.value === ''){
            getSlug();
        }
    });

    btnGetSlug.addEventListener('click', getSlug());

    function getSlug() {
        //richiesta al server dello slug
        axios.get(btnGetSlug.dataset.sluger_url + '?title=' + inputTitle.value)
            .then(response => inputSlug.value = response.data.slug);
    }
}
