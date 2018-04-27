
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import OrderProgress from './components/OrderProgress.vue'
import OrderAlert from './components/OrderAlert.vue'
import OrderNotifications from './components/OrderNotifications.vue'


const app = new Vue({
    el: '#app',
    mounted(){
        
        Echo.channel('pizzatracking')
        .listen('OrderStatusChanged', (e) => {
          console.log('Realtimg pizzatracking working')
        });
    },
    components: {
    
        'order-progress': OrderProgress,
        'order-alert': OrderAlert,
        'order-notifications': OrderNotifications
    }

});
