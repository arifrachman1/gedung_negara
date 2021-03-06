<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Gedung Negara</title>

  <!-- {{ asset('style/') }} -->
  <!-- <link rel="shortcut icon" href="{{ asset('style/img/1.jpg') }}"> -->
  
  <!-- Custom fonts for this template-->
  <link href="{{ asset('style/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- Custom styles for this template-->
  <link href="{{ asset('style/css/sb-admin-2.min.css') }}" rel="stylesheet">
  <link href="{{ asset('style/css/san.css') }}" rel="stylesheet">
  <link href="{{ asset('style/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/dashboard')}}">
        <div class="sidebar-brand-text mx-3">GEDUNG NEGARA</div>
      </a>

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="{{url('/dashboard')}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Beranda</span></a>
      </li>

      @can('role.read')
      <li class="nav-item">
        <a class="nav-link" href="{{url('/masterrole')}}">
          <i class="fas fa-fw fa-key"></i>
          <span>Master Role</span></a>
      </li>
      @endcan
      @can('user.read')
      <li class="nav-item">
        <a class="nav-link" href="{{url('/masteruser')}}">
          <i class="fas fa-fw fa-users"></i>
          <span>Master User</span></a>
      </li>
      @endcan
      <!-- Nav Item - Pages Collapse Menu -->
     
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-building"></i>
          <span>Master Gedung</span>
        </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Master Gedung:</h6>
              @can('jenisgedung.read')<a class="collapse-item" href="{{url('master_jenisgedung')}}">Jenis Gedung</a> @endcan
              @can('gedung.read')<a class="collapse-item" href="{{url('master_gedung')}}">Gedung</a> @endcan
            </div>
          </div>
      </li>
     
      <!-- Nav Item - Utilities Collapse Menu -->
      @can('satuan.read')
      <li class="nav-item">
        <a class="nav-link" href="{{url('mastersatuan')}}">
          <i class="fas fa-fw fa-unity"></i>
          <span>Master Satuan</span></a>
      </li>
      @endcan
      @can('komponen.read')
      <li class="nav-item">
        <a class="nav-link" href="{{url('/masterkomponen')}}">
          <i class="fas fa-fw fa-boxes"></i>
          <span>Master Komponen</span></a>
      </li>
      @endcan
      @can('kerusakan.read')
      <li class="nav-item">
        <a class="nav-link" href="{{url('master_kerusakan')}}">
          <i class="fas fa-fw fa-house-damage"></i>
          <span>Master Kerusakan</span></a>
      </li>
      @endcan
      <li class="nav-item">
        <a class="nav-link" href="{{url('profil')}}">
        <i class="fa fa-cog" aria-hidden="true"></i>
          <span>Pengaturan</span></a>
      </li>

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>


          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
            
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
            <a class="dropdown-item" href="{{ route('logout') }}" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Keluar
                </a>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
