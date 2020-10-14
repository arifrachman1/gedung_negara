<!doctype html>
@include('template/header')

<body>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Edit Role</h1>
          <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Form Edit Role</h6>
                </div>
                <div class="card-body">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                     <label for="nama">Nama Role :</label>
                      <input type="text" class="form-control form-control-user" id="nama" placeholder="Nama">
                  </div>
                    <hr>
                    <div class="col">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    ||  
                    <a class="btn btn-warning" href="{{url('masterrole')}}" >Kembali</a>
                    </div>
                    </div>
                  </div>
                </div>
          
        <!-- /.container-fluid -->
        </body>
@include('template/footer')
</html>