<!doctype html>
@include('template/header')

  <!-- Begin Page Content -->
<div class="container-fluid">

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
      <label>Nama Gedung:</label>
      <input type="text" class="form-control" placeholder="Nama Gedung"  name="nama_gd" required>
    </div>

    <div class="form-group">
      <label>Jenis Gedung:</label>
      <select class="form-control" name="kategori_gd" required>
        <option value="">Pilih Jenis Gedung</option>
        @foreach($jenis_gedung as $val)
        <option value="{{ $val->id }}">{{ $val->nama }}</option>
        @endforeach
        </select>
    </div>

    <div class="form-group">
      <label>Nomor Seri Gedung</label>
      <input type="text" class="form-control" placeholder="Nomor Seri Gedung" name="nomor_seri" required>
    </div>

    <div class="form-group">
      <label>Alamat:</label>
      <textarea name="alamat" cols="30" rows="3" class="form-control" placeholder="Masukkan Alamat Di Sini" required></textarea>
    </div>

    <div class="form-group">
      <label>Bujur Timur:</label>
      <input type="number" max="any"step="any" min="any" class="form-control" placeholder="0"  name="bt" required>
    </div>

    <div class="form-group">
      <label >Lintang Selatan:</label>
      <input type="number" max="any"step="any" min="any" class="form-control" placeholder="0" name="ls" required>
    </div>  
    
    <div class="form-group">
      <label>Legalitas:</label>
      <input type="text" class="form-control" placeholder="Legalitas"  name="legalitas" required>
    </div>

    <div class="form-group">
      <label>Tipe Pemilik:</label>
      <input type="text" class="form-control" placeholder="Tipe Pemilik"  name="tipe_pemilik" required>
    </div>

    <div class="form-group">
      <label>Alas Hak:</label>
      <input type="text" class="form-control" placeholder="Alas Hak"  name="alas_hak" required>
    </div>

    <div class="form-group">
      <label>Luas Lahan:</label>
      <input type="number" max="any"step="any" min="any"  class="form-control" placeholder="0"  name="luas_lahan" required>
    </div>

    <div class="form-group">
      <label>Jumlah Lantai:</label>
      <input type="number" class="form-control" placeholder="0"  name="jumlah_lantai" required>
    </div>

    <div class="form-group">
      <label>Luas Bangunan:</label>
      <input type="number" max="any"step="any" min="any" class="form-control" placeholder="0"  name="luas_bangunan" required>
    </div>

    <div class="form-group">
      <label>Tinggi Bangunan:</label>
      <input type="number" max="1000"step="any" min="any" class="form-control" placeholder="0"  name="tinggi_bangunan" required>
    </div>

    <div class="form-group">
      <label>Kompleksitas:</label>
      <input type="text" class="form-control" placeholder="Kompleksitas"  name="kompleks" required>
    </div>

    <div class="form-group">
      <label>Kepadatan:</label>
      <input type="text" class="form-control" placeholder="Kepadatan"  name="kepadatan" required>
    </div>

    <div class="form-group">
      <label>Permanensi:</label>
      <input type="text" class="form-control" placeholder="Permanensi"  name="permanensi" required>
    </div>

    <div class="form-group">
      <label>Tingkat Resiko Kebakaran:</label>
      <input type="text" class="form-control" placeholder="Tingkat Resiko Kebakaran"  name="rsk_kebakaran" required>
    </div>

    <div class="form-group">
      <label>Penangkal Petir:</label>
      <input type="text" class="form-control" placeholder="Penangkal Petir"  name="penangkal_petir" required>
    </div>

    <div class="form-group">
      <label>Struktur Bawah:</label>
      <input type="text" class="form-control" placeholder="Struktur Bawah"  name="struktur_bawah" required>
    </div>

    <div class="form-group">
      <label>Struktur Bangunan:</label>
      <input type="text" class="form-control" placeholder="Struktur Bangunan"  name="struktur_bangunan" required>
    </div>

    <div class="form-group">
      <label>Struktur Atap:</label>
      <input type="text" class="form-control" placeholder="Struktur Atap"  name="struktur_atap" required>
    </div>

    <div class="form-group">
      <label>KDB:</label>
      <input type="text" class="form-control" placeholder="KDB"  name="kdb" required>
    </div>

    <div class="form-group">
      <label>KLB:</label>
      <input type="text" class="form-control" placeholder="KLB"  name="klb" required>
    </div>

    <div class="form-group">
      <label>KDH:</label>
      <input type="text" class="form-control" placeholder="KDH"  name="kdh" required>
    </div>

    <div class="form-group">
      <label>GSB:</label>
      <input type="text" class="form-control" placeholder="GSB"  name="gsb" required>
    </div>

    <div class="form-group">
      <label>RTH:</label>
      <input type="text" class="form-control" placeholder="RTH"  name="rth" required>
    </div>

    <!-- <div class="form-group">
      <div class="row">
        <div class="col-lg-6">
          <label>Provinsi:</label>
            <select class="form-control" id="provinsi" name="kode_provinsi">
              <option value="">Pilih Provinsi</option>
              <option value=""></option>
              endforeach
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
    </div> -->

    <button type="submit"  class="btn btn-success float-left mr-2 mt-2">Submit</button>
    <a class="btn btn-warning float-left mr-2 mt-2" href="{{url('/master_gedung')}}" role="button">Kembali</a>
   
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