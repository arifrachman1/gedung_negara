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
        </style>
        <center>
            <h5>Detail Gedung</h4>
        </center>
        <div class="my-2">
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

            <div class="row">
                Bujur Timur: <strong>{{ $detail_gedung->bujur_timur }}</strong>
            </div>

            <div class="row">
                Lintang Selatan: <strong>{{ $detail_gedung->lintang_selatan }}</strong>
            </div>

            <div class="row">
                Legalitas: <strong>{{ $detail_gedung->legalitas }}</strong>
            </div>

            <div class="row">
                Alas Hak: <strong>{{ $detail_gedung->alas_hak }}</strong>
            </div>

            <div class="row">
                Luas lahan: <strong>{{ $detail_gedung->luas_lahan }}</strong>
            </div>

            <div class="row">
                Jumlah Lantai: <strong>{{ $detail_gedung->jumlah_lantai }}</strong>
            </div>

            <div class="row">
                Luas Bangunan: <strong>{{ $detail_gedung->luas_bangunan }}</strong>
            </div>

            <div class="row">
                Tinggi Bangunan: <strong>{{ $detail_gedung->tinggi_bangunan }}</strong>
            </div>

            <div class="row">
                Kompleksitas: <strong>{{ $detail_gedung->kompleks }}</strong>
            </div>

            <div class="row">
                Kepadatan: <strong>{{ $detail_gedung->kepadatan }}</strong>
            </div>

            <div class="row">
                Permanensi: <strong>{{ $detail_gedung->permanensi }}</strong>
            </div>

            <div class="row">
                Resiko Kebakaran: <strong>{{ $detail_gedung->risk_bakar }}</strong>
            </div>

            <div class="row">
                Penangkal: <strong>{{ $detail_gedung->penangkal }}</strong>
            </div>

            <div class="row">
                Struktur Bawah: <strong>{{ $detail_gedung->struktur_bawah }}</strong>
            </div>

            <div class="row">
                Struktur Bangunan: <strong>{{ $detail_gedung->struktur_bangunan }}</strong>
            </div>

            <div class="row">
                Struktur Atap: <strong>{{ $detail_gedung->struktur_atap }}</strong>
            </div>

            <div class="row">
                Provinsi: <strong>{{ ($provinsi->nama) ? $provinsi->nama : '-' }}</strong>
            </div>

            <div class="row">
                Kabupaten: <strong>{{ $kab_kota->nama }}</strong>
            </div>

            <div class="row">
                Kecamatan: <strong>{{ ($kecamatan->nama) ? $kecamatan->nama : '-' }}</strong>
            </div>

            <div class="row">
                Kelurahan: <strong>{{ ($desa_kelurahan->nama) ? $desa_kelurahan->nama : '-' }}</strong>
            </div>

            <div class="row">
                KDB: <strong>{{ $detail_gedung->kdb }}</strong>
            </div>

            <div class="row">
                KLB: <strong>{{ $detail_gedung->klb }}</strong>
            </div>

            <div class="row">
                KDH: <strong>{{ $detail_gedung->kdh }}</strong>
            </div>

            <div class="row">
                GSB: <strong>{{ $detail_gedung->gsb }}</strong>
            </div>

            <div class="row">
                RTH: <strong>{{ $detail_gedung->rth }}</strong>
            </div>
        </div>
    </body>
</html>