<!doctype html>
@include('template/header')

  <!-- Begin Page Content -->
<div class="container-fluid">

<div class="card shadow mb-4">
  <div class="card-header bg-primary py-3">
    <h6 class="m-0 font-weight-bold text-white">FORMULIR PENILAN KERUSAKAN</h6>
  </div>
  <div class="card-body">

    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <form  enctype="multipart/form-data" action="#" method='post'>
    
            <div class="form-group">
                <label hidden>ID Kerusakan:</label>
                <input type="text" class="form-control" placeholder=""  name="" hidden>
                </div>

            <div class="form-group">
                <label>OPD:</label>
                <input type="text" class="form-control" placeholder="OPD"  name="">
            </div>

            <div class="form-group">
                <label>Nama Bangunan:</label>
                <input type="text" class="form-control" placeholder="Nama Bangunan"  name="">
            </div>

            <div class="form-group">
                <label>Nomer Aset:</label>
                <input type="number" step="0.0000000001" min="0.0000000001" class="form-control" placeholder="0"  name="">
            </div>

            <div class="form-group">
                <label >Alamat:</label>
                <input type="text" class="form-control" placeholder="Alamat" name="">
            </div>  
    
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-3"> 
                        <label>Tanggal Survei :</label>
                        <?php $now = date("Y-m-d") ?>
                        <input class="form-control" value="<?=$now?>" readonly>
                    </div>
                    <div class="col-lg-2"> 
                        <label>Jam</label>
                        <?php
                        date_default_timezone_set('Asia/Jakarta');
                         $now = date("H:i:s a") ?>
                        <input class="form-control" value="<?=$now?>" readonly>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Petugas Survei 1:</label>
                <input type="text" class="form-control" placeholder="Petugas Survei"  name="">
            </div>

            <div class="form-group">
                <label>Petugas Survei 2:</label>
                <input type="text" class="form-control" placeholder="Petugas Survei"  name="">
            </div>

            <div class="form-group">
                <label>Petugas Survei 3:</label>
                <input type="text" class="form-control" placeholder="Petugas Survei"  name="">
            </div>

            <div class="form-group">
                <label>Perwakilan OPD 1:</label>
                <input type="text" class="form-control" placeholder="Perwakilan OPD"  name="">
            </div>

            <div class="form-group">
                <label>Perwakilan OPD 2:</label>
                <input type="text" class="form-control" placeholder="Perwakilan OPD"  name="">
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-lg-2">
                        <label>Luas Bangunan :</label>
                    </div>
                    <div class="col-lg-2">
                        <input type="number" max="10000" step="0.0000000001" min="0.0000000001" class="form-control" placeholder="0"  name="">
                    </div>
                    <div class="col-lg-2">
                        <label>Jumlah lantai :</label>
                    </div>
                    <div class="col-lg-2">
                        <input type="number" max="100" class="form-control" placeholder="0"  name="">
                    </div>
                </div>
            </div>
            <a href="{{url('/view_master_kerusakan')}}" class="btn btn-success float-left mt-2 mr-2">Submit</a>
              <a class="btn btn-warning float-left mt-2" href="{{url('/tambah_master_kerusakan')}}" role="button">Kembali</a>
        </form>
      </table>
    </div>
  </div>
</div>



@include('template/footer')
