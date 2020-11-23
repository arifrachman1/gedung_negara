<!DOCTYPE html>
<html>
    <head>
        <title>Daftar Gedung PDF</title>
        <style>
			body{
				background-image: url('{{ public_path('/style/img/5.png') }}');
			}
		</style>
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
        <img src="{{ public_path('/style/img/5.png') }}" height="200px">
		<h5>Daftar Gedung</h4>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
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
			@php $i=1 @endphp
			@foreach($gedung as $g)
			<tr>
				<td>{{ $i++ }}</td>
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