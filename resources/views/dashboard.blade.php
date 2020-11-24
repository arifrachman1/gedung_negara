<!doctype html>
@include('template/header')

<body>
        <!-- Begin Page Content -->
<div class="container-fluid">

          <!-- Page Heading -->
  <div class="d-sm-flex align-items-center mb-4 ml-4">
  <img style="widht:100%; height:100px;" class="mr-3 ml-5" src="{{ asset('style/img/5.png') }}">
    <h1 class="h3 mb-0 text-gray-800 san-bold">SI BanGuN <br>SISTEM INFORMASI<br>BANGUNAN GEDUNG NEGARA</h1>
  </div>
  <div class="container mb-4">
    <h5>Dinas Pekerjaan Umum & Penataan Ruang<br>Kabupaten Tuban</h5>
  </div>
<div class="container-fluid mt-3">  
  <div class="card san-no-border mb-3">
    <div class="card-body">
      <div class="card san-bg-1 san-bg-img-3">
        <div class="card-body">
          <h2 class="san-bold san-white">Gedung</h2>
          <h1 class="count san-bold san-white" style="font-size: 72px;">{{$gedung}}</h1>
          <div class="san-overlay">
          </div>
          </div>
      </div>

      <!-- Content Row -->
      <div class="row mt-4">
        <div class="col-sm-4">
          <div class="card san-bg-2 san-bg-img-1 mt-2">
            <div class="card-body">
              <h4 class="san-bold san-white">Kerusakan</h4>
              <h1 class="count san-bold san-white" style="font-size: 32px;">{{$kerusakan}}</h1>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
           <div class="card san-bg-2 san-bg-img-2 mt-2">
            <div class="card-body">
              <h4 class="san-bold san-white">Jenis</h4>
              <h1 class="san-bold san-white" style="font-size: 32px;">{{$jenis}}</h1>
            </div>
          </div>
        </div>
         <div class="col-sm-4">
           <div class="card san-bg-2 san-bg-img-4 mt-2">
            <div class="card-body">
              <h4 class="san-bold san-white">User</h4>
              <h1 class="san-bold san-white" style="font-size: 32px;">{{$user}}</h1>
            </div>
          </div>
        </div>
      </div>
      <!-- /.Content Row -->
    </div>

  </div>
</div>
      <!-- End of Main Content -->
</body>
@include('template/footer')
</html>
