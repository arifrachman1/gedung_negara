<html lang="en">
<head>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
<br>
<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">Form Tambah Data Dinamis</div>
    <div class="panel-body">
      <!-- membuat form  -->
      <!-- gunakan tanda [] untuk menampung array  -->
            <div class="control-group after-add-more">
                    <label>Nama Komponen</label>
                    <input type="text" name="nama[]" class="form-control">
                    <label>Satuan</label>
                    <input type="text" name="nama[]" class="form-control">
                    <button class="btn btn-success add-more" type="button">
                    <i class="glyphicon glyphicon-plus"></i> Add
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
            <button class="btn btn-success" type="submit">Submit</button>
        </form>

        <!-- class hide membuat form disembunyikan  -->
        <!-- hide adalah fungsi bootstrap 3, klo bootstrap 4 pake invisible  -->
        <div class="copy hide">
            <div class="control-group">
              <label>Subkomponen</label>
              <input type="text" name="nama[]" class="form-control">
              <label>Satuan</label>
              <input type="text" name="nama[]" class="form-control">
              <br>
              <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
              <hr>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
<!-- fungsi javascript untuk menampilkan form dinamis  -->
<!-- penjelasan :
saat tombol add-more ditekan, maka akan memunculkan div dengan class copy -->

</body>
</html>