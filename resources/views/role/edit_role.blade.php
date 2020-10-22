<!doctype html>
@include('template/header')
<body>
      <!-- Begin Page Content -->
      <div class="container-fluid">
        <!-- Page Heading -->
      <h1 class="h3 mb-4 text-gray-800">Edit Role</h1>
        <form role="form" action="{{ route('role.givePermission', ['id' => $role['id']]) }}" method="POST">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Form Edit Role</h6>
                </div>
                <div class="card-body">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="nama">Nama Role :</label>
                    <input type="text" class="form-control form-control-user" name="nama" placeholder="Nama" value="{{$role['name']}}" required>
                    <input type="text" class="form-control form-control-user" name="guard_name" value="web" hidden>
                  </div>
                </div>
                </br>
                <div class="card-body">
                  <div class="co-sm-6 mb-3 mb-sm-0">
                    <div class="card">
                      <div class="header-card bg-primary font-weight-bold text-white py-1 container-fluid">
                        Master Role
                      </div>
                        <div class="body-card container-fluid">
                        @csrf
                          <div class="form-group">   
                             @php $no = 1; @endphp
                             @foreach ($permissions as $key => $row)
                             <input type="checkbox" 
                                name="hasPermissions[]" 
                                class="minimal-red" 
                                value="{{ $row->name }}"
                                @if($role->hasPermissionTo($row->name))
                                    checked = "checked"
                                @endif
                            > 
                                {{ $row->name_alias }} <br>                           
                            @endforeach
                          </div>
                        </div>
                    </div></br>
                    <div class="card">
                      <div class="header-card bg-primary font-weight-bold text-white py-1 container-fluid">
                        Master User
                      </div>
                        <div class="body-card container-fluid">
                        @csrf
                          <div class="form-group">   
                             @php $no = 1; @endphp
                             @foreach ($masteruser as $key => $row)
                             <input type="checkbox" 
                                name="hasPermissions[]" 
                                class="minimal-red" 
                                value="{{ $row->name }}"
                                @if($role->hasPermissionTo($row->name))
                                    checked = "checked"
                                @endif
                            > 
                                {{ $row->name_alias }} <br>                           
                            @endforeach
                          </div>
                        </div>
                    </div></br>
                    <div class="card">
                      <div class="header-card bg-primary font-weight-bold text-white py-1 container-fluid">
                        Master Gedung
                      </div>
                        <div class="body-card container-fluid">
                        @csrf
                          <div class="form-group">   
                             @php $no = 1; @endphp
                             @foreach ($mastergedung as $key => $row)
                             <input type="checkbox" 
                                name="hasPermissions[]" 
                                class="minimal-red" 
                                value="{{ $row->name }}"
                                @if($role->hasPermissionTo($row->name))
                                    checked = "checked"
                                @endif
                            > 
                                {{ $row->name_alias }} <br>                           
                            @endforeach
                          </div>
                        </div>
                    </div></br>
                    <div class="card">
                      <div class="header-card bg-primary font-weight-bold text-white py-1 container-fluid">
                        Master Satuan
                      </div>
                        <div class="body-card container-fluid">
                        @csrf
                          <div class="form-group">   
                             @php $no = 1; @endphp
                             @foreach ($mastersatuan as $key => $row)
                             <input type="checkbox" 
                                name="hasPermissions[]" 
                                class="minimal-red" 
                                value="{{ $row->name }}"
                                @if($role->hasPermissionTo($row->name))
                                    checked = "checked"
                                @endif
                            > 
                                {{ $row->name_alias }} <br>                           
                            @endforeach
                          </div>
                        </div>
                    </div></br>
                    <div class="card">
                      <div class="header-card bg-primary font-weight-bold text-white py-1 container-fluid">
                        Master Komponen
                      </div>
                        <div class="body-card container-fluid">
                        @csrf
                          <div class="form-group">   
                             @php $no = 1; @endphp
                             @foreach ($masterkomponen as $key => $row)
                             <input type="checkbox" 
                                name="hasPermissions[]" 
                                class="minimal-red" 
                                value="{{ $row->name }}"
                                @if($role->hasPermissionTo($row->name))
                                    checked = "checked"
                                @endif
                            > 
                                {{ $row->name_alias }} <br>                           
                            @endforeach
                          </div>
                        </div>
                    </div></br>
                    <div class="card">
                      <div class="header-card bg-primary font-weight-bold text-white py-1 container-fluid">
                        Master Kerusakan
                      </div>
                        <div class="body-card container-fluid">
                        @csrf
                          <div class="form-group">   
                             @php $no = 1; @endphp
                             @foreach ($masterkerusakan as $key => $row)
                             <input type="checkbox" 
                                name="hasPermissions[]" 
                                class="minimal-red" 
                                value="{{ $row->name }}"
                                @if($role->hasPermissionTo($row->name))
                                    checked = "checked"
                                @endif
                            > 
                                {{ $row->name_alias }} <br>                           
                            @endforeach
                          </div>
                        </div>
                    </div></br>
                    <div class="card">
                      <div class="header-card bg-primary font-weight-bold text-white py-1 container-fluid">
                        Other
                      </div>
                        <div class="body-card container-fluid">
                        @csrf
                          <div class="form-group">   
                             @php $no = 1; @endphp
                             @foreach ($excel as $key => $row)
                             <input type="checkbox" 
                                name="hasPermissions[]" 
                                class="minimal-red" 
                                value="{{ $row->name }}"
                                @if($role->hasPermissionTo($row->name))
                                    checked = "checked"
                                @endif
                            > 
                                {{ $row->name_alias }} <br>                           
                            @endforeach
                          </div>
                        </div>
                    </div></br>
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
        </form>
        </body>
@include('template/footer')
</html>