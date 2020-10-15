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
                  <th>Nama Komponen</th>
                  
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Pondasi</td>
                  <td><a href="{{url('detail_komponen')}}" class="btn btn-primary mr-1">Detail</a> | <a class="btn btn-warning mr-1" href="{{url('edit_komponen')}}"><i class="button"><span class="icon text-white-100">Edit</span> </i></a> | <a class="btn btn-danger" href="#"><i class="button"><span class="icon text-white-100">Hapus</span> </i></a></td>
                </tr>
               
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