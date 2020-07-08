let homepage = require('./components/auth/home').default;
let login = require('./components/auth/login').default;
let register = require('./components/auth/register').default;
let forget = require('./components/auth/forget').default;
let logout = require('./components/auth/logout').default;

// Auth ENd

// Employee Start
let employee = require('./components/employee/allEmployee').default;
let storeemployee = require('./components/employee/addNew').default;

// Suplier Start Start
let suplier = require('./components/supliers/allSuplier').default;
let newSuplier = require('./components/supliers/addSuplier').default;





export const routes = [
    { path: '/', component: login, name:'/' },
    { path: '/register', component: register, name:'register' },
    { path: '/forget', component: forget, name:'forget' },
    { path: '/home', component: homepage, name:'home' },
    { path: '/logout', component: logout, name:'logout' },


    // Employee Start
    {path:'/employees',component:employee,name:'employee'},
    {path:'/store-employee',component:storeemployee,name:'Addemployee'},

    //suplier start

    {path:'/supliers',component:suplier,name:'suplier'},
    {path:'/Add-Suplier',component:newSuplier,name:'AddSuplier'}
  ]
