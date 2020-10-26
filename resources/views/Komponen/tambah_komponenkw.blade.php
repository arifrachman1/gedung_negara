<!doctype html>
@include('template/header')

<body>
  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">TAMBAH KOMPONEN</h1>
    <form  enctype="multipart/form-data" action="{{url('tambah_komponen_aksi')}}" method='post'>
      @csrf
      <div class="card shadow mb-4 input-group">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Form Tambah Komponen</h6>
        </div>
        <div class="card-body">
        <!--==========================-->
          <div class="control-group after-add-more">
            <label class="font-weight-bold">Nama Komponen</label>
            <input onkeyup="this.value = this.value.toUpperCase()" type="text" name="nama" class="form-control nama-komponen" required> 
            <label class="font-weight-bold">Satuan</label>
            <div class="form-group">
              <select class="form-control opsi" name="id_satuan">
                <option value="">Pilih Satuan</option>
                @foreach($satuan as $val)
                <option value="{{ $val->id }}">{{ $val->nama }}</option>
                @endforeach
              </select>
            </div>
            <label class="font-weight-bold">Bobot</label>
            <input type="number" name="bobot" class="form-control">
            <input type="hidden" id="opsi0">
            <input type="hidden" id="opsi1">
            <input type="hidden" id="opsi2">
            <input type="hidden" id="opsi3">
            <input type="hidden" id="opsi4">
            <input type="hidden" id="opsi5">
            <!-- <p id="testJSON"></p> -->
          </div><br>
          <a href="{{url('masterkomponen')}}" class="btn btn-warning">Kembali</a>  ||  
          <button class="btn btn-success add-more" type="button">Tambah Sub Komponen</button>  ||  
          <button class="btn btn-success" id="submitKomponen" type="submit">Simpan</button>
        </div>

        <div id="copy">
          <div class="control-group before-add-more"><br>
            <label>Subkomponen</label>
            <input type="text" name="nama2[]" class="form-control">
            <label>Satuan</label>
            <div class="form-group">
              <select class="form-control opsi" name="satuan2[]">
                <option value="">Pilih Satuan</option>
                @foreach($satuan as $val)
                <option value="{{ $val->id }}">{{ $val->nama }}</option>
                @endforeach
              </select>
              <label>Bobot</label>
              <input type="number" name="bobot2[]" class="form-control">
            </div> 
            <br>
            <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
            <hr>   
          </div>
        </div>
      </div>
    </form>
    <!-- Modal -->
    <div class="modal fade opsi-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Opsi Klasifikasi Kerusakan Pondasi</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <form>
              @csrf
              <label>Opsi 1 (0%)</label>
              <input type="text" name="opsi_komponen[]" class="form-control">
              <label>Opsi 2 (20%)</label>
              <input type="text" name="opsi_komponen[]" class="form-control">
              <label>Opsi 3 (40%)</label>
              <input type="text" name="opsi_komponen[]" class="form-control">
              <label>Opsi 4 (60%)</label>
              <input type="text" name="opsi_komponen[]" class="form-control">
              <label>Opsi 5 (80%)</label>
              <input type="text" name="opsi_komponen[]" class="form-control">
              <label>Opsi 6 (100%)</label>
              <input type="text" name="opsi_komponen[]" class="form-control">
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-primary save-modal" id="simpanOpsKomponen">Simpan</button>
          </div>
        </div>
      </div>
    </div>

    <div class="copy-modal">
      <div class="modal fade opsi-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Opsi Klasifikasi Kerusakan Pondasi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form>
                @csrf
                <label>Opsi 1 (0%)</label>
                <input type="text" name="opsi_komponen[]" class="form-control">
                <label>Opsi 2 (20%)</label>
                <input type="text" name="opsi_komponen[]" class="form-control">
                <label>Opsi 3 (40%)</label>
                <input type="text" name="opsi_komponen[]" class="form-control">
                <label>Opsi 4 (60%)</label>
                <input type="text" name="opsi_komponen[]" class="form-control">
                <label>Opsi 5 (80%)</label>
                <input type="text" name="opsi_komponen[]" class="form-control">
                <label>Opsi 6 (100%)</label>
                <input type="text" name="opsi_komponen[]" class="form-control">
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
              <button type="button" class="btn btn-primary save-modal" id="simpanOpsKomponen">Simpan</button>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  @include('template/footer')
</body>

<script type="text/javascript">
  $(document).ready(function() {
    
    $("#copy").hide();
    $(".copy-modal").hide();

    var no = 1;
    var jsonOpsiKomponen;
    
    $(".add-more").click(function(){ 
      var html = $("#copy").html();
      var id = "input" + no;
      $(".after-add-more").after(html);
      $(".before-add-more input").attr("id", id);
      no++;
    });
                    
    // saat tombol remove dklik control group akan dihapus 
    $("body").on("click",".remove",function(){ 
      $(this).parents(".control-group").remove();
    });

    $("body").on("change", ".opsi",function () {
      var optionVal = $(this).val();
      if ( optionVal == "1" ) {
        var namaKomp = $('div .nama-komponen').val();
        var modalKomp = namaKomp.charAt(0).toUpperCase() + namaKomp.substr(1).toLowerCase();
        console.log(namaKomp);
        var modalHeader = "<h4 class='modal-title'>Tambah Opsi Klasifikasi Kerusakan Komponen " + modalKomp + "</h4>";
        $('.modal-header').html(modalHeader);
        $('.opsi-modal').modal('show');
      }
    });

    $("#simpanOpsKomponen").on("click", function () {
      event.preventDefault();
      var inputOpsKomponen = document.getElementsByName("opsi_komponen[]");
      var a = new Array();
      var valueA = new Array();

      for (var i = 0; i < inputOpsKomponen.length; i++) {
        a[i] = inputOpsKomponen[i];
        var opsiHTML = "<input type='hidden' id='opsi" + i + "' name='opsi_komp[]' value='"  + a[i].value + "'>";
        $("#opsi" + i).replaceWith(opsiHTML);
        // valueA['opsi' + i] = a[i].value;
        console.log(valueA); 
      }

      // jsonOpsiKomponen = JSON.stringify(valueA);

      alert('Data Opsi Tersimpan');
      $('.opsi-modal').modal('hide');
    });

    

    // $("#submitKomponen").on("click", function (e) {
    //   //document.getElementById("testJSON").innerHTML = jsonOpsiKomponen;
    //   e.preventDefault();
    //   $.ajax({
    //     type: "POST",
    //     url: "tambah_komponen_aksi/",
    //     data: jsonOpsiKomponen,
    //     success:function(response){
    //       console.log(response);
    //     }
    //   });
    // });

  });
</script>

</html>