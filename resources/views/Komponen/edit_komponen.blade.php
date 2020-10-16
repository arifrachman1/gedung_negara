<!doctype html>
@include('template/header')

<body>
  <!-- Begin Page Content -->
    <div class="container-fluid">
      <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">EDIT KOMPONEN</h1>
        <form  enctype="multipart/form-data" action="{{url('editAksi')}}" method='post'>
          @csrf
          <div class="card shadow mb-4 input-group">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Form Edit Komponen</h6>
            </div>
              <div class="card-body">
                <!--==========================-->
                  <div class="control-group after-add-more">
                    <label class="font-weight-bold">Nama Komponen</label>
                      <input  onkeyup="this.value = this.value.toUpperCase()" type="text" name="nama[]" class="form-control" value="{{$komponen->nama}}">
                      
                    <label class="font-weight-bold">Satuan</label>
                  <div class="form-group">
                  <select name="id_satuan" class="form-control">
                        @foreach($satuan as $val)
                          @if($komponen->id_satuan == $val->id_satuan)
                            <option value="{{ $val->id_satuan }}" selected>{{ $val->nama }}</option>
                          @else
                            <option value="{{ $val->id_satuan }}">{{ $val->nama }}</option>
                          @endif
                        @endforeach
                    </select>
                  </div> 
                <br>
              <button class="btn btn-success add-more" type="button">Tambah Sub Komponen</button>  ||  <button class="btn btn-success" type="submit">Simpan</button>
            </div>
            
  </form>
          <!--==========================-->
</div>

<!-- Copy Fields -->

        </body>
@include('template/footer')


</script>

</html>