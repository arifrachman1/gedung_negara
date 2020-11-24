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
          <!--<a class="btn btn-secondary btn-icon-split" href="{{ url('export_excel_master_gedung') }}" role="button">
              <span class="icon text-white-100">
                  Export Excel
              </span> 
          </a>-->
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
                <th>No. Seri</th>
                <th>Nama Gedung</th>
                <th>Legalitas</th>
                <th>Tipe Pemilik</th>
                <th>Alas Hak</th>
                <th>Luas lahan</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach($gedung as $val)
              <tr>
                @if ($val->nomor_seri == null)
                <td>-</td>
                @else
                <td>{{ $val->nomor_seri }}</td>
                @endif
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
                  <a class="btn btn-primary mr-1" href="{{ url('detail_master_gedung/'.$val->id) }}"><i class="button"><span class="icon text-white-100">Detail</span> </i></a>
                  <a class="btn btn-warning mr-1" @can('gedung.update') href="{{ url('edit_master_gedung/'.$val->id) }}" @endcan><i class="button"><span class="icon text-white-100">Edit</span> </i></a> 
                  <button class="btn btn-danger" @can('gedung.delete') data-toggle="modal" data-target="#deleteModal" data-id="{{ $val->id }}" id="delete" @endcan><i class="button"><span class="icon text-white-100">Hapus</span></i></button>
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
  
@include('template/footer')

<!-- Modal -->
<div class="modal modal-danger fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
  <form action="{{url('hapus_master_gedung/')}}" method="post">
    {{ csrf_field() }}
    @method('POST')
    <input type="hidden" id="id_gedung" name="id">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Hapus Gedung</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">Apakah anda yakin mau menghapusnya?</div>
          <div class="modal-footer">
            <button type=button data-dismiss="modal" class="btn btn-warning">Tidak</button>
            <button type=submit class="btn btn-danger">Ya, hapus</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div> 

<script>

  $(document).on('click','#delete',function(){
    let id = $(this).attr('data-id');
    console.log(id);
    $('#id_gedung').val(id);
  });
      
</script>


