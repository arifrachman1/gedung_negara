<!doctype html>
@include('template/header')

  <!-- Begin Page Content -->
<div class="container-fluid">

<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header bg-primary py-3">
        <h6 class="m-0 font-weight-bold text-white">EDIT FORMULIR NILAI KERUSAKAN</h6>
      </div>

    <div class="container">
        <div class="panel panel-default">        
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
                        <br>&nbsp 2. {{ $kerusakan->petugas_survei2 }} <br/>
                        <br>&nbsp 3. {{ $kerusakan->petugas_survei3 }} <br/>
                    </div>
                    <div class="col-lg-3">
                        Perwakilan OPD
                    </div>
                    <div class="col-lg-3">
                        : 1. {{ $kerusakan->perwakilan_opd1 }}<br/>
                        <br>&nbsp 2. {{ $kerusakan->perwakilan_opd2 }}<br/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-3"> 
                        Tanggal
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
            <form method="POST" id="formEditKlasifikasiKerusakan" action="{{ url('edit_klasifikasi_kerusakan')}}" enctype="multipart/form-data">
              @csrf
              <div class="table-responsive">
                  <div class="table-content">
                    <table class="table table-bordered" id="table-kerusakan" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Komponen</th>
                          <th>Subkomponen</th>
                          <th>Satuan</th>
                          <th>Bobot</th>
                          <th>Opsi</th>
                          <th colspan="3">Tingkat Kerusakan</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php $index = 0; @endphp
                        @foreach($komponens as $parentIndex => $komponen)
                          @foreach($komponen->subKomponen as $subIndex => $subKomponen)
                          <input type="hidden" name="satuans[]" value="{{ $subKomponen->id_satuan }}" class="satuans">
                          <input type="hidden" name="komponens[]" value="{{ $subKomponen->id}}">
                          <tr>
                            <td>{{ $index + 1 }}</td>
                            @if($subIndex == 0)
                              <td rowspan="{{ $komponen->numberOfSub }}">{{ $komponen->nama }}</td>
                            @endif
                            <td>{{ $subKomponen->nama }}</td>
                            <td>{{ $subKomponen->satuan }}</td>
                            <td>{{ $subKomponen->bobot }}</td>
                            @if($subKomponen->id_satuan == 1)
                              <input type="hidden" class="input_estimasi_{{ $index }}" name="val_estimasi_{{ $index }}[]" value="{{ $subKomponen->id_komponen_opsi }}">
                              <td class="estimasi">
                                <button class="btn btn-primary hitungEstimasi" type="button"
                                  data-id="{{ $subKomponen->id }}"
                                  data-bobot="{{ $subKomponen->bobot }}"
                                  data-index-komponen="{{ $index }}"
                                  data-parent-index="{{ $parentIndex}}"
                                  data-sub-index="{{ $subIndex }}">
                                  <i class="button"><span class="icon text-white-100">Hitung</span></i>
                                </button>
                              </td>
                            @elseif($subKomponen->id_satuan == 2)
                              @foreach($subKomponen->kerusakan_klasifikasi as $kk)
                                <input type="hidden" class="input_persentase_{{ $index }}" name="val_persentase_{{ $index }}[]" value="{{ $kk->nilai_input_klasifikasi }}">
                              @endforeach
                              <td class="persen">
                                <button class="btn btn-primary hitungPersen" type="button"
                                  data-bobot="{{ $subKomponen->bobot }}"
                                  data-index-komponen="{{ $index }}"
                                  data-parent-index="{{ $parentIndex}}"
                                  data-sub-index="{{ $subIndex }}">
                                  <i class="button"><span class="icon text-white-100">Hitung</span></i>
                                </button>
                              </td>
                            @else
                              <input type="hidden" id="input_jumlah_unit_{{ $index }}" name="val_jumlah_unit_{{ $index }}[]" value="{{ $subKomponen->jumlah }}">
                              @foreach($subKomponen->kerusakan_klasifikasi as $kk)
                                <input type="hidden" class="input_unit_{{ $index }}" name="val_unit_{{ $index }}[]" value="{{ $kk->nilai_input_klasifikasi }}">
                              @endforeach

                              <td class="unit">
                                <button class="btn btn-primary hitungUnit" type="button"
                                  data-bobot="{{ $subKomponen->bobot }}"
                                  data-index-komponen="{{ $index }}"
                                  data-parent-index="{{ $parentIndex}}"
                                  data-sub-index="{{ $subIndex }}">
                                  <i class="button"><span class="icon text-white-100">Hitung</span></i>
                                </button>
                              </td>
                            @endif
                            <td>
                              <p class="tk_text_{{ $parentIndex }}"> {{ ($subKomponen->tingkat_kerusakan) ? $subKomponen->tingkat_kerusakan : 0 }}%</p>
                              <input type="hidden" class="tk_value tk_value_{{ $parentIndex}}" name="tk_value[]" value="{{ $subKomponen->tingkat_kerusakan }}">
                            </td>
                            @if($subIndex == 0)
                              <td rowspan="{{ $komponen->numberOfSub }}">
                                <p class="tk_keterangan_{{ $parentIndex }}">{{ $komponen->sumTingkatKerusakanText }}</p>
                              </td>
                            @endif
                          </tr>
                          @php $index++ @endphp
                          @endforeach
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="6">Jumlah Kerusakan</td>
                          <td>
                            <p id="totalKerusakan"></p>
                          </td>
                          <td colspan="2" >
                            <p id="keteranganTotal"></p>
                          </td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                  <div class="form-group">
                      <label >Sketsa Denah</label>
                      <ol>
                        @foreach($sketsaDenah as $denah)
                          <li> 
                            <a href="#gambarDenah_{{ $denah->id}}" data-toggle="modal" data-target="#gambarDenah_{{ $denah->id}}">{{ $denah->sketsa_denah }}</a>
                            <!-- Modal -->
                            <div class="modal fade" id="gambarDenah_{{ $denah->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body" style="widht:500px; heingt:100%;">
                                  <img src="{{ asset('denah/'.$denah->sketsa_denah) }}" alt="{{ $denah->sketsa_denah }}">
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </li>
                        @endforeach
                      </ol>
                      <input type="file" name="sketsaDenah[]" id="sketsaDenah" class="form-control-file" accept=".jpg, .jpeg, .png" multiple>
                  </div>
                  <div class="form-group">
                      <label>Gambar Bukti Kerusakan</label>
                      <ol>
                        @foreach($gambarBukti as $bukti)
                          <li>
                            <a href="#gambarBukti_{{ $bukti->id}}" data-toggle="modal" data-target="#gambarBukti_{{ $bukti->id}}">{{ $bukti->gambar_bukti }}</a>
                            <!-- Modal -->
                            <div class="modal fade" id="gambarBukti_{{ $bukti->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                  <img src="{{ asset('bukti/'.$bukti->gambar_bukti) }}" alt="{{ $bukti->gambar_bukti }}">
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </li>
                        @endforeach
                      </ol>
                      <input type="file" name="gambarBukti[]" id="gambarBukti" class="form-control-file" accept=".jpg, .jpeg, .png" multiple>
                  </div>
              </div>
                <button type="button" id="submitKerusakan" class="btn btn-success float-left mt-2 mr-2">Submit</button>
                <a class="btn btn-warning float-left mt-2" href="{{url('/master_kerusakan')}}" role="button">Kembali</a>
                <p id="notifFileEmpty"></p>
              </div>
            </form>
      </div>
    </div>
  </div>
