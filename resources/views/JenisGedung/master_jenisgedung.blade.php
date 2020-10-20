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
                      <td><a class="btn btn-warning" href="{{ url('edit_master_jenisgedung/'.$val->id) }}"><i class="button"><span class="icon text-white-100">Edit</span> </i></a> | <a data-toggle="modal" data-target="#delete" class="btn btn-danger" href="#"><i class="button"><span class="icon text-white-100">Hapus</span> </a></span> </i></a></td>
                    </tr>
                            <div class="modal fade" id="delete" role="dialog">
                                <div class="modal-dialog">

                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Hapus Jenis Gedung</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <div class="modal-body">Jika anda menghapus Jenis Gedung ini akan menyebabkan hilangnya data pada Data Gedung yang lain.!!! Apakah anda yakin mau menghapusnya?

                                        </div>
                                        <div class="modal-footer">
                                            <a class="btn btn-danger" href="{{ url('hapus_master_jenisgedung/'.$val->id) }}"><i class="button"><span class="icon text-white-100">Hapus</span> </a> </div>
                                    </div>
                  @endforeach
                  </tbody>
            </table>
            </div>
          </div>
        </div>
      
      <!-- End of Main Content -->

</body>
 @include('template/footer')
 </html>