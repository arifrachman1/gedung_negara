<!doctype html>
@include('template/header')
<body>
  <!-- Begin Page Content -->
<div class="container-fluid">

<div class="row">
  <div class="col-md-6">
    <div class="card shadow mb-4">
      <div class="card-header bg-success py-3">
        <h6 class="m-0 font-weight-bold text-white">TAMBAH DATA GEDUNG DENGAN EXCEL</h6>
      </div>
      <div class="card-body">

        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <div class="form-group">
                <label >Input dari Excel:</label>
                <input type="file" name="#" class="form-control">
              </div>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card shadow mb-4">
  <div class="card-header bg-primary py-3">
    <h6 class="m-0 font-weight-bold text-white">TAMBAH DATA GEDUNG</h6>
  </div>
  <div class="card-body">

    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <form  enctype="multipart/form-data" method='post'>

    <div class="form-group">
      <label hidden>Nama Gedung:</label>
      <input type="text" class="form-control" placeholder="Nama Gedung"  hidden>
    </div>
    
    <div class="form-group">
      <label>BT:</label>
      <input type="number" class="form-control" placeholder="0"  name="">
    </div>

    <div class="form-group">
      <label >LS:</label>
      <input type="number" class="form-control" placeholder="0" name="">
    </div>  
    
    <div class="form-group">
      <label>legalitas:</label>
      <input type="text" class="form-control" placeholder="Legalitas"  name="">
    </div>

    <div class="form-group">
      <label>Tipe Milik:</label>
      <input type="text" class="form-control" placeholder="Tipe Milik"  name="">
    </div>

    <div class="form-group">
      <label>Alas Hak:</label>
      <input type="text" class="form-control" placeholder="Alas Hak"  name="">
    </div>

    <div class="form-group">
      <label>Luas Lahan:</label>
      <input type="number" class="form-control" placeholder="0"  name="JmlB">
    </div>

    <div class="form-group">
      <label for="RakB">Rak:</label>
        <select name="RakB" class="form-control">
        @foreach($rak as $val)
            <option value="{{ $val->id_rak }}">{{ $val->nama_rak }}</option>
          @endforeach
        </select>
    </div>  
    <div class="form-group">
      <label>Deskripsi:</label>
      <textarea class="form-control" name="DeskripsiB"></textarea>
    </div>

    <button type="submit"  class="btn btn-primary float-left mt-2">Submit</button>
    <a class="btn btn-danger float-left mt-2" href="{{url('/admin/buku')}}" role="button">Kembali</a>
   
  </form>
        <tbody>
          
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>

<!-- @include('template/footer') -->
</body>
