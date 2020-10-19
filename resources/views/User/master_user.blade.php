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
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($user as $val)
                    <tr>
                      <td>{{ $val->name }}</td>
                      <td>{{ $val->email }}</td>
                      <td><a class="btn btn-warning mr-1" href="{{ url('edituser/'.$val->id) }}"><i class="button"><span class="icon text-white-100">Edit</span> </i></a>  <a class="btn btn-danger" href="{{ url('hapususer/'.$val->id) }}"><i class="button"><span class="icon text-white-100">Hapus</span> </i></a></td>
                    </tr>
                  @endforeach
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