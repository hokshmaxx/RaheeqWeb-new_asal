<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>
        @yield('title')
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="Preview page of Metronic Admin Theme #4 for statistics, charts, recent events and reports"
          name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Cairo:300,400,600,700" rel="stylesheet"
          type="text/css"/>

    @if(app()->getLocale() == 'ar')


        <link href="{{admin_assets('/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet"
              type="text/css"/>
        <link href="{{admin_assets('/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet"
              type="text/css"/>
        <link href="{{admin_assets('/global/plugins/bootstrap/css/bootstrap-rtl.min.css')}}" rel="stylesheet"
              type="text/css"/>
        <link href="{{admin_assets('/global/plugins/bootstrap-switch/css/bootstrap-switch-rtl.min.css')}}" rel="stylesheet"
              type="text/css"/>

        @yield('css_file_upload')

        <link href="{{admin_assets('global/plugins/datatables/datatables.min.css')}}" rel="stylesheet"
              type="text/css"/>
        <link href="{{admin_assets('global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable-rtl.css')}}" rel="stylesheet"
              type="text/css"/>

        <link href="{{admin_assets('/global/css/components-rtl.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{admin_assets('/global/css/plugins-rtl.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{admin_assets('/layouts/layout4/css/layout-rtl.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{admin_assets('/layouts/layout4/css/themes/default-rtl.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{admin_assets('/layouts/layout4/css/custom-rtl.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{admin_assets('global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{admin_assets('global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet"
              type="text/css"/>
        <link href="{{admin_assets('global/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet"
              type="text/css"/>
        <link href="{{admin_assets('layouts/layout4/css/customize-style.css')}}" rel="stylesheet"
              type="text/css"/>

        <link href="{{admin_assets('global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet"
              type="text/css"/>

        <style type="text/css">
            .page-breadcrumb{
                direction: rtl;
            }
            .widget-row{
                margin-top: 45px;
            }
            .btn-group{
                float: right;
            }
            body{
                direction: rtl;
            }


            .btn-group .btn+.btn, .btn-group .btn+.btn-group, .btn-group .btn-group+.btn, .btn-group .btn-group+.btn-group {
                margin-right: 4px;
            }

            .mt-checkbox>span:after {

                border-width: 0 2px 2px 0;
                transform: rotate(45deg);
            }



            .fa {
                transform: rotate(180edg);
            }

        </style>

        @yield('css')





    @else



        <link href="{{admin_assets('/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet"
              type="text/css"/>
        <link href="{{admin_assets('/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet"
              type="text/css"/>
        <link href="{{admin_assets('/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"
              type="text/css"/>
        <link href="{{admin_assets('/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet"
              type="text/css"/>

        @yield('css_file_upload')


        <link href="{{admin_assets('/global/css/components.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{admin_assets('/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{admin_assets('/layouts/layout4/css/layout.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{admin_assets('/layouts/layout4/css/themes/default.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{admin_assets('/layouts/layout4/css/custom.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{admin_assets('global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{admin_assets('global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet"
              type="text/css"/>
        <link href="{{admin_assets('global/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet"
              type="text/css"/>
        <link href="{{admin_assets('layouts/layout4/css/customize-style.css')}}" rel="stylesheet"
              type="text/css"/>
        <link href="{{admin_assets('global/plugins/datatables/datatables.min.css')}}" rel="stylesheet"
              type="text/css"/>
        <link href="{{admin_assets('global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet"
              type="text/css"/>

        <style type="text/css">

            .page-sidebar .page-sidebar-menu li>a>.arrow.open:before, .page-sidebar .page-sidebar-menu li>a>.arrow:before, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu li>a>.arrow.open:before, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu li>a>.arrow:before {
                color: #b1c4d2;
                transform: rotate(180deg);
            }
        </style>


        @yield('css')

    @endif
    <link rel="shortcut icon" href="{{url('uploads/favicon.png')}}"/>
{{--    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>--}}
    <script src="https://cdn.tiny.cloud/1/h21rul0lri8f1wuiahke5dyfy97df45xbhijowifclarmsmv/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

</head>

<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">

