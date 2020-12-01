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
                      <th>No</th>
                      <th>Nama Gedung</th>
                      <th>Legalitas</th>
                      <th>Tipe Pemilik</th>
                      <th>Alas Hak</th>
                      <th>Luas Lahan</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $no = 1; @endphp
                    @foreach($gedung as $val)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $val->nama }}</td>
                      <td>{{ $val->legalitas }}</td>
                      <td>{{ $val->tipe_pemilik }}</td>
                      <td>{{ $val->alas_hak }}</td>
                      <td>{{ $val->luas_lahan }}</td>                      
                      @if($val->kerusakans->count())
                      <td>-</td>
                      @else
                      <td><a class="btn btn-success"  href="{{url('/formulir_kerusakan_surveyor/'.$val->id)}}"><i class="button"><span class="icon text-white-100"></span>Terjadi Kerusakan</i></a></td>
                      @endif
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- <a href="{{ url('/master_kerusakan') }}" class="btn btn-warning float-left mt-2">Kembali</a> -->
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

<!-- @include('template/footer') -->
</body>
