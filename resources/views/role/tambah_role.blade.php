<!doctype html>
@include('template/header')

<body>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Tambah Role</h1>
          <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Form Tambah Role</h6>
                </div>
                <div class="card-body">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="nama">Nama Role :</label>
                    <input type="text" class="form-control form-control-user" id="nama" placeholder="Nama">
                  </div>
                  </br>
                  <div class="co-sm-6 mb-3 mb-sm-0">
                    <div class="card">
                      <div class="header-card bg-primary font-weight-bold text-white py-1 container-fluid">
                        Master User
                      </div>
                        <div class="body-card container-fluid">
                        <form role="form">
                          <div class="form-group">   
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" class="checkU" id="checkAllU"> Centang semua
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                            <input type="checkbox" class="checkU"> Membuat data baru
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" class="checkU"> Melihat data
                            </label>
                          </div>  
                            <div class="checkbox">
                            <label>
                              <input type="checkbox" class="checkU"> Mengedit data
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" class="checkU"> Menghapus data
                            </label>
                          </div>
                        </form>
                        </div>
                    </div></br>
                    <div class="co-sm-6 mb-3 mb-sm-0">
                    <div class="card">
                      <div class="header-card bg-primary font-weight-bold text-white py-1 container-fluid ">
                        Master Role
                      </div>
                        <div class="body-card container-fluid">
                        <form role="form">
                          <div class="form-group">   
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" class="checkR" id="checkAllR" value=""> Centang semua
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                            <input type="checkbox" class="checkR" value="gedung" > Membuat data baru
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" class="checkR" value="gedung" > Melihat data
                            </label>
                          </div>  
                            <div class="checkbox">
                            <label>
                              <input type="checkbox" class="checkR" value="gedung"> Mengedit data
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" class="checkR" value="gedung"> Menghapus data
                            </label>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div></br>
                  <div class="co-sm-6 mb-3 mb-sm-0">
                    <div class="card">
                      <div class="header-card bg-primary font-weight-bold text-white py-1 container-fluid ">
                        Master Gedung
                      </div>
                        <div class="body-card container-fluid ">
                        <form role="form">
                          <div class="form-group">   
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" class="checkG" id="checkAllG" value="gedung"> Centang semua
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                            <input type="checkbox" class="checkG" value="gedung" > Membuat data baru
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" class="checkG" value="gedung" > Melihat data
                            </label>
                          </div>  
                            <div class="checkbox">
                            <label>
                              <input type="checkbox" class="checkG" value="gedung"> Mengedit data
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" class="checkG" value="gedung"> Menghapus data
                            </label>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div></br>
                  <div class="co-sm-6 mb-3 mb-sm-0">
                    <div class="card">
                      <div class="header-card bg-primary font-weight-bold text-white py-1 container-fluid ">
                        Master Satuan
                      </div>
                        <div class="body-card container-fluid">
                        <form role="form">
                          <div class="form-group">   
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" class="checkS" id="checkAllS" value="gedung"> Centang semua
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                            <input type="checkbox" class="checkS" value="gedung" > Membuat data baru
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" class="checkS" value="gedung" > Melihat data
                            </label>
                          </div>  
                            <div class="checkbox">
                            <label>
                              <input type="checkbox" class="checkS" value="gedung"> Mengedit data
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" class="checkS" value="gedung"> Menghapus data
                            </label>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div></br>
                  <div class="co-sm-6 mb-3 mb-sm-0">
                    <div class="card">
                      <div class="header-card bg-primary font-weight-bold text-white py-1 container-fluid ">
                        Master Komponen
                      </div>
                        <div class="body-card container-fluid">
                        <form role="form">
                          <div class="form-group">   
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" class="checkP" id="checkAllP" value="gedung"> Centang semua
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                            <input type="checkbox" class="checkP" value="gedung" > Membuat data baru
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" class="checkP" value="gedung" > Melihat data
                            </label>
                          </div>  
                            <div class="checkbox">
                            <label>
                              <input type="checkbox" class="checkP" value="gedung"> Mengedit data
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" class="checkP" value="gedung"> Menghapus data
                            </label>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  </div></br>
                  <div class="co-sm-6 mb-3 mb-sm-0">
                    <div class="card">
                      <div class="header-card bg-primary font-weight-bold text-white py-1 container-fluid ">
                        Master Kerusakan
                      </div>
                        <div class="body-card container-fluid">
                        <form role="form">
                          <div class="form-group">   
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" class="checkK" id="checkAllK" value="gedung"> Centang semua
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                            <input type="checkbox" class="checkK" value="gedung" > Membuat data baru
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" class="checkK" value="gedung" > Melihat data
                            </label>
                          </div>  
                            <div class="checkbox">
                            <label>
                              <input type="checkbox" class="checkK" value="gedung"> Mengedit data
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" class="checkK" value="gedung"> Menghapus data
                            </label>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <form>
                    <hr>
                    <div class="col">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    ||  
                    <a class="btn btn-warning" href="{{url('masterrole')}}" >Kembali</a>
                    </div>
                    </div>
                  </div>
                </div>
        <!-- /.container-fluid -->
        
            <script>
            $("#checkAllU").click(function () {
                $(".checkU").prop('checked', $(this).prop('checked'));
            });
            $("#checkAllR").click(function () {
                $(".checkR").prop('checked', $(this).prop('checked'));
            });
            $("#checkAllG").click(function () {
                $(".checkG").prop('checked', $(this).prop('checked'));
            });
            $("#checkAllS").click(function () {
                $(".checkS").prop('checked', $(this).prop('checked'));
            });
            $("#checkAllP").click(function () {
                $(".checkP").prop('checked', $(this).prop('checked'));
            });
            $("#checkAllK").click(function () {
                $(".checkK").prop('checked', $(this).prop('checked'));
            });
            </script>
        </body>
@include('template/footer')
</html>