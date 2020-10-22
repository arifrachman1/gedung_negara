<!doctype html>
@include('template/header')

<body>
        <!-- Begin Page Content -->
        <div class="container-fluid">

<!-- Page Heading -->

<!-- DataTales Example -->
      <div class="card shadow mb-4">
      <div class="card-header bg-primary py-3">
        <h6 class="m-0 font-weight-bold text-white">MASTER SATUAN</h6>
      </div>
        <div class="card-body">
        <div class=" py-3">
        @can('satuan.create')
            <a href="{{url('tambahsatuan')}}" class="btn btn-success btn-icon-split">
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
                  <th>Nama Satuan</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              @php $no = 1; @endphp
              @foreach($satuan as $val)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $val->nama }}</td>
                  <td>
                 
                    <a class="btn btn-warning" @can('satuan.update') href="{{url('editsatuan/'.$val->id)}}" @endcan><i class="button"><span class="icon text-white-100">Edit</span> </i></a> | 
                    <button @can('satuan.delete') data-toggle="modal" data-target="#deleteModal" @endcan data-id="{{ $val->id }}" class="btn btn-danger" id="delete">Hapus</button>                    
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

<!-- Modal -->
<div class="modal modal-danger fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
    <form action="{{url('deleteSatuan')}}" method="post">
      {{ csrf_field() }}
      @method('POST')
      <input type="hidden" id="id_satuan" name="id">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Anda yakin ingin menghapus ?</h5>
        </div> 
       <div class="modal-footer">
        <button type=button data-dismiss="modal" class="btn btn-danger">Tidak</button>
        <button type=submit class="btn btn-primary">Ya, hapus</button>
      </div>
    </div>
  </form>
 </div>
</div>
</body>
@include('template/footer')
</html>
<script>
 
  $(document).on('click','#delete',function(){
         let id = $(this).attr('data-id');
         console.log(id);
         $('#id_satuan').val(id);
    });
        
    </script>