</div>

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
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" id="btn-save-estimasi" data-dismiss="modal" type="button">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Persen -->
<div class="modal fade" id="modalPersen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Klasifikasi Kerusakan</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"></div>
      <div class="modal-footer">
        <button class="btn btn-success" id="btn-save-persen" data-dismiss="modal" type="button">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Unit -->
<div class="modal fade" id="modalUnit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Klasifikasi Kerusakan</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"> </div>
      <div class="modal-footer">
        <p id="show-error"></p>
        <button class="btn btn-success" id="btn-save-unit" type="button">Simpan</button>
      </div>
    </div>
  </div>
</div>


@include('template/footer')
<script>
  $(document).ready(function(){
    let _klasifikasiKerusakanPersen = _klasifikasiKerusakanUnit = [];
    let klasifikasiKerusakan = [0.20, 0.40, 0.60, 0.80, 1.00];


    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    let total_komponen = $('#table-kerusakan tbody tr').length;

    let index_parent = index_komponen = id_komponen = index_sub_komponen = bobot = null;

    function toDouble(param){
      return param;
      // return param.toFixed(2);
    }

    function sumKlasifikasiKerusakan(param, bobot, jumlahUnit){
      return (jumlahUnit) ? ((param / jumlahUnit) * bobot) : (param * bobot) / 100;
    }

    function sumTingkatKerusakan(param, bobot){
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
      }else if(sum <= 30) {
        text =  'Tingkat Kerusakan Ringan';
      } else if (sum > 30 && sum <= 45) {
        text =  'Tingkat Kerusakan Sedang';
      } else if (sum >45) {
        text =  'Tingkat Kerusakan Berat';
      }
      return text;
    }

    function toTextTotal(param){
      let text;
      if(param == 0 ){
        text = 'Tidak ada kerusakan';
      }else if (param > 30) {
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
      $('#totalKerusakan').text(total + ' %');
      $('#keteranganTotal').text(toTextTotal(total))
      $('.tk_keterangan_'+index_parent).text(toTextKlasifikasi(index_parent));
    }

    //Init data to form
    let eleContent            = $('#table-kerusakan tbody tr');
    let eleSatuan             = $('.satuans');
    let eleTingkatKerusakan   = $('.tk_value');
    let totalTingkatkerusakan = 0;
    for (let index = 0; index < eleContent.length; index++) {
      let _input_persentase = [];
      let _input_unit       = [];
      if(eleSatuan[index].value == 1){
      }else if(eleSatuan[index].value == 2){
        let bufferPersentase = [];
        for (let indexKK = 0; indexKK < klasifikasiKerusakan.length; indexKK++) {
          bufferPersentase.push({
            input : $('.input_persentase_' + index)[indexKK].value
            });
        }
        _klasifikasiKerusakanPersen[index] = bufferPersentase;
      }else{
        let bufferUnit = [];
        for (let indexKK = 0; indexKK < klasifikasiKerusakan.length; indexKK++) {
          bufferUnit.push({
            input: $('.input_unit_' + index)[indexKK].value
          })
        }
        _klasifikasiKerusakanUnit[index] = bufferUnit;
      }
      totalTingkatkerusakan += Number(eleTingkatKerusakan[index].value);
    }
    $('#totalKerusakan').text(toDouble(totalTingkatkerusakan)+'%');
    $('#keteranganTotal').text(toTextTotal( (totalTingkatkerusakan) ? totalTingkatkerusakan / 100 : 0 ));

    //Estimasi
    let id_opsi = bobot_opsi = null;
    $('.hitungEstimasi').click( function() {
      id_komponen = $(this).attr('data-id');
      index_parent = $(this).attr('data-parent-index');
      index_komponen = $(this).attr('data-index-komponen');
      index_sub_komponen = $(this).attr('data-sub-index');
      bobot = Number($(this).attr('data-bobot'));

      $.ajax({
        url: '{{ route("get_data_komponen_opsi") }}',
        type: 'POST',
        data: { 
          id_komponen: id_komponen,
        },
        success: function(response) {
          $('#bufferEstimasi .dropdown').remove();
          response.dataOpsi.forEach( item => $('#bufferEstimasi').append('<option class="dropdown" data-nilai-opsi="'+item.nilai+'" value="'+item.id+'">'+item.opsi+'</option>'));
          let selected = Number($('.input_estimasi_'+index_komponen).val());
          $('#bufferEstimasi').val(selected);
          $('#modalEstimasi').modal('show');
        }
      })

    });

    $('#btn-save-estimasi').click(function(){
      let select = $('#bufferEstimasi');
      nilai_opsi = $('option:selected', select).attr('data-nilai-opsi');
      id_opsi = $(select).val();

      let resultKlasifikasiKerusakan = toDouble(sumTingkatKerusakan(nilai_opsi, bobot));
      $('.input_estimasi_'+index_komponen).val(id_opsi);
      $('.tk_text_'+index_parent).eq(index_sub_komponen).text(resultKlasifikasiKerusakan + ' %');
      $('.tk_value_'+index_parent).eq(index_sub_komponen).val(resultKlasifikasiKerusakan);

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
        modalBody += '<div class="row my-2"><div class="col-lg-3">'+toDouble(param)+'</div><div class="col-lg-3"><input type="number" class="form-control input-value-persen" placeholder="0" data-index-klasifikasi="'+index+'" value="'+existingData[index].input+'"></div><div class="col-lg-3">% =</div><div class="col-lg-3"><input type="number" class="form-control form-hasil text-value-persen" placeholder="0" value="'+existingData[index].result+'" readonly></div></div>'
      })

      $('#modalPersen .modal-body').html(modalBody);

      $('.input-value-persen').change(function(){
        let input_klasifikasi = $(this).val();
        let index_klasifikasi = $(this).attr('data-index-klasifikasi');
        let bobotKlasifikasi = klasifikasiKerusakan[index_klasifikasi];
        let resultKlasifikasi = toDouble(sumKlasifikasiKerusakan(input_klasifikasi, bobotKlasifikasi));
        $('.text-value-persen').eq(index_klasifikasi).val(resultKlasifikasi);
      });

      $('.input-value-persen').change();
      $('#modalPersen').modal('show');
    })

    $('#btn-save-persen').click(function(){
      let sumKlasifikasiKerusakan = 0;
      let bufferKlasifikasiKerusakanPersen = [];
      
      for (let index = 0; index < klasifikasiKerusakan.length; index++) {
        let bufferInput  = Number($('.input-value-persen').eq(index).val());
        let bufferResult = Number($('.text-value-persen').eq(index).val());
        sumKlasifikasiKerusakan += bufferResult;
        
        bufferKlasifikasiKerusakanPersen.push({
          input: bufferInput,
          result: bufferResult
        });

        $('.input_persentase_'+index_komponen).eq(index).val(bufferInput);
      }
      _klasifikasiKerusakanPersen[index_komponen] = bufferKlasifikasiKerusakanPersen;
      sumKlasifikasiKerusakan = toDouble((sumTingkatKerusakan(sumKlasifikasiKerusakan, bobot)) * 100);
      $('.tk_text_'+index_parent).eq(index_sub_komponen).text(sumKlasifikasiKerusakan + ' %');
      $('.tk_value_'+index_parent).eq(index_sub_komponen).val(sumKlasifikasiKerusakan);

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
        modalBody += '<div class="form-group"><div class="row"><div class="col-lg-3">'+toDouble(param)+'</div><div class="col-lg-3"><input type="number" class="form-control input-value-unit" placeholder="0" data-index-klasifikasi="'+index+'" value="'+existingData[index].input+'"></div><div class="col-lg-3">=</div><div class="col-lg-3"><input type="number" class="form-control text-value-unit" placeholder="0" value="'+existingData[index].result+'" readonly></div></div></div>';
      })
      $('#modalUnit .modal-body').html(modalBody);

      let ele_jumlahUnit = $('#input_jumlah_unit_'+index_komponen);      

      $('.input-value-unit').change(function(){
        let input_klasifikasi = $(this).val();
        let index_klasifikasi = $(this).attr('data-index-klasifikasi');
        let persentase = klasifikasiKerusakan[index_klasifikasi];
        let percent = sumKlasifikasiKerusakan(input_klasifikasi, persentase, $('#jumlahUnit').val());
        $('.text-value-unit').eq(index_klasifikasi).val(toDouble(percent));
      });

      $('#jumlahUnit').val(ele_jumlahUnit.val());
      $('.input-value-unit').change();
      $('#modalUnit').modal('show');


      $('#btn-save-unit').click(function(){
        let jumlah_unit = $('#jumlahUnit').val();
        if(!jumlah_unit){
          $('#show-error')
            .html('Harap mengisi Jumlah Unit.')
            .css('color', 'red');

          return false;
        }
        ele_jumlahUnit.val(jumlah_unit);

        let sumKlasifikasiKerusakan = 0;
        let bufferKlasifikasiKerusakanUnit = [];
        
        for (let index = 0; index < klasifikasiKerusakan.length; index++) {
          let bufferInput  = Number($('.input-value-unit').eq(index).val());
          let bufferResult = Number($('.text-value-unit').eq(index).val());
          sumKlasifikasiKerusakan += bufferResult;
          
          bufferKlasifikasiKerusakanUnit.push({
            input: bufferInput,
            result: bufferResult
          });

          $('.input_unit_'+index_komponen).eq(index).val(bufferInput);
        }
        _klasifikasiKerusakanUnit[index_komponen] = bufferKlasifikasiKerusakanUnit;

        sumKlasifikasiKerusakan = toDouble((sumTingkatKerusakan(sumKlasifikasiKerusakan, bobot)) * 100);
        $('.tk_text_'+index_parent).eq(index_sub_komponen).text(sumKlasifikasiKerusakan + ' %');
        $('.tk_value_'+index_parent).eq(index_sub_komponen).val(sumKlasifikasiKerusakan);
        sumOfAllKerusakan(index_parent);        
        $('#modalUnit').modal('hide');
      })

      $('#jumlahUnit').change(function(){
        $('#show-error').html('');
        $('.input-value-unit').change();
      });

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
      if(valid) $('#formEditKlasifikasiKerusakan').submit()
    });
  })
</script>