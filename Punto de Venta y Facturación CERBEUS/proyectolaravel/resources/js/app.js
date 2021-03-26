
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))

// IMPORT ELEMENT
// import ElementUI from 'element-ui';
// import 'element-ui/lib/theme-chalk/index.css';

import Vue from 'vue';
import es from 'vee-validate/dist/locale/es';
import VeeValidate, { Validator } from 'vee-validate';



Vue.use(VeeValidate);

Validator.localize("es", es);

// Vue.use(ElementUI);

Vue.component('categoria', require('./components/Categoria.vue'));
Vue.component('marca', require('./components/Marca.vue'));
Vue.component('producto', require('./components/Producto.vue'));
Vue.component('precio_historico', require('./components/PrecioHistorico.vue'))
Vue.component('proveedor', require('./components/Proveedor.vue'));
Vue.component('cliente', require('./components/Cliente.vue'));
Vue.component('rol', require('./components/Rol.vue'));
Vue.component('user', require('./components/User.vue'));
Vue.component('compra', require('./components/Compra.vue'));
Vue.component('venta', require('./components/Venta.vue'));
Vue.component('dashboard', require('./components/Dashboard.vue'));

// NEW ELEMENTUI COMPONENTS
// Vue.component('categoriaForm', require('./components/categoriaForm.vue'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',

    data:{
        
        menu:0
    },
});
