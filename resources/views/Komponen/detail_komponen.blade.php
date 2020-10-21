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
                            <label class="font-weight-bold">Nama Komponen</label>
                            <input onkeyup="this.value = this.value.toUpperCase()" value="{{ $detail1->nama }}" type="text" name="nama" class="form-control" disabled> 
                            </div>
                            <div class="table-responsive">
                              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                  <tr>
                                  <th>No</th>
                                    <th>Sub Komponen</th>
                                    <th>Bobot</th>
                                  </tr>
                                </thead>
                                <tbody>
                                @php $no = 1; @endphp
                                @forelse($detail as $val) 
                                  <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $val->nama }}</td>             
                                    <td>{{ $val->bobot }} </td>  
                                  </tr> 
                                  @empty
                                  <tr>
                                    <td colspan="5" class="text-center">Tidak Ada SubKomponen</td>
                                  </tr>
                                @endforelse  
                                </tbody>
                              </table>
                            </div>
                            <div class="card-body">
                            <div class="row">
                            </div>
                            <a class="btn btn-warning float-left mt-2" href="{{url('/masterkomponen')}}" role="button">Kembali</a>
                          </table>
                        </div>
                      </div>
                    </div>
                </div>
<!-- @include('template/footer') -->
</body>
