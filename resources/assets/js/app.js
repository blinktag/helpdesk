
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

if (process.env.NODE_ENV == 'production') {
    Vue.config.productionTip = false;
  }

import VueTreeNavigation from 'vue-tree-navigation';
import DepartmentTree from './components/department-tree.vue';
import Notes from './components/notes.vue';
import Responses from './components/responses.vue';
import Upload from './components/upload.vue';
import swal from 'sweetalert';

Vue.use(VueTreeNavigation);
Vue.component('notes', Notes);

Vue.component('department-tree', DepartmentTree);
Vue.component('responses', Responses);
Vue.component('upload', Upload);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
