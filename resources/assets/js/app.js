
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Buefy from 'buefy';
import * as VueLoaders from 'vue-loaders';
import VueProgressiveImage from 'vue-progressive-image'

import User from './Helpers/User'
window.User = User

Vue.use(Buefy);
Vue.use(VueLoaders);
Vue.use(VueProgressiveImage)

Vue.use(require('vue-moment'));

User.hasToken();

import router from './Router/router.js'

 Vue.component('AppHome', require('./components/backend/AppHome.vue'));
 Vue.component('SideNav', require('./components/backend/SideNav.vue'));
//  Vue.component('AddProjectElement', require('./components/backend/Projects/AddProjectElements.vue'));


  

const app = new Vue({
    el: '#app',
        router
});