<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="{{url('/admin/home')}}">
                <img src="{{$setting->logo}}"
                     style="margin: 3px 10px 0 !important; width: 70px;" alt="logo" class="logo-default"/>
            </a>
            <div class="menu-toggler sidebar-toggler">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
           data-target=".navbar-collapse"> </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN PAGE TOP -->
        <div class="page-top">
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <li class="separator hide"></li>
                    <li class="dropdown dropdown-user dropdown-dark">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                           data-close-others="true">
                            <span class="username username-hide-on-mobile"> {{auth()->guard('admin')->user()->name}} </span>
                            <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="{{ route('admin.admins.edit',auth()->guard('admin')->user()->id) }}">
                                    {{__('cp.edit_my_profile')}}
                                </a>


                            </li>
                            <li>
                                <a href="{{route('admin.admins.edit_password',auth()->guard('admin')->user()->id)}}">
                                    {{__('cp.Change Password')}}

                                </a>
                            </li>
                             <li>

                                <a href="{{ route('admin.logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{__('cp.logout')}}
                                </a>

                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>

                            </li>
                        </ul>
                    </li>

                    <li class="" style="padding: 10px">
                        @if(app()->getLocale() == 'en')
                            <?php
                            $lang = LaravelLocalization::getSupportedLocales()['ar']
                            ?>
                            <a href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}" class="">
                                <div style="color: #abafc1; font-size: 13px"><b>{{ $lang['native'] }}</b></div>
                            </a>
                        @else
                            <?php
                            $lang = LaravelLocalization::getSupportedLocales()['en']
                            ?>
                            <a href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}" class="">
                                <div style="color: #abafc1; font-size: 13px"><b>{{ $lang['native'] }}</b></div>
                            </a>
                        @endif
                    </li>


                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END PAGE TOP -->
    </div>
    <!-- END HEADER INNER -->
</div>



