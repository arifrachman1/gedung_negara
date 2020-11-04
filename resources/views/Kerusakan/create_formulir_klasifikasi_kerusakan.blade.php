@include('template/header')

  <!-- Begin Page Content -->
<div class="container-fluid">

<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header bg-primary py-3">
        <h6 class="m-0 font-weight-bold text-white">FORMULIR NILAI KERUSAKAN</h6>
      </div>

    <div class="container">
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
                            Tanggal Hari Ini
                        </div>
                        <div class="col-lg-2">
                            <?php $now = date("Y-m-d") ?>
                            <input class="form-control" value="<?=$now?>" readonly>
                        </div>
                    </div>
                  <input type="hidden" id="idKerusakan" name="id_kerusakan" value="{{ $id_kerusakan }}">
                </div>    
                <div class="table-responsive">
                    <a class="btn btn-secondary btn-icon-split" href="{{ url('') }}" role="button">
                        <span class="icon text-white-100">
                            Export Excel
                        </span> 
                    </a>
                    <table class="table table-bordered" id="kerusakan" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                             <th>No.</th>
                             <th>Komponen</th>
                             <th>Subkomponen</th>
                             <th>Satuan</th>
                             <th>Opsi</th>
                             <th colspan="3">Tingkat Kerusakan</th>
                            </tr>
                        </thead>
                        @php $no = 1; @endphp
                        <tbody>
                            @foreach($komponen as $val)
                            <tr>
                             <td>{{ $no++ }}</td>
                             @if($val->nama_komponen == null)
                             <td>{{ $val->sub_komponen }}</td>
                             <td>-</td>
                             @else   
                             <td>{{ $val->nama_komponen }}</td>
                             <td>{{ $val->sub_komponen }}</td>
                             @endif
                             <td>{{ $val->nama_satuan }}</td>
                             @if($val->id_satuan == 1)
                             <td class="estimasi">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#modalEstimasi" id="hitungEstimasi" data-id="{{$val->id_komponen}}">
                                  <i class="button"><span class="icon text-white-100">Hitung</span></i>
                                </button>
                             </td>
                             @elseif($val->id_satuan == 2)
                             <td class="persen">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#modalPersen" id="hitungPersen" data-id="{{$val->id_komponen}}">
                                  <i class="button"><span class="icon text-white-100">Hitung</span></i>
                                </button>
                             </td>
                             @else
                             <td class="unit">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#modalUnit" id="hitungUnit" data-id="{{$val->id_komponen}}">
                                  <i class="button"><span class="icon text-white-100">Hitung</span></i>
                                </button>
                             </td>
                             @endif

                             <td id="td{{ $val->id_komponen }}"></td>
                             <td colspan="2" id="td_keterangan{{ $val->id_komponen }}"></td>
                            </tr>
                            @endforeach
                            <tr>
                             <td colspan="5">Jumlah Kerusakan</td>
                             <td>1700%</td>
                             <td colspan="2" >Rusak Berat</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <label >Sketsa Denah Rumah:</label>
                        <input type="file" name="#" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label>Gambar Bukti Kerusakan</label>
                        <input type="file" id="file-multiple-input" name="" multiple="" class="form-control-file">
                    </div>
                </div>
            <input type="submit" class="btn btn-success float-left mt-2 mr-2" value="Submit">
            <a class="btn btn-warning float-left mt-2" href="{{url('/master_kerusakan')}}" role="button">Kembali</a>
        </div>
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
          <label>Satuan : Estimasi</label>
          <select class="form-control isi-opsi" name="" required>
            <option>Pilih Opsi</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success btn-opsi" data-dismiss="modal" type="button">Simpan</button>
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
      <form>
        <div class="modal-body">
          <div class="form-group">
            <div class="col-lg-2">
              <label>Perhitungan</label>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-lg-3">
                0,00   
              </div>
              <input type="number" value="0" id="klsfKerusakanPersen0" hidden>
              <div class="col-lg-3">
                <input type="number" step="0.01" id="inputNilaiKerusakanPersen0" class="form-control form-input" placeholder="0"  name="">
              </div>
              <div class="col-lg-3">
                =
              </div>
              <div class="col-lg-3">
                <input type="number" step="0.01" id="hasilKerusakanPersen0" class="form-control form-hasil" placeholder="0"  name="" readonly>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-lg-3">
                0,20   
              </div>
              <input type="hidden" value="0.2" id="klsfKerusakanPersen1">
              <div class="col-lg-3">
                <input type="number" step="0.01" id="inputNilaiKerusakanPersen1" class="form-control form-input" placeholder="0"  name="">
              </div>
              <div class="col-lg-3">
                =
              </div>
              <div class="col-lg-3">
                <input type="number" step="0.01" id="hasilKerusakanPersen1" class="form-control form-hasil" placeholder="0"  name="" readonly>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-lg-3">
                0,40   
              </div>
              <input type="hidden" value="0.4" id="klsfKerusakanPersen2">
              <div class="col-lg-3">
                <input type="number" step="0.01" id="inputNilaiKerusakanPersen2" class="form-control form-input" placeholder="0"  name="">
              </div>
              <div class="col-lg-3">
                =
              </div>
              <div class="col-lg-3">
                <input type="number" step="0.01" id="hasilKerusakanPersen2" class="form-control form-hasil" placeholder="0"  name="" readonly>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-lg-3">
                0,60    
              </div>
              <input type="hidden" value="0.6" id="klsfKerusakanPersen3">
              <div class="col-lg-3">
                <input type="number" step="0.01" id="inputNilaiKerusakanPersen3" class="form-control form-input" placeholder="0"  name="">
              </div>
              <div class="col-lg-3">
                =
              </div>
              <div class="col-lg-3">
                <input type="number" step="0.01" id="hasilKerusakanPersen3" class="form-control form-hasil" placeholder="0"  name="" readonly>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-lg-3">
                0,80   
              </div>
              <input type="hidden" value="0.8" id="klsfKerusakanPersen4">
              <div class="col-lg-3">
                <input type="number" step="0.01" id="inputNilaiKerusakanPersen4" class="form-control form-input" placeholder="0"  name="">
              </div>
              <div class="col-lg-3">
                =
              </div>
              <div class="col-lg-3">
                <input type="number" step="0.01" id="hasilKerusakanPersen4" class="form-control form-hasil" placeholder="0"  name="" readonly>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-lg-3">
                1,00   
              </div>
              <input type="hidden" value="1" id="klsfKerusakanPersen5">
              <div class="col-lg-3">
                <input type="number" step="0.01" id="inputNilaiKerusakanPersen5" class="form-control form-input" placeholder="0"  name="">
              </div>
              <div class="col-lg-3">
                =
              </div>
              <div class="col-lg-3">
                <input type="number" step="0.01" id="hasilKerusakanPersen5" class="form-control form-hasil" placeholder="0"  name="" readonly>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success btn-persen" data-dismiss="modal" type="button">Simpan</button>
        </div>
      </form>
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
      <form>
        <div class="modal-body"> 
          <div class="row">
            <div class="col-lg-3">
              <label>Jumlah =</label>
            </div>
            <div class="col-lg-3">
              <input type="number" value="" id="jumlahUnit" class="form-control form-input" placeholder="0"  name="" required>
            </div>
          </div>  
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="col-lg-2">
              <label>Perhitungan</label>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-lg-3">
                0,00   
              </div>
              <input type="number" value="0" id="klsfKerusakan0" hidden>
              <div class="col-lg-3">
                <input type="number" step="0.01" id="inputNilaiKerusakan0" class="form-control form-input" placeholder="0"  name="">
              </div>
              <div class="col-lg-3">
                =
              </div>
              <div class="col-lg-3">
                <input type="number" step="0.01" id="hasilKerusakan0" class="form-control form-hasil" placeholder="0"  name="" readonly>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-lg-3">
                0,20   
              </div>
              <input type="hidden" value="0.2" id="klsfKerusakan1">
              <div class="col-lg-3">
                <input type="number" step="0.01" id="inputNilaiKerusakan1" class="form-control form-input" placeholder="0"  name="">
              </div>
              <div class="col-lg-3">
                =
              </div>
              <div class="col-lg-3">
                <input type="number" step="0.01" id="hasilKerusakan1" class="form-control form-hasil" placeholder="0"  name="" readonly>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-lg-3">
                0,40   
              </div>
              <input type="hidden" value="0.4" id="klsfKerusakan2">
              <div class="col-lg-3">
                <input type="number" step="0.01" id="inputNilaiKerusakan2" class="form-control form-input" placeholder="0"  name="">
              </div>
              <div class="col-lg-3">
                =
              </div>
              <div class="col-lg-3">
                <input type="number" step="0.01" id="hasilKerusakan2" class="form-control form-hasil" placeholder="0"  name="" readonly>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-lg-3">
                0,60    
              </div>
              <input type="hidden" value="0.6" id="klsfKerusakan3">
              <div class="col-lg-3">
                <input type="number" step="0.01" id="inputNilaiKerusakan3" class="form-control form-input" placeholder="0"  name="">
              </div>
              <div class="col-lg-3">
                =
              </div>
              <div class="col-lg-3">
                <input type="number" step="0.01" id="hasilKerusakan3" class="form-control form-hasil" placeholder="0"  name="" readonly>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-lg-3">
                0,80   
              </div>
              <input type="hidden" value="0.8" id="klsfKerusakan4">
              <div class="col-lg-3">
                <input type="number" step="0.01" id="inputNilaiKerusakan4" class="form-control form-input" placeholder="0"  name="">
              </div>
              <div class="col-lg-3">
                =
              </div>
              <div class="col-lg-3">
                <input type="number" step="0.01" id="hasilKerusakan4" class="form-control form-hasil" placeholder="0"  name="" readonly>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-lg-3">
                1,00   
              </div>
              <input type="hidden" value="1" id="klsfKerusakan5">
              <div class="col-lg-3">
                <input type="number" step="0.01" id="inputNilaiKerusakan5" class="form-control form-input" placeholder="0"  name="">
              </div>
              <div class="col-lg-3">
                =
              </div>
              <div class="col-lg-3">
                <input type="number" step="0.01" id="hasilKerusakan5" class="form-control form-hasil" placeholder="0"  name="" readonly>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success btn-unit" data-dismiss="modal" type="button">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

