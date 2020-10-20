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
      
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <form>
            @csrf
                    <div class="container p-3 my-3 row">
                        <div class="card">
                            <div class="card-header">
                                Nama : {{ $profile->name }}
                            </div>
                            <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    Email 
                                </div>
                                <div class="col-sm-8">
                                    : {{ $profile->email }}
                                </div>
                                <div class="col-sm-4">
                                    Tanggal Akun Dibuat 
                                </div>
                                <div class="col-sm-8">
                                    : {{ $profile->created_at }}
                                </div>
                                <div class="col-sm-4">
                                    Tanggal Akun Di-Update
                                </div>
                                @if ($profile->updated_at == null)
                                <div class="col-sm-8">
                                    : -
                                </div>
                                @else
                                <div class="col-sm-8">
                                    : {{ $profile->updated_at }}
                                </div>
                                @endif
                            </div>
                            <a class="btn btn-warning float-left mt-2" href="{{url('pengaturan')}}" role="button">Ganti Kata Sandi</a>
            </form>        
        </table>
      </div>
    </div>
      </div>
    </div>

</body>
@include('template/footer')
</html>