<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"></div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">

    <div class="page-sidebar-wrapper">
        <div class="page-sidebar navbar-collapse collapse">
            <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">


            <!--<div class="page-sidebar navbar-collapse collapse">
                <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">-->
                    <li class="nav-item active start">
                        <a href="{{url(getLocal().'/admin/home')}}" class="nav-link">
                            <i class="icon-home"></i>
                            <span class="title">{{__('cp.dashboard')}}</span>
                        </a>


                    @if(can('owners'))
                    <li class="nav-item {{(explode("/", request()->url())[5] == "owners") ? "active open" : ''}} ">
                        <a href="{{url(getLocal().'/admin/owners')}}" class="nav-link nav-toggle">
                            <i class="fa fa-users"></i><span class="title">{{__('cp.owners')}}</span>
                        </a>
                    </li>
                    @endif


                    @if(can('stores'))
                    <li class="nav-item {{(explode("/", request()->url())[5] == "employees") ? "active open" : ''}} ">
                        <a href="{{url(getLocal().'/admin/stores')}}" class="nav-link nav-toggle">
                            <i class="fa fa-university"></i><span class="title">{{__('cp.stores')}}</span>
                        </a>
                    </li>
                    @endif



                    @if(can('store-requests'))
                    <li class="nav-item {{(explode("/", request()->url())[5] == "store_requests") ? "active open" : ''}} ">
                        <a href="{{url(getLocal().'/admin/store_requests')}}" class="nav-link nav-toggle">
                            <i class="fa fa-male"></i><span class="title">{{__('cp.store_requests')}}</span>

                            @if($join_requests>0)
                                <span style="" class="badge badge-danger">{{$join_requests}}</span>
                            @endif

                        </a>
                    </li>
                    @endif


                    @if(can('unpaid-dafter-reports'))
                    <li class="nav-item {{(explode("/", request()->url())[5] == "unpaid_dafter_reports") ? "active open" : ''}} ">
                        <a href="{{url(getLocal().'/admin/unpaid_dafter_reports')}}" class="nav-link nav-toggle">
                            <i class="fa fa-book" aria-hidden="true"></i><span class="title">{{__('cp.unpaid_dafter_reports')}}</span>
                            @if(@$unpaid_dafter_reports>0)
                                <span style="" class="badge badge-danger">{{@$unpaid_dafter_reports}}</span>
                            @endif
                        </a>
                    </li>
                    @endif


                    @if(can('complaints'))
                    <li class="nav-item {{(explode("/", request()->url())[5] == "allStoresComplaints") ? "active open" : ''}} ">
                        <a href="{{url(getLocal().'/admin/allStoresComplaints')}}" class="nav-link nav-toggle">
                            <i class="fa fa-exclamation" aria-hidden="true"></i><span class="title">{{__('cp.complaints')}}</span>
                            @if(@$allStoresComplaints>0)
                                <span style="" class="badge badge-danger">{{@$allStoresComplaints}}</span>
                            @endif
                        </a>
                    </li>
                    @endif


                    @if(can('products'))
                    <li class="nav-item  {{(explode("/", request()->url())[5] == "products") ? "active open" : ''}}">
                        <a href="{{url(getLocal().'/admin/products')}}" class="nav-link nav-toggle">
                            <i class="fa fa-th"></i><span class="title">{{__('cp.products')}}</span>
                        </a>
                    </li>
                    @endif


                    @if(can('new-products-requests'))
                    <li class="nav-item  {{(explode("/", request()->url())[5] == "products_requests") ? "active open" : ''}}">
                        <a href="{{url(getLocal().'/admin/products_requests')}}" class="nav-link nav-toggle">
                            <i class="fa fa-th"></i><span class="title">{{__('cp.new_products_requests')}}</span>

                            @if($new_product_requests>0)
                                <span style="" class="badge badge-danger">{{$new_product_requests}}</span>
                            @endif

                        </a>
                    </li>
                    @endif



                @if(can('users'))
                    <li class="nav-item {{(explode("/", request()->url())[5] == "users") ? "active open" : ''}} ">
                        <a href="{{url(getLocal().'/admin/users')}}" class="nav-link nav-toggle">
                            <i class="fa fa-user"></i><span class="title">{{__('cp.manage_users')}}</span>
                        </a>
                    </li>
                @endif



                @if(can('tahseel-requests'))
                    <li class="nav-item  {{(explode("/", request()->url())[5] == "store_payments") ? "active open" : ''}}">
                        <a href="{{url(getLocal().'/admin/store_payments')}}" class="nav-link nav-toggle">
                            <i class="fa fa-money" aria-hidden="true"></i>
                            <span class="title">{{__('cp.tahseel_requests')}}</span>

                            @if($tahseel_requests>0)
                                <span style="" class="badge badge-danger">{{$tahseel_requests}}</span>
                            @endif
                        </a>
                    </li>
                @endif


                @if(can('orders'))
                    <li class="nav-item  {{(explode("/", request()->url())[5] == "orders") ? "active open" : ''}}">
                        <a href="{{url(getLocal().'/admin/orders')}}" class="nav-link nav-toggle">
                            <i class="glyphicon glyphicon-shopping-cart"></i>
                            <span class="title">{{__('cp.orders')}}</span>
                        </a>
                    </li>
                @endif


                @if(can('notifications'))
                    <li class="nav-item  {{(explode("/", request()->url())[5] == "notifications") ? "active open" : ''}}">
                        <a href="{{url(getLocal().'/admin/notifications')}}" class="nav-link nav-toggle">
                            <i class="fa fa-bell"></i><span class="title">{{__('cp.all_notifications')}}</span>
                        </a>
                    </li>
                @endif


                @if(can('chat'))
                    <li class="nav-item  {{(explode("/", request()->url())[5] == "chat") ? "active open" : ''}}">
                        <a href="{{url(getLocal().'/admin/chat')}}" class="nav-link nav-toggle">
                            <i class="glyphicon glyphicon-comment"></i>
                            <span class="title">{{__('cp.chat')}}</span>
                            @if($chat>0)
                                <span style="" class="badge badge-danger">{{$chat}}</span>
                            @endif
                        </a>
                    </li>
                @endif



                @if(can('ads'))
                    <li class="nav-item {{(explode("/", request()->url())[5] == "ads") ? "active open" : ''}} ">
                        <a href="{{url(getLocal().'/admin/ads')}}" class="nav-link nav-toggle">
                            <i class="fa fa-bullhorn"></i><span class="title">{{__('cp.ads')}}</span>
                        </a>
                    </li>
                @endif



            @if(can('units'))
                    <li class="nav-item  {{(explode("/", request()->url())[5] == "units") ? "active open" : ''}}">
                        <a href="{{url(getLocal().'/admin/units')}}" class="nav-link nav-toggle">
                            <i class="glyphicon glyphicon-th-large"></i><span class="title">{{__('cp.units')}}</span>
                        </a>
                    </li>
                @endif


                @if(can('currencies'))
                    <li class="nav-item  {{(explode("/", request()->url())[5] == "currencies") ? "active open" : ''}}">
                        <a href="{{url(getLocal().'/admin/currencies')}}" class="nav-link nav-toggle">
                            <i class="glyphicon glyphicon-th-large"></i><span class="title">{{__('cp.currencies')}}</span>
                        </a>
                    </li>
                @endif


                @if(can('activities'))
                    <li class="nav-item {{(explode("/", request()->url())[5] == "activities") ? "active open" : ''}} ">
                        <a href="{{url(getLocal().'/admin/activities')}}" class="nav-link nav-toggle">
                            <i class="glyphicon glyphicon-tasks"></i><span class="title">{{__('cp.activities')}}</span>
                        </a>
                    </li>
                @endif


                @if(can('countries'))
                <li class="nav-item {{(explode("/", request()->url())[5] == "countries") ? "active open" : ''}} ">
                    <a href="{{url(getLocal().'/admin/countries')}}" class="nav-link nav-toggle">
                        <i class="fa fa-flag"></i><span class="title">{{__('cp.countries')}}</span>
                    </a>
                </li>
                @endif


                @if(can('cities'))
                <li class="nav-item {{(explode("/", request()->url())[5] == "governorates") ? "active open" : ''}} ">
                    <a href="{{url(getLocal().'/admin/governorates')}}" class="nav-link nav-toggle">
                        <i class="fa fa-university"></i><span class="title">{{__('cp.cities')}}</span>
                    </a>
                </li>
                @endif


                @if(can('areas'))
                <li class="nav-item  {{(explode("/", request()->url())[5] == "area") ? "active open" : ''}}">
                    <a href="{{url(getLocal().'/admin/area')}}" class="nav-link nav-toggle">
                        <i class="fa fa-map-marker"></i><span class="title">{{__('cp.areas')}}</span>
                    </a>
                </li>
                @endif


                @if(can('main-categories'))
                    <li class="nav-item  {{(explode("/", request()->url())[5] == "categories") ? "active open" : ''}}">
                        <a href="{{url(getLocal().'/admin/categories')}}" class="nav-link nav-toggle">
                            <i class="fa fa-th-list"></i><span class="title">{{__('cp.main_categories')}}</span>
                        </a>
                    </li>
                @endif



                @if(can('sub-categories'))
                    <li class="nav-item  {{(explode("/", request()->url())[5] == "sub_categories") ? "active open" : ''}}">
                        <a href="{{url(getLocal().'/admin/sub_categories')}}" class="nav-link nav-toggle">
                            <i class="fa fa-th-list"></i><span class="title">{{__('cp.sub_categories')}}</span>
                        </a>
                    </li>
                @endif



                @if(can('food-types'))
                    <li class="nav-item  {{(explode("/", request()->url())[5] == "foodType") ? "active open" : ''}}">
                        <a href="{{url(getLocal().'/admin/foodType')}}" class="nav-link nav-toggle">
                            <i class="fa fa-cutlery"></i><span class="title">{{__('cp.foodType')}}</span>
                        </a>
                    </li>
                @endif


                @if(can('job-titles'))
                <li class="nav-item {{(explode("/", request()->url())[5] == "positions") ? "active open" : ''}} ">
                    <a href="{{url(getLocal().'/admin/positions')}}" class="nav-link nav-toggle">
                        <i class="fa fa-laptop"></i><span class="title">{{__('cp.positions')}}</span>
                    </a>
                </li>
                @endif



                @if(can('admins-management'))
                <li class="nav-item {{(explode("/", request()->url())[5] == "admins") ? "active open" : ''}} ">
                    <a href="{{url(getLocal().'/admin/admins')}}" class="nav-link nav-toggle">
                        <i class="fa fa-group"></i><span class="title">{{__('cp.admins')}}</span>
                    </a>
                </li>
                @endif


                @if(can('faqs'))
                    <li class="nav-item  {{(explode("/", request()->url())[5] == "faqs") ? "active open" : ''}}">
                        <a href="{{url(getLocal().'/admin/faqs')}}" class="nav-link nav-toggle">
                            <i class="glyphicon glyphicon-question-sign"></i><span class="title">{{__('cp.faqs')}}</span>
                        </a>
                    </li>
                @endif


                @if(can('pages'))
                <li class="nav-item {{(explode("/", request()->url())[5] == "pages") ? "active open" : ''}} ">
                    <a href="{{url(getLocal().'/admin/pages')}}" class="nav-link nav-toggle">
                        <i class="fa fa-clone"></i><span class="title">{{__('cp.pages')}}</span>
                    </a>
                </li>
                @endif


                @if(can('settings'))
                <li class="nav-item {{(explode("/", request()->url())[5] == "settings") ? "active open" : ''}} ">
                    <a href="{{url(getLocal().'/admin/settings')}}" class="nav-link nav-toggle">
                        <i class="fa fa-cogs"></i><span class="title">{{__('cp.setting')}}</span>
                    </a>
                </li>
                @endif


                <!--@if(can('permissions'))-->
                <!--<li class="nav-item {{(explode("/", request()->url())[5] == "role") ? "active open" : ''}} ">-->
                <!--    <a href="{{url(getLocal().'/admin/role')}}" class="nav-link nav-toggle">-->
                <!--        <i class="fa fa-server"></i><span class="title">{{__('cp.roleTitle')}}</span>-->
                <!--    </a>-->
                <!--</li>-->
                <!--@endif-->


                </ul>
            </div>

    </div>


    {{--Begin Content--}}
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>@yield('title')
                    </h1>
                </div>
                <div class="page-toolbar" style="display: none;">
                    <div class="btn-group btn-theme-panel">
                        <a href="javascript:;" class="btn dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-settings"></i>
                        </a>
                        <div class="dropdown-menu theme-panel pull-right dropdown-custom hold-on-click">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <h3>HEADER</h3>
                                    <ul class="theme-colors">
                                        <li class="theme-color theme-color-default active" data-theme="default">
                                            <span class="theme-color-view"></span>
                                            <span class="theme-color-name">Dark Header</span>
                                        </li>
                                        <li class="theme-color theme-color-light " data-theme="light">
                                            <span class="theme-color-view"></span>
                                            <span class="theme-color-name">Light Header</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-12 seperator">
                                    <h3>LAYOUT</h3>
                                    <ul class="theme-settings">
                                        <li> Theme Style
                                            <select class="layout-style-option form-control input-small input-sm">
                                                <option value="square">Square corners</option>
                                                <option value="rounded" selected="selected">Rounded corners</option>
                                            </select>
                                        </li>
                                        <li> Layout
                                            <select class="layout-option form-control input-small input-sm">
                                                <option value="fluid" selected="selected">Fluid</option>
                                                <option value="boxed">Boxed</option>
                                            </select>
                                        </li>
                                        <li> Header
                                            <select class="page-header-option form-control input-small input-sm">
                                                <option value="fixed" selected="selected">Fixed</option>
                                                <option value="default">Default</option>
                                            </select>
                                        </li>
                                        <li> Top Dropdowns
                                            <select class="page-header-top-dropdown-style-option form-control input-small input-sm">
                                                <option value="light">Light</option>
                                                <option value="dark" selected="selected">Dark</option>
                                            </select>
                                        </li>
                                        <li> Sidebar Mode
                                            <select class="sidebar-option form-control input-small input-sm">
                                                <option value="fixed">Fixed</option>
                                                <option value="default" selected="selected">Default</option>
                                            </select>
                                        </li>
                                        <li> Sidebar Menu
                                            <select class="sidebar-menu-option form-control input-small input-sm">
                                                <option value="accordion" selected="selected">Accordion</option>
                                                <option value="hover">Hover</option>
                                            </select>
                                        </li>
                                        <li> Sidebar Position
                                            <select class="sidebar-pos-option form-control input-small input-sm">
                                                <option value="left" selected="selected">Left</option>
                                                <option value="right">Right</option>
                                            </select>
                                        </li>
                                        <li> Footer
                                            <select class="page-footer-option form-control input-small input-sm">
                                                <option value="fixed">Fixed</option>
                                                <option value="default" selected="selected">Default</option>
                                            </select>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="{{url('/admin/home')}}">{{__('cp.statistics')}}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">@yield('title')</span>
                </li>
            </ul>
            @if (count($errors) > 0)
                <ul style="border: 1px solid #e02222; background-color: white">
                    @foreach ($errors->all() as $error)
                        <li style="color: #e02222; margin: 15px">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            @if (session('status'))
                <ul style="border: 1px solid #01b070; background-color: white">
                    <li style="color: #01b070; margin: 15px">{{  session('status')  }}</li>
                </ul>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- END CONTENT -->

    <div class="page-footer">
        <div class="page-footer-inner"> {{date("Y").'&copy; Powered By'}}
            <a target="_blank" href="https://innosoft.com.sa/">{{'Innosoft'}}</a>
        </div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>