@include('template/footer')  
<script>
  let idKomp;
  let valueOpsi;
  let jumlahUnit = 1;
  let hasil0; let hasil1; let hasil2; let hasil3; let hasil4; let hasil5;

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  /* menampilkan modal estimasi kerusakan berdasarkan id komponen */
  $(document).on('click', '#hitungEstimasi', function() {
    let id = $(this).attr('data-id');
    idKomp = id;
    console.log(id);
    $.ajax({
      url: '{{ route("get_data_komponen_opsi") }}',
      type: 'POST',
      data: { id_komponen: id },
      success: function(data) {
        //console.log(data);
        $('.isi-opsi .dropdown').remove();
        $.each(data.dataOpsi, function(index, data){
          $('.isi-opsi').append('<option class="dropdown" data-id="'+data.id+'">'+data.opsi+'</option>');
        });
      },
    });
  });

  /* menampilkan modal klasifikasi kerusakan berdasarkan id komponen dengan satuan komponennya persen */
  $(document).on('click', '#hitungPersen', function() {
    let id = $(this).attr('data-id');
    idKomp = id;
    console.log(id);
    $('.form-input').val('value', 0);
    $('.form-hasil').val('value', 0);
  });

  /* menampilkan modal klasifikasi kerusakan berdasarkan id komponen dengan satuan komponennya unit */
  $(document).on('click', '#hitungUnit', function() {
    let id = $(this).attr('data-id');
    idKomp = id;
    console.log(id);
    $('.form-input').val('value', 0);
    $('.form-hasil').val('value', 0);
  });

  /*function closeOpsi() {
    $('#modalEstimasi').modal('destroy');
  }*/

  $(document).ready(function() {
    
    /* proses perhitungan estimasi kerusakan menurut opsi yang dipilih */
    $('.isi-opsi').change(function(){
      var idOpsi = $(this).find(':selected').attr('data-id');
      $('.btn-opsi').attr({'data-id': idOpsi});
    });

    $('.btn-opsi').click( function() {
      var id_komp_opsi = $('.btn-opsi').attr('data-id');
      console.log(id_komp_opsi);
      $.ajax({
        url: '{{ route("hitung_estimasi_kerusakan") }}',
        type: 'POST',
        data: { 
          id_komponen: idKomp,
          id_komponen_opsi: id_komp_opsi,
        },
        success: function(data) {
          console.log(data.hasil_estimasi);
          var hasil_estimasi = data.hasil_estimasi;
          var hiddenVal = '<input type="hidden" name="hasil_tkt_kerusakan[]" value="' + hasil_estimasi + '" readonly>';
          $('#td'+idKomp).html(hasil_estimasi + '%' + hiddenVal);
          if (hasil_estimasi > 0.3) {
            $('#td_keterangan'+idKomp).html('Rusak Berat');
          } else {
            $('#td_keterangan'+idKomp).html('Hitung Kerusakan Komponen Lain');
          }
        },
      });
    });

    /* proses perhitungan klasifikasi kerusakan dengan satuan komponen persen */

    $('#inputNilaiKerusakanPersen0').change(function (){
      var inputNilaiKerusakan = $(this).val();
      var klsfKerusakan = Number($('#klsfKerusakanPersen0').val());
      hasil0 = inputNilaiKerusakan * klsfKerusakan;
      $('#hasilKerusakanPersen0').val(hasil0);
    });

    $('#inputNilaiKerusakanPersen1').change(function (){
      var inputNilaiKerusakan = $(this).val();
      var klsfKerusakan = Number($('#klsfKerusakanPersen1').val());
      hasil1 = inputNilaiKerusakan * klsfKerusakan; 
      $('#hasilKerusakanPersen1').val(hasil1);
    });

    $('#inputNilaiKerusakanPersen2').change(function (){
      var inputNilaiKerusakan = $(this).val();
      var klsfKerusakan = Number($('#klsfKerusakanPersen2').val());
      hasil2 = inputNilaiKerusakan * klsfKerusakan;
      $('#hasilKerusakanPersen2').val(hasil2);
    });

    $('#inputNilaiKerusakanPersen3').change(function (){
      var inputNilaiKerusakan = $(this).val();
      var klsfKerusakan = Number($('#klsfKerusakanPersen3').val());
      hasil3 = inputNilaiKerusakan * klsfKerusakan;
      $('#hasilKerusakanPersen3').val(hasil3);
    });

    $('#inputNilaiKerusakanPersen4').change(function (){
      var inputNilaiKerusakan = $(this).val();
      var klsfKerusakan = Number($('#klsfKerusakanPersen4').val());
      hasil4 = inputNilaiKerusakan * klsfKerusakan;
      $('#hasilKerusakanPersen4').val(hasil4);
    });

    $('#inputNilaiKerusakanPersen5').change(function (){
      var inputNilaiKerusakan = $(this).val();
      var klsfKerusakan = Number($('#klsfKerusakanPersen5').val());
      hasil5 = inputNilaiKerusakan * klsfKerusakan;
      $('#hasilKerusakanPersen5').val(hasil5);
    });

    $('.btn-persen').click(function (){
      let sumHasil = hasil0 + hasil1 + hasil2 + hasil3 + hasil4 + hasil5;
      console.log(sumHasil);
      $.ajax({
        url: '{{ route("hitung_kerusakan_persen") }}',
        type: 'POST',
        data: { 
          id_komponen: idKomp,
          sum_hasil: sumHasil,
        },
        success: function(data) {
          console.log(data.hasil_persen);
          var hasil_persen = data.hasil_persen;
          var hiddenVal = '<input type="hidden" name="hasil_tkt_kerusakan[]" value="' + hasil_persen + '" readonly>';
          $('#td'+idKomp).html(hasil_persen + '%' + hiddenVal);
          if (hasil_persen > 0.3) {
            $('#td_keterangan'+idKomp).html('Rusak Berat');
          } else {
            $('#td_keterangan'+idKomp).html('Hitung Kerusakan Komponen Lain');
          }
        },
      });
    });

    /* proses perhitungan klasifikasi kerusakan dengan satuan komponen unit */

    $('#inputNilaiKerusakan0').change(function (){
      var inputNilaiKerusakan = $(this).val();
      var klsfKerusakan = Number($('#klsfKerusakan0').val());
      jumlahUnit = $('#jumlahUnit').val();
      hasil0 = (inputNilaiKerusakan / jumlahUnit) * klsfKerusakan;
      $('#hasilKerusakan0').val(hasil0);
    });

    $('#inputNilaiKerusakan1').change(function (){
      var inputNilaiKerusakan = $(this).val();
      var klsfKerusakan = Number($('#klsfKerusakan1').val());
      jumlahUnit = $('#jumlahUnit').val();
      hasil1 = (inputNilaiKerusakan / jumlahUnit) * klsfKerusakan; 
      $('#hasilKerusakan1').val(hasil1);
    });

    $('#inputNilaiKerusakan2').change(function (){
      var inputNilaiKerusakan = $(this).val();
      var klsfKerusakan = Number($('#klsfKerusakan2').val());
      jumlahUnit = $('#jumlahUnit').val();
      hasil2 = (inputNilaiKerusakan / jumlahUnit) * klsfKerusakan;
      $('#hasilKerusakan2').val(hasil2);
    });

    $('#inputNilaiKerusakan3').change(function (){
      var inputNilaiKerusakan = $(this).val();
      var klsfKerusakan = Number($('#klsfKerusakan3').val());
      jumlahUnit = $('#jumlahUnit').val();
      hasil3 = (inputNilaiKerusakan / jumlahUnit) * klsfKerusakan;
      $('#hasilKerusakan3').val(hasil3);
    });

    $('#inputNilaiKerusakan4').change(function (){
      var inputNilaiKerusakan = $(this).val();
      var klsfKerusakan = Number($('#klsfKerusakan4').val());
      jumlahUnit = $('#jumlahUnit').val();
      hasil4 = (inputNilaiKerusakan / jumlahUnit) * klsfKerusakan;
      $('#hasilKerusakan4').val(hasil4);
    });

    $('#inputNilaiKerusakan5').change(function (){
      var inputNilaiKerusakan = $(this).val();
      var klsfKerusakan = Number($('#klsfKerusakan5').val());
      jumlahUnit = $('#jumlahUnit').val();
      hasil5 = (inputNilaiKerusakan / jumlahUnit) * klsfKerusakan;
      $('#hasilKerusakan5').val(hasil5);
    });

    $('.btn-unit').click(function (){
      let sumHasil = hasil0 + hasil1 + hasil2 + hasil3 + hasil4 + hasil5;
      console.log(sumHasil);
      $.ajax({
        url: '{{ route("hitung_kerusakan_unit") }}',
        type: 'POST',
        data: { 
          id_komponen: idKomp,
          sum_hasil: sumHasil,
        },
        success: function(data) {
          console.log(data.hasil_unit);
          var hasil_unit = data.hasil_unit;
          var hiddenVal = '<input type="hidden" name="hasil_tkt_kerusakan[]" value="' + hasil_unit + '" readonly>';
          $('#td'+idKomp).html(hasil_unit + '%' + hiddenVal);
          if (hasil_unit > 0.3) {
            $('#td_keterangan'+idKomp).html('Rusak Berat');
          } else {
            $('#td_keterangan'+idKomp).html('Hitung Kerusakan Komponen Lain');
          }
        },
      });
    });

    /*$('#kerusakan').DataTable( {
      "processing" : true,
      "serverSide" : true,
      scrollY : '250px',
      dom: 'Bfrtip',
      buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
      ]
    });*/

  });
</script>