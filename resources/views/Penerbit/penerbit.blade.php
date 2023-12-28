@extends('layout/main')
@section('content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
          <h6>Penerbit Tables</h6>
          <a class="btn btn-outline-primary btn-sm mb-0 me-3" href="{{url('/penerbit/create')}}">Tambah penerbit</a> 
      </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Alamat</th>
                   
                    <th class="text-secondary opacity-7"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">{{ $data->nm_penerbit }}</h6>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0">{{ $data->alamat }}</p>
                        </td>
                       
                        <td class="align-middle">
                            <a href="/penerbit/edit/{{$data->id}}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit publisher">
                                Edit
                            </a>
                            <span class="text-secondary font-weight-bold text-xs"> | </span>
                            <a href="/penerbit/hapus/{{$data->id}}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Delete publisher">
                                Hapus
                            </a>
                        </td>
                    </tr>
                @endforeach                
            </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
      </div>
    </div>
  </div>
</div>
@endsection
