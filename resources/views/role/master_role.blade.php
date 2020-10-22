<!doctype html>
@include('template/header')

<body>
        <!-- Begin Page Content -->
        <div class="container-fluid">

<!-- Page Heading -->

<!-- DataTales Example -->
      <div class="card shadow mb-4">
      <div class="card-header bg-primary py-3">
        <h6 class="m-0 font-weight-bold text-white">MASTER ROLE</h6>
      </div>
        <div class="card-body">
        <div class=" py-3">
        @can('role.create')
            <a href="{{url('tambahrole')}}" class="btn btn-success btn-icon-split">
                <span class="icon text-white-100">
                    Tambah
                </span> 
                  @if (session('error'))
                    @alert(['type' => 'danger'])
                      {!! session('error') !!}
                    @endalert
                  @endif
            </a> 
          @endcan
        </div>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Role</th>
                  <th>Guard</th>
                  <th>Created At</th>                
                  <th>Opsi</th>                               
                </tr>
              </thead>
              <tbody>
                @php $no = 1; @endphp
                @forelse ($roles as $val)
                  <tr>
                    <td>{{ $no++}}</td>
                    <td>{{ $val->name }}</td>
                    <td>{{ $val->guard_name }}</td>
                    <td>{{ $val->created_at }}</td>                     
                    <td>
                    @can('role.read')
                      <a class="btn btn-info mr-1" href="{{route('role.detail', ['id' => $val->id])}}"><i class="button"><span class="icon text-white-100">Detail</span> </i></a>
                    @endcan

                    @can('role.update')
                      <a class="btn btn-warning mr-1" href="{{route('role.update', ['id' => $val->id])}}"><i class="button"><span class="icon text-white-100">Edit</span> </i></a>
                    @endcan
                    @can('role.delete')
                      <button data-toggle="modal" data-target="#deleteModal" data-id="{{ $val->id }}" class="btn btn-danger" id="delete">Hapus</button>
                    @endcan
                    </td>                                       
                  <tr>
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
        </body>
 
<!-- Modal -->
<div class="modal modal-danger fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
    <form action="{{url('destroy')}}" method="post">
      {{ csrf_field() }}
      @method('POST')
      <input type="hidden" id="id_role" name="id">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Anda yakin ingin menghapus ?</h5>
        </div>
       <div class="modal-footer">
        <button type=button data-dismiss="modal" class="btn btn-primary">Tidak</button>
        <button type=submit class="btn btn-danger">Ya, hapus</button>
      </div>
    </div>
  </form>
 </div>
@include('template/footer')
</html>

<script>
 
  $(document).on('click','#delete',function(){
         let id = $(this).attr('data-id');
         console.log(id);
         $('#id_role').val(id);
    });
        
    </script>
