<!doctype html>
@include('template/header')
<body>
<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="card shadow mb-4">
    <div class="card-header bg-primary py-3">
      <h6 class="m-0 font-weight-bold text-white">DETAIL DATA GEDUNG</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            @csrf
                    <div class="container p-3 my-3 row">
                        <div class="card">
                            <div class="card-header">
                                Nama Gedung : {{ $detail_gedung->nama }}
                            </div>
                            <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    Jenis Gedung   
                                </div>
                                <div class="col-sm-8">
                                    : {{ $detail_gedung->nama_kat }}
                                </div>
                                <div class="col-sm-4">
                                    Bujur Timur   
                                </div>
                                <div class="col-sm-8">
                                    : {{ $detail_gedung->bujur_timur }}
                                </div>
                                <div class="col-sm-4">
                                    Lintang Selatan   
                                </div>
                                <div class="col-sm-8">
                                    : {{ $detail_gedung->lintang_selatan }}
                                </div>
                                <div class="col-sm-4">
                                    Legalitas  
                                </div>
                                <div class="col-sm-8">
                                    : {{ $detail_gedung->legalitas }}
                                </div>
                                <div class="col-sm-4">
                                    Tipe Milik  
                                </div>
                                <div class="col-sm-8">
                                    : {{ $detail_gedung->tipe_milik }}
                                </div>
                                <div class="col-sm-4">
                                    Alas Hak   
                                </div>
                                <div class="col-sm-8">
                                    : {{ $detail_gedung->alas_hak }}
                                </div>
                                <div class="col-sm-4">
                                    Luas lahan   
                                </div>
                                <div class="col-sm-8">
                                    : {{ $detail_gedung->luas_lahan }}
                                </div>
                                <div class="col-sm-4">
                                    Jumlah Lantai   
                                </div>
                                <div class="col-sm-8">
                                    : {{ $detail_gedung->jumlah_lantai }}
                                </div>
                                <div class="col-sm-4">
                                    Luas Bangunan   
                                </div>
                                <div class="col-sm-8">
                                    : {{ $detail_gedung->luas }}
                                </div>
                                <div class="col-sm-4">
                                    Tinggi Bangunan   
                                </div>
                                <div class="col-sm-8">
                                    : {{ $detail_gedung->tinggi }}
                                </div>
                                <div class="col-sm-4">
                                    Kelas Tinggi   
                                </div>
                                <div class="col-sm-8">
                                    : {{ $detail_gedung->kelas_tinggi }}
                                </div>
                                <div class="col-sm-4">
                                    Kompleks   
                                </div>
                                <div class="col-sm-8">
                                    : {{ $detail_gedung->kompleks }}
                                </div>
                                <div class="col-sm-4">
                                    Kepadatan   
                                </div>
                                <div class="col-sm-8">
                                    : {{ $detail_gedung->kepadatan }}
                                </div>
                                <div class="col-sm-4">
                                    Permanensi   
                                </div>
                                <div class="col-sm-8">
                                    : {{ $detail_gedung->permanensi }}
                                </div>
                                <div class="col-sm-4">
                                    Resiko Kebakaran   
                                </div>
                                <div class="col-sm-8">
                                    : {{ $detail_gedung->risk_bakar }}
                                </div>
                                <div class="col-sm-4">
                                    Penangkal   
                                </div>
                                <div class="col-sm-8">
                                    : {{ $detail_gedung->penangkal }}
                                </div>
                                <div class="col-sm-4">
                                    Struktur Bawah   
                                </div>
                                <div class="col-sm-8">
                                    : {{ $detail_gedung->struktur_bawah }}
                                </div>
                                <div class="col-sm-4">
                                    Struktur Bangunaan   
                                </div>
                                <div class="col-sm-8">
                                    : {{ $detail_gedung->struktur_bangunan }}
                                </div>
                                <div class="col-sm-4">
                                    Struktur Atap   
                                </div>
                                <div class="col-sm-8">
                                    : {{ $detail_gedung->struktur_atap }}
                                </div>
                                <!-- <div class="col-sm-4">
                                    Kode Provinsi   
                                </div>
                                <div class="col-sm-8">
                                    : {{ $detail_gedung->nama_prov }}
                                </div>
                                <div class="col-sm-4">
                                    Kabupaten   
                                </div>
                                <div class="col-sm-8">
                                    : {{ $detail_gedung->nama_kota }}
                                </div>
                                <div class="col-sm-4">
                                    Kecamatan   
                                </div>
                                <div class="col-sm-8">
                                    : {{ $detail_gedung->nama_kec }}
                                </div>
                                <div class="col-sm-4">
                                    Kelurahan   
                                </div>
                                <div class="col-sm-8">
                                    : 
                                </div> -->

                            </div>
                        <a class="btn btn-warning float-left mt-2" href="{{url('/master_gedung')}}" role="button">Kembali</a>
                        
        </table>
      </div>
    </div>
  </div>

</div>
                    

<!-- @include('template/footer') -->
</body>
