<?php
$void = 'javascript:void(0)';
$isDashboard = true;
$v2 = isset($useAdminSidebar) ? $useAdminSidebar : false;
?>

@extends('layout')

@section('title')
 @yield('dashboard-title')
@stop

@section('scripts')
  @yield('dashboard-scripts')
@stop

@section('content')
<div id="dashboard">
     <a href="#" class="utf_dashboard_nav_responsive"><i class="fa fa-reorder"></i> Dashboard Sidebar Menu</a>
     @if($v2)
      @include('components.admin-sidebar')
     @else
     @include('components.user-sidebar')
     @endif
     <div class="utf_dashboard_content">
     <div id="titlebar" class="dashboard_gradient">
        <div class="row">
          <div class="col-md-12">
            <h2>@yield('dashboard-title')</h2>
            <nav id="breadcrumbs">
              <ul>
                <li><a href="{{url('/')}}">Home</a></li>
                <li>@yield('dashboard-title')</li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
         @yield('dashboard-content')

         <div class="row">
             <div class="col-md-12">
                 <div class="footer_copyright_part">Copyright &copy; {{date('Y')}}, All Rights Reserved.</div>
             </div>
         </div>
     </div> 
</div>
@stop