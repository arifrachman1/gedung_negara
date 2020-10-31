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
                            Nama Bangunan
                        </div>
                        <div class="col-lg-3">
                            : {{ $gedung->nama }}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            Bujur Timur   
                        </div>
                        <div class="col-lg-3">
                            : {{ $gedung->bujur_timur }}
                        </div>
                        <div class="col-lg-3">
                            Lintang Selatan   
                        </div>
                        <div class="col-lg-3">
                            : {{ $gedung->lintang_selatan }}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            Provinsi   
                        </div>
                        @if($daerah->kode_provinsi == null)
                        <div class="col-lg-3">
                            : -
                        </div>
                        @else
                        <div class="col-lg-3">
                            : {{ $provinsi->nama_provinsi }}
                        </div>
                        @endif
                        <div class="col-lg-3">
                            Kabupaten / Kota   
                        </div>
                        @if($daerah->kode_kabupaten == null)
                        <div class="col-lg-3">
                            : -
                        </div>
                        @else
                        <div class="col-lg-3">
                            : {{ $kab_kota->nama_kota }}
                        </div>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            Kecamatan   
                        </div>
                        @if($daerah->kode_kecamatan == null)
                        <div class="col-lg-3">
                            : -
                        </div>
                        @else
                        <div class="col-lg-3">
                            : {{ $kecamatan->nama_kecamatan }}
                        </div>
                        @endif
                        <div class="col-lg-3">
                            Kelurahan   
                        </div>
                        @if($daerah->kode_kelurahan == null)
                        <div class="col-lg-3">
                            : -
                        </div>
                        @else
                        <div class="col-lg-3">
                            : {{ $desa_kelurahan->nama_kelurahan }}
                        </div>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            Jumlah Lantai   
                        </div>
                        <div class="col-lg-3">
                            : {{ $gedung->jumlah_lantai }}
                        </div>
                        <div class="col-lg-3">
                            Luas Bangunan   
                        </div>
                        <div class="col-lg-3">
                            : {{ $gedung->luas }} m<sup>2</sup>
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
                        @php $no = 1; @endphp
                        <tbody>
                            @foreach($komponen as $val)
                            <tr>
                             <td>{{ $no++ }}</td>
                             @if($val->nama_komponen == null)
                             <td>{{ $val->sub_komponen }}</td>
                             <td>-</td>
                             @else   
                             <td>{{ $val->nama_komponen }}</td>
                             <td>{{ $val->sub_komponen }}</td>
                             @endif
                             <td>{{ $val->nama_satuan }}</td>
                             @if($val->id_satuan == 1)
                             <td>
                                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#Estimasi">
                                    <i class="button"><span class="icon text-white-100">Hitung</span></i>
                                </a>
                             </td>
                             @else
                             <td>
                                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#Unit">
                                    <i class="button"><span class="icon text-white-100">Hitung</span></i>
                                </a>
                             </td>
                             @endif

                             <td>100%</td>
                             <td colspan="2" > Rusak Berat</td>
                            </tr>
                            @endforeach
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
            <button type="submit" class="btn btn-success float-left mt-2 mr-2">Submit</button>
            <a class="btn btn-warning float-left mt-2" href="{{url('/master_kerusakan')}}" role="button">Kembali</a>
        </div>
      </div>
    </div>
  </div>
</div>
@include('template/footer')
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
        var $rows = $('#kerusakan tbody tr');
        var items = [],
            itemtext = [],
            currGroupStartIdx = 0;
        $rows.each(function(i) {
            var $this = $(this);
            var itemCell = $(this).find('td:eq(0)');
            var item = itemCell.text();
            itemCell.remove();
            if ($.inArray(item, itemtext) === -1) {
                itemtext.push(item);
                items.push([i, item]);
                groupRowSpan = 1;
                currGroupStartIdx = i;
                $this.data('rowspan', 1);
            } else {
                var rowspan = $rows.eq(currGroupStartIdx).data('rowspan') + 1;
                $rows.eq(currGroupStartIdx).data('rowspan', rowspan);
            }
        });

        $.each(items, function(i) {
            var $row = $rows.eq(this[0]);
            var rowspan = $row.data('rowspan');
            $row.prepend('<td rowspan"' + rowspan + '">' + this[1] + '</td>');
        });

        $('#kerusakan').DataTable( {
            "processing" : true,
            "serverSide" : true,
            scrollY : '250px',
            dom: 'Bfrtip'
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

    });
</script>
