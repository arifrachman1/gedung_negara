<!doctype html>
@include('template/header')

<body>
<div class="container-fluid">

<!-- Page Heading -->

<!-- DataTales Example -->
      <div class="card shadow mb-4">
      <div class="card-header bg-primary py-3">
        <h6 class="m-0 font-weight-bold text-white">DATA KOMPONEN</h6>
      </div>
        <div class="card-body">
        <div class=" py-3">
            <a href="{{url('tambah_komponen')}}" class="btn btn-success btn-icon-split">
                <span class="icon text-white-100">
                    Tambah
                </span> 
            </a>
        </div>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Nama Komponen</th>
                  <th>Sub Komponen</th>
                  <th>Satuan</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Pondasi</td>
                  <td>Pondasi</td>
                  <td>Estimasi</td>
                  <td><a class="btn btn-warning" href="{{url('edit_komponen')}}"><i class="button"><span class="icon text-white-100">Edit</span> </i></a> | <a class="btn btn-danger" href="#"><i class="button"><span class="icon text-white-100">Hapus</span> </i></a></td>
                </tr>
                <tr>
                  <td>Struktur</td>
                  <td>Kolom</td>
                  <td>Unit</td>
                  <td><a class="btn btn-warning" href="{{url('edit_komponen')}}"><i class="button"><span class="icon text-white-100">Edit</span> </i></a> | <a class="btn btn-danger" href="#"><i class="button"><span class="icon text-white-100">Hapus</span> </i></a></td>
                </tr>
                <tr>
                  <td>Struktur</td>
                  <td>Balok</td>
                  <td>Unit</td>
                  <td><a class="btn btn-warning" href="{{url('edit_komponen')}}"><i class="button"><span class="icon text-white-100">Edit</span> </i></a> | <a class="btn btn-danger" href="#"><i class="button"><span class="icon text-white-100">Hapus</span> </i></a></td>
                </tr>
                <tr>
                  <td>Atap</td>
                  <td>-</td>
                  <td>Persen(%)</td>
                  <td><a class="btn btn-warning" href="{{url('edit_komponen')}}"><i class="button"><span class="icon text-white-100">Edit</span> </i></a> | <a class="btn btn-danger" href="#"><i class="button"><span class="icon text-white-100">Hapus</span> </i></a></td>
                </tr>
                <tr>
                  <td>Dinding</td>
                  <td>Batubata/Partisi</td>
                  <td>Persen(%)</td>
                  <td><a class="btn btn-warning" href="{{url('edit_komponen')}}"><i class="button"><span class="icon text-white-100">Edit</span> </i></a> | <a class="btn btn-danger" href="#"><i class="button"><span class="icon text-white-100">Hapus</span> </i></a></td>
                </tr>
                <tr>
                  <td>Dinding</td>
                  <td>Kaca</td>
                  <td>Unit</td>
                  <td><a class="btn btn-warning" href="{{url('edit_komponen')}}"><i class="button"><span class="icon text-white-100">Edit</span> </i></a> | <a class="btn btn-danger" href="#"><i class="button"><span class="icon text-white-100">Hapus</span> </i></a></td>
                </tr>
                <tr>
                  <td>Dinding</td>
                  <td>Pintu</td>
                  <td>Unit</td>
                  <td><a class="btn btn-warning" href="{{url('edit_komponen')}}"><i class="button"><span class="icon text-white-100">Edit</span> </i></a> | <a class="btn btn-danger" href="#"><i class="button"><span class="icon text-white-100">Hapus</span> </i></a></td>
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