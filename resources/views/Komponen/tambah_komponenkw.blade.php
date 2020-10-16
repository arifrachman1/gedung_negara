<!doctype html>
@include('template/header')

<body>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">TAMBAH KOMPONEN</h1>
          <form  enctype="multipart/form-data" action="{{url('tambahAksi')}}" method='post'>
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
                      <label class="font-weight-bold">Satuan</label>
                        <div class="form-group">
                          <select name="id_satuan" class="form-control">
                              @foreach($satuan as $val)
                              <option value="{{ $val->id }}">{{ $val->nama }}</option>
                              @endforeach
                          </select>
                        </div>
                        <label class="font-weight-bold">Bobot</label>
                          <input type="text" name="bobot" class="form-control"> 
                    </div> 
                    
                    <br>
                    <button class="btn btn-success add-more" type="button">Tambah Subkomponen</button>  ||  
                    <button class="btn btn-success" type="submit">Simpan</button>
                  </div>
                  <div id="copy">
                    <div class="control-group"><br>
                      <label>Subkomponen</label>
                        <input type="text" name="nama2[]" class="form-control">
                      <label>Satuan</label>
                        <div class="form-group">
                          <select class="form-control" name="satuan2[]" id="satuan">
                            @foreach($satuan as $val)
                              <option value="{{ $val->id }}">{{ $val->nama }}</option>
                            @endforeach
                          </select>
                          <label>Bobot</label>
                            <input type="text" name="bobot2" class="form-control"> 
                          </div> 
                        <br>
                          <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                        <hr>
                    </div>
                  </div>
                </div>
            <script type="text/javascript">
                $(document).ready(function() {
                $("#copy").hide();
                $(".add-more").click(function(){ 
                    var html = $("#copy").html();
                    $(".after-add-more").after(html);
                });
                // saat tombol remove dklik control group akan dihapus 
                $("body").on("click",".remove",function(){ 
                    $(this).parents(".control-group").remove();
                });
                });
            </script>
        </form>
                      <!--==========================-->
                </div>
        </body>
@include('template/footer')
</script>

</html>