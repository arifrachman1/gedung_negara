<!doctype html>
@include('template/header')
<body>
<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="card shadow mb-4">
    <div class="card-header bg-primary py-3">
      <h6 class="m-0 font-weight-bold text-white">DETAIL DATA KOMPONEN</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <div class="container p-3 my-3 row">
                        <div class="card">
                            <div class="card-header">
                                Nama Komponen : PONDASI 
                            </div>
                            <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    Subkomponen  
                                </div>
                                <div class="col-sm-8">
                                    : Meja
                                </div>
                                <div class="col-sm-4">
                                </div>
                                <div class="col-sm-8">
                                    : Kursi
                                </div>
                                <div class="col-sm-4">
                                </div>
                                <div class="col-sm-8">
                                    : Pintu
                                </div>
                                <div class="col-sm-4">
                                    Bobot 
                                </div>
                                <div class="col-sm-8">
                                    : 16
                                </div>
                            </div>
                            <a class="btn btn-warning float-left mt-2" href="{{url('/masterkomponen')}}" role="button">Kembali</a>
                            
        </table>
      </div>
    </div>
  </div>

</div>
                    

<!-- @include('template/footer') -->
</body>
