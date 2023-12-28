@extends("layout.main")

@section("content")
<div class="container mt-3">
    <div class="row ">
        <div class=" mt-4">
            <form>
                <div class="row">
                    <div class="col-5">
                        <div class="mb-3">
                            <label class="form-label">User / Peminjam</label>
                            <select name="profile_id" class="form-select" aria-label="Default select example" disabled>
                                <option>
                                    {{$peminjaman->profile->nm_lengkap}} | {{ $peminjaman->profile->sn_user }}
                                </option>
                            </select>
                        </div>
                        <div id="PINJAM">
                            <div class="mb-3">
                                <label class="form-label">SN Number Buku</label>
                                <select name="dtl_buku_id" class="form-select" aria-label="Default select example" disabled>
                                    <option>
                                        {{$peminjaman->detailBuku->buku->judul}} | {{$peminjaman->detailBuku->sn_buku}}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="mb-3">
                            <label class="form-label">Tipe</label>
                            <select name="tipe" id="TIPE" class="form-select" aria-label="Default select example" disabled>
                                <option selected>{{ $peminjaman->tipe }}</option>
                            </select>
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
@endsection
