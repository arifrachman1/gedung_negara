<!doctype html>
@include('template/header')
<body>
<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="card shadow">
    <div class="card-header bg-primary">
      <h6 class="m-0 font-weight-bold text-white">DETAIL DATA GEDUNG</h6>
    </div>
    <div class="card-body">
        <a class="btn btn-secondary ml-3" href="{{ url('export_pdf_detail_gedung', ['id' => $detail_gedung->id]) }}" role="button">
            <span class="icon text-white-100">
                Export PDF
            </span> 
        </a>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <form>
            @csrf
                    <div class="container my-3 row">
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
                                    : {{ ($detail_gedung->nama_kat) ? $detail_gedung->nama_kat : '-' }}
                                </div>
                                <div class="col-sm-4">
                                    Nomor Seri Gedung   
                                </div>
                                @if ($detail_gedung->nomor_seri == null)
                                <div class="col-sm-8">
                                    : -
                                </div>
                                @else
                                <div class="col-sm-8">
                                    : {{ $detail_gedung->nomor_seri }}
                                </div>
                                @endif
                                <div class="col-sm-4">
                                    Alamat 
                                </div>
                                <div class="col-sm-8">
                                    : {{ $detail_gedung->alamat }}
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
                                    : {{ $detail_gedung->luas_bangunan }}
                                </div>
                                <div class="col-sm-4">
                                    Tinggi Bangunan   
                                </div>
                                <div class="col-sm-8">
                                    : {{ $detail_gedung->tinggi_bangunan }}
                                </div>
                                <div class="col-sm-4">
                                    Kompleksitas  
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
                                    Struktur Bangunan   
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
                                <div class="col-sm-4">
                                    Provinsi   
                                </div>
                                @if ($provinsi == null)
                                <div class="col-sm-8">
                                    : -
                                </div>
                                @else
                                <div class="col-sm-8">
                                    : {{ $provinsi->nama }}
                                </div>
                                @endif
                                <div class="col-sm-4">
                                    Kabupaten   
                                </div>
                                @if ($kab_kota == null)
                                <div class="col-sm-8">
                                    : -
                                </div>
                                @else
                                <div class="col-sm-8">
                                    : {{ $kab_kota->nama }}
                                </div>
                                @endif
                                <div class="col-sm-4">
                                    Kecamatan   
                                </div>
                                @if ($kecamatan == null)
                                <div class="col-sm-8">
                                    : -
                                </div>
                                @else
                                <div class="col-sm-8">
                                    : {{ $kecamatan->nama }}
                                </div>
                                @endif
                                <div class="col-sm-4">
                                    Kelurahan   
                                </div>
                                @if ($desa_kelurahan == null)
                                <div class="col-sm-8">
                                    : -
                                </div>
                                @else
                                <div class="col-sm-8">
                                    : {{ $desa_kelurahan->nama }}
                                </div>
                                @endif
                                <div class="col-sm-4">
                                    KDB  
                                </div>
                                <div class="col-sm-8">
                                    : {{ $detail_gedung->kdb }}
                                </div>
                                <div class="col-sm-4">
                                    KLB 
                                </div>
                                <div class="col-sm-8">
                                    : {{ $detail_gedung->klb }}
                                </div>
                                <div class="col-sm-4">
                                    KDH   
                                </div>
                                <div class="col-sm-8">
                                    : {{ $detail_gedung->kdh }}
                                </div>
                                <div class="col-sm-4">
                                    GSB
                                </div>
                                <div class="col-sm-8">
                                    : {{ $detail_gedung->gsb }}
                                </div>
                                <div class="col-sm-4">
                                    RTH
                                </div>
                                <div class="col-sm-8">
                                    : {{ $detail_gedung->rth }}
                                </div>

                            </div>
                            <hr>
                            <div class="my-2">
                                <a class="btn btn-warning" href="{{url('/master_gedung')}}" role="button">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>    
            </div>           
        </table>
      </div>
    </div>
  </div>

</div>
                    

<!-- @include('template/footer') -->
</body>
