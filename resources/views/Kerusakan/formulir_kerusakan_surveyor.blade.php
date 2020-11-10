<!doctype html>
@include('template/header')

  <!-- Begin Page Content -->
<div class="container-fluid">

<div class="card shadow mb-4">
  <div class="card-header bg-primary py-3">
    <h6 class="m-0 font-weight-bold text-white">FORMULIR PENILAIAN KERUSAKAN</h6>
  </div>
  <div class="card-body">

    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <form  enctype="multipart/form-data" action="{{ url('post_formulir_surveyor') }}" method='post'>
            @csrf
            <div class="form-group">
                <div class="form-group">
                    <label>OPD:</label>
                    <input type="text" class="form-control" placeholder="OPD"  name="" required>
                </div>

                <div class="form-group">
                    <label>Nama Bangunan:</label>
                    <input type="text" class="form-control" placeholder="Nama Bangunan"  name="nama_gedung" value="{{ $input->nama }}" readonly>
                    <input type="hidden" name="id_gedung" value="{{ $input->id }}">
                </div>

                <div class="form-group">
                    <label>Nomor Aset:</label>
                    <input type="text" class="form-control" placeholder="Nomor Aset" name="" required>
                </div>

                <div class="form-group">
                    <label >Alamat:</label>
                    <input type="text" class="form-control" placeholder="Alamat" name="alamat" value="{{ $input->alamat }}" readonly>
                </div>  
        
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3"> 
                            <label>Tanggal Survei :</label>
                            @php $now = date("Y-m-d") @endphp
                            <input class="form-control" value="<?=$now?>" name="tanggal" readonly>
                        </div>
                        <div class="col-lg-2"> 
                            <label>Jam : </label>
                            @php $time = date("H:i:s") @endphp
                            <input class="form-control" value="<?=$time?>" name="jam" readonly>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="id_user" value="{{ $surveyor->id }}">

                <div class="form-group">
                    <label>Petugas Survei 1:</label>
                    <input type="text" class="form-control" placeholder="Petugas Survei"  name="surveyor[]">
                </div>

                <div class="form-group">
                    <label>Petugas Survei 2:</label>
                    <input type="text" class="form-control" placeholder="Petugas Survei"  name="surveyor[]">
                </div>

                <div class="form-group">
                    <label>Petugas Survei 3:</label>
                    <input type="text" class="form-control" placeholder="Petugas Survei"  name="surveyor[]">
                </div>

                <div class="form-group">
                    <label>Perwakilan OPD 1:</label>
                    <input type="text" class="form-control" placeholder="Perwakilan OPD"  name="pwopd[]">
                </div>

                <div class="form-group">
                    <label>Perwakilan OPD 2:</label>
                    <input type="text" class="form-control" placeholder="Perwakilan OPD"  name="pwopd[]">
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-2">
                            <label>Luas Bangunan :</label>
                        </div>
                        <div class="col-lg-2">
                            <input type="number" max="10000" step="0.0000000001" min="0.0000000001" class="form-control" placeholder="0" name="luas_bg" value="{{ $input->luas }}" readonly>
                        </div>
                        <div class="col-lg-2">
                            <label>Jumlah lantai :</label>
                        </div>
                        <div class="col-lg-2">
                            <input type="number" max="100" class="form-control" placeholder="0"  name="jml_lantai" value="{{ $input->jumlah_lantai }}" readonly>
                        </div>
                    </div>
                </div>
                <!-- <a href="{{url('/view_master_kerusakan')}}" class="btn btn-success float-left mt-2 mr-2">Submit</a> -->
                <button type="submit" class="btn btn-success float-left mt-2 mr-2">Submit</button>
                <a class="btn btn-warning float-left mt-2" href="{{url('/tambah_master_kerusakan')}}" role="button">Kembali</a>
            </div>        
        </form>
      </table>
    </div>
  </div>
</div>



@include('template/footer')
