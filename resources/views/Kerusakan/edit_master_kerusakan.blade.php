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
            <!-- <div class=" py-3">
                <a class="btn btn-warning btn-icon-split" href="{{url('/master_kerusakan')}}" role="button">
                    <span class="icon text-white-100">
                        Kembali
                    </span> 
                </a>
            </div> -->
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nama Gedung</th>
                      <th>Legalitas</th>
                      <th>Tipe Milik</th>
                      <th>Alas Hak</th>
                      <th>Luas Lahan</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>SMAN 19 Surabaya</td>
                      <td>Legal</td>
                      <td>Negara</td>
                      <td></td>
                      <td>1905</td>
                      <td><a class="btn btn-success" href="{{url('/edit_formulir_penilaian_kerusakan')}}"><i class="button"><span class="icon text-white-100"></span>Terjadi Kerusakan</i></a>
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