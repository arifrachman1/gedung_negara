<!doctype html>
@include('template/header')

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
                    <a class="btn btn-warning" href="{{url('masteruser')}}" >Kembali</a>
                    </div>
                    </div>
                  </div>
                </form>
        <!-- /.container-fluid -->
        </body>
@include('template/footer')
</html>