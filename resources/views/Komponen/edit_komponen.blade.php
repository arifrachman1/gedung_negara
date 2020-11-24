<!doctype html>
@include('template/header')

<body>
  <!-- Begin Page Content -->
    <div class="container-fluid">
    <div>
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
             </div>            
            <div id="copy">
            <div class="control-group"><br>
              @foreach($subkomponen as $key => $value) 
              <div class="subkom">
              <input type="text " id="id_komponen" value="{{$value['id']}}" hidden>
                <label>Subkomponen</label>
                  <input type="text" name="nama2[]" class="form-control" value="{{$value['nama'] }}">
                <label>Satuan</label>
                  <div class="form-group">
                    <select class="form-control select-satuan" data-satuan="{{$value['id']}}" name="satuan2[]" id="satuans" >
                    <option value="" required>Pilih Satuan</option>
                          @foreach($satuan as $val)
                            @if($value->id_satuan == $val->id)
                              <option value="{{ $val->id }}" selected>{{ $val->nama }}</option>
                            @else
                              <option value="{{ $val->id }}">{{ $val->nama }}</option>
                            @endif
                          @endforeach
                    </select>   

                    <!-- komponen opsi -->
                    <?php 
                      $komponen_opsi = DB::table('komponen_opsi')->where('id_komponen', $value['id'])->get();
                    ?>
                    <div id="inputan" value="{{$value['id']}}">
                    @if($value->id_satuan === 1)
                      @foreach($komponen_opsi as $komp)
                      <!-- <input type="text " id="id_komponen" value="{{$value['id']}}" hidden> -->
                        <input type="text" name="opsikomp[][]" class="form-control" id="other-field a" value="{{$komp->opsi}}" required>   
                        <input type="hidden" name="nilai[][]" value="{{$komp->nilai}}" id="other-field a">                    
                      @endforeach
                    @else

                    @endif
                   
                    </div>
                    <div id="placholder"></div>
                    <!-- bobot -->
                    <label class="font-weight-bold">Bobot</label>                    
                      <input type="number" step="any" name="bobots[]" value="{{$value->bobot}}" class="form-control"> 
                  </div><br>
                  <button class="btn btn-danger remove" value="delet" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                <hr>
                </div>
                @endforeach
            </div>   
          </div>  
            <br>
              <a href="{{url('masterkomponen')}}" class="btn btn-warning">Kembali</a>  ||  
              <button class="btn btn-success add-more" type="button">Tambah Sub Komponen</button>  ||  
              <button class="btn btn-success" type="submit">Simpan</button>
          
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
                        <input type="number" step="any" name="bobots[]"  class="form-control"> 
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
    let hitungan = -1;
    $("#subkomponen").hide();
    $(".add-more").click(function(){ 
      var html = $("#subkomponen").html();
      hitungan = hitungan + 1;
      $(".after-add-more").after(html);
    });

    // saat tombol remove dklik control group akan dihapus 
    $("body").on("click",".remove",function(){
      hitungan = hitungan - 1; 
      $(this).parent().remove();
    });

    // $('body').on("change","#satuans",function () {
    //   var selectedItem = $(this).val();
    //     // console.log($(this).next('div#inputan'));   // inii buat nampilin yang ada isinya ko ohh iy njir
    //     if (selectedItem == '1') {
    //     // if (!$('#other-field a').length) {
    //       $(this).next('div#inputan').show();//         $().appendTo($(this).next('#placholders'));         
    //   } else $('div#inputan').css('display','none');
    // });
    //subKomponen opsi

    $('body').on("change","#satuans",function () {
      var selectedItem = $(this).val();
        // console.log($(this).next('div#placholders'));
        if (selectedItem == '1') {
          if($(this).next('div#inputan').children().length > 0){
            $(this).next('div#inputan').show();
              } else {
                $(this).next(`div#inputan`).append(`<div id="inp"><input type="text" name="opsikomp[][]" class="form-control" id="other-field a" placeholder="memiliki nilai 0%" required><input type="text" name="opsikomp[][]" class="form-control" id="other-field a"placeholder="memiliki nilai 20%" required><input type="text" name="opsikomp[][]" class="form-control" id="other-field a"placeholder="memiliki nilai 40%" required><input type="text" name="opsikomp[][]" class="form-control" id="other-field a"placeholder="memiliki nilai 60%" required><input type="text" name="opsikomp[][]" class="form-control" id="other-field a"placeholder="memiliki nilai 80%" required><input type="text" name="opsikomp[][]" class="form-control" id="other-field a"placeholder="memiliki nilai 100%" required> <input type="hidden" name="nilai[][]" value="0" id="other-field a"><input type="hidden" name="nilai[][]" value="20" id="other-field a"><input type="hidden" name="nilai[][]" value="40" id="other-field a"><input type="hidden" name="nilai[][]" value="60" id="other-field a"><input type="hidden" name="nilai[][]" value="80" id="other-field a"><input type="hidden" name="nilai[][]" value="100" id="other-field a"></div>`);
                }      
          }
       else { $(this).next('div#inputan').hide(); }
    });

    //add new
    $('body').on("change","#satuan",function () {
      var selectedItem = $(this).val();
        // console.log($(this).next('div#placholders'));
        if (selectedItem == '1') {
        if (!$('#other-field a').length) {
          $(this).next('div#placholders').append(`<div id="inp"><input type="text" name="opsikomp[][]" class="form-control" id="other-field a" placeholder="memiliki nilai 0%" required><input type="text" name="opsikomp[][]" class="form-control" id="other-field a"placeholder="memiliki nilai 20%" required><input type="text" name="opsikomp[][]" class="form-control" id="other-field a"placeholder="memiliki nilai 40%" required><input type="text" name="opsikomp[][]" class="form-control" id="other-field a"placeholder="memiliki nilai 60%" required><input type="text" name="opsikomp[][]" class="form-control" id="other-field a"placeholder="memiliki nilai 80%" required><input type="text" name="opsikomp[][]" class="form-control" id="other-field a"placeholder="memiliki nilai 100%" required> <input type="hidden" name="nilai[][]" value="0" id="other-field a"><input type="hidden" name="nilai[][]" value="20" id="other-field a"><input type="hidden" name="nilai[][]" value="40" id="other-field a"><input type="hidden" name="nilai[][]" value="60" id="other-field a"><input type="hidden" name="nilai[][]" value="80" id="other-field a"><input type="hidden" name="nilai[][]" value="100" id="other-field a"></div>`);//         $().appendTo($(this).next('#placholders')); 
        }
      } else  $(this).next('div#placholders').children().remove();
    });
});


</script>

