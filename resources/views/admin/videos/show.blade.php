@extends('template.master')

@section('content')
    <div class="container py-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Detail Video</h5>
                <a href="{{ route('videos.index') }}" class="btn btn-secondary btn-sm">Kembali ke Daftar</a>
            </div>

            <div class="card-body">
                <h4 class="fw-bold">{{ $video->title }}</h4>

                @if ($video->description)
                    <p class="text-muted">{{ $video->description }}</p>
                @else
                    <p class="text-muted fst-italic">Tidak ada deskripsi.</p>
                @endif

                <hr>

                <div class="text-center my-3">
                    @if (Str::startsWith($video->video_path, ['http', 'https']))
                        <div class="ratio ratio-16x9">
                            <iframe src="{{ $video->video_path }}" frameborder="0" allowfullscreen></iframe>
                        </div>
                    @elseif (Str::startsWith($video->video_path, ['<iframe']))
                        <div class="ratio ratio-16x9">
                            {!! $video->video_path !!}
                        </div>
                    @else
                        <video width="100%" controls class="rounded shadow-sm">
                            <source src="{{ asset('videos/' . $video->video_path) }}" type="video/mp4">
                            Browser Anda tidak mendukung tag video.
                        </video>
                    @endif
                </div>


                <hr>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div>
                        <a href="{{ route('videos.edit', $video->id) }}" class="btn btn-warning">
                            <i class="bi bi-pencil-square"></i> Edit Video
                        </a>

                        <form action="{{ route('videos.destroy', $video->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus video ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                    <small class="text-muted">
                        Diperbarui: {{ $video->updated_at->format('d M Y, H:i') }}
                    </small>
                </div>
            </div>
        </div>
    </div>
@endsection
