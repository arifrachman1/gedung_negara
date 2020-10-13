<!doctype html>
@include('template/header')
<body>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
          <div class="card-header bg-primary py-3">
            <h6 class="m-0 font-weight-bold text-white">DATA JENIS GEDUNG</h6>
        </div>
            <div class="card-body">
            <div class=" py-3">
                <a class="btn btn-success btn-icon-split" href="{{url('/tambah_master_jenisgedung')}}" role="button">
                    <span class="icon text-white-100">
                        Tambah
                    </span> 
                </a>
            </div>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nama Jenis Gedung</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($kategori as $val)
                    <tr>
                      <td>{{ $val->nama }}</td>
                      <td><a class="btn btn-warning" href="{{ url('edit_master_jenisgedung/'.$val->id) }}"><i class="button"><span class="icon text-white-100">Edit</span> </i></a> | <a class="btn btn-danger" href="{{ url('hapus_master_jenisgedung/'.$val->id) }}"><i class="button"><span class="icon text-white-100">Hapus</span> </i></a></td>
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