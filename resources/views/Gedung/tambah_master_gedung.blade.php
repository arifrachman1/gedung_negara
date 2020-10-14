<!doctype html>
@include('template/header')

  <!-- Begin Page Content -->
<div class="container-fluid">

<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header bg-primary py-3">
        <h6 class="m-0 font-weight-bold text-white">TAMBAH DATA GEDUNG DENGAN EXCEL</h6>
      </div>
      <div class="card-body">

        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <div class="form-group">
                <label >Tambahkan dari Excel:</label>
                <input type="file" name="#" class="form-control">
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-6">
                    <label>Kode Provinsi:</label>
                      <select id="select" class="form-control" name="">
                      <option value="0">Lokasi Gedung</option>
                      <option value="1">Option #1</option>
                      <option value="2">Option #2</option>
                      <option value="3">Option #3</option>
                      </select>
                  </div>

                  <div class="col-lg-6">
                    <label>Kode Kabupaten:</label>
                      <select id="select" class="form-control" name="">
                      <option value="0">Lokasi Gedung</option>
                      <option value="1">Option #1</option>
                      <option value="2">Option #2</option>
                      <option value="3">Option #3</option>
                      </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-lg-6">
                    <label>Kode Kecamatan:</label>
                      <select id="select" class="form-control" name="">
                      <option value="0">Lokasi Gedung</option>
                      <option value="1">Option #1</option>
                      <option value="2">Option #2</option>
                      <option value="3">Option #3</option>
                      </select>
                    </div>

                  <div class="col-lg-6">
                    <label>Kode Kelurahan:</label>
                      <select id="select" class="form-control" name="">
                      <option value="0">Lokasi Gedung</option>
                      <option value="1">Option #1</option>
                      <option value="2">Option #2</option>
                      <option value="3">Option #3</option>
                      </select>
                    </div>
                  </div>
                </div>
              <button type="submit"  class="btn btn-primary float-left mt-2">Submit</button>
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
      <label hidden>ID Gedung:</label>
      <input type="text" class="form-control" placeholder="Nama Gedung"  name="" hidden>
    </div>

    <div class="form-group">
      <label>Nama Gedung:</label>
      <input type="text" class="form-control" placeholder="Nama Gedung"  name="">
    </div>

    <div class="form-group">
      <label>Bujur Timur:</label>
      <input type="number" class="form-control" placeholder="0"  name="">
    </div>

    <div class="form-group">
      <label >Lintang Selatan:</label>
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
      <input type="number" class="form-control" placeholder="0"  name="">
    </div>

    <div class="form-group">
      <label>Jumlah Lantai:</label>
      <input type="number" class="form-control" placeholder="0"  name="">
    </div>

    <div class="form-group">
      <label>Luas Bangunan:</label>
      <input type="number" class="form-control" placeholder="0"  name="">
    </div>

    <div class="form-group">
      <label>Tinggi Bangunan:</label>
      <input type="number" class="form-control" placeholder="0"  name="">
    </div>

    <div class="form-group">
      <label>Kelas Tinggi:</label>
      <input type="text" class="form-control" placeholder="Klas Tinggi"  name="">
    </div>

    <div class="form-group">
      <label>Kompleks:</label>
      <input type="text" class="form-control" placeholder="Kompleks"  name="">
    </div>

    <div class="form-group">
      <label>Kepadatan:</label>
      <input type="text" class="form-control" placeholder="kepadatan"  name="">
    </div>

    <div class="form-group">
      <label>Permanensi:</label>
      <input type="text" class="form-control" placeholder="Permanensi"  name="">
    </div>

    <div class="form-group">
      <label>Resiko Kebakar:</label>
      <input type="text" class="form-control" placeholder="Resiko Kebakar"  name="">
    </div>

    <div class="form-group">
      <label>Penangkal:</label>
      <input type="text" class="form-control" placeholder="Penangkal"  name="">
    </div>

    <div class="form-group">
      <label>Struktur Bawah:</label>
      <input type="text" class="form-control" placeholder="Struktur Bawah"  name="">
    </div>

    <div class="form-group">
      <label>Struktur Bangunan:</label>
      <input type="text" class="form-control" placeholder="Struktur Bangunan"  name="">
    </div>

    <div class="form-group">
      <label>Struktur Atap:</label>
      <input type="text" class="form-control" placeholder="Struktur Atap"  name="">
    </div>

    <div class="form-group">
      <div class="row">
        <div class="col-lg-6">
          <label>Kode Provinsi:</label>
            <select id="select" class="form-control" name="">
              <option value="0">Lokasi Gedung</option>
              <option value="1">Option #1</option>
              <option value="2">Option #2</option>
              <option value="3">Option #3</option>
            </select>
        </div>

        <div class="col-lg-6">
          <label>Kode Kabupaten:</label>
            <select id="select" class="form-control" name="">
              <option value="0">Lokasi Gedung</option>
              <option value="1">Option #1</option>
              <option value="2">Option #2</option>
              <option value="3">Option #3</option>
            </select>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="row">
        <div class="col-lg-6">
          <label>Kode Kecamatan:</label>
            <select id="select" class="form-control" name="">
              <option value="0">Lokasi Gedung</option>
              <option value="1">Option #1</option>
              <option value="2">Option #2</option>
              <option value="3">Option #3</option>
            </select>
        </div>

        <div class="col-lg-6">
          <label>Kode Kelurahan:</label>
            <select id="select" class="form-control" name="">
              <option value="0">Lokasi Gedung</option>
              <option value="1">Option #1</option>
              <option value="2">Option #2</option>
              <option value="3">Option #3</option>
            </select>
        </div>
      </div>
    </div>

    <button type="submit"  class="btn btn-primary float-left mt-2">Submit</button>
    <a class="btn btn-warning float-left mt-2" href="{{url('/master_gedung')}}" role="button">Kembali</a>
   
        </form>
        <tbody>
          
        </tbody>
      </table>
    </div>
  </div>
</div>



<!-- @include('template/footer') -->
