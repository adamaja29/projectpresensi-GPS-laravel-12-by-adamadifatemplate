@extends('layouts.mahasiswa.presen')
@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            @foreach($dosendatang as $dosen)
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm mb-3">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="avatar"
                                          style="background-image: url('{{ asset('uploads/profile/dosen/' . $dosen->foto) }}');
                                                 width: 60px;
                                                 height: 60px;
                                                 border-radius: 50%;
                                                 background-size: cover;
                                                 display: inline-block;">
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $dosen->nama }}
                                    </div>
                                    <p class="text-muted mb-0">🕒 {{ $dosen->jam_in }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection