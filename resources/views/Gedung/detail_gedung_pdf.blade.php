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
                font-size: 12pt;
            }
            table {
                border-collapse: collapse;
                border-spacing: 25px;
            }
            table, th, td {
                border: 0px solid black;
                padding: 5px;
            }

        </style>
        <center>
            <h4>Detail Gedung </h4>
        </center>
        <table class="table">
            <thead>
                <tr>
                    <td>
                        Nama Gedung
                    </td>
                    <td>
                        : <strong>{{ $detail_gedung->nama }} </strong>
                    </td>
                </tr>
                <tr>
                    <td>
                        Jenis Gedung
                    </td>
                    <td>
                        : <strong>{{ $detail_gedung->nama_kat }}</strong>
                    </td>
                </tr>
                <tr>
                    <td>
                        Nomor Seri Gedung
                    </td>
                    <td>
                        : <strong>{{ ($detail_gedung->nomor_seri) ? $detail_gedung->nomor_seri : '-' }}</strong>
                    </td>
                </tr>
                <tr>
                    <td>
                        Alamat
                    </td>
                    <td>
                        : <strong>{{ $detail_gedung->alamat }}</strong>
                    </td>
                </tr>
            </thead>
        </table> <br/><br/>
    <!-- <div class="my-2">
            <div class="row">
                Nama Gedung: <strong>{{ $detail_gedung->nama }} </strong>
            </div>

            <div class="row">
                Jenis Gedung: <strong>{{ $detail_gedung->nama_kat }}</strong>
            </div>

            <div class="row">
                Nomor Seri Gedung: <strong>{{ ($detail_gedung->nomor_seri) ? $detail_gedung->nomor_seri : '-' }}</strong>
            </div>

            <div class="row">
                Alamat: <strong>{{ $detail_gedung->alamat }}</strong>
            </div>
        </div>
    -->
        <table>
            <tbody>
                <tr>
                    <td>Bujur Timur</td>
                    <td>: <strong>{{ $detail_gedung->bujur_timur }}</strong></td>
                    <td>Struktur Bawah</td>
                    <td>: <strong>{{ $detail_gedung->struktur_bawah }}</strong></td>
                </tr>
                <tr>
                    <td>Lintang Selatan</td>
                    <td>: <strong>{{ $detail_gedung->lintang_selatan }}</strong></td>
                    <td>Struktur Bangunan</td>
                    <td>: <strong>{{ $detail_gedung->struktur_bangunan }}</strong></td>
                </tr>
                <tr>
                    <td>Legalitas</td>
                    <td>: <strong>{{ $detail_gedung->legalitas }}</strong></td>
                    <td>Struktur Atap</td>
                    <td>: <strong>{{ $detail_gedung->struktur_atap }}</strong></td>
                </tr>
                <tr>
                    <td>Alas Hak</td>
                    <td>: <strong>{{ $detail_gedung->alas_hak }}</strong></td>
                    <td>Provinsi</td>
                    <td>: <strong>{{ ($provinsi->nama) ? $provinsi->nama : '-' }}</strong></td>
                </tr>
                <tr>
                    <td>Luas lahan</td>
                    <td>: <strong>{{ $detail_gedung->luas_lahan }}</strong></td>
                    <td>Kabupaten</td>
                    <td>: <strong>{{ $kab_kota->nama }}</strong></td>
                </tr>
                <tr>
                    <td>Jumlah Lantai</td>
                    <td>: <strong>{{ $detail_gedung->jumlah_lantai }}</strong></td>
                    <td>Kecamatan</td>
                    <td>: <strong>{{ ($kecamatan->nama) ? $kecamatan->nama : '-' }}</strong></td>
                </tr>
                <tr>
                    <td>Luas Bangunan</td>
                    <td>: <strong>{{ $detail_gedung->luas_bangunan }}</strong></td>
                    <td>Kelurahan</td>
                    <td>: <strong>{{ ($desa_kelurahan->nama) ? $desa_kelurahan->nama : '-' }}</strong></td>
                </tr>
                <tr>
                    <td>Tinggi Bangunan</td>
                    <td>: <strong>{{ $detail_gedung->tinggi_bangunan }}</strong></td>
                    <td>KDB</td>
                    <td>: <strong>{{ $detail_gedung->kdb }}</strong></td>
                </tr>
                <tr>
                    <td>Kompleksitas</td>
                    <td>: <strong>{{ $detail_gedung->kompleks }}</strong></td>
                    <td>KLB</td>
                    <td>: <strong>{{ $detail_gedung->klb }}</strong></td>
                </tr>
                <tr>
                    <td>Kepadatan</td>
                    <td>: <strong>{{ $detail_gedung->kepadatan }}</strong></td>
                    <td>KDH</td>
                    <td>: <strong>{{ $detail_gedung->kdh }}</strong></td>
                </tr>
                <tr>
                    <td>Permanensi</td>
                    <td>: <strong>{{ $detail_gedung->permanensi }}</strong></td>
                    <td>GSB</td>
                    <td>: <strong>{{ $detail_gedung->gsb }}</strong></td>
                </tr>
                <tr>
                    <td>Resiko Kebakaran</td>
                    <td>: <strong>{{ $detail_gedung->risk_bakar }}</strong></td>
                    <td>RTH</td>
                    <td>: <strong>{{ $detail_gedung->rth }}</strong></td>
                </tr>
                <tr>
                    <td>Penangkal</td>
                    <td>: <strong>{{ $detail_gedung->penangkal }}</strong></td>
                </tr>
            </tbody>
        </table>
    </body>
</html>