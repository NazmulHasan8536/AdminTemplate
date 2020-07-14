let homepage = require('./components/auth/home').default;
let login = require('./components/auth/login').default;
let register = require('./components/auth/register').default;
let forget = require('./components/auth/forget').default;
let logout = require('./components/auth/logout').default;

// Auth ENd

// Employee Start
let employee = require('./components/employee/allEmployee').default;
let storeemployee = require('./components/employee/addNew').default;
let edit = require('./components/employee/edit').default;

// Suplier Start Start
let supplier = require('./components/supliers/addSuplier').default;
let storesuppliers = require('./components/supliers/allSuplier').default;
let editSupplier = require('./components/supliers/editSupplier').default;





export const routes = [
    { path: '/', component: login, name:'/' },
    { path: '/register', component: register, name:'register' },
    { path: '/forget', component: forget, name:'forget' },
    { path: '/home', component: homepage, name:'home' },
    { path: '/logout', component: logout, name:'logout' },


    // Employee Start
    {path:'/employees',component:employee,name:'employee'},
    {path:'/store-employee',component:storeemployee,name:'Addemployee'},
    {path:'/edit-employee/:id',component:edit,name:'edit-employee'},

    //suplier start


    {path:'/Suppliers',component:storesuppliers,name:'suppliers'},
    {path:'/store-suppliers',component:supplier,name:'Addsupplier'},
    {path:'/edit-supplier/:id',component:editSupplier,name:'edit-supplier'},
  ]
