<html lang="en">
<head>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
<br>
<div class="container">
<div class="container">
      <div class="col-md-offset-5 col-md-5 check-row">
                      <form role="form">
                          <div class="form-group">   
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" class="check" id="checkAll" value="gedung"> Centang semua
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                            <input type="checkbox" class="check" value="gedung" > Membuat data baru
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" class="check" value="gedung" > Melihat data
                            </label>
                          </div>  
                            <div class="checkbox">
                            <label>
                              <input type="checkbox" class="check" value="gedung"> Mengedit data
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" class="check" value="gedung"> Menghapus data
                            </label>
                          </div>
                        </form>
      </div>
    </div>
</div>

<script>
$("#checkAll").click(function () {
    $(".check").prop('checked', $(this).prop('checked'));
});
$("#checkAllS").click(function () {
    $(".checkS").prop('checked', $(this).prop('checked'));
});
</script>
<!-- fungsi javascript untuk menampilkan form dinamis  -->
<!-- penjelasan :
saat tombol add-more ditekan, maka akan memunculkan div dengan class copy -->

</body>
</html>