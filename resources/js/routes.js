//auth.........
let homepage = require('./components/auth/home').default;
let login = require('./components/auth/login').default;
let register = require('./components/auth/register').default;
let forget = require('./components/auth/forget').default;
let logout = require('./components/auth/logout').default;
// Auth ENd......

// Employee Start.......
let employee = require('./components/employee/allEmployee').default;
let storeemployee = require('./components/employee/addNew').default;
let edit = require('./components/employee/edit').default;
// Suplier Start..........
let supplier = require('./components/supliers/addSuplier').default;
let storesuppliers = require('./components/supliers/allSuplier').default;
let editSupplier = require('./components/supliers/editSupplier').default;
//Customer Start..........
let allcustomers = require('./components/customer/index').default;
let storecustomer = require('./components/customer/create').default;
let editCustomer = require('./components/customer/edit').default;
// Category Start...........
let category = require('./components/catagories/create').default;
let storeCategory = require('./components/catagories/index').default;
let editCategory = require('./components/catagories/edit').default;
//Products.........
let storeproduct = require('./components/products/create').default;
let products = require('./components/products/index').default;
let editproduct = require('./components/products/edit').default;
//Expenses...........
let storeexpense = require('./components/expense/create').default;
let expenses = require('./components/expense/index').default;
let editexpense = require('./components/expense/edit').default;
//Salary.............
let all_employee  = require('./components/salary/all_Employee').default;
let pay_salary  = require('./components/salary/create').default;
let allSalary  = require('./components/salary/index').default;
let viewSalary  = require('./components/salary/view').default;
let editSalary  = require('./components/salary/edit').default;
// Stock
let stock  = require('./components/products/stock').default;
let editStock  = require('./components/products/editStock').default;



//print of sale(pos).........
let pos = require('./components/pos/postofserveice').default;


export const routes = [
    //Authentication.........
    { path: '/', component: login, name:'/' },
    { path: '/register', component: register, name:'register' },
    { path: '/forget', component: forget, name:'forget' },
    { path: '/home', component: homepage, name:'home' },
    { path: '/logout', component: logout, name:'logout' },

    // Employee Start........
    {path:'/employees',component:employee,name:'employee'},
    {path:'/store-employee',component:storeemployee,name:'Addemployee'},
    {path:'/edit-employee/:id',component:edit,name:'edit-employee'},

    //suplier start...........
    {path:'/Suppliers',component:storesuppliers,name:'suppliers'},
    {path:'/store-suppliers',component:supplier,name:'Addsupplier'},
    {path:'/edit-supplier/:id',component:editSupplier,name:'edit-supplier'},

    //category Start.........
    {path:'/store-category',component:category,name:'store-category'},
    {path:'/categories',component:storeCategory,name:'categories'},
    {path:'/edit-category/:id',component:editCategory,name:'edit-category'},

    //customers Start.........
    {path:'/store-customer',component:storecustomer,name:'store-customer'},
    {path:'/customers',component:allcustomers,name:'customers'},
    {path:'/edit-customer/:id',component:editCustomer,name:'edit-customer'},

    //products Start........
    {path:'/store-product',component:storeproduct,name:'store-product'},
    {path:'/products',component:products,name:'products'},
    {path:'/edit-product/:id',component:editproduct,name:'edit-product'},

    //Expenses..........
    {path:'/store-expense',component:storeexpense,name:'store-expense'},
    {path:'/expense',component:expenses,name:'expense'},
    {path:'/edit-expense/:id',component:editexpense,name:'edit-expense'},

    //Salary............
    {path:'/given-salary',component:all_employee,name:'given-salary'},
    {path:'/pay-salary/:id',component:pay_salary,name:'pay-salary'},
    {path:'/salary',component:allSalary,name:'salary'},
    {path:'/view-salary/:id',component:viewSalary,name:'view-salary'},
    {path:'/edit-salary/:id',component:editSalary,name:'edit-salary'},

    //stock............
    {path:'/stocks',component:stock,name:'stocks'},
    {path:'/editStock/:id',component:editStock,name:'editStock'},

    //pos..............
    {path:'/pos',component:pos,name:'pos'},

]
