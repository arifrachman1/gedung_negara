<!doctype html>
@include('template/header')
<body>
  <!-- Begin Page Content -->
<div class="container-fluid">

<!-- <div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header bg-primary py-3">
        <h6 class="m-0 font-weight-bold text-white">EDIT DATA GEDUNG DENGAN EXCEL</h6>
      </div>
      <div class="card-body">

        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <div class="form-group">
                <label >Input dari Excel:</label>
                <input type="file" name="#" class="form-control">
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-6">
                    <label>Kode Provinsi:</label>
                      <select id="select" class="form-control" name="">
                      <option value="0">Lokasi Gedung</option>
                      <option value="1">Option #1</option>
                      <option value="2">Option #2</option>
                      <option value="3">Option #3</option>
                      </select>
                  </div>

                  <div class="col-lg-6">
                    <label>Kode Kabupaten:</label>
                      <select id="select" class="form-control" name="">
                      <option value="0">Lokasi Gedung</option>
                      <option value="1">Option #1</option>
                      <option value="2">Option #2</option>
                      <option value="3">Option #3</option>
                      </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-lg-6">
                    <label>Kode Kecamatan:</label>
                      <select id="select" class="form-control" name="">
                      <option value="0">Lokasi Gedung</option>
                      <option value="1">Option #1</option>
                      <option value="2">Option #2</option>
                      <option value="3">Option #3</option>
                      </select>
                    </div>

                  <div class="col-lg-6">
                    <label>Kode Kelurahan:</label>
                      <select id="select" class="form-control" name="">
                      <option value="0">Lokasi Gedung</option>
                      <option value="1">Option #1</option>
                      <option value="2">Option #2</option>
                      <option value="3">Option #3</option>
                      </select>
                    </div>
                  </div>
                </div>
              <button type="submit"  class="btn btn-primary float-left mt-2">Submit</button>
          </table>
        </div>
      </div>
    </div>
  </div>
</div> -->

<div class="card shadow mb-4">
  <div class="card-header bg-primary py-3">
    <h6 class="m-0 font-weight-bold text-white">EDIT DATA GEDUNG</h6>
  </div>
  <div class="card-body">

    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <form action="{{ url('edit_master_gedung_post/'.$edit->id) }}" method='post'>
      @csrf

    <div class="form-group">
      <label>Nama Gedung:</label>
      <input type="text" class="form-control" placeholder="Nama Gedung"  name="nama_gd" value="{{ $edit->nama }}" required>
    </div>

    <div class="form-group">
      <label>Jenis Gedung:</label>
      <select class="form-control" name="kategori_gd" required>
        <option value="">Pilih Jenis Gedung</option>
        @foreach($kategori as $val)
          <option value="{{ $val->id }}" {{ $val->id == $edit->id_gedung_kategori ? 'selected' : ''}}>{{ $val->nama }}</option>
        @endforeach
        </select>
    </div>
    
    <div class="form-group">
      <label>Bujur Timur:</label>
      <input type="number" max="any" step="any" min="any" class="form-control" placeholder="0"  name="bt" value="{{ $edit->bujur_timur }}" required>
    </div>

    <div class="form-group">
      <label >Lintang Selatan:</label>
      <input type="number" max="any" step="any" min="any" class="form-control" placeholder="0" name="ls" value="{{ $edit->lintang_selatan }}" required>
    </div>  
    
    <div class="form-group">
      <label>legalitas:</label>
      <input type="text" class="form-control" placeholder="Legalitas"  name="legalitas" value="{{ $edit->legalitas }}" required>
    </div>

    <div class="form-group">
      <label>Tipe Milik:</label>
      <input type="text" class="form-control" placeholder="Tipe Milik"  name="tipe_milik" value="{{ $edit->tipe_milik }}" required>
    </div>

    <div class="form-group">
      <label>Alas Hak:</label>
      <input type="text" class="form-control" placeholder="Alas Hak"  name="alas_hak" value="{{ $edit->alas_hak }}" required>
    </div>

    <div class="form-group">
      <label>Luas Lahan:</label>
      <input type="number" max="10000" step="0.0000000001" min="0.0000000001" class="form-control" placeholder="0"  name="luas_lahan" value="{{ $edit->luas_lahan }}" required>
    </div>

    <div class="form-group">
      <label>Jumlah Lantai:</label>
      <input type="number" class="form-control" placeholder="0"  name="jumlah_lantai" value="{{ $edit->jumlah_lantai }}" required>
    </div>

    <div class="form-group">
      <label>Luas Bangunan:</label>
      <input type="number" max="10000" step="0.0000000001" min="0.0000000001" class="form-control" placeholder="0"  name="luas_bangunan" value="{{ $edit->luas }}" required>
    </div>

    <div class="form-group">
      <label>Tinggi Bangunan:</label>
      <input type="number" max="10000" step="0.0000000001" min="0.0000000001" class="form-control" placeholder="0"  name="tinggi_bangunan" value="{{ $edit->tinggi }}" required> 
    </div>

    <div class="form-group">
      <label>Kelas Tinggi:</label>
      <input type="text" class="form-control" placeholder="Klas Tinggi"  name="klas_tinggi" value="{{ $edit->kelas_tinggi }}" required>
    </div>

    <div class="form-group">
      <label>Kompleks:</label>
      <input type="text" class="form-control" placeholder="Kompleks"  name="kompleks" value="{{ $edit->kelas_tinggi }}" required>
    </div>

    <div class="form-group">
      <label>Kepadatan:</label>
      <input type="text" class="form-control" placeholder="kepadatan"  name="kepadatan" value="{{ $edit->kepadatan }}" required>
    </div>

    <div class="form-group">
      <label>Pemanensi:</label>
      <input type="text" class="form-control" placeholder="Pemanensi"  name="permanensi" value="{{ $edit->permanensi }}" required>
    </div>

    <div class="form-group">
      <label>Resiko Kebakaran:</label>
      <input type="text" class="form-control" placeholder="Resiko Kebakaran"  name="risk_bakar" value="{{ $edit->risk_bakar }}" required>
    </div>

    <div class="form-group">
      <label>Penangkal:</label>
      <input type="text" class="form-control" placeholder="Penangkal"  name="penangkal" value="{{ $edit->penangkal }}" required>
    </div>

    <div class="form-group">
      <label>Struktur Bawah:</label>
      <input type="text" class="form-control" placeholder="Struktur Bawah"  name="struktur_bawah" value="{{ $edit->struktur_bawah }}" required>
    </div>

    <div class="form-group">
      <label>Struktur Bangunan:</label>
      <input type="text" class="form-control" placeholder="Struktur Bangunan"  name="struktur_bangunan" value="{{ $edit->struktur_bangunan }}" required>
    </div>

    <div class="form-group">
      <label>Struktur Atap:</label>
      <input type="text" class="form-control" placeholder="Struktur Atap"  name="struktur_atap" value="{{ $edit->struktur_atap }}" required>
    </div>

    <div class="form-group">
      <div class="row">
        <div class="col-lg-6">
          <label>Provinsi:</label>
            <select id="provinsi" class="form-control" name="kode_provinsi" required>
              <option value="">Pilih Provinsi</option>
              @foreach($daerah as $prov)
                <option value="{{ $prov->id_prov }}">{{ $prov->nama }}</option>
              @endforeach
            </select>
        </div>

        <div class="col-lg-6">
          <label>Kabupaten/Kota:</label>
            <select id="kab_kota" class="form-control" name="kode_kabupaten" required>
              <option value="">Pilih Kabupaten/Kota</option>
            </select>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="row">
        <div class="col-lg-6">
          <label>Kecamatan:</label>
            <select id="kecamatan" class="form-control" name="kode_kecamatan" required>
              <option value="">Pilih Kecamatan</option>
            </select>
        </div>

        <div class="col-lg-6">
          <label>Kelurahan:</label>
            <select id="desa_kelurahan" class="form-control" name="kode_kelurahan" required>
              <option value="">Pilih Kelurahan</option>
            </select>
        </div>
      </div>
    </div>

    <button type="submit"  class="btn btn-success float-left mr-2 mt-2">Submit</button>
    <a class="btn btn-warning float-left mr-2 mt-2" href="{{url('/master_gedung')}}" role="button">Kembali</a>
   
        </form>
        <tbody>
          
        </tbody>
      </table>
    </div>
  </div>
