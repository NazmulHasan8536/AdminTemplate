// All require files
require('./bootstrap');
import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)



// Routes Declared
import {routes} from './routes';

// Import Global Helpers Class
import User from './helpers/User'
window.User =  User;


// Sweet Alert Start
import Swal from 'sweetalert2'
window.Swal = Swal;

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  window.Toast = Toast;
// Sweet alert End


// Noty start
import Notifications from './helpers/Notifications';
window.Notifications = Notifications;

// noty ENd

// Vue router declared
const router = new VueRouter({
    routes, // short for `routes: routes,
    mode:'history'
})




// Global route
const app = new Vue({
    el: '#app',
    router
});
