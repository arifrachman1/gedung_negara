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
                            <br><span class="ml-2"> 2. {{ $kerusakan->petugas_survei2 }} </span><br>
                            <br><span class="ml-2"> 3. {{ $kerusakan->petugas_survei3 }} </span>
                        </div>
                        <div class="col-lg-3">
                            Perwakilan OPD
                        </div>
                        <div class="col-lg-3">
                            : 1. {{ $kerusakan->perwakilan_opd1 }}<br/>
                            <br><span class="ml-2">2. {{ $kerusakan->perwakilan_opd2 }}</span><br/>
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
                            : {{ $kerusakan->luas }} m<sup>2</sup>
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
                    <button class="btn btn-secondary" href="{{url('kerusakan.excel.export')}}">Export to Excel</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            <th>No.</th>
                            <th>Komponen</th>
                            <th>Subkomponen</th>
                            <th>Satuan</th>
                            <th>Bobot</th>
                            <th>Klasifikasi</th>
                            <th colspan="3">Tingkat Kerusakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $index = 0; @endphp
                            @foreach($komponens as $parentIndex => $komponen)
                                @foreach($komponen->subKomponen as $subIndex => $subKomponen)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    @if($subIndex == 0)
                                        <td rowspan="{{ $komponen->numberOfSub }}">{{ strtoupper($komponen->nama) }}</td>
                                    @endif
                                    <td>{{ strtoupper($subKomponen->nama) }}</td>
                                    <td>{{ $subKomponen->satuan }}</td>
                                    <td>{{ strtoupper($subKomponen->bobot) }}</td>
                                    @if($subKomponen->id_satuan == 1)

                                    <td class="estimasi">
                                        <button class="btn btn-primary hitungEstimasi" type="button"
                                            data-id="{{ $subKomponen->id_komponen }}"
                                            data-bobot="{{ $subKomponen->bobot }}"
                                            data-index-komponen="{{ $index }}"
                                            data-parent-index="{{ $parentIndex}}"
                                            data-sub-index="{{ $subIndex }}"
                                            data-val="{{ $subKomponen->id_komponen_opsi }}">
                                            <i class="button"><span class="icon text-white-100">Lihat</span></i>
                                        </button>
                                    </td>
                                    <!-- Modal Estimasi-->
                                    <div class="modal fade" id="modalEstimasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Klasifikasi Kerusakan</h5>
                                                <button class="close" type="button" data-dismiss="modal">
                                                <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                <label>Satuan: Estimasi</label>
                                                <select class="form-control" id="bufferEstimasi">
                                                    <option value="0" disabled>Pilih Opsi</option>
                                                </select>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                    @elseif($subKomponen->id_satuan == 2)
                                    <td class="persen">
                                        <button class="btn btn-primary hitungPersen" type="button"
                                            data-bobot="{{ $subKomponen->bobot }}"
                                            data-index-komponen="{{ $index }}"
                                            data-parent-index="{{ $parentIndex}}"
                                            data-sub-index="{{ $subIndex }}"
                                            data-toggle="modal"
                                            data-target="#modalPersen{{ $index }}">
                                            <i class="button"><span class="icon text-white-100">Lihat</span></i>
                                        </button>
                                    </td>
                                    <!-- Modal Persen -->
                                    <div class="modal fade" id="modalPersen{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Klasifikasi Kerusakan</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label>Perhitungan</label>
                                                    </div>
                                                </div>
                                                @foreach($subKomponen->klasifikasi as $klasifikasi)
                                                <div class="row my-2">
                                                    <div class="col-lg-3">{{ $klasifikasi->klasifikasi }}</div>
                                                    <div class="col-lg-3">
                                                        <input type="number" class="form-control" placeholder="0" value="{{ $klasifikasi->nilai_input_klasifikasi }}" readonly>
                                                    </div>
                                                    <div class="col-lg-3">% =</div>
                                                    <div class="col-lg-3">
                                                        <input type="number" class="form-control form-hasil" value="{{ round((($klasifikasi->klasifikasi * $klasifikasi->nilai_input_klasifikasi) / 100), 2) }}" placeholder="0" readonly="">
                                                    </div>
                                                </div>
                                                @endforeach
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <td class="unit">
                                        <button class="btn btn-primary" type="button"
                                            data-bobot="{{ $subKomponen->bobot }}"
                                            data-index-komponen="{{ $index }}"
                                            data-parent-index="{{ $parentIndex}}"
                                            data-sub-index="{{ $subIndex }}"
                                            data-toggle="modal"
                                            data-target="#modalUnit{{ $index }}">
                                            <i class="button"><span class="icon text-white-100">Lihat</span></i>
                                        </button>
                                    </td>
                                    <!-- Modal Unit -->
                                    <div class="modal fade" id="modalUnit{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Klasifikasi Kerusakan</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label>Jumlah</label>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <input type="number" id="jumlahUnit" class="form-control" value="{{ ($subKomponen->jumlah) ? $subKomponen->jumlah : 0 }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row my-2">
                                                    <div class="col-lg-2">
                                                        <label>Perhitungan</label>
                                                    </div>
                                                </div>
                                                @foreach($subKomponen->klasifikasi as $klasifikasi)
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-3">{{ $klasifikasi->klasifikasi }}</div>
                                                        <div class="col-lg-3">
                                                            <input type="number" class="form-control input-value-unit" placeholder="0" value="{{ $klasifikasi->nilai_input_klasifikasi }}" data-index-klasifikasi="1" readonly>
                                                        </div>
                                                        <div class="col-lg-3">=</div>
                                                        <div class="col-lg-3">
                                                            <input type="number" class="form-control text-value-unit" placeholder="0" value="{{ ($subKomponen->jumlah) ? round((($klasifikasi->nilai_input_klasifikasi / $subKomponen->jumlah) * $klasifikasi->klasifikasi), 2) : 0  }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <td>{{round($subKomponen->tingkat_kerusakan, 4)}}%</td>
                                    @if($subIndex == 0)
                                      <td style="border-right: 0">{{round($komponen->sumTingkatKerusakan,4)}}%</td>
                                      <td rowspan="{{ $komponen->numberOfSub }}">{{ $komponen->sumTingkatKerusakanStatus }}</td>
                                    @endif

                                </tr>
                                @php $index++ @endphp
                                @endforeach
                            @endforeach
                            <tr>
                              <td colspan="6">Jumlah Kerusakan</td>
                              <td> {{ round($sumAlltingkatKerusakan,3) }}% </td>
                              <td colspan="2"> {{ $sumAlltingkatKerusakanText }} </td>
                            </tr>
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

@include('template/footer')
<script>
  $(document).ready(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    function percentToDecimal(param){
      return param * 100;
    }

    //Opsi
    let id_komponen = id_komponen_opsi = null;
    $('.hitungEstimasi').click( function() {
      id_komponen = $(this).attr('data-id');
      id_komponen_opsi = $(this).attr('data-val');

      $.ajax({
        url: '{{ route("get_data_komponen_opsi") }}',
        type: 'POST',
        data: { 
          id_komponen: id_komponen,
        },
        success: function(response) {
          $('#bufferEstimasi .dropdown').remove();
          response.dataOpsi.forEach( item => $('#bufferEstimasi').append('<option class="dropdown" data-nilai-opsi="'+item.nilai+'" value="'+item.id+'">'+item.opsi+'</option>'));
          $('#bufferEstimasi').val(id_komponen_opsi);
          $('#modalEstimasi').modal('show');
        }
      })

    });
  })
</script>
