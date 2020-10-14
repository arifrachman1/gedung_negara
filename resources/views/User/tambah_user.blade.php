<!doctype html>
@include('template/header')

<body>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Tambah Anggota</h1>
          <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Form Tambah Anggota</h6>
                </div>
                <div class="card-body">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                     <label for="nama">Nama :</label>
                      <input type="text" class="form-control form-control-user" id="nama" placeholder="Nama">
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="role">Role :</label>
                  <div class="col form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="role">Admin
                      </label>
                  </div>
                  <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="role">Super Admin
                      </label>
                  </div>
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="telepon">No. Telp:</label>
                      <input type="text" class="form-control form-control" id="nama" placeholder="No. Telp">
                  </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="pwd">Kata Sandi:</label>
                      <input type="password" class="form-control form-control" id="nama" placeholder="Password">
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="pwd">Ulangi Kata Sandi:</label>
                      <input type="password" class="form-control form-control" id="nama" placeholder="Ulangi Password">
                    </div>
                    <hr>
                    <div class="col">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    ||  
                    <a class="btn btn-warning" href="{{url('masteruser')}}" >Kembali</a>
                    </div>
                    </div>
                  </div>
                </div>
          
        <!-- /.container-fluid -->
        </body>
@include('template/footer')
</html>