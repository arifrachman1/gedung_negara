<!doctype html>
@include('template/header')

<body>
        <!-- Begin Page Content -->
        <div class="container-fluid">

<!-- Page Heading -->

<!-- DataTales Example -->
      <div class="card shadow mb-4">
      <div class="card-header bg-primary py-3">
        <h6 class="m-0 font-weight-bold text-white">MASTER ROLE</h6>
      </div>
        <div class="card-body">
        <div class=" py-3">
            <a href="{{url('tambahrole')}}" class="btn btn-success btn-icon-split">
                <span class="icon text-white-100">
                    Tambah
                </span> 
                  @if (session('error'))
                    @alert(['type' => 'danger'])
                      {!! session('error') !!}
                    @endalert
                  @endif
            </a>
      <form role="form" action="" method="POST">
             @csrf
        </div>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Role</th>
                  <th>Guard</th>
                  <th>Created At</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                @php $no = 1; @endphp
                @forelse ($role as $val)
                  <tr>
                    <td>{{ $no++}}</td>
                    <td>{{ $val->name }}</td>
                    <td>{{ $val->guard_name }}</td>
                    <td>{{ $val->created_at }}</td>
                    <td>
                      <a class="btn btn-warning mr-1" href="{{url('editrole')}}"><i class="button"><span class="icon text-white-100">Edit</span> </i></a>  <a class="btn btn-danger" href="#"><i class="button"><span class="icon text-white-100">Hapus</span> </i></a>
                    </td>
                  <tr>
                  @empty
                    <tr>
                      <td colspan="5" class="text-center">Tidak ada data</td>
                    </tr>
                @endforelse  
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