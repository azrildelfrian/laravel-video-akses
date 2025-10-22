@extends('template.master')

@section('content')
    <div class="container py-4">
        <h4>{{ $video->title }}</h4>

        @if ($canWatch)
            <div class="text-center my-3">
                @if (Str::startsWith($video->video_path, ['http', 'https']))
                    <div class="ratio ratio-16x9">
                        <iframe src="{{ $video->video_path }}" frameborder="0" allowfullscreen></iframe>
                    </div>
                @else
                    <video width="100%" controls class="rounded shadow-sm">
                        <source src="{{ asset('videos/' . $video->video_path) }}" type="video/mp4">
                        Browser Anda tidak mendukung tag video.
                    </video>
                @endif
            </div>

            <p class="text-success mt-3">
                <strong>Waktu menonton berakhir pada:</strong>
                {{ \Carbon\Carbon::parse($access->end_time)->format('d M Y H:i') }}
            </p>

            <p id="countdown" class="fw-bold text-primary"></p>

            <script>
                const endTime = new Date("{{ \Carbon\Carbon::parse($access->end_time)->toIso8601String() }}").getTime();

                function updateCountdown() {
                    const now = new Date().getTime();
                    const distance = endTime - now;

                    if (distance <= 0) {
                        document.getElementById("countdown").innerHTML = "Waktu menonton telah berakhir.";
                        setTimeout(() => window.location.reload(), 2000);
                        return;
                    }

                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    document.getElementById("countdown").innerHTML =
                        `Sisa waktu menonton: ${hours}j ${minutes}m ${seconds}d`;

                    setTimeout(updateCountdown, 1000);
                }

                updateCountdown();
            </script>
        @else
            <div class="alert alert-warning">
                Waktu menonton video ini telah habis atau belum diizinkan.
            </div>
            <form method="POST" action="{{ route('customer.videos.requestTime', $video->id) }}">
                @csrf
                <button type="submit" class="btn btn-primary">Ajukan Perpanjangan Waktu</button>
            </form>
        @endif
    </div>
@endsection
