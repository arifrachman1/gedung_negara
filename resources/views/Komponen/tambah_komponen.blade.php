<!doctype html>
@include('template/header')

<body>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">TAMBAH KOMPONEN</h1>
          <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Form Tambah Komponen</h6>
                </div>
                <div class="card-body">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                     <label for="komponen">Nama Komponen :</label>
                      <input type="text" class="form-control form-control-user" id="komponen" placeholder="Komponen">
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                     <label for="subkomkonen">Nama Subkomponen :</label>
                      <input type="text" class="form-control form-control-user" id="subkomponen" placeholder="Subkomponen">
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="satuan">Satuan :</label>
                  <div class="col form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="satuan">Estimasi
                      </label>
                  </div>
                  <div class="col form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="satuan">Persen(%)
                      </label>
                  </div>
                  <div class="col form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="satuan">Unit
                      </label>
                  </div>
                  </div>
                    <hr>
                    <div class="col">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                    </div>
                  </div>
                </div>
          
        <!-- /.container-fluid -->
        </body>
@include('template/footer')
</html>