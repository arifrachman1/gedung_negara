<!doctype html>
@include('template/header')

<body>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">EDIT KOMPONEN</h1>
          <div class="card shadow mb-4 input-group">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Form Edit Komponen</h6>
                </div>
                <div class="card-body">
                      <!--==========================-->
                      <div class="control-group after-add-more">
                    <label class="font-weight-bold">Nama Komponen</label>
                    <input type="text" name="nama[]" class="form-control">
                    <label class="font-weight-bold">Satuan</label>
                    <div class="form-group">
                        <select class="form-control" id="satuan">
                          <option>Unit</option>
                          <option>Persen</option>
                          <option>Estimasi</option>
                        </select>
                      </div> 
                    <br>
                    <button class="btn btn-success add-more" type="button">Tambah Subkomponen</button>  ||  <button class="btn btn-success" type="submit">Simpan</button>
                    <button class="btn btn-warning float-left mt-2" href="{{url('/masterkomponen')}}" >Kembali</button>
            </div>
            <div class="copy invisible">
            <div class="control-group"><br>
              <label>Subkomponen</label>
              <input type="text" name="nama[]" class="form-control">
              <label>Satuan</label>
                    <div class="form-group">
                        <select class="form-control" id="satuan">
                          <option>Unit</option>
                          <option>Persen</option>
                          <option>Estimasi</option>
                        </select>
                      </div> 
              <br>
              <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
              <hr>

            </div>
            
          </div>
          
        </div>
        
            <script type="text/javascript">
                $(document).ready(function() {
                $(".add-more").click(function(){ 
                    var html = $(".copy").html();
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

<!-- Copy Fields -->

        </body>
@include('template/footer')


</script>

</html>