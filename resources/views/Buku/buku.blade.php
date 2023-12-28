@extends('layout/main')
@section('content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
          <h6>Buku Tables</h6>
          <a class="btn btn-outline-primary btn-sm mb-0 me-3" href="/buku/create">Tambah Buku</a> 
      </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Judul</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Penerbit</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Penulis</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">jml_halaman</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($datas as $buku)
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{$buku->judul}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{$buku->penerbit->nm_penerbit}}</p>
                    <p class="text-xs text-secondary mb-0">Tahun {{$buku->tahun_terbit}}</p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    @foreach ($buku->penulis as $p)
                      <p class="text-xs text-secondary mb-0">{{$p->nm_penulis}}</p>
                    @endforeach
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">
                      {{$buku->jml_halaman}}
                    </span>
                  </td>
                  <td class="align-middle">
                    <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                      Edit
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