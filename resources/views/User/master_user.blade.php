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
              @can('user.create')
                <a href="{{url('tambahuser')}}" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-100">
                        Tambah
                    </span> 
                </a>
              @endcan
            </div>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Username</th>
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @php $no = 1; @endphp
                  @foreach($user as $val)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $val->name }}</td>
                      <td>{{ $val->email }}</td>                      
                        <td>
                         <a class="btn btn-warning mr-1" @can('user.update') href="{{ url('edituser/'.$val->id) }}" @endcan><i class="button"><span class="icon text-white-100">Edit</span> </i></a> 
                         <a class="btn btn-danger" @can('user.delete') href="{{ url('hapususer/'.$val->id) }}" @endcan><i class="button"><span class="icon text-white-100">Hapus</span> </i></a>
                        </td>
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