@extends('layouts.mahasiswa.presen')

@section('content')
<div class="page-header d-print-none" aria-label="Page header">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h1 class="page-title">Dashboard</h1>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <!-- Welcome Section -->
            <div class="col-sm-12 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row gy-3">
                            <div class="col-12 col-sm d-flex flex-column">
                                <h2 class="h1">Welcome back, {{ Auth::guard('mahasiswa')->user()->nama }}</h2>
                                <p class="text-muted">Isi Apa Ya bagusnya???</p>
                                <div class="d-flex align-items-center pb-9">
                                    <div class="d-flex flex-column flex-grow-1">
                                        <h3 class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bold">Program Studi</h3>
                                        <span class="text-muted">Sistem Informasi</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center pb-9">
                                    <div class="d-flex flex-column flex-grow-1">
                                        <h3 class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bold">Fakultas</h3>
                                        <span class="text-muted">Fakultas Ilmu Komputer</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-auto d-flex justify-content-center">
                                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="img-fluid" width="200" height="150">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Announcement Section -->
            <div class="col-sm-12 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row gy-3">
                            <div class="col-12 col-sm d-flex flex-column">
                                <h2 class="h1">Pengumuman</h2>
                                <p class="text-muted">Isi Pengumuman seputar SI atau bisa proker himasi</p>
                            </div>
                            <div class="col-12 col-sm-auto d-flex justify-content-center">
                                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Himasi" class="img-fluid" width="200" height="150">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Dosen Section -->
            <div class="col-sm-6 col-lg-3">
                <a href="#" class="card">
                    <div class="card-body text-center">
                        <h2 class="h4 text-muted mb-3">Total Dosen</h2>
                        <div class="d-flex justify-content-center mb-3">
                            <span class="bg-primary text-white avatar">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-address-book"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 6v12a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2z" /><path d="M10 16h6" /><path d="M13 11m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M4 8h3" /><path d="M4 12h3" /><path d="M4 16h3" /></svg>
                            </span>
                        </div>
                        <div class="h1">{{ $totaldosen }}</div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-lg-3">
                <a href="{{route('mahasiswa.lihatdosen')}}" class="card">
                    <div class="card-body text-center">
                        <h2 class="h4 text-muted mb-3">Dosen Yang Datang</h2>
                        <div class="d-flex justify-content-center mb-3">
                            <span class="bg-yellow text-white avatar">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4" /><path d="M15 19l2 2l4 -4" /></svg>
                            </span>
                        </div>
                        <div class="h1">{{ $dosendatang }}</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection


