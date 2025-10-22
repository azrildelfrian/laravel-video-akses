@extends('template.master')

@section('content')
    <div class="container py-4">
        <h4>Daftar Video</h4>
        <div class="row">
            @foreach ($videos as $video)
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $video->title }}</h5>
                            <p>{{ Str::limit($video->description, 80) }}</p>
                            <a href="{{ route('customer.videos.show', $video->id) }}" class="btn btn-primary btn-sm">Tonton
                                Video</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