</div>


</body>
<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(document).ready(function () {
    $('#provinsi').change(function(e) {
      $('#kab_kota').find('option').not(':first').remove();
      var id_prov = e.target.value;
      //console.log(id_prov);
      $.ajax({
        url: "{{ url('lokasi_kota') }}/"+id_prov,
        type: "GET",
        data: {
          id_prov: id_prov
        },
        success: function (data) {
          //console.log(data);
          $.each(data.kabKota[0].kabupaten_kota, function(index, kab_kota){
            $('#kab_kota').append('<option value="'+kab_kota.id_kota+'">'+kab_kota.nama+'</option>');
          })
        }
      })
    });

    $('#kab_kota').change(function(e) {
      $('#kecamatan').find('option').not(':first').remove();
      var id_kota = e.target.value;
      //console.log(id_kota);
      $.ajax({
        url: "{{ url('lokasi_kec') }}/"+id_kota,
        type: "GET",
        data: {
          id_kota: id_kota
        },
        success: function (data) {
          //console.log(data);
          $.each(data.Kecamatan[0].kecamatan, function(index, kecamatan){
            $('#kecamatan').append('<option value="'+kecamatan.id_kec+'">'+kecamatan.nama+'</option>');
          })
        }
      })
    });

    $('#kecamatan').change(function(e) {
      $('#desa_kelurahan').find('option').not(':first').remove();
      var id_kec = e.target.value;
      //console.log(id_kec);
      $.ajax({
        url: "{{ url('lokasi_desa') }}/"+id_kec,
        type: "GET",
        data: {
          id_kec: id_kec
        },
        success: function (data) {
          //console.log(data);
          $.each(data.desaKelurahan[0].desa_kelurahan, function(index, desa_kelurahan){
            $('#desa_kelurahan').append('<option value="'+desa_kelurahan.id_kel+'">'+desa_kelurahan.nama+'</option>');
          })
        }
      })
    });
  });
</script>
@include('template/footer')