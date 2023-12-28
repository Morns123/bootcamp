@extends('/layout/main')
@section('content')
<div class="container mt-3">
  <div class="row ">
    <div class=" mt-4">

      <form action="/buku/create/post" method="POST">
        @csrf
        <div class="row">
          <div class="col-5">
            <div class="mb-3">
              <label class="form-label">Judul</label>
              <input
                type="text"
                class="form-control"
                name="judul"
                autocomplete="off"
              />
            </div>  
            <div class="mb-3">
              <label class="form-label">Jumlah Halaman</label>
              <input
                type="number"
                class="form-control"
                name="jml_halaman"
                autocomplete="off"
              />
            </div>  
            <div class="mb-3">
              <label class="form-label">Tahun Terbit</label>
              <input
                type="number"
                class="form-control"
                name="tahun_terbit"
                autocomplete="off"
                max="9999"
                value="2016"
              />
            </div>  
          </div>
          <div class="col-5">
            <div class="mb-3">
              <label class="form-label">ISBN</label>
              <input
                type="number"
                class="form-control"
                name="isbn"
                autocomplete="off"
              />
            </div> 
            <label class="form-label">Penerbit</label>
            <div class="mb-4">
              <select name="penerbit_id" class="form-select" aria-label="Default select example">
                @foreach ($penerbit as $penerbit)
                  <option value="{{$penerbit->id}}">{{$penerbit->nm_penerbit}}</option>
                @endforeach
              </select>
            </div>
            <label class="form-label">Penulis</label>
            <div class="mb-3">
              <select size="1" name="penulis_id[]" multiple="multiple" class=" penulis" aria-label="Default select example" style="width: 100%">
                @foreach ($penulis as $penulis)
                  <option value="{{$penulis->id}}">{{$penulis->nm_penulis}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="float-start">
          <a href="/buku" class="btn btn-secondary">Back</a>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
  $(document).ready(function() {
    $('.penulis').select2();
  });
</script>
@endsection