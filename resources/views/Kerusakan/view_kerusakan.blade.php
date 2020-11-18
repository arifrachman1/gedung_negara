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
                                                            <input type="number" class="form-control text-value-unit" placeholder="0" value="{{ ($subKomponen->jumlah) ? round(((($klasifikasi->nilai_input_klasifikasi / $subKomponen->jumlah) * $klasifikasi->klasifikasi) / 100), 2) : 0  }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <td>{{$subKomponen->tingkat_kerusakan * 100}}%</td>
                                    @if($subIndex == 0)
                                      <td style="border-right: 0">{{ is_numeric($komponen->sumTingkatKerusakan) ? $komponen->sumTingkatKerusakan * 100 : $komponen->sumTingkatKerusakan }}%</td>
                                      <td rowspan="{{ $komponen->numberOfSub }}">{{ $komponen->sumTingkatKerusakanStatus }}</td>
                                    @endif

                                </tr>
                                @php $index++ @endphp
                                @endforeach
                            @endforeach
                            <tr>
                              <td colspan="6">Jumlah Kerusakan</td>
                              <td> {{ $sumAlltingkatKerusakan }}% </td>
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

    let _klasifikasiKerusakanPersen = _klasifikasiKerusakanUnit = [];
    let klasifikasiKerusakan = [0.20, 0.40, 0.60, 0.80, 1.00];
    let total_komponen = $('#table-kerusakan tbody tr').length;

    let index_parent = index_komponen = id_komponen = index_sub_komponen = bobot = null;

    function toDouble(param){
      return param.toFixed(2);
    }

    function toPercent(param, bobot, jumlahUnit){
      return (jumlahUnit) ? ((param / jumlahUnit) * bobot) / 100 : (param * bobot) / 100;
    }

    function toPercentFinal(param, bobot){
      return (bobot) ? (param * bobot) / 100 : param;
    }

    function toTextKlasifikasi(indexParent){
      let input = $('.tk_value_'+indexParent);
      let sum = 0;
      let text;
      for (let index = 0; index < input.length; index++) {
        sum += Number(input[index].value);
      }
      if(sum == 0 ){
        text = 'Tidak ada kerusakan';
      }else if(sum <= 0.3) {
        text =  'Tingkat Kerusakan Ringan';
      } else if (sum > 0.3 && sum <= 0.45) {
        text =  'Tingkat Kerusakan Sedang';
      } else if (sum > 0.45) {
        text =  'Tingkat Kerusakan Berat';
      }
      return text;
    }

    function toTextTotal(param){
      let text;
      if(param == 0 ){
        text = 'Tidak ada kerusakan';
      }else if (param > 0.3) {
        text = 'Rusak Berat';
      } else {
        text = 'Hitung Kerusakan Komponen Lain';
      }

      return text;
    }

    function sumOfAllKerusakan(){
      let total = 0;
      for (let index = 0; index < total_komponen; index++)
        total += Number($('.tk_value')[index].value);
      total = toDouble(total);
      $('#textTotalKerusakan').text(total+ ' %');
      let textTotal = toTextTotal(total);
      $('#keteranganTotal').text(textTotal)

      let status = toTextKlasifikasi(index_parent);
      $('.tk_keterangan_'+index_parent).text(status);
    }


    //Opsi
    let id_opsi = bobot_opsi = null;
    $('.hitungEstimasi').click( function() {
      id_komponen = $(this).attr('data-id');
      index_parent = $(this).attr('data-parent-index');
      index_komponen = $(this).attr('data-index-komponen');
      index_sub_komponen = $(this).attr('data-sub-index');
      id_komponen_opsi = $(this).attr('data-val');
      bobot = Number($(this).attr('data-bobot'));
      console.log(index_komponen);

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

    $('#btn-save-estimasi').click(function(){
      let select = $('#bufferEstimasi');
      nilai_opsi = $('option:selected', select).attr('data-nilai-opsi');
      id_opsi = $(select).val();

      let percent = toDouble(toPercent(nilai_opsi, bobot));
      $('.input_estimasi_'+index_komponen).val(id_opsi);
      $('.tk_text_'+index_parent).eq(index_sub_komponen).text(percent + ' %');
      $('.tk_value_'+index_parent).eq(index_sub_komponen).val(percent);

      sumOfAllKerusakan(index_parent);
    })

    // Persen
    $('.hitungPersen').click(function() {
      index_parent = $(this).attr('data-parent-index');
      index_komponen = $(this).attr('data-index-komponen');
      index_sub_komponen = $(this).attr('data-sub-index');
      bobot = Number($(this).attr('data-bobot'));

      let existingData = _klasifikasiKerusakanPersen[index_komponen];
      
      let modalBody = '<div class="row"><div class="col-lg-2"><label>Perhitungan</label></div></div>';
      klasifikasiKerusakan.forEach((param, index)=>{
        modalBody += (existingData) ?
          '<div class="row my-2"><div class="col-lg-3">'+toDouble(param)+'</div><div class="col-lg-3"><input type="number" class="form-control input-value-persen" placeholder="0" data-index-klasifikasi="'+index+'" value="'+existingData[index].input+'"></div><div class="col-lg-3">% =</div><div class="col-lg-3"><input type="number" class="form-control form-hasil text-value-persen" placeholder="0" value="'+existingData[index].result+'" readonly></div></div>'
          : '<div class="row my-2"><div class="col-lg-3">'+toDouble(param)+'</div><div class="col-lg-3"><input type="number" class="form-control input-value-persen" placeholder="0" data-index-klasifikasi="'+index+'"></div><div class="col-lg-3">% =</div><div class="col-lg-3"><input type="number" class="form-control form-hasil text-value-persen" placeholder="0" readonly></div></div>';
      })

      $('#modalPersen .modal-body').html(modalBody);
      $('#modalPersen').modal('show');

      $('.input-value-persen').change(function(){
        let input_klasifikasi = $(this).val();
        let index_klasifikasi = $(this).attr('data-index-klasifikasi');
        let persentase = klasifikasiKerusakan[index_klasifikasi];
        let percent = toDouble(toPercent(input_klasifikasi, persentase));
        $('.text-value-persen').eq(index_klasifikasi).val(percent);
      });
    })

    $('#btn-save-persen').click(function(){
      let sum = 0;
      let bufferKlasifikasiKerusakanPersen = [];
      
      for (let index = 0; index < klasifikasiKerusakan.length; index++) {
        let bufferInput  = Number($('.input-value-persen').eq(index).val());
        let bufferResult = Number($('.text-value-persen').eq(index).val());
        sum += bufferResult;
        
        bufferKlasifikasiKerusakanPersen.push({
          input: bufferInput,
          result: bufferResult
        });

        $('.input_persentase_'+index_komponen).eq(index).val(bufferInput);
      }
      _klasifikasiKerusakanPersen[index_komponen] = bufferKlasifikasiKerusakanPersen;

      sum = toDouble(toPercentFinal(sum, bobot));
      $('.tk_text_'+index_parent).eq(index_sub_komponen).text(sum + ' %');
      $('.tk_value_'+index_parent).eq(index_sub_komponen).val(sum);

      sumOfAllKerusakan(index_parent);
    })

    //Unit
    $('.hitungUnit').click(function(){
      index_parent = $(this).attr('data-parent-index');
      index_komponen = $(this).attr('data-index-komponen');
      index_sub_komponen = $(this).attr('data-sub-index');
      bobot = Number($(this).attr('data-bobot'));

      let existingData = _klasifikasiKerusakanUnit[index_komponen];
      let modalBody = '<div class="row"><div class="col-lg-3"><label>Jumlah</label></div><div class="col-lg-3"><input type="number" id="jumlahUnit" class="form-control" placeholder="0"></div></div><div class="row my-2"><div class="col-lg-2"><label>Perhitungan</label></div></div>'

      klasifikasiKerusakan.forEach((param, index)=>{
        modalBody += (existingData) ? 
          '<div class="form-group"><div class="row"><div class="col-lg-3">'+toDouble(param)+'</div><div class="col-lg-3"><input type="number" class="form-control input-value-unit" placeholder="0" data-index-klasifikasi="'+index+'" value="'+existingData[index].input+'"></div><div class="col-lg-3">=</div><div class="col-lg-3"><input type="number" class="form-control text-value-unit" placeholder="0" value="'+existingData[index].result+'" readonly></div></div></div>'
          : '<div class="form-group"><div class="row"><div class="col-lg-3">'+toDouble(param)+'</div><div class="col-lg-3"><input type="number" class="form-control input-value-unit" placeholder="0" data-index-klasifikasi="'+index+'"></div><div class="col-lg-3">=</div><div class="col-lg-3"><input type="number" class="form-control text-value-unit" placeholder="0" readonly></div></div></div>';
      })
      $('#modalUnit .modal-body').html(modalBody);

      let ele_jumlahUnit = $('#input_jumlah_unit_'+index_komponen);
      let ele_jumlahUnitModal = $('#jumlahUnit');
      
      ele_jumlahUnitModal.val(ele_jumlahUnit.val());
      $('#modalUnit').modal('show');

      $('.input-value-unit').change(function(){
        let input_klasifikasi = $(this).val();
        let index_klasifikasi = $(this).attr('data-index-klasifikasi');
        let persentase = klasifikasiKerusakan[index_klasifikasi];
        let percent = toPercent(input_klasifikasi, persentase, ele_jumlahUnitModal.val());
        $('.text-value-unit').eq(index_klasifikasi).val(toDouble(percent));
      });

      $('#btn-save-unit').click(function(){
        let jumlah_unit = ele_jumlahUnitModal.val();
        if(!jumlah_unit){
          $('#show-error')
            .html('Harap mengisi Jumlah Unit.')
            .css('color', 'red');

          return false;
        }
        ele_jumlahUnit.val(jumlah_unit);

        let sum = 0;
        let bufferKlasifikasiKerusakanUnit = [];
        
        for (let index = 0; index < klasifikasiKerusakan.length; index++) {
          let bufferInput  = Number($('.input-value-unit').eq(index).val());
          let bufferResult = Number($('.text-value-unit').eq(index).val());
          sum += bufferResult;
          
          bufferKlasifikasiKerusakanUnit.push({
            input: bufferInput,
            result: bufferResult
          });

          $('.input_unit_'+index_komponen).eq(index).val(bufferInput);
        }
        _klasifikasiKerusakanUnit[index_komponen] = bufferKlasifikasiKerusakanUnit;

        sum = toDouble(toPercentFinal(sum, bobot));
        $('.tk_text_'+index_parent).eq(index_sub_komponen).text(sum + ' %');
        $('.tk_value_'+index_parent).eq(index_sub_komponen).val(sum);
        sumOfAllKerusakan(index_parent);        
        $('#modalUnit').modal('hide');
      })

      ele_jumlahUnitModal.change(function(){
        $('#show-error').html('');
        $('.input-value-unit').change();
      })
    })


    $('#sketsaDenah, #gambarBukti').change(function(){
      $('#notifFileEmpty').html('');
    })
    
    $('#submitKerusakan').click(function(){
      // File validation
      let eleFDenah = $('#sketsaDenah')[0];
      let eleFBukti = $('#gambarBukti')[0];
      fileExist = eleFDenah.files.length && eleFBukti.files.length;
      if(!fileExist){
        $('#notifFileEmpty')
          .html('Harap upload file yang diperlukan.')
          .css('color', 'red');
        return false;
      }

      if(eleFDenah.files.length > 3 || eleFBukti.files.length > 5){
        $('#notifFileEmpty')
          .html('Perhatian: Sketsa denah maksimal 3 foto dan gambar bukti maksimal 5 foto.')
          .css('color', 'red');
        return false;
      }

      let valid = false;
      for (let index = 0; index < eleFDenah.files.length; index++){
        valid = eleFDenah.files.item(index).size <= 5242880;
      }
      for (let index = 0; index < eleFBukti.files.length; index++) {
        valid = eleFBukti.files.item(index).size <= 5242880;
      }
      if(valid) $('#formKlasifikasiKerusakan').submit()
    });
  })
</script>
