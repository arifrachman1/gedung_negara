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

    <div class="container">
        <div class="panel panel-default">
        
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
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3"> 
                            Tanggal Hari Ini
                        </div>
                        <div class="col-lg-2">
                            <?php $now = date("Y-m-d") ?>
                            <input class="form-control" value="<?=$now?>" readonly>
                        </div>
                    </div>
                </div>    
                <div class="table-responsive">
                    <a class="btn btn-secondary btn-icon-split" href="{{ url('') }}" role="button">
                        <span class="icon text-white-100">
                            Export Excel
                        </span> 
                    </a>
                    <table class="table table-bordered" id="kerusakan" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                             <th>No.</th>
                             <th>Komponen</th>
                             <th>Subkomponen</th>
                             <th>Satuan</th>
                             <th>Opsi</th>
                             <th colspan="3">Tingkat Kerusakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                             <td>1</td>
                             <td>Pondasi</td>
                             <td>Pondasi</td>
                             <td>Estimasi</td>
                             <td><a class="btn btn-primary" href="#" data-toggle="modal" data-target="#Estimasi">
                                <i class="button"><span class="icon text-white-100">Hitung</span></i>
                                </a></td>
                             <td>100%</td>
                             <td colspan="2" > Rusak Berat</td>
                            </tr>
                            <tr>
                             <td rowspan="3">2</td>
                             <td rowspan="3">Struktur</td>
                             <td>Kolom</td>
                             <td>Unit</td>
                             <td><a class="btn btn-primary" href="#" data-toggle="modal" data-target="#Unit">
                                <i class="button"><span class="icon text-white-100">Hitung</span></i>
                                 </a></td>
                             <td>100%</td>
                             <td rowspan="3" >300%</td>
                             <td rowspan="3">Rusak Berat</td>
                            </tr>
                            <tr>
                             <td>Balok</td>
                             <td>Unit</td>
                             <td><a class="btn btn-primary" href="#" data-toggle="modal" data-target="#Unit">
                            <i class="button"><span class="icon text-white-100">Hitung</span></i>
                             </a></td>
                             <td>100%</td>>
                            </tr>
                            <tr>
                             <td>Pelat</td>
                             <td>Unit</td>
                             <td><a class="btn btn-primary" href="#" data-toggle="modal" data-target="#Unit">
                                <i class="button"><span class="icon text-white-100">Hitung</span></i>
                             </a></td>
                             <td>100%</td>
                            </tr>
                            <tr>
                             <td>3</td>
                             <td>Atap</td>
                             <td></td>
                             <td>%</td>
                             <td><a class="btn btn-primary" href="#" data-toggle="modal" data-target="#Persen">
                                <i class="button"><span class="icon text-white-100">Hitung</span></i>
                             </a></td>
                             <td>100%</td>
                             <td colspan="2" >Rusak Berat</td>
                            </tr>
                            <tr>
                             <td>4</td>
                             <td>Plafond</td>
                             <td></td>
                             <td>%</td>
                             <td><a class="btn btn-primary" href="#" data-toggle="modal" data-target="#Persen">
                                <i class="button"><span class="icon text-white-100">Hitung</span></i>
                             </a></td>
                             <td>100%</td>
                             <td  colspan="2" > Rusak berat</td>
                            </tr>
                            <tr>
                             <td rowspan="4">5</td>
                             <td rowspan="4">Dinding</td>
                             <td>batu Bata</td>
                             <td>%</td>
                             <td><a class="btn btn-primary" href="#" data-toggle="modal" data-target="#Persen">
                                <i class="button"><span class="icon text-white-100">Hitung</span></i>
                             </a></td>
                             <td>100%</td>
                             <td rowspan="4" >400%</td>
                             <td rowspan="4">Rusak Berat</td>
                            </tr>
                            <tr>
                             <td>Kaca</td>
                             <td>Unit</td>
                             <td><a class="btn btn-primary" href="#" data-toggle="modal" data-target="#Unit">
                                <i class="button"><span class="icon text-white-100">Hitung</span></i>
                             </a></td>
                             <td>100%</td>
                            </tr>
                            <tr>
                             <td>Pintu</td>
                             <td>Unit</td>
                             <td><a class="btn btn-primary" href="#" data-toggle="modal" data-target="#Unit">
                                <i class="button"><span class="icon text-white-100">Hitung</span></i>
                                </a></td>
                             <td>100%</td>
                            </tr>
                            <tr>
                             <td>Kusen</td>
                             <td>Unit</td>
                             <td><a class="btn btn-primary" href="#" data-toggle="modal" data-target="#Unit">
                                <i class="button"><span class="icon text-white-100">Hitung</span></i>
                             </a></td>
                             <td>100%</td>
                            </tr>
                            <tr>
                             <td>6</td>
                             <td>Lantai</td>
                             <td>Penutup lantai</td>
                             <td>%</td>
                             <td><a class="btn btn-primary" href="#" data-toggle="modal" data-target="#Persen">
                                <i class="button"><span class="icon text-white-100">Hitung</span></i>
                             </a></td>
                             <td>100%</td>
                             <td  colspan="2" >Rusak Berat</td>
                            </tr>
                            <tr>
                             <td rowspan="3">7</td>
                             <td rowspan="3">Utilitas</td>
                             <td>Instalasi Listrik</td>
                             <td>Estimasi</td>
                             <td><a class="btn btn-primary" href="#" data-toggle="modal" data-target="#Estimasi">
                                <i class="button"><span class="icon text-white-100">Hitung</span></i>
                             </a></td>
                             <td>100%</td>
                             <td rowspan="3" >300%</td>
                             <td rowspan="3">Rusak Berat</td>
                            </tr>
                            <tr>
                             <td>Instalasi Air</td>
                             <td>Estimasi</td>
                             <td><a class="btn btn-primary" href="#" data-toggle="modal" data-target="#Estimasi">
                                 <i class="button"><span class="icon text-white-100">Hitung</span></i>
                             </a></td>
                             <td>100%</td>
                            </tr>
                            <tr>
                             <td>Drainase Limbah</td>
                             <td>m1</td>
                             <td><a class="btn btn-primary" href="#" data-toggle="modal" data-target="#">
                                <i class="button"><span class="icon text-white-100">Hitung</span></i>
                             </a></td>
                             <td>100%</td>
                            </tr>
                            <tr>
                             <td rowspan="3">8</td>
                             <td rowspan="3">Finishing</td>
                             <td>Finishing Langit-Langit</td>
                             <td>%</td>
                             <td><a class="btn btn-primary" href="#" data-toggle="modal" data-target="#Persen">
                                <i class="button"><span class="icon text-white-100">Hitung</span></i>
                             </a></td>
                             <td>100%</td>
                             <td rowspan="3" >300%</td>
                             <td rowspan="3">Rusak Berat</td>
                            </tr>
                            <tr>
                             <td>Finishing Dinding</td>
                             <td>%</td>
                             <td><a class="btn btn-primary" href="#" data-toggle="modal" data-target="#Persen">
                                <i class="button"><span class="icon text-white-100">Hitung</span></i>
                             </a></td>
                             <td>100%</td>
                            </tr>
                            <tr>
                             <td>Finishing Kusen/Pintu</td>
                             <td>Unit</td>
                             <td><a class="btn btn-primary" href="#" data-toggle="modal" data-target="#Unit">
                                 <i class="button"><span class="icon text-white-100">Hitung</span></i>
                             </a></td>
                             <td>100%</td>
                            </tr>
                            <tr>
                             <td colspan="5">Jumlah Kerusakan</td>
                             <td>1700%</td>
                             <td colspan="2" >Rusak Berat</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <label >Sketsa Denah Rumah:</label>
                        <input type="file" name="#" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label>Gambar Bukti Kerusakan</label>
                        <input type="file" id="file-multiple-input" name="" multiple="" class="form-control-file">
                    </div>
                </div>
            <button type="submit"  class="btn btn-success float-left mt-2 mr-2">Submit</button>
            <a class="btn btn-warning float-left mt-2" href="{{url('/master_kerusakan')}}" role="button">Kembali</a>
        </div>
      </div>
    </div>
  </div>
</div>
@include('template/footer')
<script src="https://code.jquery.com/jquery-3.5.1.js"> </script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"> </script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"> </script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"> </script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"> </script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"> </script>

<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"> </script>


<script> 
    $(document).ready(function() {
    $('#kerusakan').DataTable( {
        "processing" : true,
        "serverSide" : true,
        scrollY : '250px',
        dom: 'Bfrtip'
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>