</div>

<div id="deleteAll" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">{{__('cp.delete')}}</h4>
            </div>
            <div class="modal-body">
                <p>{{__('cp.confirmDeleteAll')}} </p>
            </div>
            <div class="modal-footer">
                <button class="btn default" data-dismiss="modal" aria-hidden="true" >{{__('cp.cancel')}}</button>
                <a href="#" class="confirmAll" data-action="delete"><button class="btn btn-danger">{{__('cp.delete')}}</button></a>
            </div>
        </div>
    </div>
</div>

<div id="activation" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">{{__('cp.activation')}}</h4>
            </div>
            <div class="modal-body">
                <p>{{__('cp.confirmActiveAll')}} </p>
            </div>
            <div class="modal-footer">
                <button class="btn default" data-dismiss="modal" aria-hidden="true">{{__('cp.cancel')}}</button>
                <a href="#" class="confirmAll" data-action="active">
                    <button class="btn btn-success">{{__('cp.Yes')}}</button>
                </a>
            </div>
        </div>
    </div>
</div>

<div id="cancel_activation" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">{{__('cp.cancel_activation')}}</h4>
            </div>
            <div class="modal-body">
                <p>{{__('cp.confirmNotActiveAll')}} </p>
            </div>
            <div class="modal-footer">
                <button class="btn default" data-dismiss="modal" aria-hidden="true">{{__('cp.cancel')}}</button>
                <a href="#" class="confirmAll" data-action="not_active"><button class="btn btn-default">{{__('cp.Yes')}}</button></a>
            </div>
        </div>
    </div>
