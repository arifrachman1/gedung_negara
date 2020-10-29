<!doctype html>
@include('template/header')

<body>
  <!-- Begin Page Content -->
    <div class="container-fluid">
      <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">EDIT KOMPONEN</h1>
        <form  enctype="multipart/form-data" action="{{url('editAksi', [$komponen->id])}}" method='post'>
            @csrf       
          <div class="card shadow mb-4 input-group">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Form Edit Komponen</h6>              
            </div>
              <div class="card-body">
                <!--==========================-->
                  <div class="control-group after-add-more">
                    <label class="font-weight-bold">Nama Komponen</label>
                      <input  onkeyup="this.value = this.value.toUpperCase()" type="text" name="nama" class="form-control" value="{{$komponen->nama}}">
                          <label class="font-weight-bold">Satuan</label>
                        <div class="form-group">
                          <select name="id_satuan" class="form-control">
                            @foreach($satuan as $val)
                              @if($komponen->id_satuan == $val->id)
                                <option value="{{ $val->id }}" selected>{{ $val->nama }}</option>
                              @else
                                <option value="{{ $val->id }}">{{ $val->nama }}</option>
                              @endif
                            @endforeach
                          </select>
                          <div id="placholders"></div>
                          <label class="font-weight-bold">Bobot</label>
                    <input type="number" name="bobot" value="{{$komponen->bobot}}" class="form-control"> 
                  </div> 
            </div>
            <br>
              <a href="{{url('masterkomponen')}}" class="btn btn-warning">Kembali</a>  ||  
              <button class="btn btn-success add-more" type="button">Tambah Sub Komponen</button>  ||  
              <button class="btn btn-success" type="submit">Simpan</button>

            <div id="copy">
            <div class="control-group"><br>
              @foreach($subkomponen as $key => $value)
              <div class="sub">
                <label>Subkomponen</label>
                  <input type="text" name="nama2[]" class="form-control" value="{{$value['nama'] }}">
                <label>Satuan</label>
                  <div class="form-group">
                    <select class="form-control" name="satuan2[]" id="satuan" >
                    <option value="" required>Pilih Satuan</option>
                          @foreach($satuan as $val)
                            @if($value->id_satuan == $val->id)
                              <option value="{{ $val->id }}" selected>{{ $val->nama }}</option>
                            @else
                              <option value="{{ $val->id }}">{{ $val->nama }}</option>
                            @endif
                          @endforeach
                    </select>                   
                    <div id="placholders">
                    <!-- @foreach($komponenopsi as $key => $value) -->
                      <div id="inp">
                        <input type="text" value="{{$value['opsi'] }}" name="opsikomp[][]" class="form-control" id="other-field a" placeholder="memiliki nilai 0%" required>
                      </div>
                      <!-- @endforeach -->
                    </div>                    
                    <label class="font-weight-bold">Bobot</label>                    
                      <input type="number" name="bobots[]" value="{{$value->bobot}}" class="form-control"> 
                  </div><br>
                  <button class="btn btn-danger remove" value="delet" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                <hr>
                </div>
                @endforeach
            </div>   
          </div>            
          </div>      
          </div>          
  </form>
  <div id="subkomponen">
              <div class="control-group"><br>
              <div class="sub">
                <label>Subkomponen</label>
                  <input type="text" name="nama2[]" class="form-control">
                    <label>Satuan</label>
                      <div class="form-group">
                        <select class="form-control" name="satuan2[]" id="satuan" >
                        <option value="" required>Pilih Satuan</option>
                          @foreach($satuan as $val)
                            @if($komponen->id == $val->id)
                              <option value="{{ $val->id }}">{{ $val->nama }}</option>
                            @else
                                <option value="{{ $val->id }}">{{ $val->nama }}</option>
                            @endif
                          @endforeach
                        </select>
                        <div id="placholders"></div>
                        <label class="font-weight-bold">Bobot</label>
                        <input type="number" name="bobots[]"  class="form-control"> 
                      </div><br>
                    <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button><hr>
                </div> 
                </div>           
              </div> 
          <!--==========================-->
</div>
</body>
@include('template/footer')
</html>
<script type="text/javascript">
  $(document).ready(function() {
    $("#subkomponen").hide();
    $(".add-more").click(function(){ 
      var html = $("#subkomponen").html();
      $(".after-add-more").after(html);
    });

    // saat tombol remove dklik control group akan dihapus 
    $("body").on("click",".remove",function(){ 
      $(this).parent().remove();
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