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
                              @if($komponen->id == $val->id)
                                <option value="{{ $val->id }}" selected>{{ $val->nama }}</option>
                              @else
                                <option value="{{ $val->id }}">{{ $val->nama }}</option>
                              @endif
                            @endforeach
                          </select>
                          <label class="font-weight-bold">Bobot</label>
                    <input type="text" name="bobot" value="{{$komponen->bobot}}" class="form-control"> 
                  </div> 
                <br>
              <button class="btn btn-success add-more" type="button">Tambah Subkomponen</button>  ||  <button class="btn btn-success" type="submit">Simpan</button>
            </div>
            <div id="copy">
            <div class="control-group"><br>
              @foreach($subkomponen as $key => $value)
              <div class="sub">
                <label>Subkomponen</label>
                  <input type="text" name="nama2[]" class="form-control" value="{{$value['nama'] }}">
                <label>Satuan</label>
                  <div class="form-group">
                    <select class="form-control" name="satuan2[]" id="satuan" >
                          @foreach($satuan as $val)
                            @if($komponen->id == $val->id)
                              <option value="{{ $val->id }}" selected>{{ $val->nama }}</option>
                            @else
                              <option value="{{ $val->id }}">{{ $val->nama }}</option>
                            @endif
                          @endforeach
                    </select>
                    <label class="font-weight-bold">Bobot</label>
                      <input type="text" name="bobots[]" value="{{$value->bobot}}" class="form-control"> 
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
                          @foreach($satuan as $val)
                            @if($komponen->id == $val->id)
                              <option value="{{ $val->id }}">{{ $val->nama }}</option>
                            @else
                                <option value="{{ $val->id }}">{{ $val->nama }}</option>
                            @endif
                          @endforeach
                        </select>
                        <label class="font-weight-bold">Bobot</label>
                        <input type="text" name="bobots[]"  class="form-control"> 
                      </div><br>
                    <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button><hr>
                </div> 
                </div>           
              </div> 
          <!--==========================-->
</div>
</body>
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
        });
      </script>
@include('template/footer')
</script>

</html>