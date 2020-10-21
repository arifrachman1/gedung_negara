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
                  <th>ID</th>
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
                  @can('satuan.update')
                    <a class="btn btn-warning" href="{{url('editsatuan')}}"><i class="button"><span class="icon text-white-100">Edit</span> </i></a> | 
                  @endcan
                  @can('satuan.delete')
                    <a class="btn btn-danger" href="#"><i class="button"><span class="icon text-white-100">Hapus</span> </i></a>
                  @endcan
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
</html>