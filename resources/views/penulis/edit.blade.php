@extends('/layout/main')
@section('content')
<div class="container mt-3">
  <div class="row ">
    <div class=" mt-4">
      <form action="/penulis/update/{{ $penulis->id }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $penulis->id }}">
        <div class="row">
          <div class="col-5">
            <div class="mb-3">
              <label class="form-label">Nama Penulis</label>
              <input
                required
                type="text"
                class="form-control"
                name="nm_penulis"
                autocomplete="off"
                value="{{ $penulis->nm_penulis }}"
              />
            </div>
            <div class="mb-3">
              <label class="form-label">jenis kelamin</label>
              <input
                required
                type="text"
                class="form-control"
                name="jn_kelamin"
                autocomplete="off"
                value="{{ $penulis->jn_kelamin }}"
              />
            </div>
            <div class="mb-3">
              <label class="form-label">tanggal lahir</label>
              <input
                required
                type="date"
                class="form-control"
                name="tgl_lahir"
                autocomplete="off"
                value="{{ $penulis->tgl_lahir }}"
              />
            </div>
            <div class="mb-3">
              <label class="form-label">ket</label>
              <input
                required
                type="text"
                class="form-control"
                name="text"
                autocomplete="off"
                value="{{ $penulis->text }}"
              />
            </div>
          </div>
        </div>

        <div class="float-start">
          <a href="/penulis" class="btn btn-secondary">Back</a>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
