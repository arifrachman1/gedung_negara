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
            <div class=" py-3">
                <a class="btn btn-success btn-icon-split" href="{{ url('tambah_master_gedung') }}" role="button">
                  @can('gedung.create')
                    <span class="icon text-white-100">
                        Tambah
                    </span> 
                  @endcan
                </a>
                <a class="btn btn-info btn-icon-split" href="{{ url('tambah_excel_master_gedung') }}" role="button">
                @can('excel.import')
                    <span class="icon text-white-100">
                        Import Excel
                    </span> 
                  @endcan
                </a>
                <a class="btn btn-secondary btn-icon-split" href="{{ url('export_excel_master_gedung') }}" role="button">
                @can('excel.Export')
                    <span class="icon text-white-100">
                        Export Excel
                    </span> 
                  @endcan
                </a>
                <a class="btn btn-secondary btn-icon-split" href="{{ url('export_pdf_master_gedung') }}" role="button">
                    <span class="icon text-white-100">
                        Export PDF
                    </span> 
                </a>
            </div>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <td>No</th>
                      <th>Nama Gedung</th>
                      <th>Legalitas</th>
                      <th>Tipe Pemilik</th>
                      <th>Alas Hak</th>
                      <th>Luas lahan</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @php $no = 1; @endphp
                  @foreach($gedung as $val)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $val->nama }}</td>
                      @if ($val->legalitas == null)
                      <td>-</td>
                      @else
                      <td>{{ $val->legalitas }}</td>
                      @endif
                      @if ($val->tipe_pemilik == null)
                      <td>-</td>
                      @else
                      <td>{{ $val->tipe_pemilik }}</td>
                      @endif
                      @if ($val->alas_hak == null)
                      <td>-</td>
                      @else
                      <td>{{ $val->alas_hak }}</td>
                      @endif
                      @if ($val->luas_lahan == null)
                      <td>-</td>
                      @else
                      <td>{{ $val->luas_lahan }}</td>
                      @endif
                      <td>
                        <a class="btn btn-primary" href="{{ url('detail_master_gedung/'.$val->id) }}"><i class="button"><span class="icon text-white-100">Detail</span> </i></a>
                       |<a class="btn btn-warning" @can('gedung.update') href="{{ url('edit_master_gedung/'.$val->id) }}" @endcan><i class="button"><span class="icon text-white-100">Edit</span> </i></a> 
                       |<a class="btn btn-danger" @can('gedung.delete') href="{{ url('hapus_master_gedung/'.$val->id) }}" @endcan><i class="button"><span class="icon text-white-100">Hapus</span></i></a></td>
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