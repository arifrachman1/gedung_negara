<!doctype html>
@include('template/header')

<body>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
          <div class="card-header bg-primary py-3">
            <h6 class="m-0 font-weight-bold text-white">DATA ANGGOTA</h6>
          </div>
            <div class="card-body">
            <div class=" py-3">
              @can('user.create')
                <a href="{{url('tambahuser')}}" class="btn btn-success btn-icon-split">
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
                      <th>Username</th>
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @php $no = 1; @endphp
                  @foreach($user as $val)
                    <tr>
                      <td>{{ $no++ }}</td>                      
                      <td>{{ $val->name }}</td>
                      <td>{{ $val->email }}</td>                      
                      <td>
                      @if($val->id == 4 )
                        -
                      @else
                        <a class="btn btn-warning mr-1" @can('user.update') href="{{ url('edituser/'.$val->id) }}" @endcan><i class="button"><span class="icon text-white-100">Edit</span> </i></a> 
                        <button data-toggle="modal" data-target="#deleteModal" data-id="{{ $val->id }}" class="btn btn-danger" id="delete">Hapus</button>
                      @endif
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
        </body>
@include('template/footer')
<div class="modal modal-danger fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
    <form action="{{url('hapususer/'.$val->id)}}" method="post">
      {{ csrf_field() }}
      @method('GET')
      <input type="hidden" id="id_user" name="id">
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
</html>

<script>
 
 $(document).on('click','#delete',function(){
        let id = $(this).attr('data-id');
        console.log(id);
        $('#id_user').val(id);
   });
       
   </script>
