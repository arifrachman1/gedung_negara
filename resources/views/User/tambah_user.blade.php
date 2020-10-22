<!doctype html>
@include('template/header')

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
                
                @if (Session::has('success'))
                  <div class="alert alert-success">
                    {{ Session::get('success') }}
                  </div>
                @endif
                @if (Session::has('error'))
                  <div class="alert alert-danger">
                    {{ Session::get('error') }}
                  </div>
                @endif

                <div class="card-body">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                     <label for="nama">Username :</label>
                      <input type="text" class="form-control form-control-user" name="name" id="nama" placeholder="Username" required>
                      @foreach($errors->get('username') as $error)
                        <span class="help-block">{{ $error }}</span>
                      @endforeach
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="role" class="">Role :</label><br>
                    <select class="form-control" name="role" required>
                      <option>Pilih Role</option>
                      @foreach($role as $val)
                      <option value="{{ $val->name }}">{{ $val->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <!--<div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="telepon">No. Telp:</label>
                    <input type="number" class="form-control form-control" placeholder="No. Telp">
                  </div>-->
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="email">Email:</label>
                      <input name="email" type="email" class="form-control form-control" placeholder="Email" required>
                      @foreach($errors->get('email') as $error)
                        <span class="help-block">{{ $error }}</span>
                      @endforeach
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="pwd">Kata Sandi:</label>
                      <input type="password" name="password" class="form-control form-control-user" id="txtPassword" placeholder="Kata Sandi" required>
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="pwd">Konfirmasi Kata Sandi:</label>
                      <input type="password" class="form-control form-control-user" id="txtConfirmPassword" placeholder="Konfirmasi Kata Sandi" required>
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
                                      alert("Kata Sandi dan Konfirmasi Kata Sandi Harus Sama!");
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