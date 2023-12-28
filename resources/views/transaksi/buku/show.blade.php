@extends("layout.main")

@section("content")
<div class="container mt-3">
    <div class="row ">
        <div class=" mt-4">
            <form>
                <div class="row">
                    <div class="col-5">
                        @if($transaksi->tipe == "IN")
                        <div id="IN">
                            <div class="mb-3">
                                <label class="form-label">Buku</label>
                                <select name="buku_id" class="form-select" aria-label="Default select example" disabled>
                                    <option value="{{$transaksi->buku->id}}" selected>
                                        {{$transaksi->buku->judul}}
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Qty</label>
                                <input type="number" class="form-control" name="qty" autocomplete="off" value="{{$transaksi->qty}}" disabled/>
                            </div>
                        </div>
                        @else
                        <div id="OUT">
                            <div class="mb-3">
                                <label class="form-label">SN Number Buku</label>
                                <select name="dtl_buku_id" class="form-select" aria-label="Default select example" disabled>
                                    <option value="{{$transaksi->id}}" selected>
                                        {{$transaksi->buku->judul}} | {{$transaksi->sn_buku}}
                                    </option>
                                </select>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="col-5">
                        <div class="mb-3">
                            <label class="form-label">Tipe</label>
                            <select name="tipe" id="TIPE" class="form-select" aria-label="Default select example" disabled>
                                <option selected>{{ $transaksi->tipe }}</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal</label>
                            <input type="text" class="form-control" name="qty" autocomplete="off" value="{{$transaksi->created_at}}" disabled/>
                        </div>
                    </div>
                </div>
                <div class="float-start">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>

@if($transaksi->tipe == "IN")
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Data Buku Yang Masuk</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Judul</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Serial Number</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No Rak</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi->dtlBukusByIn as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $item->buku->judul }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->sn_buku }}</p>
                                    </td>
                                    @if ($item->status == "disimpan")
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-success">{{ $item->status }}</span>
                                        </td>
                                    @elseif($item->status == "dipinjam")
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-info">{{ $item->status }}</span>
                                        </td>
                                    @else
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-warning">{{ $item->status }}</span>
                                        </td>
                                    @endif
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $item->created_at }}</span>
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
@endif
@endsection