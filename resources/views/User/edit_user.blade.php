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
          <h1 class="h3 mb-4 text-gray-800">Edit Anggota</h1>
          <div class="card shadow mb-4">
              <form action="{{ url('edituserpost/'.$edit->id) }}" method="post">
              @csrf
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Form Edit Anggota</h6>
                </div>
                <div class="card-body">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="nama">Username :</label>
                      <input type="text" name="name" class="form-control form-control-user" id="nama" placeholder="Username" value="{{ $edit->name }}" required>
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="role" class="">Role :</label><br>
                    <select class="form-control" name="role" required>
                      <option>Pilih Role</option>
                      @foreach($role as $val)
                      <option value="{{ $val->name }}" {{ $val->id == $model->role_id ? 'selected' : ''}}>{{ $val->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <!--<div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="telepon">No. Telp:</label>
                    <input type="number" class="form-control form-control" id="nama" placeholder="No. Telp">
                  </div>-->
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="email">Email:</label>
                      <input name="email" type="email" class="form-control form-control" placeholder="Email" value="{{ $edit->email }}" required>
                    </div>
                    <hr>
                    <div class="col">
                    <input class="btn btn-success mr-1" type="submit" id="btnSubmit" value="Submit" />  
                    <a class="btn btn-warning" href="{{url('masteruser')}}" ><span class="icon text-white-100">Kembali</span></a>
                    </div>
                    </div>
                  </div>
                </form>
        <!-- /.container-fluid -->
        </body>
@include('template/footer')
</html>