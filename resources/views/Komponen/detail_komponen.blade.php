<!doctype html>
@include('template/header')
<body>
<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="card shadow mb-4">
    <div class="card-header bg-primary py-3">
      <h6 class="m-0 font-weight-bold text-white">DETAIL DATA KOMPONEN</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <th>Sub Komponen</th>
            <th>Satuan</th>
            <th>Bobot</th>
          </thead>
          <tbody>
            <tr>
              <td>Kolom</td>
              <td>Unit</td>
              <td></td>
            </tr>
            <tr>
              <td>Balok</td>
              <td>Unit</td>
              <td></td>
            </tr>
            <tr>
              <td>Pelat</td>
              <td>Unit</td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
      <a class="btn btn-warning float-left mt-2" href="{{url('/masterkomponen')}}" role="button">Kembali</a>
    </div>
  </div>

</div>
                    

@include('template/footer')
</body>
