<!doctype html>
@include('template/header')
<body>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
          <div class="card-header bg-primary py-3">
            <h6 class="m-0 font-weight-bold text-white">DATA GEDUNG</h6>
        </div>
            <div class="card-body">
            <div class=" py-3">
                <a href="{{url('tambah_master_gedung')}}" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-100">
                        Tambah
                    </span> 
                </a>
            </div>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nama Gedung</th>
                      <th>Legalitas</th>
                      <th>Tipe Milik</th>
                      <th>Alas Hak</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Tiger Nixon</td>
                      <td>System Architect</td>
                      <td>Edinburgh</td>
                      <td>61</td>
                      <td><a class="btn btn-primary" href="#"><i class="button"><span class="icon text-white-100">Detail</span> </i></a> |<a class="btn btn-warning" href="#"><i class="button"><span class="icon text-white-100">Edit</span> </i></a> | <a class="btn btn-danger" href="#"><i class="button"><span class="icon text-white-100">Hapus</span> </i></a></td>
                    </tr>
                    <tr>
                      <td>Garrett Winters</td>
                      <td>Accountant</td>
                      <td>Tokyo</td>
                      <td>63</td>
                      <td><a class="btn btn-primary" href="#"><i class="button"><span class="icon text-white-100">Detail</span> </i></a> |<a class="btn btn-warning" href="#"><i class="button"><span class="icon text-white-100">Edit</span> </i></a> | <a class="btn btn-danger" href="#"><i class="button"><span class="icon text-white-100">Hapus</span> </i></a></td>
                    </tr>
                    <tr>
                      <td>Ashton Cox</td>
                      <td>Junior Technical Author</td>
                      <td>San Francisco</td>
                      <td>66</td>
                      <td><a class="btn btn-primary" href="#"><i class="button"><span class="icon text-white-100">Detail</span> </i></a> |<a class="btn btn-warning" href="#"><i class="button"><span class="icon text-white-100">Edit</span> </i></a> | <a class="btn btn-danger" href="#"><i class="button"><span class="icon text-white-100">Hapus</span> </i></a></td>
                    </tr>
                    <tr>
                      <td>Cedric Kelly</td>
                      <td>Senior Javascript Developer</td>
                      <td>Edinburgh</td>
                      <td>22</td>
                      <td><a class="btn btn-primary" href="#"><i class="button"><span class="icon text-white-100">Detail</span> </i></a> |<a class="btn btn-warning" href="#"><i class="button"><span class="icon text-white-100">Edit</span> </i></a> | <a class="btn btn-danger" href="#"><i class="button"><span class="icon text-white-100">Hapus</span> </i></a></td>
                    </tr>
                    <tr>
                      <td>Airi Satou</td>
                      <td>Accountant</td>
                      <td>Tokyo</td>
                      <td>33</td>
                      <td><a class="btn btn-primary" href="#"><i class="button"><span class="icon text-white-100">Detail</span> </i></a> |<a class="btn btn-warning" href="#"><i class="button"><span class="icon text-white-100">Edit</span> </i></a> | <a class="btn btn-danger" href="#"><i class="button"><span class="icon text-white-100">Hapus</span> </i></a></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

<!-- @include('template/footer') -->
</body>
