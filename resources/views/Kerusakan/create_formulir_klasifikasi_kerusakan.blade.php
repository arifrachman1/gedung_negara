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
                  <input type="hidden" id="idKerusakan" name="id_kerusakan" value="{{ $id_kerusakan }}">
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
                             <td class="estimasi">
                                <button class="btn btn-primary" onclick="showOpsi({{$val->id_komponen}})">
                                  <i class="button"><span class="icon text-white-100">Hitung</span></i>
                                </button>
                             </td>
                             @else
                             <td class="numerik">
                                <button class="btn btn-primary" onclick="showNumerik({{$val->id_komponen}})">
                                  <i class="button"><span class="icon text-white-100">Hitung</span></i>
                                </button>
                             </td>
                             @endif

                             <td id="td{{ $val->id_komponen }}"></td>
                             <td colspan="2" id="td_keterangan{{ $val->id_komponen }}"></td>
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
            <input type="submit" class="btn btn-success float-left mt-2 mr-2" value="Submit">
            <a class="btn btn-warning float-left mt-2" href="{{url('/master_kerusakan')}}" role="button">Kembali</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Estimasi-->
<div class="modal fade" id="modalEstimasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Klasifikasi Kerusakan</h5>
          <button class="close" type="button" onclick="closeOpsi()">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Satuan : Estimasi</label>
              <select class="form-control isi-opsi" name="" required>
                <option>Pilih Opsi</option>
              </select>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success btn-opsi" type="button">Simpan</button>
        </div>
      </div>
    </div>
</div>

