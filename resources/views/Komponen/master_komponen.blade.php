<!doctype html>
@include('template/header')

<body>
<div class="container-fluid">

<!-- Page Heading -->

<!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header bg-primary py-3">
          <h6 class="m-0 font-weight-bold text-white">DATA KOMPONEN</h6>
        </div>
        <div class="card-body">
        <div class=" py-3">
        @can('komponen.create')
            <a href="{{url('tambah_komponen')}}" class="btn btn-success btn-icon-split">
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
                  <th>Nama Komponen</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              @php $no = 1; @endphp
              @forelse($komponen as $val)
              
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $val->nama }}</td>
                  <td>
                    <a href="{{url('detail/'.$val->id)}}" class="btn btn-primary mr-1">Detail</a>                
                    <a class="btn btn-warning" @can('komponen.update') href="{{url('edit/'.$val->id)}}" @endcan   ><i class="a"><span class="icon text-white-100">Edit</span> </i></a>                    
                    <button @can('komponen.update') data-toggle="modal" data-target="#deleteModal" @endcan data-id="{{ $val->id }}" class="btn btn-danger" id="delete">Hapus</button>                
                  </td>             
                </tr> 
                @empty
                <tr>
                  <td colspan="5" class="text-center">Tidak ada data</td>
                </tr>
              @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
</div>
<!-- /.container-fluid -->

<!-- Modal -->
<div class="modal modal-danger fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
    <form action="{{url('delete')}}" method="post">
      {{ csrf_field() }}
      @method('POST')
      <input type="hidden" id="id_komponen" name="id">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Hapus Komponen</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
          <div class="modal-body">Jika anda menghapus Komponen ini akan menyebabkan hilangnya data pada Data Kerusakan yang lain.!!! Apakah anda yakin mau menghapusnya?</div>
        <div class="modal-footer">
        <button type=button data-dismiss="modal" class="btn btn-warning">Tidak</button>
        <button type=submit class="btn btn-danger">Ya, hapus</button>
      </div>
    </div>
  </form>
 </div>
</div>
</html>
</body>
@include('template/footer')

 <script>
 
  $(document).on('click','#delete',function(){
         let id = $(this).attr('data-id');
         console.log(id);
         $('#id_komponen').val(id);
    });
        
    </script>


