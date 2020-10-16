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
                <a class="btn btn-success btn-icon-split" href="{{url('/tambah_master_kerusakan')}}" role="button">
                    <span class="icon text-white-100">
                        Tambah Kerusakan
                    </span> 
                </a>
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
                    <tr>
                      <td>SMAN 19 Surabaya</td>
                      <td>Sekolah</td>
                      <td>Jl.Kedungan Cowek NO.390, Tanah Kali Kedinding,kec.Kenjeran,Kota Surabaya</td>
                      <td><a class="btn btn-primary" href="{{url('/view_kerusakan')}}"><i class="button"><span class="icon text-white-100">View</span></i></a>
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
