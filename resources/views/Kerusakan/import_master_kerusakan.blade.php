<!doctype html>
@include('template/header')
<body>
  <!-- Begin Page Content -->
<div class="container-fluid">

<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header bg-primary py-3">
        <h6 class="m-0 font-weight-bold text-white">TAMBAH DATA PERHITUNGAN KERUSAKAN DENGAN EXCEL</h6>
      </div>
      <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <div class="form-group">
                    <label >Tambahkan Perhitungan dengan Excel:</label>
                    <input type="file" name="file_excel" class="form-control">
                    </div>
                    <a href="" class="btn btn-success float-left mt-2 mr-2">Submit</a>
                    <a class="btn btn-warning float-left mr-2 mt-2" href="{{url('/view_master_kerusakan')}}" role="button">Kembali</a>
                </thead>
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
