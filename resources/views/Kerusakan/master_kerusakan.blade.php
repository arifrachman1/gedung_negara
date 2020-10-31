<!doctype html>
@include('template/header')
<body>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
          <div class="card-header bg-primary py-3">
            <h6 class="m-0 font-weight-bold text-white">DATA KERUSAKAN</h6>
        </div>
            <div class="card-body">
            <div class=" py-3">
              @can('kerusakan.create')
                <a class="btn btn-success btn-icon-split" href="{{url('/tambah_master_kerusakan')}}" role="button">
                    <span class="icon text-white-100">
                        Tambah Kerusakan
                    </span> 
                </a>
                <a class="btn btn-info btn-icon-split" href="{{ url('/import_master_kerusakan') }}" role="button">
                    <span class="icon text-white-100">
                      Import Excel
                    </span> 
                </a>
              @endcan
            </div>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nama Gedung</th>
                      <th>Jenis Gedung</th>
                      <th>Lokasi Gedung</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($kerusakan as $val)
                    <tr>
                      <td>{{ $val->nama_gedung }}</td>
                      @if($val->jenis_gd == null)
                      <td>-</td>
                      @else
                      <td>{{ $val->jenis_gd }}</td>
                      @endif
                      <td>{{ $val->alamat }}</td>
                      <td><a class="btn btn-primary float-left mr-2" @can('kerusakan.read') href="{{url('/view_kerusakan')}}" @endcan><i class="button"><span class="icon text-white-100">View</span></i></a>
                          <a class="btn btn-warning float-left mr-2" @can('kerusakan.update') href="{{url('/edit_formulir_penilaian_kerusakan')}}" @endcan><i class="button"><span class="icon text-white-100">Edit</span></i></a> 
                          <a class="btn btn-danger float-left mr-2" @can('kerusakan.create') href="" @endcan><i class="button"><span class="icon text-white-100">Hapus</span> </i></a>
                    </tr>
                    @endforeach
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