</div>

<script src="{{admin_assets('/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{admin_assets('/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
@yield('js_file_upload')

<script src="{{admin_assets('/global/plugins/moment.min.js')}}" type="text/javascript"></script>




<script src="{{admin_assets('/global/plugins/counterup/jquery.waypoints.min.js')}}" type="text/javascript"></script>
<script src="{{admin_assets('/global/plugins/counterup/jquery.counterup.min.js')}}" type="text/javascript"></script>
<script src="{{admin_assets('/global/scripts/app.min.js')}}" type="text/javascript"></script>
<script src="{{admin_assets('/layouts/layout4/scripts/layout.min.js')}}" type="text/javascript"></script>
<script src="{{admin_assets('/global/plugins/bootstrap-sweetalert/sweetalert.min.js')}}" type="text/javascript"></script>
<script src="{{admin_assets('/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{admin_assets('/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>
<script src="{{admin_assets('/pages/scripts/ui-sweetalert.min.js')}}" type="text/javascript"></script>
<script src="{{admin_assets('global/scripts/datatable.js')}}" type="text/javascript"></script>
@if(app()->getLocale() == "ar")
    <script src="{{admin_assets('global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
@else

    <script src="{{admin_assets('global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
@endif
<script src="{{admin_assets('global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
<script src="{{admin_assets('pages/scripts/table-datatables-managed.min.js')}}" type="text/javascript"></script>
<script src="{{admin_assets('global/plugins/ckeditor/ckeditor.js')}}" type="text/javascript"></script>