<!-- Modal Unit-->
<div class="modal fade" id="modalUnit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Klasifikasi Kerusakan</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"> 
            <div class="row">
              <div class="col-lg-2">
                <label>Jumlah =</label>
              </div>
              <div class="col-lg-2">
                <input type="text" class="form-control" placeholder="0"  name="">
              </div>
            </div>  
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="col-lg-2">
              <label>Perhitungan</label>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-lg-3">
                0,00   
              </div>
              <div class="col-lg-3">
                <input type="text" class="form-control" placeholder="0"  name="">
              </div>
              <div class="col-lg-3">
                =
              </div>
              <div class="col-lg-3">
                <input type="text" class="form-control" placeholder="0"  name="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-lg-3">
                0,20   
              </div>
              <div class="col-lg-3">
                <input type="text" class="form-control" placeholder="0"  name="">
              </div>
              <div class="col-lg-3">
                =
              </div>
              <div class="col-lg-3">
                <input type="text" class="form-control" placeholder="0"  name="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-lg-3">
                0,40   
              </div>
              <div class="col-lg-3">
                <input type="text" class="form-control" placeholder="0"  name="">
              </div>
              <div class="col-lg-3">
                =
              </div>
              <div class="col-lg-3">
                <input type="text" class="form-control" placeholder="0"  name="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-lg-3">
                0,60   
              </div>
              <div class="col-lg-3">
                <input type="text" class="form-control" placeholder="0"  name="">
              </div>
              <div class="col-lg-3">
                =
              </div>
              <div class="col-lg-3">
                <input type="text" class="form-control" placeholder="0"  name="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-lg-3">
                0,80   
              </div>
              <div class="col-lg-3">
                <input type="text" class="form-control" placeholder="0"  name="">
              </div>
              <div class="col-lg-3">
                =
              </div>
              <div class="col-lg-3">
                <input type="text" class="form-control" placeholder="0"  name="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-lg-3">
                1,00   
              </div>
              <div class="col-lg-3">
                <input type="text" class="form-control" placeholder="0"  name="">
              </div>
              <div class="col-lg-3">
                =
              </div>
              <div class="col-lg-3">
                <input type="text" class="form-control" placeholder="0"  name="">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success" type="button">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Unit-->
  <div class="modal fade" id="Persen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Klasifikasi Kerusakan</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"> 
            <div class="row">
              <div class="col-lg-2">
                <label>Jumlah=</label>
              </div>
              <div class="col-lg-2">
                <input type="text" class="form-control" placeholder="0"  name="">
              </div>
            </div>  
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="col-lg-2">
              <label>Perhitungan</label>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-lg-3">
                0%   
              </div>
              <div class="col-lg-3">
                <input type="text" class="form-control" placeholder="0"  name="">
              </div>
              <div class="col-lg-3">
                =
              </div>
              <div class="col-lg-3">
                <input type="text" class="form-control" placeholder="0"  name="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-lg-3">
                20%   
              </div>
              <div class="col-lg-3">
                <input type="text" class="form-control" placeholder="0"  name="">
              </div>
              <div class="col-lg-3">
                =
              </div>
              <div class="col-lg-3">
                <input type="text" class="form-control" placeholder="0"  name="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-lg-3">
                40%   
              </div>
              <div class="col-lg-3">
                <input type="text" class="form-control" placeholder="0"  name="">
              </div>
              <div class="col-lg-3">
                =
              </div>
              <div class="col-lg-3">
                <input type="text" class="form-control" placeholder="0"  name="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-lg-3">
                60%   
              </div>
              <div class="col-lg-3">
                <input type="text" class="form-control" placeholder="0"  name="">
              </div>
              <div class="col-lg-3">
                =
              </div>
              <div class="col-lg-3">
                <input type="text" class="form-control" placeholder="0"  name="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-lg-3">
                80%   
              </div>
              <div class="col-lg-3">
                <input type="text" class="form-control" placeholder="0"  name="">
              </div>
              <div class="col-lg-3">
                =
              </div>
              <div class="col-lg-3">
                <input type="text" class="form-control" placeholder="0"  name="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-lg-3">
                100%   
              </div>
              <div class="col-lg-3">
                <input type="text" class="form-control" placeholder="0"  name="">
              </div>
              <div class="col-lg-3">
                =
              </div>
              <div class="col-lg-3">
                <input type="text" class="form-control" placeholder="0"  name="">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success" type="button">Simpan</button>
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
    var idKomp;
    var valueOpsi;
    var bobot;

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    // menampilkan modal estimasi berdasarkan id komponen
    function showOpsi(id_komponen) {
      idKomp = id_komponen;
      $.ajax({
        url: '{{ route("get_data_komponen") }}',
        type: 'POST',
        data: { id_komponen: id_komponen },
        success: function(data) {
          console.log(data);
          $.each(data.dataOpsi, function(index, data){
            $('.isi-opsi').append('<option class="dropdown" data-id="'+data.id+'" value="'+data.nilai+'">'+data.opsi+'</option>');
          });
          bobot = data.bobot;
          $('#modalEstimasi').modal('show');
        },
      });
    }

    function closeOpsi() {
      $('.isi-opsi .dropdown').remove();
      $('#modalEstimasi').modal('hide');
    }

    $(document).ready(function() {

        $('.isi-opsi').change(function(){
          var idOpsi = $(this).find(':selected').attr('data-id');
          var val  = this.value;
          valueOpsi = val * bobot / 100;
          console.log(valueOpsi);
          $('.btn-opsi').attr({'data-val': valueOpsi, 'data-id': idOpsi});
        });

        $('.btn-opsi').click(function(){
          var id_kerusakan = $('#idKerusakan').val();
          var id_komp_opsi = $('.btn-opsi').attr('data-id');
          $.ajax({
            url: '{{ route("simpan_kerusakan_detail") }}',
            type: 'POST',
            data: {
              id_kerusakan: id_kerusakan,
              id_komponen: idKomp,
              id_komponen_opsi: id_komp_opsi,
            },
            success: function(data) {
              console.log(data);
              var val_opsi = $('.btn-opsi').attr('data-val');
              var hiddenVal = '<input type="hidden" name="tkt_kerusakan[]" value="' + val_opsi + '" readonly>';
              $('#td'+idKomp).html(val_opsi + '%' + hiddenVal);
              if (val_opsi > 0.3) {
                $('#td_keterangan'+idKomp).html('Rusak Berat');
              } else {
                $('#td_keterangan'+idKomp).html('Hitung Komponen Lain');
              }
              $('#modalEstimasi').modal('hide');
              $('.isi-opsi .dropdown').remove();
            },
          });
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
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

    });
</script>
