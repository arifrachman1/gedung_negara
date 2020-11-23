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
                        <input onkeyup="this.value = this.value.toUpperCase()" type="text" name="nama" class="form-control" required>  
                    </div> <br>
                    <div class="control-group before-add-more"><br>
                      <label>Subkomponen</label>
                        <input type="text" name="nama2[]" class="form-control" required>
                      <label>Satuan</label>
                        <div class="form-group">
                          <select class="form-control" name="satuan2[]" id="satuan">
                          <option value="" required>Pilih Satuan</option>
                            @foreach($satuan as $val)
                              <option value="{{ $val->id }}">{{ $val->nama }}</option>
                            @endforeach
                          </select>
                          <div id="placholders"></div>
                          <label>Bobot</label>
                            <input type="number" step="any" name="bobot2[]" class="form-control"> 
                          </div> 
                        <br>

                        
                    </div>
                    <a href="{{url('masterkomponen')}}" class="btn btn-warning">Kembali</a>  ||  
                     <button class="btn btn-success add-more" type="button">Tambah Sub Komponen</button>  ||  
                     <button class="btn btn-success" type="submit">Simpan</button>
                  </div>
                  <div class="card-body">
                  <div id="copy">
                
                    <div class="control-group before-add-more"><br>
                      <label>Subkomponen</label>
                        <input type="text" name="nama2[]" class="form-control">
                      <label>Satuan</label>
                        <div class="form-group">
                          <select class="form-control" name="satuan2[]" id="satuan">
                          <option value="" required>Pilih Satuan</option>
                            @foreach($satuan as $val)
                              <option value="{{ $val->id }}">{{ $val->nama }}</option>
                            @endforeach
                          </select>
                          <div id="placholders"></div>
                          <label>Bobot</label>
                            <input type="number" step="any" name="bobot2[]" class="form-control"> 
                          </div> 
                        <br>
                          <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                        <hr>
                        
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                </div>
</form>
</div>
</body>
@include('template/footer')
</html>
<script type="text/javascript">
  $(document).ready(function() {
    let hitungan = -1;
    $("#copy").hide();
    $(".add-more").click(function(){ 
      var html = $("#copy").html();
      hitungan = hitungan + 1;
      $(".after-add-more").after(html);
    });
// saat tombol remove dklik control group akan dihapus 
    $("body").on("click",".remove",function(){ 
      hitungan = hitungan - 1;
      $(this).parents(".control-group").remove();
    });
//Komponen opsi
    $('body').on("change","#opsi",function () {
      var selectedItem = $(this).val();
        if (selectedItem == '1') {
        if (!$('#other-field').length) {
          $('<div id="in"><input type="text" name="ops[]" class="form-control" id="other-field" placeholder="memiliki nilai 0%" required><input type="text" name="ops[]" class="form-control" id="other-field" placeholder="memiliki nilai 20%" required><input type="text" name="ops[]" class="form-control" id="other-field" placeholder="memiliki nilai 40%" required><input type="text" name="ops[]" class="form-control" id="other-field" placeholder="memiliki nilai 60%" required><input type="text" name="ops[]" class="form-control" id="other-field" placeholder="memiliki nilai 80%" required><input type="text" name="ops[]" class="form-control" id="other-field" placeholder="memiliki nilai 100%" required><input type="hidden" name="nilai[]" value="0" id="other-field "><input type="hidden" name="nilai[]" value="20" id="other-field "><input type="hidden" name="nilai[]" value="40" id="other-field "><input type="hidden" name="nilai[]" value="60" id="other-field "><input type="hidden" name="nilai[]" value="80" id="other-field "><input type="hidden" name="nilai[]" value="100" id="other-field "></div>').appendTo('#placholder'); 
        }
      } else $('#in').remove();
    });

    //subKomponen opsi
    $('body').on("change","#satuan",function () {
      var selectedItem = $(this).val();
        // console.log($(this).next('div#placholders'));
        if (selectedItem == '1') {
        if (!$('#other-field a').length) {
          $(this).next('div#placholders').append(`<div id="inp"><input type="text" name="opsikomp[][]" class="form-control" id="other-field a" placeholder="memiliki nilai 0%" required><input type="text" name="opsikomp[][]" class="form-control" id="other-field a"placeholder="memiliki nilai 20%" required><input type="text" name="opsikomp[][]" class="form-control" id="other-field a"placeholder="memiliki nilai 40%" required><input type="text" name="opsikomp[][]" class="form-control" id="other-field a"placeholder="memiliki nilai 60%" required><input type="text" name="opsikomp[][]" class="form-control" id="other-field a"placeholder="memiliki nilai 80%" required><input type="text" name="opsikomp[][]" class="form-control" id="other-field a"placeholder="memiliki nilai 100%" required> <input type="hidden" name="nilai[][]" value="0" id="other-field a"><input type="hidden" name="nilai[][]" value="20" id="other-field a"><input type="hidden" name="nilai[][]" value="40" id="other-field a"><input type="hidden" name="nilai[][]" value="60" id="other-field a"><input type="hidden" name="nilai[][]" value="80" id="other-field a"><input type="hidden" name="nilai[][]" value="100" id="other-field a"></div>`);//         $().appendTo($(this).next('#placholders')); 
        }
      } else $('#inp').remove();
    });

});
</script>