<script src="{{admin_assets('/global/plugins/jquery-validation/js/jquery.validate.js')}}" type="text/javascript"></script>
<script src="{{admin_assets('/global/plugins/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
<script src="{{admin_assets('/global/scripts/app.min.js')}}" type="text/javascript"></script>


<script src="{{admin_assets('sweet_alert/sweetalert.min.js')}}" type="text/javascript"></script>
<script src="{{admin_assets('global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>


@yield('js')

<script type="text/javascript">
    var FormValidation = function () {

        // basic validation
        var handleValidation1 = function() {
            // for more info visit the official plugin documentation:
            // http://docs.jquery.com/Plugins/Validation

            var form1 = $('#form');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);

            form1.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                messages: {
                    select_multi: {
                        maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
                        minlength: jQuery.validator.format("At least {0} items must be selected"),
                    },
                },
                rules: {
                    name: {
                        minlength: 2,
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },

                    mobile: {
                        required: true,
                        minlength: 8
                    },

                    password: { required: true },
                    confirm_password: { required: true , equalTo: '[name="password"]'},
                    admin_type: {
                        required: true
                    },

                    title: {required: true},
                    logo: {required: true},
                },

                invalidHandler: function (event, validator) { //display error alert on form submit
                    success1.hide();
                    error1.show();
                    App.scrollTo(error1, -200);
                },




                //     errorPlacement: function (error, element) { // render error placement for each input typeW
                //     if (element.parent(".input-group").size() > 0)
                //     {
                //         error.insertAfter(element.parent(".input-group"));
                //     }
                //     else if (element.attr("data-error-container"))
                //     {
                //         error.appendTo(element.attr("data-error-container"));
                //     }
                //     else
                //     {
                //         error.insertAfter(element); // for other inputs, just perform default behavior
                //     }
                // },

                highlight: function (element) { // hightlight error inputs

                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                    success1.show();
                    error1.hide
                    e.submit()                }
            });


        };



        return {
            //main function to initiate the module
            init: function () {

                handleValidation1();

            }

        };

    }();

    jQuery(document).ready(function() {
        FormValidation.init();
    });



    $r = '{{app()->getLocale()}}' ;
    if($r == 'ar'){



        //overright messsages
        $.extend( $.validator, {

            defaults: {
                messages: {},
                groups: {},
                rules: {},
                errorClass: "error",
                validClass: "valid",
                errorElement: "label",
                focusCleanup: false,
                focusInvalid: true,
                errorContainer: $( [] ),
                errorLabelContainer: $( [] ),
                onsubmit: true,
                ignore: ":hidden",
                ignoreTitle: false,
                onfocusin: function( element ) {
                    this.lastActive = element;

                    // Hide error label and remove error class on focus if enabled
                    if ( this.settings.focusCleanup ) {
                        if ( this.settings.unhighlight ) {
                            this.settings.unhighlight.call( this, element, this.settings.errorClass, this.settings.validClass );
                        }
                        this.hideThese( this.errorsFor( element ) );
                    }
                },
                onfocusout: function( element ) {
                    if ( !this.checkable( element ) && ( element.name in this.submitted || !this.optional( element ) ) ) {
                        this.element( element );
                    }
                },
                onkeyup: function( element, event ) {
                    // Avoid revalidate the field when pressing one of the following keys
                    // Shift       => 16
                    // Ctrl        => 17
                    // Alt         => 18
                    // Caps lock   => 20
                    // End         => 35
                    // Home        => 36
                    // Left arrow  => 37
                    // Up arrow    => 38
                    // Right arrow => 39
                    // Down arrow  => 40
                    // Insert      => 45
                    // Num lock    => 144
                    // AltGr key   => 225
                    var excludedKeys = [
                        16, 17, 18, 20, 35, 36, 37,
                        38, 39, 40, 45, 144, 225
                    ];

                    if ( event.which === 9 && this.elementValue( element ) === "" || $.inArray( event.keyCode, excludedKeys ) !== -1 ) {
                        return;
                    } else if ( element.name in this.submitted || element === this.lastElement ) {
                        this.element( element );
                    }
                },
                onclick: function( element ) {
                    // click on selects, radiobuttons and checkboxes
                    if ( element.name in this.submitted ) {
                        this.element( element );

                        // or option elements, check parent select in that case
                    } else if ( element.parentNode.name in this.submitted ) {
                        this.element( element.parentNode );
                    }
                },
                highlight: function( element, errorClass, validClass ) {
                    if ( element.type === "radio" ) {
                        this.findByName( element.name ).addClass( errorClass ).removeClass( validClass );
                    } else {
                        $( element ).addClass( errorClass ).removeClass( validClass );
                    }
                },
                unhighlight: function( element, errorClass, validClass ) {
                    if ( element.type === "radio" ) {
                        this.findByName( element.name ).removeClass( errorClass ).addClass( validClass );
                    } else {
                        $( element ).removeClass( errorClass ).addClass( validClass );
                    }
                }
            },

            // http://jqueryvalidation.org/jQuery.validator.setDefaults/
            setDefaults: function( settings ) {
                $.extend( $.validator.defaults, settings );
            },



            messages: {

                required: "هذا الحقل مطلوب",
                remote: "Please fix this field.",
                email: "الرجاء ادخال عنوان بريد الكتروني صحيح .",
                date: "الرجاء ادخال تاريخ صحيح.",
                dateISO: "Please enter a valid date ( ISO ).",
                number: "Please enter a valid number.",
                digits: "Please enter only digits.",
                creditcard: "Please enter a valid credit card number.",
                equalTo: "الرجاء ادخال نفس قيمة الباسوورد.",
                maxlength: $.validator.format( "Please enter no more than {0} characters." ),
                minlength: $.validator.format( "Please enter at least {0} characters." ),
                rangelength: $.validator.format( "Please enter a value between {0} and {1} characters long." ),
                range: $.validator.format( "Please enter a value between {0} and {1}." ),
                max: $.validator.format( "الرجاء ادخال قيمة اقل او تساوي {0}." ),
                min: $.validator.format( "الرجاء ادخال قيمة اكبر او تساوي {0}." )
            },

        });
    }






