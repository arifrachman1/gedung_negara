<!DOCTYPE html>
<html>
    <head>   
        <title>Daftar Gedung PDF</title>
	    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    </head>
    <body>
    <style type="text/css">
    
		table tr td,
		table tr th{
			font-size: 8pt;
		}

        table {
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }
        .center{
            margin-left: auto;
            margin-right: auto;
        }
        body {
                margin-top: 4cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2cm;
            }

        #watermark {
            position: fixed;
                /** 
                    Set a position in the page for your image
                    This should center it vertically
                **/
                bottom:   5cm;
                left:     11cm;

                /** Change image dimensions**/
                width:    100%;
                height:   100%;
                /** Your watermark should be behind every content**/
                z-index:  -1000;
             }
        @page { margin: 0cm 0cm; }
        .header {
                position: fixed;
                top: 0cm;
                left: 5cm;
                right: 0cm;
                height:3cm;
                
            }
        /* .header { position: fixed; left: 0px; top: -100px; right: 0px; height: 100px; text-align: center; } */
        .footer {
                position: fixed; 
                bottom: 0cm; 
                left: 2cm; 
                right: 0cm;
                height: 2cm;
                text-align: left;}
        .footer .pagenum:before { content: counter(page); }
        
	</style>
    </head>
    <body>
          <div class="header">
          <img src="{{ asset('style/img/header.png') }}"  width="80%" height="100%"/>
        </div>
        <div class="footer">
                
        <p style="font-size:12px; " onload="viewjam(); hari();">Diprint melalui aplikasi Sistem Informasi Bangunan Gedung Negara (Si BanGun)
            <br>
            Dinas Pekerjaan Umum dan Penataan Ruang Kabupaten Tuban
            <br>
            Pada <?php
            function format_hari_tanggal($waktu)
            {
                $hari_array = array(
                    'Minggu',
                    'Senin',
                    'Selasa',
                    'Rabu',
                    'Kamis',
                    'Jumat',
                    'Sabtu'
                );
                $hr = date('w', strtotime($waktu));
                $hari = $hari_array[$hr];
                $tanggal = date('j', strtotime($waktu));
                $bulan_array = array(
                    1 => 'Januari',
                    2 => 'Februari',
                    3 => 'Maret',
                    4 => 'April',
                    5 => 'Mei',
                    6 => 'Juni',
                    7 => 'Juli',
                    8 => 'Agustus',
                    9 => 'September',
                    10 => 'Oktober',
                    11 => 'November',
                    12 => 'Desember',
                );
                $bl = date('n', strtotime($waktu));
                $bulan = $bulan_array[$bl];
                $tahun = date('Y', strtotime($waktu));
                $jam = date( 'H:i:s', strtotime($waktu));
                
                //untuk menampilkan hari, tanggal bulan tahun jam
                //return "$hari, $tanggal $bulan $tahun $jam";
            
                //untuk menampilkan hari, tanggal bulan tahun
                return "$hari, $tanggal $bulan $tahun";
            }
            $date=date('Y-m-d');
            echo "".format_hari_tanggal($date);
            ?> oleh {{ $profile->name}} </p>            
        </div>      
            <!-- The content of your PDF here -->
            <table class='table table-bordered center'>
                <thead>
                    <tr>
                        <th>Nomor Seri Gedung</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>BT</th>
                        <th>LS</th>
                        <th>Legalitas</th>
                        <th>Tipe Pemilik</th>
                        <th>Alas Hak</th>
                        <th>Luas Lahan</th>
                        <th>Jumlah Lantai</th>
                        <th>Luas Bangunan</th>
                        <th>Tinggi Bangunan</th>
                        <th>Kompleksitas</th>
                        <th>Kepadatan</th>
                        <th>Permanensi</th>
                        <th>Tingkat Resiko Kebakaran</th>
                        <th>Penangkal Petir</th>
                        <th>Struktur Bawah</th>
                        <th>Struktur Bangunan</th>
                        <th>Struktur Atap</th>
                        <th>KDB</th>
                        <th>KLB</th>
                        <th>KDH</th>
                        <th>GSB</th>
                        <th>RTH</th>
                    </tr>
                </thead>
                <tbody>                    
                    @foreach($gedung as $g)
                    <tr>
                        <td>{{ $g->nomor_seri }}</td>
                        <td>{{ $g->nama }}</td>
                        <td>{{ $g->alamat }}</td>
                        <td>{{ $g->bujur_timur }}</td>
                        <td>{{ $g->lintang_selatan }}</td>
                        <td>{{ $g->legalitas }}</td>
                        <td>{{ $g->tipe_pemilik }}</td>
                        <td>{{ $g->alas_hak }}</td>
                        <td>{{ $g->luas_lahan }}</td>
                        <td>{{ $g->jumlah_lantai }}</td>
                        <td>{{ $g->luas }}</td>
                        <td>{{ $g->tinggi }}</td>
                        <td>{{ $g->kompleks }}</td>
                        <td>{{ $g->kepadatan }}</td>
                        <td>{{ $g->permanensi }}</td>
                        <td>{{ $g->tkt_resiko_kebakaran }}</td>
                        <td>{{ $g->penangkal_petir }}</td>
                        <td>{{ $g->struktur_bawah }}</td>
                        <td>{{ $g->struktur_bangunan }}</td>
                        <td>{{ $g->struktur_atap }}</td>
                        <td>{{ $g->kdb }}</td>
                        <td>{{ $g->klb }}</td>
                        <td>{{ $g->kdh }}</td>
                        <td>{{ $g->gsb }}</td>
                        <td>{{ $g->rth }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>           
    </body>
</html>