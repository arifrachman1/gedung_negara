var idKomp;
var valueOpsi;
var table;
var hasil0; var hasil1; var hasil2; var hasil3; var hasil4; var hasil5;
var hasil = [0, 0, 0, 0, 0, 0];
var jumlahUnit = 1;

/* Convert table ke JSON
function tableToJson() {
var data = [];

// first row needs to be headers
var headers = [];
for (var i=0; i<table.rows[0].cells.length; i++) {
    headers[i] = table.rows[0].cells[i].innerHTML.toLowerCase().replace(/ /gi,'');
}

// go through cells
for (var i=1; i<table.rows.length; i++) {

    var tableRow = table.rows[i];
    var rowData = {};

    for (var j=0; j<tableRow.cells.length; j++) {

        rowData[ headers[j] ] = tableRow.cells[j].innerHTML;

    }

    data.push(rowData);
}       

return data;
} */

/* menampilkan modal estimasi kerusakan berdasarkan id komponen */
$(document).on('click', '#hitungEstimasi', function() {
let id = $(this).attr('data-id');
idKomp = id;
console.log(id);
$.ajax({
    url: '{{ route("get_data_komponen_opsi") }}',
    type: 'POST',
    data: { id_komponen: id },
    success: function(data) {
    //console.log(data);
    $('.isi-opsi .dropdown').remove();
    $.each(data.dataOpsi, function(index, data){
        $('.isi-opsi').append('<option class="dropdown" data-id="'+data.id+'">'+data.opsi+'</option>');
    });
    },
});
});

/* menampilkan modal klasifikasi kerusakan berdasarkan id komponen dengan satuan komponennya persen */
$(document).on('click', '#hitungPersen', function() {
let id = $(this).attr('data-id');
idKomp = id;
console.log(id);
$('.form-input').val('');
$('.form-hasil').val(0);
});

/* menampilkan modal klasifikasi kerusakan berdasarkan id komponen dengan satuan komponennya unit */
$(document).on('click', '#hitungUnit', function() {
let id = $(this).attr('data-id');
idKomp = id;
console.log(id);
$('#jumlah').val(0);
$('.form-input').val('');
$('.form-hasil').val(0);
});

/* menyimpan data ke table kerusakan */
$(document).on('click', '#submitKerusakan', function() {
var idUser = $('#idUser').val();
var idKerusakan = $('#idKerusakan').val();

var idKomp = $('input[name="id_komp[]"]').map(function () {
    return this.value;
}).get();
var idKompOpsi = $('.td-hasil').map(function () {
    return $(this).attr('data-ops');
}).get();
var jumlah = $('.td-hasil').map(function () {
    return $(this).attr('data-qty');
}).get();
var tingkatKerusakan = $('.td-hasil').map(function () {
    return $(this).attr('data-val');
}).get();

console.log(idKomp);
console.log(idKompOpsi);
console.log(jumlah);
console.log(tingkatKerusakan);

$.ajax({
    url: '{{ url("submit_kerusakan") }}',
    type: 'post',
    data: {
    id_user: idUser,
    id_kerusakan: idKerusakan,
    id_komp: idKomp,
    id_komp_opsi: idKompOpsi,
    jumlah: jumlah,
    tingkat_kerusakan: tingkatKerusakan,
    },
    success: function(data) {
    console.log('Input sukses');
    }
});
});

/* function pembulatan */
function roundNumber(num, scale) {
if(!("" + num).includes("e")) {
    return +(Math.round(num + "e+" + scale)  + "e-" + scale);
} else {
    var arr = ("" + num).split("e");
    var sig = "";
    if(+arr[1] + scale > 0) {
    sig = "+";
    }
    return +(Math.round(+arr[0] + "e" + sig + (+arr[1] + scale)) + "e-" + scale);
}
}

