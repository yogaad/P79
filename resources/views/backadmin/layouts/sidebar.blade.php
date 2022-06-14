<!-- BEGIN: Main Menu-->
@php
    $logo = App\Models\Logo::where('name','logo')->first();
@endphp
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="">
                    <span class="brand-logo">
                         <img src="{{ asset('backadmin/images/logo/logoPTP.png')}}">
                    </span>
                    <h2 class="brand-text">P79</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                    <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
           
           
 
             {{-- Master Data --}}
             <li class=" navigation-header"><span data-i18n="Master &amp; Data">Master Data</span><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg></li>
             <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'backadmin.account.') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{route('backadmin.account.index')}}"><i data-feather="users"></i><span class="menu-title text-truncate" data-i18n="users">Account</span></a>
            </li>
             <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'backadmin.transaction.') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{route('backadmin.transaction.index')}}"><i data-feather="shopping-bag"></i><span class="menu-title text-truncate" data-i18n="shopping-bag">Transaction</span></a>
            </li>
            <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'backadmin.point.') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{route('backadmin.point.index')}}"><i data-feather="pocket"></i><span class="menu-title text-truncate" data-i18n="pocket">Point</span></a>
            </li>  
            <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'backadmin.report.') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{route('backadmin.report.index')}}"><i data-feather="printer"></i><span class="menu-title text-truncate" data-i18n="printer">Report</span></a>
            </li>  
        </ul>
    </div>
</div>
<!-- END: Main Menu-->