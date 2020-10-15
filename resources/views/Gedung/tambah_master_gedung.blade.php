<!doctype html>
@include('template/header')

  <!-- Begin Page Content -->
<div class="container-fluid">

<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header bg-primary py-3">
        <h6 class="m-0 font-weight-bold text-white">TAMBAH DATA GEDUNG DENGAN EXCEL</h6>
      </div>
      <div class="card-body">

        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <div class="form-group">
                <label >Tambahkan dari Excel:</label>
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
              <button type="submit"  class="btn btn-success float-left mt-2">Submit</button>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card shadow mb-4">
  <div class="card-header bg-primary py-3">
    <h6 class="m-0 font-weight-bold text-white">TAMBAH DATA GEDUNG</h6>
  </div>
  <div class="card-body">

    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <form  enctype="multipart/form-data" action="{{ url('input_master_gedung') }}" method='post'>
      @csrf
    
    <div class="form-group">
      <label hidden>ID Gedung:</label>
      <input type="text" class="form-control" placeholder="ID Gedung"  name="id_gd" hidden>
    </div>

    <div class="form-group">
      <label>Nama Gedung:</label>
      <input type="text" class="form-control" placeholder="Nama Gedung"  name="nama_gd">
    </div>

    <div class="form-group">
      <label>Jenis Gedung:</label>
      <select class="form-control" name="kategori_gd">
        <option value="">Pilih Jenis Gedung</option>
        @foreach($jenis_gedung as $val)
        <option value="{{ $val->id }}">{{ $val->nama }}</option>
        @endforeach
        </select>
    </div>

    <div class="form-group">
      <label>Bujur Timur:</label>
      <input type="number" max="180" step="0.0000000001" min="0.0000000001" class="form-control" placeholder="0"  name="bt">
    </div>

    <div class="form-group">
      <label >Lintang Selatan:</label>
      <input type="number" max="90" step="0.0000000001" min="0.0000000001" class="form-control" placeholder="0" name="ls">
    </div>  
    
    <div class="form-group">
      <label>Legalitas:</label>
      <input type="text" class="form-control" placeholder="Legalitas"  name="legalitas">
    </div>

    <div class="form-group">
      <label>Tipe Milik:</label>
      <input type="text" class="form-control" placeholder="Tipe Milik"  name="tipe_milik">
    </div>

    <div class="form-group">
      <label>Alas Hak:</label>
      <input type="text" class="form-control" placeholder="Alas Hak"  name="alas_hak">
    </div>

    <div class="form-group">
      <label>Luas Lahan:</label>
      <input type="number" max="10000" step="0.0000000001" min="0.0000000001" value="0.0000000001" class="form-control" placeholder="0"  name="luas_lahan">
    </div>

    <div class="form-group">
      <label>Jumlah Lantai:</label>
      <input type="number" class="form-control" placeholder="0"  name="jumlah_lantai">
    </div>

    <div class="form-group">
      <label>Luas Bangunan:</label>
      <input type="number" max="10000" step="0.0000000001" min="0.0000000001" value="0.0000000001" class="form-control" placeholder="0"  name="luas_bangunan">
    </div>

    <div class="form-group">
      <label>Tinggi Bangunan:</label>
      <input type="number" class="form-control" placeholder="0"  name="tinggi_bangunan">
    </div>

    <div class="form-group">
      <label>Kelas Tinggi:</label>
      <input type="text" class="form-control" placeholder="Klas Tinggi"  name="kls_tinggi">
    </div>

    <div class="form-group">
      <label>Kompleks:</label>
      <input type="text" class="form-control" placeholder="Kompleks"  name="kompleks">
    </div>

    <div class="form-group">
      <label>Kepadatan:</label>
      <input type="text" class="form-control" placeholder="Kepadatan"  name="kepadatan">
    </div>

    <div class="form-group">
      <label>Permanensi:</label>
      <input type="text" class="form-control" placeholder="Permanensi"  name="permanensi">
    </div>

    <div class="form-group">
      <label>Resiko Kebakar:</label>
      <input type="text" class="form-control" placeholder="Resiko Kebakar"  name="risk_bakar">
    </div>

    <div class="form-group">
      <label>Penangkal:</label>
      <input type="text" class="form-control" placeholder="Penangkal"  name="penangkal">
    </div>

    <div class="form-group">
      <label>Struktur Bawah:</label>
      <input type="text" class="form-control" placeholder="Struktur Bawah"  name="struktur_bawah">
    </div>

    <div class="form-group">
      <label>Struktur Bangunan:</label>
      <input type="text" class="form-control" placeholder="Struktur Bangunan"  name="struktur_bangunan">
    </div>

    <div class="form-group">
      <label>Struktur Atap:</label>
      <input type="text" class="form-control" placeholder="Struktur Atap"  name="struktur_atap">
    </div>

    <div class="form-group">
      <div class="row">
        <div class="col-lg-6">
          <label>Provinsi:</label>
            <select class="form-control" id="provinsi" name="kode_provinsi">
              <option value="">Pilih Provinsi</option>
              @foreach($provinsi as $val)
              <option value="{{ $val->id_prov }}">{{ $val->nama }}</option>
              @endforeach
            </select>
        </div>

        <div class="col-lg-6">
          <label>Kabupaten/Kota:</label>
            <select class="form-control" id="kab_kota" name="kode_kota">
              <option value="0">Pilih Kabupaten/Kota</option>
            </select>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="row">
        <div class="col-lg-6">
          <label>Kecamatan:</label>
            <select class="form-control" id="kecamatan" name="kode_kecamatan">
              <option value="0">Pilih Kecamatan</option>
            </select>
        </div>

        <div class="col-lg-6">
          <label>Desa/Kelurahan:</label>
            <select class="form-control" id="desa_kelurahan" name="kode_kelurahan">
              <option value="0">Pilih Desa/Kelurahan</option>
            </select>
        </div>
      </div>
    </div>

    <button type="submit"  class="btn btn-success float-left mt-2">Submit</button>
    <a class="btn btn-warning float-left mt-2" href="{{url('/master_gedung')}}" role="button">Kembali</a>
   
        </form>
        <tbody>
          
        </tbody>
      </table>
    </div>
  </div>
</div>

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
