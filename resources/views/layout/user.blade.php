@extends('layout.master')

@section('app')

<div class="layout-container">
    <!-- top navbar-->
    <header class="header-container">
        <nav>
            <ul class="visible-xs visible-sm">
                <li><a id="sidebar-toggler" href="#" class="menu-link menu-link-slide"><span><em></em></span></a></li>
            </ul>
            <ul class="hidden-xs">
                <li><a id="offcanvas-toggler" href="#" class="menu-link menu-link-slide"><span><em></em></span></a></li>
            </ul>
            <h2 class="header-title">@yield('header-title')</h2>
        </nav>
    </header>
    <!-- sidebar-->
    <aside class="sidebar-container">
        <div class="sidebar-header">
            <div class="pull-right pt-lg text-muted hidden"><em class="ion-close-round"></em></div><a href="#" class="sidebar-header-logo"><span class="sidebar-header-logo-text">TAB Member</span></a>
        </div>
        <div class="sidebar-content">
            <div class="sidebar-toolbar text-center"><a href=""><img src="{{ asset('centric/img/user/01.jpg') }}" alt="Profile" class="img-circle thumb64"></a>
                <div class="mt dropdown">
                    <a href="#" style="color:#fff;text-decoration: none;" data-toggle="dropdown" class="dropdown-toggle ripple">
                        <span>{{ auth()->guard('user')->user()->firstname . ' ' . auth()->guard('user')->user()->lastname }}</span> 
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu md-dropdown-menu">
                        <li><a href="{{ url('show_user') }}"><em class="ion-person icon-fw"></em>ข้อมูลส่วนตัว</a></li>
                        <li role="presentation" class="divider"></li>
                        <li><a href="{{ url('logout') }}"><em class="ion-log-out icon-fw"></em>ออกจากระบบ</a></li>
                    </ul>
                </div>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li {{ Request::segment(1) == '' ? 'class=active' : '' }}>
                        <a href="{{ url('/') }}" class="ripple">
                            <span class="nav-icon">
                                <em class="ion-monitor"></em>
                            </span>
                            <span>หน้าแรก</span>
                        </a>
                    </li>
                    <li {{ Request::segment(1) == 'tab_member' && Request::segment(2) != 'create' ? 'class=active' : '' }}>
                        <a href="{{ url('tab_member') }}" class="ripple">
                            <span class="nav-icon">
                                <em class="ion-person"></em>
                            </span>
                            <span>ข้อมูลสมาชิก</span>
                        </a>
                    </li>
                    <li {{ Request::segment(1) == 'tab_member' &&  Request::segment(2) == 'create' ? 'class=active' : '' }}>
                        <a href="{{ route('tab_member.create') }}" class="ripple">
                            <span class="nav-icon">
                                <em class="ion-person-add"></em>
                            </span>
                            <span>ลงทะเบียนสมาชิก</span>
                        </a>
                    </li>
                    <li {{ Request::segment(1) == 'report' ? 'class=active' : '' }}>
                        <a href="{{ url('report') }}" class="ripple">
                            <span class="nav-icon">
                                <em class="ion-ios-paper"></em>
                            </span>
                            <span>รายงาน</span>
                        </a>
                    </li>
                    <li {{ Request::segment(1) == 'import' ? 'class=active' : '' }}>
                        <a href="{{ url('import') }}" class="ripple">
                            <span class="nav-icon">
                                <em class="ion-ios-download"></em>
                            </span>
                            <span>Import</span>
                        </a>
                    </li>
                    @if(auth()->guard('user')->user()->admin)
                    <li {{ Request::segment(1) == 'manage_user' ? 'class=active' : '' }}>
                        <a href="{{ url('manage_user') }}" class="ripple">
                            <span class="nav-icon">
                                <em class="ion-ios-gear"></em>
                            </span>
                            <span>จัดการผู้ใช้</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
    </aside>
    <div class="sidebar-layout-obfuscator"></div>
    <!-- Main section-->
    <main class="main-container">
        <!-- Page content-->
        <section>
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
        <!-- Page footer-->
        <footer>
            <span>Develop & Design by  <a target="_blank" href="http://www.4devstudio.com">4devstudio.com</a></span>
        </footer>
    </main>
</div>

@endsection