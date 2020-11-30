<!DOCTYPE html>
<html>
    <head>
        <title>Daftar Gedung PDF</title>
        <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
        <style type="text/css">        
            /* CSS Detail Gedung */
           
            #detail-gedung {
                font-size: 8pt;
                border-collapse: collapse;
                border-spacing: 25px;
            }
            #detail-gedung th, #detail-gedung td{
                border: none;
                padding: 5px;
            }
            /* CSS Detail Kerusakan */
            #detail-kerusakan {
                font-size: 8pt;
                border-collapse: collapse;
            }

            #detail-kerusakan th, #detail-kerusakan td{
                border: 1px solid black;
            }
            body {
                margin-top: 3cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2cm;
            }           
            @page { margin: 0cm 0cm; }
            .header {
                    position: fixed;
                    top: 0cm;
                    left: 0cm;
                    right: 0cm;
                    height: 3cm;
                }
            /* .header { position: fixed; left: 0px; top: -100px; right: 0px; height: 100px; text-align: center; } */
            .footer {         position: fixed; 
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
            <img src="{{ asset('style/img/header.png') }}"  width="100%" height="100%"/>
        </div>        
        <table id="detail-gedung">        
            <thead>
                <tr>
                    <td>OPD</td>
                    <td>: {{ $gedung->opd }} </td>

                    <td>Nama Bangunan</td>
                    <td>: {{ $gedung->nama_gedung }}</td>
                </tr>
                <tr>
                    <td>Nomor Aset</td>
                    <td>: {{ ($gedung->nomor_aset) ? $gedung->nomor_aset : '-' }}</td>
                </tr>
                <tr>
                    <td>Provinsi</td>
                    <td>: {{ ($gedung->nama_provinsi) ? $gedung->nama_provinsi : '-' }}</td>

                    <td>Kabupaten / Kota</td>
                    <td>: {{ ($gedung->nama_kota) ? $gedung->nama_kota : '-' }}</td>
                </tr>
                <tr>
                    <td>Kecamatan</td>
                    <td>: {{ ($gedung->nama_kecamatan) ? $gedung->nama_kecamatan : '-' }}</td>

                    <td>Kelurahan</td>
                    <td>: {{ ($gedung->nama_kelurahan) ? $gedung->nama_kelurahan : '-' }}</td>
                </tr>

                <tr>
                    <td>Petugas Survey</td>
                    <td>:
                        <ol>
                            <li>{{ ($gedung->petugas_survei1) ? $gedung->petugas_survei1 : '-' }}</li>
                            <li>{{ ($gedung->petugas_survei2) ? $gedung->petugas_survei2 : '-' }}</li>
                            <li>{{ ($gedung->petugas_survei3) ? $gedung->petugas_survei3 : '-' }}</li>
                        </ol>
                    </td>

                    <td>Perwakilan OPD</td>
                    <td>: 
                        <ol>
                            <li>{{ ($gedung->perwakilan_opd1) ? $gedung->perwakilan_opd1 : '-' }}</li>
                            <li>{{ ($gedung->perwakilan_opd2) ? $gedung->perwakilan_opd2 : '-' }}</li>
                        </ol>
                    </td>
                </tr>

                <tr>
                    <td>Tanggal Hari Ini</td>
                    <td>: {{ date('d/m/Y')}}</td>

                    <td>Jam</td>
                    <td>: {{date('H:i')}}</td>
                </tr>
                <tr>
                    <td>Luas Bangunan</td>
                    <td>: {{ ($gedung->luas_bangunan) ? $gedung->luas_bangunan : '-' }} m2</td>

                    <td>Jumlah Lantai</td>
                    <td>: {{ ($gedung->jumlah_lantai) ? $gedung->jumlah_lantai : '-' }}</td>
                </tr>

            </thead>
        </table>
        <h4>Detail Kerusakan</h4>    
        <table id="detail-kerusakan">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Komponen</th>
                    <th rowspan="2">Sub Komponen</th>
                    <th rowspan="2">Satuan</th>
                    <th rowspan="2">Jumlah</th>
                    <th rowspan="2">Bobot</th>
                    <th colspan="10" colspan="5">Klasifikasi Kerusakan</th>
                    <th rowspan="2" colspan="3">Tingkat Kerusakan</th>
                </tr>
                <tr>
                    <th colspan="2">0.2</th>
                    <th colspan="2">0.4</th>
                    <th colspan="2">0.6</th>
                    <th colspan="2">0.8</th>
                    <th colspan="2">1.0</th>
                </tr>
                <tr>
                    <th>(1)</th>
                    <th>(2)</th>
                    <th>(3)</th>
                    <th>(4)</th>
                    <th>(5)</th>
                    <th>(6)</th>
                    <th colspan="2">(7)</th>
                    <th colspan="2">(8)</th>
                    <th colspan="2">(9)</th>
                    <th colspan="2">(10)</th>
                    <th colspan="2">(11)</th>
                    <th colspan="3">(12)</th>
                </tr>
            </thead>
            <tbody>
                @php $nomor = 1 @endphp
                @foreach($komponens as $komponen)
                    @foreach($komponen->subKomponen as $subIndex => $subKomponen)
                    <tr>
                        <td>{{ $nomor++ }}</td>
                        @if($subIndex == 0)
                            <td rowspan="{{ $komponen->numberOfSub}}">{{ $komponen->nama }}</td>
                        @endif
                        <td>{{ $subKomponen->nama }}</td>
                        <td>{{ $subKomponen->satuan }}</td>
                        <td>{{ $subKomponen->jumlah }}</td>
                        <td>{{ $subKomponen->bobot }}</td>
                        @if($subKomponen->id_satuan == 1)
                            <td colspan="10">{{ ($subKomponen->nama_opsi) ? $subKomponen->nama_opsi : '-' }}</td>
                        @elseif($subKomponen->id_satuan == 2)
                            @foreach($subKomponen->kerusakan_klasifikasi as $kk)
                                <td>{{ $kk->nilai_input_klasifikasi }}</td>
                                <td>{{ $kk->nilai_input_klasifikasi * $kk->klasifikasi }} %</td>
                            @endforeach
                        @else
                            @foreach($subKomponen->kerusakan_klasifikasi as $kk)
                                <td>{{ $kk->nilai_input_klasifikasi }}</td>
                                <td>{{ ($subKomponen->jumlah) ? (($kk->nilai_input_klasifikasi / $subKomponen->jumlah) * $kk->klasifikasi) : 0 }}</td>
                            @endforeach
                        @endif
                        <td>{{ ($subKomponen->tingkat_kerusakan) ? $subKomponen->tingkat_kerusakan : '0' }}%</td>
                        @if($subIndex == 0)
                            <td rowspan="{{ $komponen->numberOfSub}}">{{ $komponen->sumTingkatKerusakan }}%</td>
                            <td rowspan="{{ $komponen->numberOfSub }}">{{ $komponen->sumTingkatKerusakanText }}</td>
                        @endif
                    </tr>
                    @endforeach
                @endforeach
                <tr>
                    <td colspan="16">Jumlah Kerusakan</td>
                    <td colspan="2">{{ $sumAlltingkatKerusakan }}%</td>
                    <td>{{ $sumAlltingkatKerusakanText }}</td>
                </tr>
            </tbody>
        </table>
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
    </body>
    
</html>