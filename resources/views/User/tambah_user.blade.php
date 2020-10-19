<!doctype html>
@include('template/header')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<body>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Tambah Anggota</h1>
          <div class="card shadow mb-4">
              <form action="{{url('inputuserpost')}}" method="post">
              @csrf
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Form Tambah Anggota</h6>
                </div>
                <div class="card-body">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                     <label for="nama">Nama :</label>
                      <input type="text" class="form-control form-control-user" name="name" id="nama" placeholder="Nama">
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="role" class="">Role :</label><br>
                    <select class="col selectpicker" multiple data-live-search="true">
                      <option value="1">Admin</option>
                      <option value="2">Superadmin</option>
                      <option value="3">Bukan Admin</option>
                    </select>
                  </div>
                  <!--<div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="telepon">No. Telp:</label>
                    <input type="number" class="form-control form-control" placeholder="No. Telp">
                  </div>-->
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="email">Email:</label>
                      <input name="email" type="email" class="form-control form-control" placeholder="Email">
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="pwd">Kata Sandi:</label>
                      <input type="password" name="password" class="form-control form-control-user" id="txtPassword" placeholder="Kata Sandi">
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="pwd">Ulangi Kata Sandi:</label>
                      <input type="password" class="form-control form-control-user" id="txtConfirmPassword" placeholder="Kata Sandi">
                    </div>
                    <hr>
                    <div class="col">
                    <input class="btn btn-success mr-1" type="submit" id="btnSubmit" value="Submit" />  
                    <a class="btn btn-warning" href="{{url('masteruser')}}" >Kembali</a>
                    </div>
                    </div>
                  </div>
                </form>
                  <!--==========================================-->
                <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
                <script type="text/javascript">
                          $(function () {
                              $("#btnSubmit").click(function () {
                                  var password = $("#txtPassword").val();
                                  var confirmPassword = $("#txtConfirmPassword").val();
                                  if (password != confirmPassword) {
                                      alert("Kata Sandi dan konfirmasi Kata Sandi harus sama!");
                                      return false;
                                  }
                                  return true;
                              });
                          });
                </script>
<!--==========================================-->
        <!-- /.container-fluid -->
        </body>
@include('template/footer')
</html>