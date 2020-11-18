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
            @can('jenisgedung.create')
              <a class="btn btn-success btn-icon-split" href="{{url('/tambah_master_jenisgedung')}}" role="button">
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
                      <th>Nama Jenis Gedung</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @php $no = 1; @endphp
                  @foreach($kategori as $val)
                    <tr>
                      <td>{{$no++}}</td>
                      <td>{{ $val->nama }}</td>
                      <td>
                        <a class="btn btn-warning mr-1" @can('jenisgedung.update') href="{{ url('edit_master_jenisgedung/'.$val->id) }}" @endcan><i class="button"><span class="icon text-white-100">Edit</span> </i></a>
                        <button class="btn btn-danger" @can('jenisgedung.delete') data-toggle="modal" data-target="#deleteModal" data-id="{{ $val->id }}" id="delete" @endcan><i class="button"><span class="icon text-white-100">Hapus</span></i></button>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
            </table>
            </div>
          </div>
        </div>
      
      <!-- End of Main Content -->

 @include('template/footer')
 <!-- Modal -->
<div class="modal modal-danger fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
  <form action="{{url('hapus_master_jenisgedung')}}" method="post">
    {{ csrf_field() }}
    @method('POST')
    <input type="hidden" id="id_jenis_gedung" name="id">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Hapus Jenis Gedung</h4>
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
    $('#id_jenis_gedung').val(id);
  });
      
</script>