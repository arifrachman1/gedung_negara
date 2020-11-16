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
      <!-- <form method="" action=""> -->
        
        <div class="panel panel-default">
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-3">
                        OPD  
                    </div>
                    <div class="col-lg-3">
                        : {{ $opd }}
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
                        Nomor Aset   
                    </div>
                    <div class="col-lg-3">
                        : {{ $nomor_aset }}
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
                        : 1. {{ $petugas_survei1 }}<br/> 
                        <br>&nbsp 2. {{ $petugas_survei2 }} <br/>
                        <br>&nbsp 3. {{ $petugas_survei3 }} <br/>
                    </div>
                    <div class="col-lg-3">
                        Perwakilan OPD
                    </div>
                    <div class="col-lg-3">
                        : 1. {{ $perwakilan_opd1 }}<br/>
                        <br>&nbsp 2. {{ $perwakilan_opd2 }}<br/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-3"> 
                        Tanggal
                    </div>
                    <div class="col-lg-3">
                        : {{ $tanggal }}
                    </div>
                    <div class="col-lg-3">
                        Jam   
                    </div>
                    <div class="col-lg-3">
                        : {{ $jam }}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-3">
                        Luas Bangunan   
                    </div>
                    <div class="col-lg-3">
                        : {{ $gedung->luas }} m<sup>2</sup>
                    </div>
                    <div class="col-lg-3">
                        Jumlah Lantai   
                    </div>
                    <div class="col-lg-3">
                        : {{ $gedung->jumlah_lantai }}
                    </div>
                </div>
            </div>   
          <a class="btn btn-info btn-icon-split mt-2 mb-2" href="{{ url('/import_master_kerusakan') }}" role="button">
            <span class="icon text-white-100">
              Import Excel
            </span> 
          </a>
          <div class="table-responsive">
            <div class="table-content">
              <table class="table table-bordered" id="kerusakan" width="100%" cellspacing="0">
                <tr>
                  <th>No.</th>
                  <th>Komponen</th>
                  <th>Subkomponen</th>
                  <th>Satuan</th>
                  <th>Opsi</th>
                  <th colspan="3">Tingkat Kerusakan</th>
                </tr>
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

                  <td id="td{{ $val->id_komponen }}" class="td-hasil" data-val="" data-qty="0" data-ops="">
                  </td>
                  <input id="id_komp{{ $val->id_komponen }}" type="hidden" name="id_komp[]" value="{{ $val->id_komponen }}">
                  <td colspan="2" id="td_keterangan{{ $val->id_komponen }}"></td>
                </tr>
                @endforeach
                <tr>
                  <td colspan="5">Jumlah Kerusakan</td>
                  <td id="totalJmlKerusakan"></td>
                  <td id="keteranganTotal" colspan="2" ></td>
                </tr>
              </table>
            </div>
            <div class="form-group">
                <label >Sketsa Denah</label>
                <input type="file" id="sketsaDenah" name="sketsa_denah" class="form-control-file">
                <p style="font-size: 9pt" class="mt-2">*Recommended max size upload 5MB</p>
            </div>
            <div class="form-group">
                <label>Gambar Bukti Kerusakan</label>
                <input type="file" id="gambarBukti" name="gambar_bukti" class="form-control-file">
                <p style="font-size: 9pt" class="mt-2">*Recommended max size upload 5MB</p>
            </div>
          </div>
            <button type="button" id="submitKerusakan" class="btn btn-success float-left m-2">Submit</button>
            <a class="btn btn-warning m-2 float-left" href="{{url('/master_kerusakan')}}" role="button">Kembali</a>
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
                <input type="number" step="0.01" id="inputNilaiKlasifikasiPersen0" class="form-control form-input" placeholder="0"  name="">
              </div>
              <div class="col-lg-3">
                % =
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
                <input type="number" step="0.01" id="inputNilaiKlasifikasiPersen1" class="form-control form-input" placeholder="0"  name="">
              </div>
              <div class="col-lg-3">
                % =
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
                <input type="number" step="0.01" id="inputNilaiKlasifikasiPersen2" class="form-control form-input" placeholder="0"  name="">
              </div>
              <div class="col-lg-3">
                % =
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
                <input type="number" step="0.01" id="inputNilaiKlasifikasiPersen3" class="form-control form-input" placeholder="0"  name="">
              </div>
              <div class="col-lg-3">
                % =
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
                <input type="number" step="0.01" id="inputNilaiKlasifikasiPersen4" class="form-control form-input" placeholder="0"  name="">
              </div>
              <div class="col-lg-3">
                % =
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
                <input type="number" step="0.01" id="inputNilaiKlasifikasiPersen5" class="form-control form-input" placeholder="0"  name="">
              </div>
              <div class="col-lg-3">
                % =
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
                <input type="number" step="0.01" id="inputNilaiKlasifikasi0" class="form-control form-input" placeholder="0"  name="">
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
                <input type="number" step="0.01" id="inputNilaiKlasifikasi1" class="form-control form-input" placeholder="0"  name="">
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
                <input type="number" step="0.01" id="inputNilaiKlasifikasi2" class="form-control form-input" placeholder="0"  name="">
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
                <input type="number" step="0.01" id="inputNilaiKlasifikasi3" class="form-control form-input" placeholder="0"  name="">
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
                <input type="number" step="0.01" id="inputNilaiKlasifikasi4" class="form-control form-input" placeholder="0"  name="">
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
                <input type="number" step="0.01" id="inputNilaiKlasifikasi5" class="form-control form-input" placeholder="0"  name="">
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
  var idKomp;
  var valueOpsi;
  var table;
  var hasil = [0, 0, 0, 0, 0, 0];
  var jumlahUnit = 0;
  var inputArr = [0,0,0,0,0,0];
  var klsfArr = [0, 0.2, 0.4, 0.6, 0.8, 1];

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  /* Convert table ke JSON
  function tableToJson() {
    var data = [];

    // first row needs to be headers
    var headers = [];
    for (var i=0; i<table.rows[0].cells.length; i++) {
        headers[i] = table.rows[0].cells[i].innerHTML.toLowerCase().replace(/ /gi,'');
    }

    // go through cells
    for (var i=1; i<table.rows.length; i++) {

        var tableRow = table.rows[i];
        var rowData = {};

        for (var j=0; j<tableRow.cells.length; j++) {

            rowData[ headers[j] ] = tableRow.cells[j].innerHTML;

        }

        data.push(rowData);
    }       

    return data;
  } */

  /* menampilkan modal estimasi kerusakan berdasarkan id komponen */
  $(document).on('click', '#hitungEstimasi', function() {
    let id = $(this).attr('data-id');
    idKomp = id;
    //console.log(id);
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
    //console.log(id);
    $('.form-input').val('');
    $('.form-hasil').val(0);
  });

  /* menampilkan modal klasifikasi kerusakan berdasarkan id komponen dengan satuan komponennya unit */
  $(document).on('click', '#hitungUnit', function() {
    let id = $(this).attr('data-id');
    idKomp = id;
    //console.log(id);
    $('#jumlah').val(0);
    $('.form-input').val('');
    $('.form-hasil').val(0);
  });

  /* menyimpan data ke table kerusakan */
  $(document).on('click', '#submitKerusakan', function() {
    var idUser = $('#idUser').val();
    var idGedung = $('#idGedung').val();
    var tanggalJam = $('#tanggalJam').val();

    // membaca data hasil perhitungan klasifikasi kerusakan
    var idKomp = $('input[name="id_komp[]"]').map(function () {
      return this.value;
    }).get();

    var idKompOpsi = $('.td-hasil').map(function () {
      return $(this).attr('data-ops');
    }).get();

    var jumlah = $('.td-hasil').map(function () {
      return $(this).attr('data-qty');
    }).get();

    var tingkatKerusakan = $('.td-hasil').map(function () {
      return $(this).attr('data-val');
    }).get();

    var inputNilaiKlsf = $('.td-hasil').map(function () {
      return $(this).data('inp-klsf');
    }).get();

    var Klasifikasi = $('.td-hasil').map(function () {
      return $(this).data('klsf');
    }).get();

    console.log(idKomp);
    console.log(idKompOpsi);
    console.log(jumlah);
    console.log(tingkatKerusakan);
    console.log(inputNilaiKlsf);
    console.log(Klasifikasi);
    
    /* upload file tanpa submit form (tidak di dalam tag form) | tutorial: https://www.webslesson.info/2017/02/upload-file-without-using-form-submit-in-ajax-php.html
    var formData = new FormData();

    // upload sketsa denah
    let fileSketsaDenah = document.getElementById('sketsaDenah').files[0];
    var nameSketsaDenah = document.getElementById('sketsaDenah').files[0].name;
    var extSketsaDenah = nameSketsaDenah.split('.').pop().toLowerCase();
    if (jQuery.inArray(extSketsaDenah, ['png', 'jpg', 'jpeg', 'pdf', 'doc']) == -1) {
      alert("Format file tidak diizinkan, format file yang diizinkan: PNG, JPG, JPEG, PDF");
    }
    let ofReaderSketsaDenah = new FileReader();
    ofReaderSketsaDenah.readAsDataURL(fileSketsaDenah);
    var fileSizeSketsaDenah = fileSketsaDenah.size||fileSketsaDenah.fileSize;

    // upload gambar bukti
    let fileGambarBukti = document.getElementById('gambarBukti').files[0];
    var nameGambarBukti = document.getElementById('gambarBukti').files[0].name;
    var extGambarBukti = nameGambarBukti.split('.').pop().toLowerCase();
    if (jQuery.inArray(extGambarBukti, ['png', 'jpg', 'jpeg', 'pdf', 'doc']) == -1) {
      alert("Format file tidak diizinkan, format file yang diizinkan: PNG, JPG, JPEG, PDF");
    }
    let ofReaderGambarBukti = new FileReader();
    ofReaderGambarBukti.readAsDataURL(fileGambarBukti);
    var fileSizeGambarBukti = fileGambarBukti.size||fileGambarBukti.fileSize;

    if (fileSizeSketsaDenah > 5000000 || fileSizeGambarBukti > 5000000) {
      alert('File terlalu besar, maksimal ukuran file 5 MB');
    } else {*/
    $.ajax({
      url: '{{ url("submit_kerusakan") }}',
      type: 'post',
      //processData: false,
      data: {
        id_user: idUser,
        id_gedung: idGedung,
        tanggal_jam: tanggalJam,
        id_komp: idKomp,
        id_komp_opsi: idKompOpsi,
        jumlah: jumlah,
        tingkat_kerusakan: tingkatKerusakan,
        input_nilai_klsf: inputNilaiKlsf,
        klasifikasi: Klasifikasi,
        //formData,
      },
      success: function(data) {
        alert('Input sukses');
        //window.location.href = "{{ url('master_kerusakan/') }}";
      },
    }); 
    //}
  });

  /* function pembulatan */
  function roundNumber(num, scale) {
    if(!("" + num).includes("e")) {
      return +(Math.round(num + "e+" + scale)  + "e-" + scale);
    } else {
      var arr = ("" + num).split("e");
      var sig = "";
      if(+arr[1] + scale > 0) {
        sig = "+";
      }
      return +(Math.round(+arr[0] + "e" + sig + (+arr[1] + scale)) + "e-" + scale);
    }
  }

  $(document).ready(function() {
    
    /* proses perhitungan estimasi kerusakan menurut opsi yang dipilih */
    $('.isi-opsi').change(function(){
      var idOpsi = $(this).find(':selected').attr('data-id');
      $('.btn-opsi').attr({'data-id': idOpsi});
    });

    $('.btn-opsi').click( function() {
      var id_komp_opsi = $('.btn-opsi').attr('data-id');
      //console.log(id_komp_opsi);
      $.ajax({
        url: '{{ route("hitung_estimasi_kerusakan") }}',
        type: 'POST',
        data: { 
          id_komponen: idKomp,
          id_komponen_opsi: id_komp_opsi,
        },
        success: function(data) {
          //console.log(data.hasil_estimasi);
          var hasil_estimasi = data.hasil_estimasi;
          hasil_estimasi = roundNumber(hasil_estimasi, 2);
          $('#td'+idKomp).attr('data-val', hasil_estimasi);
          $('#td'+idKomp).attr('data-ops', id_komp_opsi);

          $('#id_komp'+idKomp).val(idKomp);
          $('#id_komp_opsi'+idKomp).val(id_komp_opsi);
          $('#jml'+idKomp).val('');
          
          // td tingkat kerusakan kolom kiri
          var hasil_estimasi100 = hasil_estimasi * 100;
          
          //
          hasil_estimasi100 = roundNumber(hasil_estimasi100, 2);
          $('#td'+idKomp).html(hasil_estimasi100 + '%');

          // td tingkat kerusakan kolom kanan
          if (hasil_estimasi > 0.3) {
            $('#td_keterangan'+idKomp).html('Rusak Berat');
          } else {
            $('#td_keterangan'+idKomp).html('Hitung Kerusakan Komponen Lain');
          }

          // total jumlah kerusakan
          let sum = 0;
          $('.td-hasil').each(function () {
            sum += Number($(this).attr('data-val'));
          });
          var sum100 = sum * 100;

          // pembulatan
          sum100 = roundNumber(sum100, 2);
          $('#totalJmlKerusakan').html(sum100+'%');
          console.log(sum);
          if(sum <= 0.3) {
            $('#keteranganTotal').html('Tingkat Kerusakan Ringan');
          } else if (sum > 0.3 && sum <= 0.45) {
            $('#keteranganTotal').html('Tingkat Kerusakan Sedang');
          } else if (sum > 0.45) {
            $('#keteranganTotal').html('Tingkat Kerusakan Berat');
          }
        },
      });
    });

    /* proses perhitungan klasifikasi kerusakan dengan satuan komponen persen */

    $('#inputNilaiKlasifikasiPersen0').change(function (){
      let preHasil = 0;
      var inputNilaiKlasifikasi = Number($(this).val());
      var klsfKerusakan = Number($('#klsfKerusakanPersen0').val());
      inputArr[0] = inputNilaiKlasifikasi;
      if (inputNilaiKlasifikasi == null) {
        hasil[0] = 0;
      } else {
        preHasil = inputNilaiKlasifikasi * klsfKerusakan / 100;
        hasil[0] = preHasil;
      }
      if (hasil[0] == NaN) {
        hasil[0] = 0;
      }
      $('#hasilKerusakanPersen0').val(preHasil);
    });

    $('#inputNilaiKlasifikasiPersen1').change(function (){
      let preHasil = 0;
      var inputNilaiKlasifikasi = Number($(this).val());
      var klsfKerusakan = Number($('#klsfKerusakanPersen1').val());
      inputArr[1] = inputNilaiKlasifikasi;
      if (inputNilaiKlasifikasi == NaN) {
        hasil[1] = 0;
      } else {
        preHasil = inputNilaiKlasifikasi * klsfKerusakan / 100;
        hasil[1] = preHasil;
      }
      if (hasil[1] == NaN) {
        hasil[1] = 0;
      }
      $('#hasilKerusakanPersen1').val(preHasil);
    });

    $('#inputNilaiKlasifikasiPersen2').change(function (){
      let preHasil = 0;
      var inputNilaiKlasifikasi = Number($(this).val());
      var klsfKerusakan = Number($('#klsfKerusakanPersen2').val());
      inputArr[2] = inputNilaiKlasifikasi;
      if (inputNilaiKlasifikasi == NaN) {
        hasil[2] = 0;
      } else {
        preHasil = inputNilaiKlasifikasi * klsfKerusakan / 100;
        hasil[2] = preHasil;
      }
      if (hasil[2] == NaN) {
        hasil[2] = 0;
      }
      $('#hasilKerusakanPersen2').val(preHasil);
    });

    $('#inputNilaiKlasifikasiPersen3').change(function (){
      let preHasil = 0;
      var inputNilaiKlasifikasi = Number($(this).val());
      var klsfKerusakan = Number($('#klsfKerusakanPersen3').val());
      inputArr[3] = inputNilaiKlasifikasi;
      if (inputNilaiKlasifikasi == NaN) {
        hasil[3] = 0;
      } else {
        preHasil = inputNilaiKlasifikasi * klsfKerusakan / 100;
        hasil[3] = preHasil;
      }
      if (hasil[3] == NaN) {
        hasil[3] = 0;
      }
      $('#hasilKerusakanPersen3').val(preHasil);
    });

    $('#inputNilaiKlasifikasiPersen4').change(function (){
      let preHasil = 0;
      var inputNilaiKlasifikasi = Number($(this).val());
      var klsfKerusakan = Number($('#klsfKerusakanPersen4').val());
      inputArr[4] = inputNilaiKlasifikasi;
      if (inputNilaiKlasifikasi == NaN) {
        hasil[4] = 0;
      } else {
        preHasil = inputNilaiKlasifikasi * klsfKerusakan / 100;
        hasil[4] = preHasil;
      }
      if (hasil[4] == NaN) {
        hasil[4] = 0;
      }
      $('#hasilKerusakanPersen4').val(preHasil);
    });

    $('#inputNilaiKlasifikasiPersen5').change(function (){
      let preHasil = 0;
      var inputNilaiKlasifikasi = Number($(this).val());
      var klsfKerusakan = Number($('#klsfKerusakanPersen5').val());
      inputArr[5] = inputNilaiKlasifikasi;
      if (inputNilaiKlasifikasi == NaN) {
        hasil[5] = 0;
      } else {
        preHasil = inputNilaiKlasifikasi * klsfKerusakan / 100;
        hasil[5] = preHasil;
      }
      if (hasil[5] == NaN) {
        hasil[5] = 0;
      }
      $('#hasilKerusakanPersen5').val(preHasil);
    });

    $('.btn-persen').click(function (){
      sumHasil = 0;
      hasil.forEach(function(n){
        sumHasil += n;
      });
      $.ajax({
        url: '{{ route("hitung_kerusakan_persen") }}',
        type: 'POST',
        data: {
          id_komponen: idKomp,
          sum_hasil: sumHasil,
        },
        success: function(data) {
          var hasil_persen = data.hasil_persen;
          $('#td'+idKomp).attr('data-val', hasil_persen);
          //console.log(inputArr);
          //console.log(klsfArr);
          inputArr = '[[' + inputArr + ']]';
          klsfArr = '[[' + klsfArr + ']]';
          $('#td'+idKomp).attr('data-inp-klsf', inputArr);
          $('#td'+idKomp).attr('data-klsf', klsfArr);

          $('#id_komp'+idKomp).val(idKomp);
          $('#id_komp_opsi'+idKomp).val('');
          $('#jml'+idKomp).val('');
          
          hasil_persen100 = hasil_persen * 100;
          $('#td'+idKomp).html(roundNumber(hasil_persen100,2) + '%');
          if (hasil_persen > 0.3) {
            $('#td_keterangan'+idKomp).html('Rusak Berat');
          } else {
            $('#td_keterangan'+idKomp).html('Hitung Kerusakan Komponen Lain');
          }

          // total jumlah kerusakan
          let sum = 0;
          $('.td-hasil').each(function () {
            sum += Number($(this).attr('data-val'));
          });
          var sum100 = sum * 100;
          $('#totalJmlKerusakan').html(roundNumber(sum100,2) + '%');
          //console.log(sum);
          if(sum <= 0.3) {
            $('#keteranganTotal').html('Tingkat Kerusakan Ringan');
          } else if (sum > 0.3 && sum <= 0.45) {
            $('#keteranganTotal').html('Tingkat Kerusakan Sedang');
          } else if (sum > 0.45) {
            $('#keteranganTotal').html('Tingkat Kerusakan Berat');
          }

          hasil = [0,0,0,0,0,0];
          inputArr = [0,0,0,0,0,0];
          klsfArr = [0, 0.2, 0.4, 0.6, 0.8, 1];
          hasil_persen = 0;
        },
      });
    });

    /* proses perhitungan klasifikasi kerusakan dengan satuan komponen unit */
    $('#inputNilaiKlasifikasi0').change(function (){
      let preHasil = 0;
      var inputNilaiKlasifikasi = $(this).val();
      var klsfKerusakan = Number($('#klsfKerusakan0').val());
      inputArr[0] = inputNilaiKlasifikasi;
      jumlahUnit = $('#jumlahUnit').val();
      if (inputNilaiKlasifikasi == NaN) {
        hasil[0] = 0;
      } else {
        preHasil = (inputNilaiKlasifikasi / jumlahUnit) * klsfKerusakan;
        hasil[0] = preHasil;
      }
      if (hasil[0] == NaN) {
        hasil[0] = 0;
      }
      $('#hasilKerusakan0').val(preHasil);
    });

    $('#inputNilaiKlasifikasi1').change(function (){
      let preHasil = 0;
      var inputNilaiKlasifikasi = $(this).val();
      var klsfKerusakan = Number($('#klsfKerusakan1').val());
      inputArr[1] = inputNilaiKlasifikasi;
      jumlahUnit = $('#jumlahUnit').val();
      if (inputNilaiKlasifikasi == NaN) {
        hasil[1] = 0;
      } else {
        preHasil = (inputNilaiKlasifikasi / jumlahUnit) * klsfKerusakan;
        hasil[1] = preHasil;
      }
      if (hasil[1] == NaN) {
        hasil[1] = 0;
      }
      $('#hasilKerusakan1').val(preHasil);
    });

    $('#inputNilaiKlasifikasi2').change(function (){
      let preHasil = 0;
      var inputNilaiKlasifikasi = $(this).val();
      var klsfKerusakan = Number($('#klsfKerusakan2').val());
      inputArr[2] = inputNilaiKlasifikasi;
      jumlahUnit = $('#jumlahUnit').val();
      if (inputNilaiKlasifikasi == NaN) {
        hasil[2] = 0;
      } else {
        preHasil = (inputNilaiKlasifikasi / jumlahUnit) * klsfKerusakan;
        hasil[2] = preHasil;
      }
      if (hasil[2] == NaN) {
        hasil[2] = 0;
      }
      $('#hasilKerusakan2').val(preHasil);
    });

    $('#inputNilaiKlasifikasi3').change(function (){
      let preHasil = 0;
      var inputNilaiKlasifikasi = $(this).val();
      var klsfKerusakan = Number($('#klsfKerusakan3').val());
      inputArr[3] = inputNilaiKlasifikasi;
      jumlahUnit = $('#jumlahUnit').val();
      if (inputNilaiKlasifikasi == NaN) {
        hasil[3] = 0;
      } else {
        preHasil = (inputNilaiKlasifikasi / jumlahUnit) * klsfKerusakan;
        hasil[3] = preHasil;
      }
      if (hasil[3] == NaN) {
        hasil[3] = 0;
      }
      $('#hasilKerusakan3').val(preHasil);
    });

    $('#inputNilaiKlasifikasi4').change(function (){
      let preHasil = 0;
      var inputNilaiKlasifikasi = $(this).val();
      var klsfKerusakan = Number($('#klsfKerusakan4').val());
      inputArr[4] = inputNilaiKlasifikasi;
      jumlahUnit = $('#jumlahUnit').val();
      if (inputNilaiKlasifikasi == NaN) {
        hasil[4] = 0;
      } else {
        preHasil = (inputNilaiKlasifikasi / jumlahUnit) * klsfKerusakan;
        hasil[4] = preHasil;
      }
      if (hasil[4] == NaN) {
        hasil[4] = 0;
      }
      $('#hasilKerusakan4').val(preHasil);
    });

    $('#inputNilaiKlasifikasi5').change(function (){
      let preHasil = 0;
      var inputNilaiKlasifikasi = $(this).val();
      var klsfKerusakan = Number($('#klsfKerusakan5').val());
      inputArr[5] = inputNilaiKlasifikasi;
      jumlahUnit = $('#jumlahUnit').val();
      if (inputNilaiKlasifikasi == NaN) {
        hasil[5] = 0;
      } else {
        preHasil = (inputNilaiKlasifikasi / jumlahUnit) * klsfKerusakan;
        hasil[5] = preHasil;
      }
      if (hasil[5] == NaN) {
        hasil[5] = 0;
      }
      $('#hasilKerusakan5').val(preHasil);
    });

    $('.btn-unit').click(function (){
      sumHasil = 0;
      hasil.forEach(function(n){
        sumHasil += n;
      });
      //console.log(sumHasil); hasil = [0,0,0,0,0,0]; return;
      $.ajax({
        url: '{{ route("hitung_kerusakan_unit") }}',
        type: 'POST',
        data: {
          id_komponen: idKomp,
          sum_hasil: sumHasil,
        },
        success: function(data) {
          //console.log(data.hasil_unit);
          var hasil_unit = data.hasil_unit;
          var jml_unit = $('#jumlahUnit').val();
          $('#td'+idKomp).attr('data-val', hasil_unit);
          $('#td'+idKomp).attr('data-qty', jumlahUnit);
          inputArr = '[[' + inputArr + ']]';
          klsfArr = '[[' + klsfArr + ']]';
          $('#td'+idKomp).attr('data-inp-klsf', inputArr);
          $('#td'+idKomp).attr('data-klsf', klsfArr);
          let hasil_unit100 = hasil_unit * 100;
          hasil_unit100 = roundNumber(hasil_unit100, 2);

          $('#id_komp'+idKomp).val(idKomp);
          $('#id_komp_opsi'+idKomp).val('');
          $('#jml'+idKomp).val(jml_unit);

          $('#td'+idKomp).html(hasil_unit100 + '%');
          if (hasil_unit > 0.3) {
            $('#td_keterangan'+idKomp).html('Rusak Berat');
          } else {
            $('#td_keterangan'+idKomp).html('Hitung Kerusakan Komponen Lain');
          }

          // total jumlah kerusakan
          let sum = 0;
          $('.td-hasil').each(function () {
            sum += Number($(this).attr('data-val'));
          });
          let sum100 = sum * 100;
          $('#totalJmlKerusakan').html(roundNumber(sum100, 2)+'%');
          //console.log(sum);
          if(sum <= 0.3) {
            $('#keteranganTotal').html('Tingkat Kerusakan Ringan');
          } else if (sum > 0.3 && sum <= 0.45) {
            $('#keteranganTotal').html('Tingkat Kerusakan Sedang');
          } else if (sum > 0.45) {
            $('#keteranganTotal').html('Tingkat Kerusakan Berat');
          }

          hasil = [0,0,0,0,0,0];
          hasil_unit = 0;
          inputArr = [0,0,0,0,0,0];
          klsfArr = [0, 0.2, 0.4, 0.6, 0.8, 1];
          jumlahUnit = 0;
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