$(document).ready(function() {

/* proses perhitungan estimasi kerusakan menurut opsi yang dipilih */
$('.isi-opsi').change(function(){
    var idOpsi = $(this).find(':selected').attr('data-id');
    $('.btn-opsi').attr({'data-id': idOpsi});
});

$('.btn-opsi').click( function() {
    var id_komp_opsi = $('.btn-opsi').attr('data-id');
    //console.log(id_komp_opsi);
    $.ajax({
    url: '{{ route("hitung_estimasi_kerusakan") }}',
    type: 'POST',
    data: { 
        id_komponen: idKomp,
        id_komponen_opsi: id_komp_opsi,
    },
    success: function(data) {
        //console.log(data.hasil_estimasi);
        var hasil_estimasi = data.hasil_estimasi;
        hasil_estimasi = roundNumber(hasil_estimasi, 2);
        $('#td'+idKomp).attr('data-val', hasil_estimasi);
        $('#td'+idKomp).attr('data-ops', id_komp_opsi);

        $('#id_komp'+idKomp).val(idKomp);
        $('#id_komp_opsi'+idKomp).val(id_komp_opsi);
        $('#jml'+idKomp).val('');
        
        // td tingkat kerusakan kolom kiri
        var hasil_estimasi100 = hasil_estimasi * 100;
        
        //
        hasil_estimasi100 = roundNumber(hasil_estimasi100, 2);
        $('#td'+idKomp).html(hasil_estimasi100 + '%');

        // td tingkat kerusakan kolom kanan
        if (hasil_estimasi > 0.3) {
        $('#td_keterangan'+idKomp).html('Rusak Berat');
        } else {
        $('#td_keterangan'+idKomp).html('Hitung Kerusakan Komponen Lain');
        }

        // total jumlah kerusakan
        let sum = 0;
        $('.td-hasil').each(function () {
        sum += Number($(this).attr('data-val'));
        });
        var sum100 = sum * 100;

        // pembulatan
        sum100 = roundNumber(sum100, 2);
        $('#totalJmlKerusakan').html(sum100+'%');
        console.log(sum);
        if(sum <= 0.3) {
        $('#keteranganTotal').html('Tingkat Kerusakan Ringan');
        } else if (sum > 0.3 && sum <= 0.45) {
        $('#keteranganTotal').html('Tingkat Kerusakan Sedang');
        } else if (sum > 0.45) {
        $('#keteranganTotal').html('Tingkat Kerusakan Berat');
        }
    },
    });
});

/* proses perhitungan klasifikasi kerusakan dengan satuan komponen persen */

$('#inputNilaiKerusakanPersen0').change(function (){
    let preHasil = 0;
    var inputNilaiKerusakan = Number($(this).val());
    var klsfKerusakan = Number($('#klsfKerusakanPersen0').val());
    if (inputNilaiKerusakan == null) {
    hasil[0] = 0;
    } else {
    preHasil = inputNilaiKerusakan * klsfKerusakan / 100;
    hasil[0] = preHasil;
    }
    if (hasil[0] == NaN) {
    hasil[0] = 0;
    }
    $('#hasilKerusakanPersen0').val(preHasil);
});

$('#inputNilaiKerusakanPersen1').change(function (){
    let preHasil = 0;
    var inputNilaiKerusakan = Number($(this).val());
    var klsfKerusakan = Number($('#klsfKerusakanPersen1').val());
    if (inputNilaiKerusakan == NaN) {
    hasil[1] = 0;
    } else {
    preHasil = inputNilaiKerusakan * klsfKerusakan / 100;
    hasil[1] = preHasil;
    }
    if (hasil[1] == NaN) {
    hasil[1] = 0;
    }
    $('#hasilKerusakanPersen1').val(preHasil);
});

$('#inputNilaiKerusakanPersen2').change(function (){
    let preHasil = 0;
    var inputNilaiKerusakan = Number($(this).val());
    var klsfKerusakan = Number($('#klsfKerusakanPersen2').val());
    if (inputNilaiKerusakan == NaN) {
    hasil[2] = 0;
    } else {
    preHasil = inputNilaiKerusakan * klsfKerusakan / 100;
    hasil[2] = preHasil;
    }
    if (hasil[2] == NaN) {
    hasil[2] = 0;
    }
    $('#hasilKerusakanPersen2').val(preHasil);
});

$('#inputNilaiKerusakanPersen3').change(function (){
    let preHasil = 0;
    var inputNilaiKerusakan = Number($(this).val());
    var klsfKerusakan = Number($('#klsfKerusakanPersen3').val());
    if (inputNilaiKerusakan == NaN) {
    hasil[3] = 0;
    } else {
    preHasil = inputNilaiKerusakan * klsfKerusakan / 100;
    hasil[3] = preHasil;
    }
    if (hasil[3] == NaN) {
    hasil[3] = 0;
    }
    $('#hasilKerusakanPersen3').val(preHasil);
});

$('#inputNilaiKerusakanPersen4').change(function (){
    let preHasil = 0;
    var inputNilaiKerusakan = Number($(this).val());
    var klsfKerusakan = Number($('#klsfKerusakanPersen4').val());
    if (inputNilaiKerusakan == NaN) {
    hasil[4] = 0;
    } else {
    preHasil = inputNilaiKerusakan * klsfKerusakan / 100;
    hasil[4] = preHasil;
    }
    if (hasil[4] == NaN) {
    hasil[4] = 0;
    }
    $('#hasilKerusakanPersen4').val(preHasil);
});

$('#inputNilaiKerusakanPersen5').change(function (){
    let preHasil = 0;
    var inputNilaiKerusakan = Number($(this).val());
    var klsfKerusakan = Number($('#klsfKerusakanPersen5').val());
    if (inputNilaiKerusakan == NaN) {
    hasil[5] = 0;
    } else {
    preHasil = inputNilaiKerusakan * klsfKerusakan / 100;
    hasil[5] = preHasil;
    }
    if (hasil[5] == NaN) {
    hasil[5] = 0;
    }
    $('#hasilKerusakanPersen5').val(preHasil);
});

$('.btn-persen').click(function (){
    sumHasil = 0;
    hasil.forEach(function(n){
    sumHasil += n;
    });
    $.ajax({
    url: '{{ route("hitung_kerusakan_persen") }}',
    type: 'POST',
    data: {
        id_komponen: idKomp,
        sum_hasil: sumHasil,
    },
    success: function(data) {
        var hasil_persen = data.hasil_persen;
        $('#td'+idKomp).attr('data-val', hasil_persen);

        $('#id_komp'+idKomp).val(idKomp);
        $('#id_komp_opsi'+idKomp).val('');
        $('#jml'+idKomp).val('');
        
        hasil_persen100 = hasil_persen * 100;
        $('#td'+idKomp).html(roundNumber(hasil_persen100,2) + '%');
        if (hasil_persen > 0.3) {
        $('#td_keterangan'+idKomp).html('Rusak Berat');
        } else {
        $('#td_keterangan'+idKomp).html('Hitung Kerusakan Komponen Lain');
        }

        // total jumlah kerusakan
        let sum = 0;
        $('.td-hasil').each(function () {
        sum += Number($(this).attr('data-val'));
        });
        var sum100 = sum * 100;
        $('#totalJmlKerusakan').html(roundNumber(sum100,2) + '%');
        //console.log(sum);
        if(sum <= 0.3) {
        $('#keteranganTotal').html('Tingkat Kerusakan Ringan');
        } else if (sum > 0.3 && sum <= 0.45) {
        $('#keteranganTotal').html('Tingkat Kerusakan Sedang');
        } else if (sum > 0.45) {
        $('#keteranganTotal').html('Tingkat Kerusakan Berat');
        }

        hasil = [0,0,0,0,0,0];
    },
    });
});

/* proses perhitungan klasifikasi kerusakan dengan satuan komponen unit */

$('#inputNilaiKerusakan0').change(function (){
    let preHasil = 0;
    var inputNilaiKerusakan = $(this).val();
    var klsfKerusakan = Number($('#klsfKerusakan0').val());
    jumlahUnit = $('#jumlahUnit').val();
    if (inputNilaiKerusakan == NaN) {
    hasil[0] = 0;
    } else {
    preHasil = (inputNilaiKerusakan / jumlahUnit) * klsfKerusakan;
    hasil[0] = preHasil;
    }
    if (hasil[0] == NaN) {
    hasil[0] = 0;
    }
    $('#hasilKerusakan0').val(preHasil);
});

$('#inputNilaiKerusakan1').change(function (){
    let preHasil = 0;
    var inputNilaiKerusakan = $(this).val();
    var klsfKerusakan = Number($('#klsfKerusakan1').val());
    jumlahUnit = $('#jumlahUnit').val();
    if (inputNilaiKerusakan == NaN) {
    hasil[1] = 0;
    } else {
    preHasil = (inputNilaiKerusakan / jumlahUnit) * klsfKerusakan;
    hasil[1] = preHasil;
    }
    if (hasil[1] == NaN) {
    hasil[1] = 0;
    }
    $('#hasilKerusakan1').val(preHasil);
});

$('#inputNilaiKerusakan2').change(function (){
    let preHasil = 0;
    var inputNilaiKerusakan = $(this).val();
    var klsfKerusakan = Number($('#klsfKerusakan2').val());
    jumlahUnit = $('#jumlahUnit').val();
    if (inputNilaiKerusakan == NaN) {
    hasil[2] = 0;
    } else {
    preHasil = (inputNilaiKerusakan / jumlahUnit) * klsfKerusakan;
    hasil[2] = preHasil;
    }
    if (hasil[2] == NaN) {
    hasil[2] = 0;
    }
    $('#hasilKerusakan2').val(preHasil);
});

$('#inputNilaiKerusakan3').change(function (){
    let preHasil = 0;
    var inputNilaiKerusakan = $(this).val();
    var klsfKerusakan = Number($('#klsfKerusakan3').val());
    jumlahUnit = $('#jumlahUnit').val();
    if (inputNilaiKerusakan == NaN) {
    hasil[3] = 0;
    } else {
    preHasil = (inputNilaiKerusakan / jumlahUnit) * klsfKerusakan;
    hasil[3] = preHasil;
    }
    if (hasil[3] == NaN) {
    hasil[3] = 0;
    }
    $('#hasilKerusakan3').val(preHasil);
});

$('#inputNilaiKerusakan4').change(function (){
    let preHasil = 0;
    var inputNilaiKerusakan = $(this).val();
    var klsfKerusakan = Number($('#klsfKerusakan4').val());
    jumlahUnit = $('#jumlahUnit').val();
    if (inputNilaiKerusakan == NaN) {
    hasil[4] = 0;
    } else {
    preHasil = (inputNilaiKerusakan / jumlahUnit) * klsfKerusakan;
    hasil[4] = preHasil;
    }
    if (hasil[4] == NaN) {
    hasil[4] = 0;
    }
    $('#hasilKerusakan4').val(preHasil);
});

$('#inputNilaiKerusakan5').change(function (){
    let preHasil = 0;
    var inputNilaiKerusakan = $(this).val();
    var klsfKerusakan = Number($('#klsfKerusakan5').val());
    jumlahUnit = $('#jumlahUnit').val();
    if (inputNilaiKerusakan == NaN) {
    hasil[5] = 0;
    } else {
    preHasil = (inputNilaiKerusakan / jumlahUnit) * klsfKerusakan;
    hasil[5] = preHasil;
    }
    if (hasil[5] == NaN) {
    hasil[5] = 0;
    }
    $('#hasilKerusakan5').val(preHasil);
});

$('.btn-unit').click(function (){
    sumHasil = 0;
    hasil.forEach(function(n){
    sumHasil += n;
    });
    console.log(sumHasil); hasil = [0,0,0,0,0,0]; return;
    $.ajax({
    url: '{{ route("hitung_kerusakan_unit") }}',
    type: 'POST',
    data: {
        id_komponen: idKomp,
        sum_hasil: sumHasil,
    },
    success: function(data) {
        //console.log(data.hasil_unit);
        var hasil_unit = data.hasil_unit;
        var jml_unit = $('#jumlahUnit').val();
        $('#td'+idKomp).attr('data-val', hasil_unit);
        $('#td'+idKomp).attr('data-qty', jumlahUnit);
        let hasil_unit100 = hasil_unit * 100;

        $('#id_komp'+idKomp).val(idKomp);
        $('#id_komp_opsi'+idKomp).val('');
        $('#jml'+idKomp).val(jml_unit);

        $('#td'+idKomp).html(hasil_unit100 + '%');
        if (hasil_unit > 0.3) {
        $('#td_keterangan'+idKomp).html('Rusak Berat');
        } else {
        $('#td_keterangan'+idKomp).html('Hitung Kerusakan Komponen Lain');
        }

        // total jumlah kerusakan
        let sum = 0;
        $('.td-hasil').each(function () {
        sum += Number($(this).attr('data-val'));
        });
        let sum100 = sum * 100;
        $('#totalJmlKerusakan').html(sum100+'%');
        console.log(sum);
        if(sum <= 0.3) {
        $('#keteranganTotal').html('Tingkat Kerusakan Ringan');
        } else if (sum > 0.3 && sum <= 0.45) {
        $('#keteranganTotal').html('Tingkat Kerusakan Sedang');
        } else if (sum > 0.45) {
        $('#keteranganTotal').html('Tingkat Kerusakan Berat');
        }

        hasil = [0,0,0,0,0,0];
    },
    });
});

/*$('#kerusakan').DataTable( {
    "processing" : true,
    "serverSide" : true,
    scrollY : '250px',
    dom: 'Bfrtip',
    buttons: [
    'copy', 'csv', 'excel', 'pdf', 'print'
    ]
});*/

});