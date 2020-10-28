<!doctype html>
@include('template/header')
<body>
  <!-- Begin Page Content -->
<div class="container-fluid">

<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header bg-primary py-3">
        <h6 class="m-0 font-weight-bold text-white">TAMBAH DATA GEDUNG DENGAN EXCEL</h6>
      </div>
      <div class="card-body">
        <form action="{{ url('import_excel_master_gedung') }}" method="post" enctype="multipart/form-data">
        @csrf
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <div class="form-group">
                  <label >Tambahkan dari Excel:</label>
                  <input type="file" name="file_excel" class="form-control" required>
                </div>
                
                <!-- <div class="form-group">
                  <div class="row">
                    <div class="col-lg-6">
                      <label>Kode Provinsi:</label>
                        <select id="select" class="form-control" name="">
                        <option value="0">Lokasi Gedung</option>
                        <option value="1">Option #1</option>
                        <option value="2">Option #2</option>
                        <option value="3">Option #3</option>
                        </select>
                    </div>

                    <div class="col-lg-6">
                      <label>Kode Kabupaten:</label>
                        <select id="select" class="form-control" name="">
                        <option value="0">Lokasi Gedung</option>
                        <option value="1">Option #1</option>
                        <option value="2">Option #2</option>
                        <option value="3">Option #3</option>
                        </select>
                    </div>
                  </div>
                </div>

              <div class="form-group">
                  <div class="row">
                    <div class="col-lg-6">
                      <label>Kode Kecamatan:</label>
                        <select id="select" class="form-control" name="">
                        <option value="0">Lokasi Gedung</option>
                        <option value="1">Option #1</option>
                        <option value="2">Option #2</option>
                        <option value="3">Option #3</option>
                        </select>
                      </div>

                    <div class="col-lg-6">
                      <label>Kode Kelurahan:</label>
                        <select id="select" class="form-control" name="">
                        <option value="0">Lokasi Gedung</option>
                        <option value="1">Option #1</option>
                        <option value="2">Option #2</option>
                        <option value="3">Option #3</option>
                        </select>
                      </div>
                    </div>
                  </div>
              </div> -->
                <button type="submit"  class="btn btn-success float-left mr-2 mt-2">Submit</button>
                <a class="btn btn-warning float-left mr-2 mt-2" href="{{url('/master_gedung')}}" role="button">Kembali</a>
            </table>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>


<!-- @include('template/footer') -->
</body>
