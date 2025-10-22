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

        @if ($errors->any())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Perhatian!</strong> Terjadi kesalahan pada input:
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h5>Edit Video</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('videos.update', $video->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Video</label>
                        <input type="text" name="title" id="title" class="form-control"
                            value="{{ old('title', $video->title) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea name="description" id="description" class="form-control">{{ old('description', $video->description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="video_path" class="form-label">Path / URL Video</label>
                        <input type="text" name="video_path" id="video_path" class="form-control mb-2"
                            value="{{ old('video_path', $video->video_path) }}" placeholder="Masukkan URL video (opsional)">

                        <label for="video_file" class="form-label">Upload Video Baru (opsional)</label>
                        <input type="file" name="video_file" id="video_file" class="form-control" accept="video/*">

                        @if ($video->video_path)
                            <div class="mt-3">
                                <p class="mb-1 fw-bold">Video Saat Ini:</p>
                                @if (Str::startsWith($video->video_path, ['http', 'https']))
                                    <a href="{{ $video->video_path }}" target="_blank">Lihat Video</a>
                                @else
                                    <video width="300" controls>
                                        <source src="{{ asset('videos/' . $video->video_path) }}" type="video/mp4">
                                        Browser Anda tidak mendukung video tag.
                                    </video>
                                @endif
                            </div>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-success">Perbarui</button>
                    <a href="{{ route('videos.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
