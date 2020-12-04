<!doctype html>
@include('template/header')

  <!-- Begin Page Content -->
<div class="container-fluid">

    <div class="card shadow mb-4">
    <div class="card-header bg-primary py-3">
        <h6 class="m-0 font-weight-bold text-white">EDIT FORMULIR PENILAIAN KERUSAKAN</h6>
    </div>
    <div class="card-body">

        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <form  enctype="multipart/form-data" action="{{ url('post_edit_formulir_surveyor') }}" method='post'>
                @csrf
                <div class="form-group"><input type="hidden" class="form-control" value="{{ $kerusakan->id_kerusakan }}" name="id_kerusakan"></div>

                <div class="form-group"><input type="hidden" class="form-control" value="{{ $kerusakan->id_gedung }}" name="id_gedung"></div>

                <div class="form-group">
                    <label>OPD:</label>
                    <input type="text" class="form-control" value="{{ $kerusakan->opd }}" name="opd">
                </div>

                <div class="form-group">
                    <label>Nama Bangunan:</label>
                    <input type="text" class="form-control" value="{{ $kerusakan->nama_gedung }}" name="nama_gedung" readonly>
                </div>

                <div class="form-group">
                    <label>Nomor Aset:</label>
                    <input type="text" class="form-control" value="{{ $kerusakan->nomor_aset }}" name="nomor_aset">
                </div>

                <div class="form-group">
                    <label >Alamat:</label>
                    <input type="text" class="form-control" value="{{ $kerusakan->alamat }}" name="alamat" readonly>
                </div>  
        
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3"> 
                            <label>Tanggal Survei :</label>
                            <?php $now = date("Y-m-d") ?>
                            <input class="form-control" value="{{ substr($kerusakan->tanggal, 0, -9) }}" name="tanggal" readonly>
                        </div>
                        <div class="col-lg-2"> 
                            <label>Jam</label>
                                <?php
                                date_default_timezone_set('Asia/Jakarta');
                                $now = date("H:i:s") ?>
                                <input class="form-control" value="{{ substr($kerusakan->tanggal, -8) }}" name="jam" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Petugas Survei 1:</label>
                    <input type="text" class="form-control" value="{{ $kerusakan->petugas_survei1 }}" name="petugas_survei1">
                </div>

                <div class="form-group">
                    <label>Petugas Survei 2:</label>
                    <input type="text" class="form-control" value="{{ $kerusakan->petugas_survei2 }}" name="petugas_survei2">
                </div>

                <div class="form-group">
                    <label>Petugas Survei 3:</label>
                    <input type="text" class="form-control" value="{{ $kerusakan->petugas_survei3 }}" name="petugas_survei3">
                </div>

                <div class="form-group">
                    <label>Perwakilan OPD 1:</label>
                    <input type="text" class="form-control" value="{{ $kerusakan->perwakilan_opd1 }}" name="perwakilan_opd1">
                </div>

                <div class="form-group">
                    <label>Perwakilan OPD 2:</label>
                    <input type="text" class="form-control" value="{{ $kerusakan->perwakilan_opd2 }}" name="perwakilan_opd2">
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-2">
                            <label>Luas Bangunan :</label>
                        </div>
                        <div class="col-lg-2">
                            <input type="number" max="10000" step="0.0000000001" min="0.0000000001" class="form-control" value="{{ $kerusakan->luas }}" name="luas" readonly>
                        </div>
                        <div class="col-lg-2">
                            <label>Jumlah lantai :</label>
                        </div>
                        <div class="col-lg-2">
                            <input type="number" max="100" class="form-control" value="{{ $kerusakan->jml_lantai }}" name="jml_lantai" readonly>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success float-left mt-2 mr-2">Selanjutnya</button>
                <a class="btn btn-warning float-left mt-2" href="{{url('/master_kerusakan')}}" role="button">Kembali</a>
            </form>
        </table>
        </div>
    </div>
    </div>



@include('template/footer')
