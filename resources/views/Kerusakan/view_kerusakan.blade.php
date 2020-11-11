<!doctype html>
@include('template/header')
  <!-- Begin Page Content -->
<div class="container-fluid">

<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header bg-primary py-3">
        <h6 class="m-0 font-weight-bold text-white">FORMULIR NILAI KERUSAKAN</h6>
      </div>
      <div class="card-body">

        <div class="">
          <table class="table table-bordered">
            <thead>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            OPD  
                        </div>
                        <div class="col-lg-3">
                            : {{ $kerusakan->opd }}
                        </div>
                        <div class="col-lg-3">
                            Nama bangunan
                        </div>
                        <div class="col-lg-3">
                            : {{ $kerusakan->nama_gedung }}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            Nomor Aset   
                        </div>
                        <div class="col-lg-3">
                            : {{ $kerusakan->nomor_aset }}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            Provinsi   
                        </div>
                        <div class="col-lg-3">
                            : {{ $provinsi->nama_provinsi }}
                        </div>
                        <div class="col-lg-3">
                            Kabupaten / Kota   
                        </div>
                        <div class="col-lg-3">
                            : {{ $kab_kota->nama_kota }}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            Kecamatan   
                        </div>
                        <div class="col-lg-3">
                            : {{ $kecamatan->nama_kecamatan }}
                        </div>
                        <div class="col-lg-3">
                            Kelurahan   
                        </div>
                        <div class="col-lg-3">
                            : {{ $desa_kelurahan->nama_kelurahan }}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            Petugas Survey   
                        </div>
                        <div class="col-lg-3">
                            : 1. {{ $kerusakan->petugas_survei1 }}<br/> 
                            <br> 2. {{ $kerusakan->petugas_survei2 }} <br/>
                            <br> 3. {{ $kerusakan->petugas_survei3 }} <br/>
                        </div>
                        <div class="col-lg-3">
                            Perwakilan OPD
                        </div>
                        <div class="col-lg-3">
                            : 1. {{ $kerusakan->perwakilan_opd1 }}<br/>
                            <br> 2. {{ $kerusakan->perwakilan_opd2 }}<br/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3"> 
                            Tanggal Hari Ini
                        </div>
                        <div class="col-lg-3">
                            : {{ substr($kerusakan->tanggal, 0, -9) }}
                        </div>
                        <div class="col-lg-3">
                            Jam   
                        </div>
                        <div class="col-lg-3">
                            : {{ substr($kerusakan->tanggal, -8) }}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            Luas Bangunan   
                        </div>
                        <div class="col-lg-3">
                            : {{ $kerusakan->luas }} m2
                        </div>
                        <div class="col-lg-3">
                            Jumlah Lantai   
                        </div>
                        <div class="col-lg-3">
                            : {{ $kerusakan->jml_lantai }}
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <button class="btn btn-secondary">Export to Excel</button>
                </div>
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Komponen</th>
                      <th>Subkomponen</th>
                      <th>Satuan</th>
                      <th colspan="3">Tingkat Kerusakan</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $no = 1; @endphp

                    @foreach($komponen as $val)
                    <tr>
                        <td>{{ $no++ }}</td>
                        @if($val->nama_komponen == null)
                        <td>{{ strtoupper($val->sub_komponen) }}</td>
                        <td>-</td>
                        @else   
                        <td>{{ strtoupper($val->nama_komponen) }}</td>
                        <td>{{ strtoupper($val->sub_komponen) }}</td>
                        @endif
                        <td>{{ $val->nama_satuan }}</td>
                        <td>{{ $val->tingkat_kerusakan }}</td>
                        @if ( $val->tingkat_kerusakan <= 0.3)
                        <td colspan="2">Tingkat Kerusakan Ringan</td>
                        @elseif ( $val->tingkat_kerusakan > 0.3 && $val->tingkat_kerusakan <= 0.45 )
                        <td colspan="2">Tingkat Kerusakan Sedang</td>
                        @elseif ( $val->tingkat_kerusakan > 0.45 )
                        <td colspan="2">Tingkat Kerusakan Berat</td>
                        @endif
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="form-group">

                </div>
                <div class="form-group">

              </div>
            </thead>
            <a href="{{ url('/master_kerusakan') }}" class="btn btn-warning float-left mt-2">Kembali</a>
        
          </table>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- @include('template/footer') -->
