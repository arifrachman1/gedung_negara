<!DOCTYPE html>
<html>
    <head>
        <title>Daftar Gedung PDF</title>
        <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
    </head>
    <body>
    <div class="">
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

        @page {
   margin: 2cm;
   size: landscape;
}
	</style>
 
	<table class='table table-center table-bordered'>
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
		<tbody>
		</tbody>
    </table>
</div>
    </body>
</html>