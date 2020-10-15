<!doctype html>
@include('template/header')

<body>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
          <div class="card-header bg-primary py-3">
            <h6 class="m-0 font-weight-bold text-white">DATA ANGGOTA</h6>
          </div>
            <div class="card-body">
            <div class=" py-3">
                <a href="{{url('tambahuser')}}" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-100">
                        Tambah
                    </span> 
                </a>
            </div>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>Role</th>
                      <th>No. Telp</th>
                      <th>Alamat</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Tiger Nixon</td>
                      <td>Super Admin</td>
                      <td>Edinburgh</td>
                      <td>61</td>
                      <td><a class="btn btn-warning" href="{{url('edituser')}}"><i class="button"><span class="icon text-white-100">Edit</span> </i></a></td>
                    </tr>
                    <tr>
                      <td>Garrett Winters</td>
                      <td>Super Admin</td>
                      <td>Tokyo</td>
                      <td>63</td>
                      <td><a class="btn btn-warning" href="{{url('edituser')}}"><i class="button"><span class="icon text-white-100">Edit</span> </i></a></td>
                    </tr>
                    <tr>
                      <td>Ashton Cox</td>
                      <td>Admin</td>
                      <td>San Francisco</td>
                      <td>66</td>
                      <td><a class="btn btn-warning mr-1" href="{{url('edituser')}}"><i class="button"><span class="icon text-white-100">Edit</span> </i></a>  <a class="btn btn-danger" href="#"><i class="button"><span class="icon text-white-100">Hapus</span> </i></a></td>
                    </tr>
                    <tr>
                      <td>Cedric Kelly</td>
                      <td>Admin</td>
                      <td>Edinburgh</td>
                      <td>22</td>
                      <td><a class="btn btn-warning mr-1" href="{{url('edituser')}}"><i class="button"><span class="icon text-white-100">Edit</span> </i></a>  <a class="btn btn-danger" href="#"><i class="button"><span class="icon text-white-100">Hapus</span> </i></a></td>
                    </tr>
                    <tr>
                      <td>Airi Satou</td>
                      <td>Admin</td>
                      <td>Tokyo</td>
                      <td>33</td>
                      <td><a class="btn btn-warning mr-1" href="{{url('edituser')}}"><i class="button"><span class="icon text-white-100">Edit</span> </i></a>  <a class="btn btn-danger" href="#"><i class="button"><span class="icon text-white-100">Hapus</span> </i></a></td>
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