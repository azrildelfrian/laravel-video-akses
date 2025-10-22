@extends('template.master')

@section('content')
    <div class="row">
        {{-- Jumlah Video Tersedia --}}
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Video Tersedia</p>
                                <h5 class="font-weight-bolder">
                                    {{ $totalVideos ?? 0 }}
                                </h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">{{ $newVideosToday ?? 0 }}</span>
                                    video baru hari ini
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-tv-2 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Akses Aktif --}}
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Akses Aktif</p>
                                <h5 class="font-weight-bolder">
                                    {{ $activeAccess ?? 0 }}
                                </h5>
                                <p class="mb-0">
                                    <span
                                        class="text-success text-sm font-weight-bolder">{{ $accessEndingSoon ?? 0 }}</span>
                                    akan habis dalam 24 jam
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                <i class="ni ni-key-25 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Permintaan Perpanjangan --}}
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Permintaan Perpanjangan</p>
                                <h5 class="font-weight-bolder">
                                    {{ $pendingRequests ?? 0 }}
                                </h5>
                                <p class="mb-0">
                                    <span class="text-warning text-sm font-weight-bolder">Sedang diproses</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                <i class="ni ni-send text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Video Terbaru --}}
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Video Terbaru</p>
                                <h5 class="font-weight-bolder">
                                    {{ $latestVideoTitle ?? '-' }}
                                </h5>
                                <p class="mb-0">
                                    Ditambahkan pada {{ $latestVideoDate ?? '-' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                <i class="ni ni-archive-2 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
