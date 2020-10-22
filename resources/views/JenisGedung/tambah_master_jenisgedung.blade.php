<!doctype html>
@include('template/header')

  <!-- Begin Page Content -->
<div class="container-fluid">

<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header bg-primary py-3">
        <h6 class="m-0 font-weight-bold text-white">TAMBAH DATA JENIS GEDUNG</h6>
      </div>
      <div class="card-body">

        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <form action="{{ url('tambah_master_jenisgedung_post') }}" method="post">
            @csrf
              <div class="form-group">
                <label hidden>id:</label>
                <input type="text" name="#" class="form-control" hidden>
              </div>
              <div class="form-group">
                <label >Nama Jenis Gedung:</label>
                <input type="text" class="form-control" placeholder="Masukkan Nama Jenis Gedung"  name="nama_jenis_gedung" required>
                <!-- <div class="valid-feedback">Sudah Terisi.</div>
                <div class="invalid-feedback">Harap Di Isi.</div> -->
              </div>
              <button type="submit"  class="btn btn-success float-left mt-2 mr-2">Submit</button>
              <a class="btn btn-warning float-left mt-2" href="{{ url('/master_jenisgedung') }}" role="button">Kembali</a>
            </form>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>


<!-- <script>
// Disable form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script> -->

@include('template/footer')