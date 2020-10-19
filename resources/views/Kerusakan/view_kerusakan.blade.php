<!doctype html>
@include('template/header')
  <!-- Begin Page Content -->
<div class="container-fluid">

<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header bg-primary py-3">
        <h6 class="m-0 font-weight-bold text-white">FORMULIR NILAI KERUSAKAN</h6>
      </div>
      <div class="card-body">

        <div class="">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            Nama Instansi Bangunan   
                        </div>
                        <div class="col-lg-3">
                            : Dinas Pendidikan
                        </div>
                        <div class="col-lg-3">
                            Nama bangunan
                        </div>
                        <div class="col-lg-3">
                            : SMAN 19 Surabaya
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            Bujur Timur   
                        </div>
                        <div class="col-lg-3">
                            : 299,100
                        </div>
                        <div class="col-lg-3">
                            Lintang Selatan   
                        </div>
                        <div class="col-lg-3">
                            : 393,01
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            Provinsi   
                        </div>
                        <div class="col-lg-3">
                            : Jawa Timur
                        </div>
                        <div class="col-lg-3">
                            Kabupaten / Kota   
                        </div>
                        <div class="col-lg-3">
                            : Surabaya
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            Kecamatan   
                        </div>
                        <div class="col-lg-3">
                            : Kenjeran
                        </div>
                        <div class="col-lg-3">
                            Kelurahan   
                        </div>
                        <div class="col-lg-3">
                            : Tanah kali Ke Dinding
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            Jumlah Lantai   
                        </div>
                        <div class="col-lg-3">
                            : 2
                        </div>
                        <div class="col-lg-3">
                            Luas Bangunan   
                        </div>
                        <div class="col-lg-3">
                            : 100 m2
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                
                </div>
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Komponen</th>
                      <th>Subkomponen</th>
                      <th>Satuan</th>
                      <th colspan="3">Tingkat Kerusakan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Pondasi</td>
                      <td>Pondasi</td>
                      <td>Estimasi</td>
                      <td>0%</td>
                      <td colspan="2">Hitung kerusakan komponen lain</td>
                    </tr>
                    <tr>
                        <td rowspan="3">2</td>
                        <td rowspan="3">Struktur</td>
                        <td>Kolom</td>
                        <td>Unit</td>
                        <td>0%</td>
                        <td rowspan="3">0%</td>
                        <td rowspan="3">Hitung kerusakan komponen lain</td>

                    </tr>
                    <tr>
                        <td>Balok</td>
                        <td>Unit</td>
                        <td>0%</td>
                    </tr>
                    <tr>
                        <td>Pelat</td>
                        <td>Unit</td>
                        <td>0%</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Atap</td>
                        <td></td>
                        <td>%</td>
                        <td>0%</td>
                        <td colspan="2">Hitung kerusakan komponen lain</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Plafond</td>
                        <td></td>
                        <td>%</td>
                        <td>0%</td>
                        <td colspan="2">Hitung kerusakan komponen lain</td>
                    </tr>
                    <tr>
                        <td rowspan="4">5</td>
                        <td rowspan="4" >Dinding</td>
                        <td>batu Bata</td>
                        <td>%</td>
                        <td>0%</td>
                        <td rowspan="4">0%</td>
                        <td rowspan="4">Hitung kerusakan komponen lain</td>
                    </tr>
                    <tr>
                        <td>Kaca</td>
                        <td>Unit</td>
                        <td>0%</td>
                    </tr>
                    <tr>
                        <td>Pintu</td>
                        <td>Unit</td>
                        <td>0%</td>
                    </tr>
                    <tr>
                        <td>Kusen</td>
                        <td>Unit</td>
                        <td>0%</td>

                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Lantai</td>
                        <td>Penutup lantai</td>
                        <td>%</td>
                        <td>0%</td>
                        <td colspan="2">Hitung kerusakan komponen lain</td>
                    </tr>
                    <tr>
                        <td rowspan="3">7</td>
                        <td rowspan="3">Utilitas</td>
                        <td>Instalasi Listrik</td>
                        <td>Estimasi</td>
                        <td>0%</td>
                        <td rowspan="3">0%</td>
                        <td rowspan="3">Hitung kerusakan komponen lain</td>
                    </tr>
                    <tr>
                        <td>Instalasi Air</td>
                        <td>Estimasi</td>
                        <td>0%</td>
                    </tr>
                    <tr>
                        <td>Drainase Limbah</td>
                        <td>m1</td>
                        <td>0%</td>
                    </tr>
                    <tr>
                        <td rowspan="3">8</td>
                        <td rowspan="3">Finishing</td>
                        <td>Finishing Langit-Langit</td>
                        <td>%</td>
                        <td>0%</td>
                        <td rowspan="3">0%</td>
                        <td rowspan="3">Hitung kerusakan komponen lain</td>
                    </tr>
                    <tr>
                        <td>Finishing Dinding</td>
                        <td>%</td>
                        <td>0%</td>
                    </tr>
                    <tr>
                        <td>Finishing Kusen/Pintu</td>
                        <td>Unit</td>
                        <td>0%</td>
                    </tr>
                  </tbody>
                </table>
                <div class="form-group">

                </div>
                <div class="form-group">

              </div>
            </thead>
            <a href="{{ url('/master_kerusakan') }}" class="btn btn-warning float-left mt-2">Kembali</a>
        
          </table>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- @include('template/footer') -->
