@extends('/layout/main')
@section('content')
<div class="container mt-3">
  <div class="row ">
    <div class=" mt-4">
      <form action="/penerbit/store" method="POST">
        @csrf
        <div class="row">
          <div class="col-5">
            <div class="mb-3">
                <label class="form-label">Nama Penerbit</label>
                <input
                  required
                  type="text"
                  class="form-control"
                  name="nm_penerbit"
                  autocomplete="off"
                />
              </div> 
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <input
                  required
                  type="text"
                  class="form-control"
                  name="alamat"
                  autocomplete="off"
                />
              </div>  
              <div class="mb-3">
                <label class="form-label">Nomor Telepon</label>
                <input
                  required    
                  type="number"
                  class="form-control"
                  name="no_telepon"
                  autocomplete="off"
                />
              </div>  
          </div>
        </div>
        
        <div class="float-start">
          <a href="/penerbit" class="btn btn-secondary">Back</a>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection