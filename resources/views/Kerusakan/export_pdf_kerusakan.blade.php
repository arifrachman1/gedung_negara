<!DOCTYPE html>
<html>
    <head>
        <title>Daftar Gedung PDF</title>
	    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    </head>
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
            body {
                    margin-top: 3cm;
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
                    width:    8cm;
                    height:   8cm;

                    /** Your watermark should be behind every content**/
                    z-index:  -1000;
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
                    left: 0cm; 
                    right: 0cm;
                    height: 2cm;
                    text-align: center;}
            .footer .pagenum:before { content: counter(page); }
        </style>
    <body>
        <div id="watermark">
            <img src="{{ asset('style/img/watermark.png') }}" width="100%" height="100%"/>
        </div>
          <div class="header">
          <img src="{{ asset('style/img/header.png') }}"  width="100%" height="100%"/>
        </div>
        <div class="footer">
            Page <span class="pagenum"></span>
        </div>  
    <h5>Daftar Gedung</h4>
 
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
        @foreach($komponens as $komponen)
            @foreach($komponen->subKomponen as $subIndex => $subKomponen)
            <tr>
                <td>{{ $subIndex + 1}}</td>
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
    </body>
</html>