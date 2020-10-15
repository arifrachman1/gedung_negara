<!doctype html>
@include('template/header')
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multilpe Select</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<body>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Tambah Anggota</h1>
          <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Form Tambah Anggota</h6>
                </div>
                <div class="card-body">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                     <label for="nama">Nama :</label>
                      <input type="text" class="form-control form-control-user" id="nama" placeholder="Nama">
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="role">Role :</label>
                  <div class="col form-group">
                    <select class="mul-select" multiple="true">
                        <option value="Cambodia">Cambodia</option>
                        <option value="Khmer">Khmer</option>
                        <option value="Thiland">Thiland</option>
                        <option value="Koren">Koren</option>
                        <option value="China">China</option>
                        <option value="English">English</option>
                        <option value="USA">USA</option>
                    </select>
                </div> 
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="telepon">No. Telp:</label>
                      <input type="text" class="form-control form-control" id="nama" placeholder="No. Telp">
                  </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="pwd">Kata Sandi:</label>
                      <input type="password" class="form-control form-control" id="nama" placeholder="Password">
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="pwd">Ulangi Kata Sandi:</label>
                      <input type="password" class="form-control form-control" id="nama" placeholder="Ulangi Password">
                    </div>
                    <hr>
                    <div class="col">
                    <button type="submit" class="btn btn-success mr-1">Simpan</button>  
                    <a class="btn btn-warning" href="{{url('masteruser')}}" >Kembali</a>
                    </div>
                    </div>
                  </div>
                </div>
          
                <script>
        $(document).ready(function(){
            $(".mul-select").select2({
                    placeholder: "select country", //placeholder
                    tags: true,
                    tokenSeparators: ['/',',',';'," "] 
                });
            })
    </script>
        <!-- /.container-fluid -->
        </body>
@include('template/footer')
</html>