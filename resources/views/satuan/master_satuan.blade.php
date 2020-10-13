<!doctype html>
@include('template/header')

<body>
        <!-- Begin Page Content -->
        <div class="container-fluid">

<!-- Page Heading -->

<!-- DataTales Example -->
      <div class="card shadow mb-4">
      <div class="card-header bg-primary py-3">
        <h6 class="m-0 font-weight-bold text-white">MASTER SATUAN</h6>
      </div>
        <div class="card-body">
        <div class=" py-3">
            <a href="{{url('tambahsatuan')}}" class="btn btn-success btn-icon-split">
                <span class="icon text-white-100">
                    Tambah
                </span> 
            </a>
        </div>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nama Satuan</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Estimasi</td>
                  <td><a class="btn btn-warning" href="{{url('editsatuan')}}"><i class="button"><span class="icon text-white-100">Edit</span> </i></a> | <a class="btn btn-danger" href="#"><i class="button"><span class="icon text-white-100">Hapus</span> </i></a></td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>%</td>
                  <td><a class="btn btn-warning" href="{{url('editsatuan')}}"><i class="button"><span class="icon text-white-100">Edit</span> </i></a> | <a class="btn btn-danger" href="#"><i class="button"><span class="icon text-white-100">Hapus</span> </i></a></td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Unit</td>
                  <td><a class="btn btn-warning" href="{{url('editsatuan')}}"><i class="button"><span class="icon text-white-100">Edit</span> </i></a> | <a class="btn btn-danger" href="#"><i class="button"><span class="icon text-white-100">Hapus</span> </i></a></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      </div>
        <!-- /.container-fluid -->
        </body>
@include('template/footer')
</html>