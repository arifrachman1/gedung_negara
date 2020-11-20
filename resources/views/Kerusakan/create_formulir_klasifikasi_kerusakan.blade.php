@extends('template.default')

@section('content')
  <!-- Begin Page Content -->
<div class="container-fluid">

<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header bg-primary py-3">
        <h6 class="m-0 font-weight-bold text-white">FORMULIR NILAI KERUSAKAN</h6>
      </div>

    <div class="container">
      <form method="POST" action="{{ url('submit_klasifikasi_kerusakan')}}" enctype="multipart/form-data" id="formKlasifikasiKerusakan">
        @csrf
        <div class="panel panel-default">
          <div class="form-group">
              <div class="row">
                  <div class="col-lg-3">
                      Nama Instansi Bangunan   
                  </div>
                  <div class="col-lg-3">
                      : Dinas Pendidikan
                  </div>
                  <div class="col-lg-3">
                      Nama Bangunan
                  </div>
                  <div class="col-lg-3">
                      : {{ $gedung->nama }}
                  </div>
              </div>
          </div>
          <div class="form-group">
              <div class="row">
                  <div class="col-lg-3">
                      Bujur Timur   
                  </div>
                  <div class="col-lg-3">
                      : {{ $gedung->bujur_timur }}
                  </div>
                  <div class="col-lg-3">
                      Lintang Selatan   
                  </div>
                  <div class="col-lg-3">
                      : {{ $gedung->lintang_selatan }}
                  </div>
              </div>
          </div>
          <div class="form-group">
              <div class="row">
                  <div class="col-lg-3">
                      Provinsi   
                  </div>
                  @if($daerah->kode_provinsi == null)
                  <div class="col-lg-3">
                      : -
                  </div>
                  @else
                  <div class="col-lg-3">
                      : {{ $provinsi->nama_provinsi }}
                  </div>
                  @endif
                  <div class="col-lg-3">
                      Kabupaten / Kota   
                  </div>
                  @if($daerah->kode_kabupaten == null)
                  <div class="col-lg-3">
                      : -
                  </div>
                  @else
                  <div class="col-lg-3">
                      : {{ $kab_kota->nama_kota }}
                  </div>
                  @endif
              </div>
          </div>
          <div class="form-group">
              <div class="row">
                  <div class="col-lg-3">
                      Kecamatan   
                  </div>
                  @if($daerah->kode_kecamatan == null)
                  <div class="col-lg-3">
                      : -
                  </div>
                  @else
                  <div class="col-lg-3">
                      : {{ $kecamatan->nama_kecamatan }}
                  </div>
                  @endif
                  <div class="col-lg-3">
                      Kelurahan   
                  </div>
                  @if($daerah->kode_kelurahan == null)
                  <div class="col-lg-3">
                      : -
                  </div>
                  @else
                  <div class="col-lg-3">
                      : {{ $desa_kelurahan->nama_kelurahan }}
                  </div>
                  @endif
              </div>
          </div>
          <div class="form-group">
              <div class="row">
                  <div class="col-lg-3">
                      Jumlah Lantai   
                  </div>
                  <div class="col-lg-3">
                      : {{ $gedung->jumlah_lantai }}
                  </div>
                  <div class="col-lg-3">
                      Luas Bangunan   
                  </div>
                  <div class="col-lg-3">
                      : {{ $gedung->luas }} m<sup>2</sup>
                  </div>
              </div>
          </div>
          <div class="form-group">
              <div class="row">
                  <div class="col-lg-3"> 
                      Tanggal
                  </div>
                  <div class="col-sm-3">
                    : {{ date('d-M-Y H:i:s', strtotime("now")) }}
                  </div>
              </div>
            <input type="hidden" id="idGedung" name="id_gedung" value="{{ $id_gedung }}">
            <input type="hidden" id="idUser" name="id_user" value="{{ $id_user }}">
          </div>    
          <hr>
          <a class="btn btn-success mb-3 btn-show-form-kerusakan" href="#" id-gedung="{{$id_gedung}}">
            <span class="icon text-white-100">
              Import Excel
            </span> 
          </a>
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
                  @php $index = 0 @endphp
                  @foreach($komponens as $parentIndex => $komponen)
                    @foreach($komponen->subKomponen as $subIndex => $subKomponen)
                    <input type="hidden" name="satuans[]" value="{{ $subKomponen->id_satuan }}">
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
                        <input type="hidden" class="input_estimasi_{{ $index }}" name="val_estimasi_{{ $index }}[]">

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

                        <input type="hidden" class="input_persentase_{{ $index }}" name="val_persentase_{{ $index }}[]">
                        <input type="hidden" class="input_persentase_{{ $index }}" name="val_persentase_{{ $index }}[]">
                        <input type="hidden" class="input_persentase_{{ $index }}" name="val_persentase_{{ $index }}[]">
                        <input type="hidden" class="input_persentase_{{ $index }}" name="val_persentase_{{ $index }}[]">
                        <input type="hidden" class="input_persentase_{{ $index }}" name="val_persentase_{{ $index }}[]">

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

                        <input type="hidden" id="input_jumlah_unit_{{ $index }}" name="val_jumlah_unit_{{ $index }}[]">
                        <input type="hidden" class="input_unit_{{ $index }}" name="val_unit_{{ $index }}[]">
                        <input type="hidden" class="input_unit_{{ $index }}" name="val_unit_{{ $index }}[]">
                        <input type="hidden" class="input_unit_{{ $index }}" name="val_unit_{{ $index }}[]">
                        <input type="hidden" class="input_unit_{{ $index }}" name="val_unit_{{ $index }}[]">
                        <input type="hidden" class="input_unit_{{ $index }}" name="val_unit_{{ $index }}[]">

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
                        <p class="tk_text_{{ $parentIndex }}"></p>
                        <input type="hidden" class="tk_value tk_value_{{ $parentIndex}}" name="tk_value[]">
                      </td>
                      @if($subIndex == 0)
                        <td rowspan="{{ $komponen->numberOfSub }}">
                          <p class="tk_keterangan_{{ $parentIndex }}"></p>
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
                      <p id="keteranganTotalKerusakan"></p>
                    </td>
                  </tr>
                </tfoot>
              </table>
            </div>
            <div class="form-group">
                <label >Sketsa Denah</label>
                <input type="file" id="sketsaDenah" name="sketsa_denah[]" class="form-control-file" accept=".jpg, .jpeg, .png" multiple>
                <p style="font-size: 9pt" class="mt-2">*Recommended max size upload 5MB</p>
            </div>
            <div class="form-group">
                <label>Gambar Bukti Kerusakan</label>
                <input type="file" id="gambarBukti" name="gambar_bukti[]" class="form-control-file" accept=".jpg, .jpeg, .png" multiple>
                <p style="font-size: 9pt" class="mt-2">*Recommended max size upload 5MB</p>
            </div>
          </div>
            <button type="button" id="submitKerusakan" class="btn btn-success float-left m-2">Submit</button>
            <a class="btn btn-warning m-2 float-left" href="{{url('/master_kerusakan')}}" role="button">Kembali</a>
            <p id="notifSubmitError"></p>
          </div>
        </div>
      </form>
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
        <p id="show-error-estimasi"></p>
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
        <p id="show-error-unit"></p>
        <button class="btn btn-success" id="btn-save-unit" data-dismiss="modal" type="button">Simpan</button>
      </div>
    </div>
  </div>