</script>
<script>


    $(document).ready(function () {
        $('#clickmewow').click(function () {
            $('#radio1003').attr('checked', 'checked');
        });





        /////////////// Choose Countries & Cities ///////////////
        if($(".country").val() != ''){
            $('.country').change();
        }




        /////////////////////// View Cities ////////////////////
        $(document).on('change','.country',function(e){
            var country_id = $(this).val();
            var url = "{{ url(app()->getLocale().'/getCities/') }}";

            if(country_id){
                $.ajax({
                    type: "GET",
                    url: url+'/'+country_id,
                    success: function (response) {
                        if(response)
                        {
                            $(".city").empty();
                            $(".city").append('<option value="  ">{{__('website.select')}}</option>');
                            $.each(response, function(index, value){
                                $(".city").append('<option value="'+value.id+'">'+ value.name +'</option>');
                            });
                        }
                    }
                });
            }
            else{
                $(".city").empty();
            }
        });









    });


</script>
<script>

    var IDArray = [];
    $("input:checkbox[name=chkBox]:checked").each(function () {
        IDArray.push($(this).val());
    });
    if (IDArray.length == 0) {
        $('.event').attr('disabled', 'disabled');
    }
    $('.chkBox').on('change', function () {
        var IDArray = [];
        $("input:checkbox[name=chkBox]:checked").each(function () {
            IDArray.push($(this).val());
        });
        if (IDArray.length == 0) {
            $('.event').attr('disabled', 'disabled');
        } else {
            $('.event').removeAttr('disabled');
        }
    });
    $('.confirmAll').on('click', function (e) {
        e.preventDefault();
        var action = $(this).data('action');

        var url = "{{ url(getLocal().'/admin/changeStatus/'.Request::segment(3)) }}";
        var csrf_token = '{{csrf_token()}}';
        var IDsArray = [];
        $("input:checkbox[name=chkBox]:checked").each(function () {
            IDsArray.push($(this).val());
        });

        if (IDsArray.length > 0) {
            $.ajax({
                type: 'POST',
                headers: {'X-CSRF-TOKEN': csrf_token},
                url: url,
                data: {action: action, IDsArray: IDsArray, _token: csrf_token},
                success: function (response) {
                    if (response === 'active') {
                        //alert('fsvf');
                        $.each(IDsArray, function (index, value) {
                            $('#label-' + value).removeClass('label-danger');
                            $('#label-' + value).addClass('label-info');
                            $r = '{{app()->getLocale()}}';
                            if($r == 'ar'){
                                $('#label-' + value).text('فعال ');
                            }else{
                                $('#label-' + value).text('active');

                            }
                        });

                        $('#activation').modal('hide');
                    } else if (response === 'not_active') {
                        //alert('fg');
                        $.each(IDsArray, function (index, value) {
                            $('#label-' + value).removeClass('label-info');
                            $('#label-' + value).addClass('label-danger');
                            $r = '{{app()->getLocale()}}';
                            if($r == 'ar'){
                                $('#label-' + value).text('غير فعال');
                            }else{
                                $('#label-' + value).text('Not Active');

                            }
                        });
                        $('#cancel_activation').modal('hide');
                    } else if (response === 'delete') {
                        $.each(IDsArray, function (index, value) {
                            $('#tr-' + value).hide(2000);
                        });
                        $('#deleteAll').modal('hide');
                    }

                    IDArray = [];
                    $("input:checkbox[name=chkBox]:checked").each(function () {
                        $(this).prop('checked', false);
                    });
                     $('.event').attr('disabled', 'disabled');

                },
                fail: function (e) {
                    alert(e);
                }
            });
        } else {
            alert('{{__('cp.not_selected')}}');
        }
    });

    function readURL(input, target) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                target.attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }


    $('#toolsTable').DataTable({
        dom: 'Bfrtip',
        searching: true,
        "oLanguage": {
            "sSearch": "{{__('cp.search')}}"
        },
        bInfo: true, //Dont display info e.g. "Showing 1 to 4 of 4 entries"
        paging: true,//Dont want paging
        bPaginate: true,//Dont want paging
        buttons: [
            'copy', 'excel', 'pdf', 'print'
        ]
    });

    $('.btn--filter').click(function () {
        $('.box-filter-collapse').slideToggle(500);
    });


</script>







<script>
    $(document).ready(function(){
        /////////////////////// View Sub Categories ////////////////////
        $(document).on('change','.main_category',function(e){
            var category_id = $(this).val();
            var url = "{{ url(app()->getLocale().'/getSubCategories/') }}";


            if(category_id){
                $.ajax({
                    type: "GET",
                    url: url+'/'+category_id,
                    success: function (response) {
                        if(response)
                        {
                            $(".sub_category").empty();
                            $(".sub_category").append('<optgroup label="{{__('cp.sub_category')}}">');
                            $.each(response, function(index, value){
                                $(".sub_category").append('<option value="'+value.id+'">'+ value.name +'</option>');
                                $(".sub_category").append('</optgroup>');
                            });
                        }
                    }
                });
            }
            else{
                $(".sub_category").empty();
            }
        });

    });
</script>






@yield('script')
</body>

</html>
