<?php
// Start the session
if(isset($_SESSION)){
        // do nothing if the session is set
      }
        else{
          session_start();
        }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Incisive Insights | Telemetry</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


</head>
<body class="hold-transition sidebar-mini layout-fixed text-sm">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{route('home')}}" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li>
      </ul>

      <!-- Right navbar links -->


      <ul class="navbar-nav ml-auto">

<!--  Notifications Dropdown Menu  -->
        <li class="nav-item dropdown">
          <a class="nav-link brand-link" data-toggle="dropdown" href="#">
            <span class="brand-text font-weight-light float-right">Incisive<b>Insights</b></span>
            <img src="{{ asset('dist/img/logo.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-2 float-right"
        style="opacity: .9">

          </a>
<!--           <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">0 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 0 new messages
              <span class="float-right text-muted text-sm">--</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 0 new reports
              <span class="float-right text-muted text-sm">--</span>
            </a>

          </div> -->
        </li>



      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
           <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <!--<img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">-->
          </div>
          <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
          @can('Prop Man')
          <li class="nav-item">
            <a href="{{ route('rap') }}" class="nav-link">

              <p>
               <i class="nav-icon fas fa-chart-pie"></i>Rentals Dashboard

             </p>
           </a>
         </li>
          @endcan

        @can('Prop Agent')
          <li class="nav-item">
            <a href="{{ route('agentsDashboard') }}" class="nav-link">

              <p>
               <i class="nav-icon fas fa-home"></i>Rental Coordinators

             </p>
           </a>
         </li>
          @endcan

          @can('Prop Man')
                <li class="nav-item">
                    <a href="{{ route('prop.properties.available') }}" class="nav-link">

                        <p>
                            <i class="nav-icon fas fa-building"></i>Available Properties

                        </p>
                    </a>
                </li>
            @endcan

           @can('Access Control')
           <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link">

              <p>
               <i class="nav-icon fas fa-chart-pie"></i>Dashboard

             </p>
           </a>
         </li>

         <li class="nav-header">ACCESS CONTROL</li>

         <li class="nav-item has-treeview">
          <a href="{{ asset('pages/calendar.html') }}" class="nav-link">
            <i class="nav-icon fas fa-thermometer-half"></i>
            <p>
              Temperature Scanning
            </p>
            <i class="right fas fa-angle-left"></i>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.rfidtags.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>RFID Tags</p>
              </a>
            </li>

          </ul>
        </li>
        @endcan
        @can('Auto Body Ops')
        <li class="nav-header">AUTO BODY OPS</li>


        <li class="nav-item has-treeview">
          <a href="" class="nav-link">
           <i class="nav-icon fas fa-tools"></i>
           <p>
              Job Cards
            </p>
           <i class="right fas fa-angle-left"></i>
         </a>
         <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('bpm.jobs.index') }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>View Active</p>
            </a>
          </li>

        </ul>
        @can('BPM Admin')
         <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('bpm.jobs.all') }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>View All</p>
            </a>
          </li>

        </ul>
        @endcan
      </li>

      <li class="nav-item has-treeview">
        <a href="" class="nav-link">
          <i class="nav-icon fas fa-car-crash"></i>
          <p>
            Towing Slips
          </p>
          <i class="right fas fa-angle-left"></i>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('abo.towing_slips.index') }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>View All</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('abo.towing_slips.create') }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Create New</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.rfidtags.index') }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Link Vehicles</p>
            </a>
          </li>

        </ul>
      </li>
      @endcan

    @can('Prop Man')
        <li class="nav-header">PROPERTY MANAGEMENT</li>
        <li class="nav-item has-treeview">
          <a href="" class="nav-link">
           <i class="fas fa-house-user"></i>
           <p>
              Task Lists
            </p>
           <i class="right fas fa-angle-left"></i>
         </a>
         <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('bpm.jobs.index') }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>View Active</p>
            </a>
          </li>

        </ul>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('bpm.rap.processing') }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Processing Dashboard</p>
            </a>
          </li>

        </ul>
        @can('BPM Admin')
         <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('bpm.jobs.all') }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>View All</p>
            </a>
          </li>

        </ul>
        @endcan

        @can('Prop Maint')
        <li class="nav-item has-treeview">
            <a href="" class="nav-link">
                <i class="fas fa-house-user"></i>
                <p>
                    Property Maintenance
                </p>
                <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('prop.properties.list') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Property Details</p>
                    </a>
                </li>
            </ul>
        </li>
    @endcan
      </li>

      @endcan
      @can('Company Administrator')
      <li class="nav-header">ADMINISTRATION</li>

      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-sitemap"></i>
          <p>
            Organisation
          </p>
          <i class="right fas fa-angle-left"></i>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('company.company.index') }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Company Details</p>
            </a>
          </li>
          <li class="nav-item">
           <a href="{{ route('company.locations.index') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Locations</p>
          </a>
        </li>
        <li class="nav-item">
         <a href="{{ route('admin.users.index') }}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Users</p>
        </a>
      </li>
      <li class="nav-item">
       <a href="{{ route('admin.rfidtags.index') }}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>RFID Tags</p>
      </a>
    </li>

  </ul>
</li>

<li class="nav-item has-treeview">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-laptop"></i>
    <p>
      Assets
    </p>
    <i class="right fas fa-angle-left"></i>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ route('admin.assets.index') }}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Manage Assets</p>
      </a>
    </li>
    <li class="nav-item">
     <a href="{{ route('admin.asset_categories.index') }}" class="nav-link">
      <i class="far fa-circle nav-icon"></i>
      <p>Asset Categories</p>
    </a>
  </li>
  <li class="nav-item">
   <a href="{{ route('admin.asset_categories.index') }}" class="nav-link">
    <i class="far fa-circle nav-icon"></i>
    <p>Asset Maintenance</p>
  </a>
</li>

</ul>
</li>

</li>
@endcan
@role('Super Admin')
<li class="nav-item has-treeview">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-cog"></i>
    <p>
      Configuration
    </p>
    <i class="right fas fa-angle-left"></i>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ route('admin.permissions.index') }}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Permissions</p>
      </a>
    </li>
    <li class="nav-item">
     <a href="{{ route('admin.roles.index') }}" class="nav-link">
      <i class="far fa-circle nav-icon"></i>
      <p>Roles</p>
    </a>
  </li>
  <li class="nav-item">
   <a href="{{ route('admin.asset_types.index') }}" class="nav-link">
    <i class="far fa-circle nav-icon"></i>
    <p>Asset Types</p>
  </a>
</li>
<li class="nav-item">
 <a href="{{ route('admin.asset_types.index') }}" class="nav-link">
  <i class="far fa-circle nav-icon"></i>
  <p>Maintenance Types</p>
</a>
</li>

</ul>
</li>
@endrole
<li class="nav-header">ACTIONS</li>
<li class="nav-item">
  <a class="nav-link" href="{{ route('logout') }}"
  onclick="event.preventDefault();
  document.getElementById('logout-form').submit();">
  <i class="nav-icon far fa-circle text-danger"></i>
  {{ __('Logout') }}
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
  @csrf
</form>

</li>

</ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
 @yield('content')
 <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>



@stack('scripts')

</body>
</html>
