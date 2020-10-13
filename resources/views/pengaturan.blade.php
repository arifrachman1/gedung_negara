<!doctype html>
@include('template/header')

<body>
  <div class="container-fluid">

        <!-- Page Heading -->

        <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header bg-primary py-3">
          <h6 class="m-0 font-weight-bold text-white">PENGATURAN</h6>
      </div>
      <div class="card-body">
        <div class=" py-3">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="nama">Katasandi lama :</label>
            <input type="password" class="form-control form-control-user col-sm-6 mb-3 mb-sm-3" id="nama" placeholder="katasandi lama">
          </div>
          <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="nama">Katasandi baru :</label>
            <input type="password" class="form-control form-control-user col-sm-6 mb-3 mb-sm-3 " id="nama" placeholder="katasandi baru">
          </div>
          <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="nama">Konfirmasi Katasandi baru :</label>
            <input type="password" class="form-control form-control-user col-sm-6 mb-3 mb-sm-3 " id="nama" placeholder="Konfirmasi Katasandi baru">
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
@include('template/footer')
</html>