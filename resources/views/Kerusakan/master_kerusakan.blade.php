<!doctype html>
@include('template/header')
<body>
        <!-- Begin Page Content -->
        <div class="container-fluid">
        <div>
        <div>
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
              @endcan
            </div>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Gedung</th>
                      <th>Jenis Gedung</th>
                      <th>Lokasi Gedung</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @php $no = 1; @endphp
                    @foreach($kerusakan as $val)
                    <tr>
                      <td>{{$no++}}</td>
                      <td>{{ $val->nama_gedung }}</td>
                      @if($val->jenis_gd == null)
                      <td>-</td>
                      @else
                      <td>{{ $val->jenis_gd }}</td>
                      @endif
                      <td>{{ $val->alamat }}</td>
                      <td><a class="btn btn-primary float-left mr-2" @can('kerusakan.read') href="{{url('view_kerusakan/'.$val->id)}}" @endcan><i class="button"><span class="icon text-white-100">View</span></i></a>
                          <a class="btn btn-warning float-left mr-2" @can('kerusakan.update') href="{{url('edit_formulir_penilaian_kerusakan/'.$val->id)}}" @endcan><i class="button"><span class="icon text-white-100">Edit</span></i></a> 
                          <!-- <a class="btn btn-danger float-left mr-2" @can('kerusakan.delete') href="{{url('hapus_kerusakan/'.$val->id)}}" @endcan><i class="button"><span class="icon text-white-100">Hapus</span> </i></a> -->
                          <button data-toggle="modal" @can('kerusakan.delete') data-target="#deleteModal" data-id="{{ $val->id }}" @endcan class="btn btn-danger" id="delete" >Hapus</button>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
      
      <!-- End of Main Content -->
@include('template/footer')
<!-- Modal -->
<div class="modal modal-danger fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
    <form action="{{url('deleteKerusakan')}}" method="post">
      {{ csrf_field() }}
      @method('POST')
      <input type="hidden" id="id_kerusakan" name="id">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Anda yakin ingin menghapus ?</h5>
        </div> 
       <div class="modal-footer">
        <button type=button data-dismiss="modal" class="btn btn-warning">Tidak</button>
        <button type=submit class="btn btn-danger">Ya, hapus</button>
      </div>
    </div>
  </form>
 </div>
</body>



<script>
  $(document).on('click','#delete',function(){
         let id = $(this).attr('data-id');
         console.log(id);
         $('#id_kerusakan').val(id);
    });        
</script>

