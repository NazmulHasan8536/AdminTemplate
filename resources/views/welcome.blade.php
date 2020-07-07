<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edmin</title>
        <link type="text/css" href="{{asset('./backend/assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link type="text/css" href="{{asset('./backend/assets/bootstrap/css/bootstrap-responsive.min.css')}}" rel="stylesheet">
        <link type="text/css" href="{{asset('./backend/assets/css/theme.css')}}" rel="stylesheet">
        <link type="text/css" href="{{asset('./backend/assets/images/icons/css/font-awesome.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{./css/app.css}">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
    </head>
    <body>


        <div id="app">

        <div class="navbar navbar-fixed-top" id="topbar" style="display: none;" v-show="$route.path === '/' || $route.path === '/register' || $route.path === '/forget' ? false : true">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="index.html">Inventory </a>
                    <div class="nav-collapse collapse navbar-inverse-collapse">
                        <ul class="nav nav-icons">
                            <li class="active"><a href="#"><i class="icon-envelope"></i></a></li>
                            <li><a href="#"><i class="icon-eye-open"></i></a></li>
                            <li><a href="#"><i class="icon-bar-chart"></i></a></li>
                        </ul>
                        <form class="navbar-search pull-left input-append" action="#">
                        <input type="text" class="span3">
                        <button class="btn" type="button">
                            <i class="icon-search"></i>
                        </button>
                        </form>
                        <ul class="nav pull-right">
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Item No. 1</a></li>
                                    <li><a href="#">Don't Click</a></li>
                                    <li class="divider"></li>
                                    <li class="nav-header">Example Header</li>
                                    <li><a href="#">A Separated link</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Support </a></li>
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="images/user.png" class="nav-avatar" />
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Your Profile</a></li>
                                    <li><a href="#">Edit Profile</a></li>
                                    <li><a href="#">Account Settings</a></li>
                                    <li class="divider"></li>
                                    <li>
                                        <router-link to="/logout">Logout</router-link>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /.nav-collapse -->
                </div>
            </div>
            <!-- /navbar-inner -->
        </div>
        <!-- /navbar -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="span3" id="leftbar"  id="leftbar" style="display: none;" v-show="$route.path === '/' || $route.path === '/register'  || $route.path === '/forget' ? false : true">
                        <div class="sidebar">
                            <ul class="widget widget-menu unstyled">
                                <li class="active"><router-link to="/home"><i class="menu-icon icon-dashboard"></i>Dashboard
                                </router-link>
                                </li>


                                <li><a href="activity.html"><i class="menu-icon icon-bullhorn"></i>News Feed </a>
                                </li>
                                <li><a href="message.html"><i class="menu-icon icon-inbox"></i>Inbox <b class="label green pull-right">
                                    11</b> </a></li>
                                <li><a href="task.html"><i class="menu-icon icon-tasks"></i>Tasks <b class="label orange pull-right">
                                    19</b> </a></li>
                            </ul>
                            <!--/.widget-nav-->




                            {{-- My Pagees start  --}}

                            <!--/.widget-nav-->
                            <ul class="widget widget-menu unstyled">
                                {{-- Employee  --}}
                                <li><a class="collapsed" data-toggle="collapse"  href="#togglePages"><i class="menu-icon icon-cog">
                                </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                                </i>Employee </a>
                                    <ul id="togglePages" class="collapse unstyled">
                                        <li><router-link to="/add/employee"><i class="menu-icon icon-tasks"></i>Add Employee</router-link> </li>
                                        <li><router-link to="/all/employee"><i class="menu-icon icon-tasks"></i>All Employee</router-link> </li>
                                    </ul>
                                </li>

                                {{-- Supplier  --}}
                                <li><a class="collapsed" data-toggle="collapse" href="#togglePages"><i class="menu-icon icon-cog">
                                </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                                </i>Supliers </a>
                                    <ul id="togglePages" class="collapse unstyled">
                                        <li><router-link to="/add/suplier"><i class="menu-icon icon-tasks"></i>Add Suplier</router-link> </li>
                                        <li><router-link to="/all/suplier"><i class="menu-icon icon-tasks"></i>All Suplier</router-link> </li>
                                    </ul>
                                </li>
                            </ul>


                            {{-- My Pages end  --}}

                            <ul class="widget widget-menu unstyled">
                                <li><a class="collapsed" data-toggle="collapse" href="#togglePages"><i class="menu-icon icon-cog">
                                </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                                </i>More Pages </a>
                                    <ul id="togglePages" class="collapse unstyled">
                                        <li><router-link to="/" class="pull-left" >Already have a Account ?</router-link></li>
                                        <li><router-link to="/register" class="pull-left" >Need a Account ?</router-link></li>
                                        <li><router-link to="/forget" class="pull-left" >Forget Password ?</router-link></li>
                                       </ul>
                                </li>
                                <li>
                                    <router-link to="/logout"><i class="menu-icon icon-signout"></i>Logout</router-link>
                                </li>
                            </ul>
                        </div>
                        <!--/.sidebar-->
                    </div>












                    <!--/.span3-->
                    <div class="span9">
                        <div class="content">

                            <router-view></router-view>


                            <!--/.module-->
                        </div>
                        <!--/.content-->
                    </div>
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.wrapper-->
        <div class="footer"  id="footbar" style="display: none;" v-show="$route.path === '/' || $route.path === '/register'  || $route.path === '/forget' ? false : true">
            <div class="container">
                <b class="copyright">&copy; 2020 Nazmul Hasan - nazmulinfo.com </b>All rights reserved.
            </div>
        </div>


    </div>
        <script src="{{asset('./backend/assets/scripts/jquery-1.9.1.min.js')}}" type="text/javascript"></script>
<script src="{{asset('./js/app.js')}}"></script>
        <script src="{{asset('./backend/assets/scripts/jquery-ui-1.10.1.custom.min.js')}}" type="text/javascript"></script>

        <script>
            let token = localStorage.getItem('token')

            if(token){
                $('#topbar').css('display','')
                $('#leftbar').css('display','')
                $('#footbar').css('display','')
            }
        </script>


         <script src="{{asset('./backend/assets/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('./backend/assets/scripts/flot/jquery.flot.js')}}" type="text/javascript"></script>
        <script src="{{asset('./backend/assets/scripts/flot/jquery.flot.resize.js')}}" type="text/javascript"></script>
        <script src="{{asset('./backend/assets/scripts/datatables/jquery.dataTables.js')}}" type="text/javascript"></script>
        <script src="{{asset('./backend/assets/scripts/common.js')}}" type="text/javascript"></script>

    </body>
