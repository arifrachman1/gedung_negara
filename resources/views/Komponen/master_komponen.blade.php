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
            <a href="{{url('tambah_komponen')}}" class="btn btn-success btn-icon-split">
                <span class="icon text-white-100">
                    Tambah
                </span> 
            </a>
        </div>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                <th>No</th>
                  <th>Nama Komponen</th>
                  <th>Satuan</th>
                  <th>Bobot</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              @php $no = 1; @endphp
              @foreach($komponen as $val)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $val->nama }}</td>
                  <td>{{ $val->id_satuan }}</td>
                  <td>{{ $val->bobot }}</td>
                  <td>
                    <a href="{{url('detail/'.$val->id)}}" class="btn btn-primary mr-1">Detail</a>
                    <a class="btn btn-warning" href="{{url('edit/'.$val->id)}}"><i class="a"><span class="icon text-white-100">Edit</span> </i></a>                    
                    <a href="" data-toggle="modal" data-id='{{$val->id}}' data-target="#exampleModalCenter" class="btn btn-danger">Remove</a>
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
<div class="modal" id="exampleModalCenter">
   <form action="{{url('delete/'.$val->id)}}" method="get">
      {{ csrf_field() }}
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Anda yankin ingein menghapus ?</h5>
        </div>
       <div class="modal-footer">
        <button type=button data-dismiss="modal" class="btn btn-danger">Tidak</button>
        <button type=submit class="btn btn-primary">Ya, hapus</button>
      </div>
    </div>
  </form>
 </div>
</html>
</body>
@include('template/footer')

