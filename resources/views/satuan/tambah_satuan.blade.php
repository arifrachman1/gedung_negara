<!doctype html>
@include('template/header')

<body>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Tambah Satuan</h1>
          <form action="{{url('inputsatuanpost')}}" method="post">
              @csrf
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Tambah Satuan</h6>
              </div>
              <div class="card-body">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="nama">Nama :</label>
                  <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama" required>
                </div><hr>
                  <div class="col">
                    <button type="submit" class="btn btn-success mr-1">Simpan</button>                      
                    <a class="btn btn-warning" href="{{url('mastersatuan')}}" >Kembali</a>
                  </div>
                </div>
              </div>
            </div>
          </form>
          
        <!-- /.container-fluid -->
        </body>
@include('template/footer')
</html>