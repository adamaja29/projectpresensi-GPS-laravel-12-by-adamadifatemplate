@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Data Dosen
                </h2>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="row">
                                <div class="col-12">
                                    @if (Session::get('success'))
                                            <div class="alert alert-success">
                                                {{ Session::get('success') }}
                                            </div>
                                        @endif
                                        @if (Session::get('warning'))
                                            <div class="alert alert-warning">
                                                {{ Session::get('warning') }}
                                            </div>
                                        @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <a href="#" class="btn btn-primary" id="btnTambahdosen">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                    Tambah Data
                                </a>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <form action="/dosen" method="GET">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <input type="text" name="nama" id="nama"
                                                    class="form-control" placeholder="Nama dosen"
                                                    value="{{ Request('nama') }}">
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                        <path d="M21 21l-6 -6" />
                                                    </svg>
                                                    Cari
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIDN</th>
                                            <th>Nama</th>
                                            <th>No HP</th>
                                            <th>Foto</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dosen as $index => $item)
                                        <tr>
                                            <td>{{ $index + $dosen->firstItem() }}</td>
                                            <td>{{ $item->nidn }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->nohp }}</td>
                                            <td>
                                                @if ($item->foto)
                                                <img src="{{ asset('uploads/profile/dosen/' . $item->foto) }}" alt="Foto Dosen"
                                                    class="avatar" style="width: 100px; height: 100px; object-fit: cover;">
                                                @else
                                                <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="avatar" style="width: 100px; height: 100px; object-fit: cover;">
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-primary edit" nidn="{{ $item->nidn }}">Edit</a>

                                                <form action="/dosen/{{ $item->nidn }}/delete" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger delete-confirm">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                </table>
                                {{ $dosen->links('vendor.pagination.bootstrap-5') }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="modal-dosen" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Dosen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/dosen/store" method="POST" id="form-dosen" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12">
                        <div class="input-icon mb-3" bis_skin_checked="1">
                            <span class="input-icon-addon">
                              <!-- Download SVG icon from http://tabler.io/icons/icon/user -->
                              <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-barcode"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7v-1a2 2 0 0 1 2 -2h2" /><path d="M4 17v1a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v1" /><path d="M16 20h2a2 2 0 0 0 2 -2v-1" /><path d="M5 11h1v2h-1z" /><path d="M10 11l0 2" /><path d="M14 11h1v2h-1z" /><path d="M19 11l0 2" /></svg>
                            </span>
                            <input type="number" value="" id="nidn" class="form-control" placeholder="NIDN" name="nidn">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="input-icon mb-3" bis_skin_checked="1">
                            <span class="input-icon-addon">
                              <!-- Download SVG icon from http://tabler.io/icons/icon/user -->
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                              </svg>
                            </span>
                            <input type="text" value="" id="nama" class="form-control" placeholder="Nama Lengkap Dosen" name="nama">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-icon mb-3" bis_skin_checked="1">
                            <span class="input-icon-addon">
                              <!-- Download SVG icon from http://tabler.io/icons/icon/user -->
                              <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-phone"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /></svg>
                            </span>
                            <input type="number" value="" id="nohp" class="form-control" placeholder="Telepon/No HP" name="nohp">
                        </div>
                    </div>
                    
                    <div class="mb-3" bis_skin_checked="1">
                        <div class="form-label" bis_skin_checked="1"></div>
                        <input type="file" class="form-control" name="foto">
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <button class="btn btn-primary w-100"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  
                                    viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  
                                    stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-telegram">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 10l-4 4l6 6l4 -16l-18 7l4 2l2 6l3 -4" />
                                </svg>simpan</button>
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Edit Data -->
<div class="modal modal-blur fade" id="modal-editdosen" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Dosen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="load-editdosen">

            </div>
        </div>
    </div>
</div>
@endsection

@push('myscript')
<script>
    $(function() {
        $("#btnTambahdosen").click(function() {
            $("#modal-dosen").modal("show");
        });

        $(".edit").click(function() {
            var nidn = ($(this).attr("nidn"));
            $.ajax({
                type: 'POST',
                url: '/dosen/edit',
                cache: false,
                data: {
                    _token: "{{ csrf_token() }}",
                    nidn: nidn,

                },
                success: function(respond) {
                    $("#load-editdosen").html(respond);
                }
            });
            $("#modal-editdosen").modal("show");
        });

        $(".delete-confirm").click(function(e) {
                var form = $(this).closest('form');
                e.preventDefault();
                Swal.fire({
                    title: "Apakah Anda Yakin Data Ini Ingin Dihapus?",
                    text: "Jika Dihapus, Maka Data Akan Terhapus Permanen!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Hapus Data"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        Swal.fire({
                            title: "Terhapus!",
                            text: "Data Berhasil Dihapus.",
                            icon: "success"
                        });
                    }
                });
            });
        
        $("#form-dosen").submit(function() {
            var nidn = $("#nidn").val();
            var nama = $("#nama").val();
            var nohp = $("#nohp").val();
            if (nidn == "") {
                //alert('NIDN Harus Diisi');
                Swal.fire({
                    title: 'warning!',
                    text: 'NIDN Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    $("#nidn").focus();
                });
                return false;
            }else if (nama = "") {
                //alert('Nama Harus Diisi');
                Swal.fire({
                    title: 'warning!',
                    text: 'Nama Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    $("#nama").focus();
                });
                return false;
            } else if (nohp = "") {
                //alert('No HP Harus Diisi');
                Swal.fire({
                    title: 'warning!',
                    text: 'No HP Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    $("#nohp").focus();
                });
                return false;
            }                      
        });  
    });
</script>
@endpush
