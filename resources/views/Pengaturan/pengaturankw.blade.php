<!doctype html>
@include('template/header')

<body>
  <div class="container-fluid">

        <!-- Page Heading -->

        <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header bg-primary py-3">
          <h6 class="m-0 font-weight-bold text-white">PENGATURAN</h6>
      </div>
      <div class="card-body">
        <form action="{{ url('update_pwd/'.$user->id) }}" method="post">
          @csrf
          <div class=" py-3">
            <div class="col-sm-6 mb-3 mb-sm-0">
              <label for="nama">Kata Sandi Lama :</label>
              <input type="password" class="form-control form-control-user col-sm-6 mb-3 mb-sm-3" id="pass" placeholder="Kata Sandi Lama" name="old_pwd" required>
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
              <label for="nama">Kata Sandi Baru :</label>
              <input type="password" class="form-control form-control-user col-sm-6 mb-3 mb-sm-3" id="txtPassword" placeholder="Kata Sandi Baru" name="new_pwd" required>
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
              <label for="nama">Konfirmasi Kata Sandi Baru :</label>
              <input type="password" class="form-control form-control-user col-sm-6 mb-3 mb-sm-3" id="txtConfirmPassword" placeholder="Ulangi Kata Sandi" required>
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
              <input class="btn btn-success mr-1" type="submit" id="btnSubmit" value="Submit" />
                      <a class="btn btn-warning" href="{{url('profil')}}">Kembali</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<!--==========================================-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $("#btnSubmit").click(function () {
                var password = $("#txtPassword").val();
                var confirmPassword = $("#txtConfirmPassword").val();
                if (password != confirmPassword) {
                    alert("Kata Sandi Baru dan Konfirmasi Kata Sandi Baru harus sama!");
                    return false;
                }
                return true;
            });
        });
    </script>
<!--==========================================-->
</body>
@include('template/footer')
</html>

