<!DOCTYPE html>
<html class="loading bordered-layout" lang="en" data-layout="bordered-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Padepokan 79">
    <meta name="keywords" content="Pelamaran">
    <meta name="author" content="PENTACODE">
    <title>Padepokan 79 | {{ $title ?? '' }}</title>
    <link rel="apple-touch-icon" href="{{ asset('backadmin/theme/images/ico/apple-icon-120.png') }}">
    @php
        $fav = App\Models\Logo::where('name','logofavicon')->first();
    @endphp
    <link rel="shortcut icon" type="image/x-icon" href="{{ $fav ? asset('storage/logo/'.$fav->file) : asset('backadmin/images/logo/fsavicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backadmin/theme/vendors/css/extensions/toastr.min.css') }}">
    @yield('vendor-css')
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/css/themes/semi-dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/css/themes/bordered-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/css/plugins/extensions/ext-component-toastr.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/app/css/style.css') }}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern navbar-floating footer-static menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="">
    <!-- BEGIN: Header-->
    {{-- <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-fixed navbar-shadow navbar-brand-center">
         <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
                </ul>
                <ul class="nav navbar-nav">
                    <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>
                </ul>
            </div>
            <ul class="nav navbar-nav align-items-center ml-auto">
                <li class="nav-item dropdown dropdown-user">
                    <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none">
                        </div>
                        <span class="avatar">
                            <img class="round" src="{{ asset('backadmin/app/img/avatar.jpg') }}" alt="avatar" height="40" width="40">
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="{{ route('backadmin.auth.logout') }}"><i class="mr-50" data-feather="power"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav> --}}
    <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
                </ul>
                <ul class="nav navbar-nav">
                    <li class="nav-item d-none d-lg-block">
                        <a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>
                </ul>
            </div>
            <ul class="nav navbar-nav align-items-center ml-auto">
                <li class="nav-item dropdown dropdown-user">
                    <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none">
                            <span class="user-name font-weight-bolder"> </span>
                            <span class="user-status"> </span>
                        </div>
                        <span class="avatar">
                            <img class="round" src="{{ asset('backadmin/app/img/avatar.jpg') }}" alt="avatar" height="40" width="40">
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                       
                    
                        <a class="dropdown-item" href="{{ route('backadmin.auth.logout') }}"><i class="mr-50" data-feather="power"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- END: Header-->

    <div class="modal fade" id="modal-logo" tabindex="-1" role="dialog" aria-labelledby="modalLogo" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalLogo">Upload Image</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('backadmin.users.logo')}}" enctype="multipart/form-data" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="logo">Logo</label>
                            <input type="file" name="logo"  class="form-control required" placeholder="masukan file">
                        </div>
                        <div class="form-group">
                            <label for="logologin">Logo Login</label>
                            <input type="file" name="logologin"   class="form-control required" placeholder="masukan file">
                        </div>
                        <div class="form-group">
                            <label for="logofavicon">logo favicon</label>
                            <input type="file" name="logofavicon"  class="form-control required" placeholder="masukan file">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-primary">Ubah</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('backadmin.layouts.sidebar')

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">{{ $title }}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    @yield('breadcrumb')
                                    <li class="breadcrumb-item active {{ isset($subtitle) ? 'control-breadcumb' : ''}}">{{ $subtitle??$title }}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-right col-12 mt-2 mt-md-0">
                    <div class="form-group breadcrumb-right d-flex d-md-block align-items-center justify-content-end">
                        @yield('action')
                    </div>
                </div>
            </div>

            <div class="content-body">
                @yield('content')
                <!--/ Kick start -->
            </div>
            <div class="content-header-right text-md-right col-12">
                <div class="form-group breadcrumb-right d-flex d-md-block align-items-center justify-content-between">
                    @yield('actions')
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
    <style>
        .loading-container {
            position: fixed;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            left: 0;
            top: 0;
            z-index: 99999;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
    
    <div class="loading-container">
        <div>
            <div>
                <img src="{{ asset('backadmin/images/logo/logoPTP.png') }}" style="width: 150px" />
            </div>
            <div style="text-align: center">
                <img src="{{ asset('backadmin/images/30.svg') }}" style="width: 150px; margin-top: 10px" />
            </div>
        </div>
    </div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">Copyright &copy; 2022<a class="ml-25" href="javascript:void(0)" target="_blank">Padepokan 79</a></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->

    @stack('modal')

    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('backadmin/theme/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('backadmin/theme/vendors/js/extensions/toastr.min.js') }}"></script>
    <script src="{{ asset('backadmin/theme/vendors/js/extensions/moment.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    @yield('vendor-js')
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('backadmin/theme/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('backadmin/theme/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->
    
    @include('backadmin.layouts.toastr')


    @stack('page-js-before')

    <!-- BEGIN: Page JS-->
    @stack('page-js')
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            $('.loading-container').hide();
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
<!-- END: Body-->

</html>