</div>

@include("Kerusakan.import_excel", ['id_gedung' => $id_gedung])
@endsection

@push('scripts')
<script>
  $(document).ready(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    let _klasifikasiKerusakanPersen = _klasifikasiKerusakanUnit = [];
    let klasifikasiKerusakan = [0.20, 0.40, 0.60, 0.80, 1.00];
    let komponen = {};

    function toDouble(param){
      // return param;
      return param.toFixed(2);
    }

    function getTingkatKerusakan(param, bobot){
      // return (bobot) ? (param * bobot) / 100 : param;
      return (param * bobot) / 100;
    }

    function toTextKategoriKerusakan(param){
      let text;
      if(param == 0 ){
        text = 'Tidak ada kerusakan';
      }else if(param <= 30) {
        text =  'Tingkat Kerusakan Ringan';
      } else if (param > 30 && param <= 45) {
        text =  'Tingkat Kerusakan Sedang';
      } else if (param > 45) {
        text =  'Tingkat Kerusakan Berat';
      }
      return text;
    }

    function toTextKlasifikasi(indexParent){
      let input = $('.tk_value_'+indexParent);
      let sum = 0;
      let text;
      for (let index = 0; index < input.length; index++) {
        sum += Number(input[index].value);
      }
      
      return toTextKategoriKerusakan(sum);
    }

    function initVar(element){
      return {
        id_komponen: $(element).attr('data-id'),
        index_parent: $(element).attr('data-parent-index'),
        index_komponen: $(element).attr('data-index-komponen'),
        index_sub_komponen: $(element).attr('data-sub-index'),
        bobot: Number($(element).attr('data-bobot'))
      }
    }

    function sumKlasifikasiKerusakan(param, bobot, jumlahUnit){
      return (jumlahUnit) ? ((param / jumlahUnit) * bobot) : (param * bobot) / 100;
    }

    function onChangeModalKlasifikasiKerusakan(element, which, jumlahUnit){
      let input_klasifikasi = $(element).val();
      let index_klasifikasi = $(element).attr('data-index-klasifikasi');
      let bobotKlasifikasi = klasifikasiKerusakan[index_klasifikasi];
      let resultKlasifikasi = toDouble(sumKlasifikasiKerusakan(input_klasifikasi, bobotKlasifikasi, jumlahUnit));
      if(which == 'persen')
        $('.text-value-persen').eq(index_klasifikasi).val(resultKlasifikasi)
      else $('.text-value-unit').eq(index_klasifikasi).val(resultKlasifikasi);
    }

    function sumModalKlasifikasiKerusakan(which, index_komponen){
      let sum = 0;
      let bufferKlasifikasiKerusakan = [];
      
      for (let index = 0; index < klasifikasiKerusakan.length; index++) {
        let bufferInput  = (which == 'persen') ? Number($('.input-value-persen').eq(index).val()) : Number($('.input-value-unit').eq(index).val());
        let bufferResult = (which == 'persen') ? Number($('.text-value-persen').eq(index).val()) : Number($('.text-value-unit').eq(index).val());
        bufferKlasifikasiKerusakan.push({
          input: bufferInput,
          result: bufferResult
        });
        sum += bufferResult;
        if(which == 'persen')
          $('.input_persentase_'+index_komponen).eq(index).val(bufferInput);
        else $('.input_unit_'+index_komponen).eq(index).val(bufferInput);
      }
      if(which == 'persen')
        _klasifikasiKerusakanPersen[index_komponen] = bufferKlasifikasiKerusakan;
      else _klasifikasiKerusakanUnit[index_komponen] = bufferKlasifikasiKerusakan;
      sum = toDouble((getTingkatKerusakan(sum, komponen.bobot)) * 100);

      return sum;
    }

    function setTingkatKerusakan(indexParent, indexSubKomponen, value){
      $('.tk_text_'+ indexParent).eq(indexSubKomponen).text(value + ' %');
      $('.tk_value_'+ indexParent).eq(indexSubKomponen).val(value);
      setTingkatAllKerusakan(indexParent);
    }

    function setTingkatAllKerusakan(indexParent){
      let total_komponen = $('#table-kerusakan tbody tr').length;

      let total = 0;
      for (let index = 0; index < total_komponen; index++)
        total += Number($('.tk_value')[index].value);
      total = toDouble(total);
      $('#totalKerusakan').text(total + ' %');
      $('#keteranganTotalKerusakan').text(toTextKategoriKerusakan(total));
      $('.tk_keterangan_'+indexParent).text(toTextKlasifikasi(indexParent));
    }

    //Estimasi
    let id_opsi = bobot_opsi = null;

    function setNotifErrorEstimasi(status, message){
      if(status)
        $('#show-error-estimasi').html(message).css('color', 'red');
      else $('#show-error-estimasi').html('');
    }

    $('.hitungEstimasi').click( function() {
      komponen = initVar(this);

      $.ajax({
        url: '{{ route("get_data_komponen_opsi") }}',
        type: 'POST',
        data: { 
          id_komponen: komponen.id_komponen,
        },
        success: function(response) {
          $('#bufferEstimasi .dropdown').remove();
          response.dataOpsi.forEach( item => $('#bufferEstimasi').append('<option class="dropdown" data-nilai-opsi="'+item.nilai+'" value="'+item.id+'">'+item.opsi+'</option>'));

          let selected = Number($('.input_estimasi_'+ komponen.index_komponen).val());
          $('#bufferEstimasi').val(selected);

          $('#modalEstimasi').modal('show');
        }
      })

    });

    $('#bufferEstimasi').change(function(){
      setNotifErrorEstimasi(false);
    });

    $('#btn-save-estimasi').click(function(){
      let ele_select = $('#bufferEstimasi');
      let nilai_opsi = $('option:selected', ele_select).attr('data-nilai-opsi');
      let id_opsi = $(ele_select).val();
      if(!id_opsi){
        setNotifErrorEstimasi(true, 'Harap pilih opsi.')
        return false;
      }
      let resultKlasifikasiKerusakan = toDouble(getTingkatKerusakan(nilai_opsi, komponen.bobot));
      $('.input_estimasi_'+ komponen.index_komponen).val(id_opsi);
      setTingkatKerusakan(komponen.index_parent, komponen.index_sub_komponen, resultKlasifikasiKerusakan);
    })

    // Persen
    $('.hitungPersen').click(function() {
      komponen = initVar(this);

      let existingData = _klasifikasiKerusakanPersen[komponen.index_komponen];
      
      let modalBody = '<div class="row"><div class="col-lg-2"><label>Perhitungan</label></div></div>';
      klasifikasiKerusakan.forEach((param, index)=>{
        modalBody += (existingData) ?
          '<div class="row my-2"><div class="col-lg-3">'+toDouble(param)+'</div><div class="col-lg-3"><input type="number" class="form-control input-value-persen" placeholder="0" data-index-klasifikasi="'+index+'" value="'+existingData[index].input+'"></div><div class="col-lg-3">% =</div><div class="col-lg-3"><input type="number" class="form-control form-hasil text-value-persen" placeholder="0" value="'+existingData[index].result+'" readonly></div></div>'
          : '<div class="row my-2"><div class="col-lg-3">'+toDouble(param)+'</div><div class="col-lg-3"><input type="number" class="form-control input-value-persen" placeholder="0" data-index-klasifikasi="'+index+'"></div><div class="col-lg-3">% =</div><div class="col-lg-3"><input type="number" class="form-control form-hasil text-value-persen" placeholder="0" readonly></div></div>';
      })

      $('#modalPersen .modal-body').html(modalBody);
      $('#modalPersen').modal('show');

      $('.input-value-persen').change(function(){
        onChangeModalKlasifikasiKerusakan(this, 'persen')
      });
    })

    $('#btn-save-persen').click(function(){
      let resultSum = sumModalKlasifikasiKerusakan('persen', komponen.index_komponen);
      setTingkatKerusakan(komponen.index_parent, komponen.index_sub_komponen, resultSum)
    })

    //Unit
    function setNotifJumlahEmpty(status, message){
      if(status)
        $('#show-error-unit').html(message).css('color', 'red');
      else $('#show-error-unit').html('');
    }

    $('.hitungUnit').click(function(){
      komponen = initVar(this);

      let existingData = _klasifikasiKerusakanUnit[komponen.index_komponen];
      let modalBody = '<div class="row"><div class="col-lg-3"><label>Jumlah</label></div><div class="col-lg-3"><input type="number" id="jumlahUnit" class="form-control" placeholder="0"></div></div><div class="row my-2"><div class="col-lg-2"><label>Perhitungan</label></div></div>'

      klasifikasiKerusakan.forEach((param, index)=>{
        modalBody += (existingData) ? 
          '<div class="form-group"><div class="row"><div class="col-lg-3">'+toDouble(param)+'</div><div class="col-lg-3"><input type="number" class="form-control input-value-unit" placeholder="0" data-index-klasifikasi="'+index+'" value="'+existingData[index].input+'"></div><div class="col-lg-3">=</div><div class="col-lg-3"><input type="number" class="form-control text-value-unit" placeholder="0" value="'+existingData[index].result+'" readonly></div></div></div>'
          : '<div class="form-group"><div class="row"><div class="col-lg-3">'+toDouble(param)+'</div><div class="col-lg-3"><input type="number" class="form-control input-value-unit" placeholder="0" data-index-klasifikasi="'+index+'"></div><div class="col-lg-3">=</div><div class="col-lg-3"><input type="number" class="form-control text-value-unit" placeholder="0" readonly></div></div></div>';
      })
      $('#modalUnit .modal-body').html(modalBody);
      
      $('#jumlahUnit').val($('#input_jumlah_unit_'+komponen.index_komponen).val());

      setNotifJumlahEmpty(false);
      $('#modalUnit').modal('show');

      $('.input-value-unit').change(function(){
        onChangeModalKlasifikasiKerusakan(this, 'unit', $('#jumlahUnit').val());
      });

      $('#btn-save-unit').click(function(){
        let jumlah_unit = $('#jumlahUnit').val();
        if(!jumlah_unit){
          setNotifJumlahEmpty(true, 'Harap mengisi jumlah unit.')
          return false;
        }
        $('#input_jumlah_unit_'+komponen.index_komponen).val(jumlah_unit);

        let resultSum = sumModalKlasifikasiKerusakan('unit', komponen.index_komponen);
        setTingkatKerusakan(komponen.index_parent, komponen.index_sub_komponen, resultSum)
      })

      $('#jumlahUnit').change(function(){
        setNotifJumlahEmpty(false)
        $('.input-value-unit').change();
      })
    })
    
    //Validation
    function setNotifSubmitError(status, message){
      if(status)
        $('#notifSubmitError')
            .html(message)
            .css('color', 'red');
      else $('#notifSubmitError').html('');
    }


    $('#sketsaDenah, #gambarBukti').change(function(){
      setNotifSubmitError(false);
    })
    
    $('#submitKerusakan').click(function(){

      //Input Validation
      if(_klasifikasiKerusakanPersen.length == 0 && _klasifikasiKerusakanUnit.length == 0){
        setNotifSubmitError(true, 'Harap mengisi form.');
        return false;
      }


      // File validation
      let eleFDenah = $('#sketsaDenah')[0];
      let eleFBukti = $('#gambarBukti')[0];

      // fileExist = eleFDenah.files.length && eleFBukti.files.length;
      // if(!fileExist){
      //   setNotifSubmitError(true, 'Harap upload file yang diperlukan.')
      //   return false;
      // }

      if(eleFDenah.files.length > 3 || eleFBukti.files.length > 5){
        setNotifSubmitError(true, 'Perhatian: Sketsa denah maksimal 3 foto dan gambar bukti maksimal 5 foto.');
        return false;
      }

      let valid = false;
      if(eleFDenah.files.length || eleFBukti.files.length){
        for (let index = 0; index < eleFDenah.files.length; index++){
          valid = eleFDenah.files.item(index).size <= 5242880;
        }
        for (let index = 0; index < eleFBukti.files.length; index++) {
          valid = eleFBukti.files.item(index).size <= 5242880;
        }
      }else{
        valid = true;
      }
      if(valid)
        $('#formKlasifikasiKerusakan').submit()
      else setNotifSubmitError(true, 'Besar Files harus kurang dari 5Mb')
    });
  })
</script>
@endpush