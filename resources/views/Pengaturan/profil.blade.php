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
                    <div class="container p-3 my-3 row">
                        <div class="card">
                            <div class="card-header">
                                Nama : Hasbi Maulana 
                            </div>
                            <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    Email 
                                </div>
                                <div class="col-sm-8">
                                    : maulanahasbi09@gmail.com
                                </div>
                                <div class="col-sm-4">
                                    Alamat  
                                </div>
                                <div class="col-sm-8">
                                    : Indonesia
                                </div>
                                <div class="col-sm-4">
                                    Role  
                                </div>
                                <div class="col-sm-8">
                                    : Super Admin
                                </div>
                            </div>
                            <a class="btn btn-warning float-left mt-2" href="{{url('pengaturan')}}" role="button">Ganti Password</a>
                            
        </table>
      </div>
    </div>
      </div>
    </div>

</body>
@include('template/footer')
</html>