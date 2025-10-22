@extends('template.master')

@section('content')
    <div class="container-fluid py-4">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6>Daftar Permintaan Akses Video</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped text-center align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Video</th>
                                <th>Status</th>
                                <th>Permintaan Pada</th>
                                <th>Akses Mulai</th>
                                <th>Akses Berakhir</th>
                                <th>Durasi & Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($requests as $index => $req)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $req->user->name }}</td>
                                    <td>{{ $req->video->title }}</td>
                                    <td>
                                        @if ($req->status == 'pending')
                                            <span class="badge bg-warning">Menunggu</span>
                                        @elseif($req->status == 'approved')
                                            <span class="badge bg-success">Disetujui</span>
                                        @else
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>{{ $req->created_at->format('d M Y H:i') }}</td>

                                    <td>
                                        @if ($req->status == 'approved' && $req->access)
                                            {{ $req->access->start_time->format('d M Y H:i') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($req->status == 'approved' && $req->access)
                                            {{ $req->access->end_time->format('d M Y H:i') }}
                                        @else
                                            -
                                        @endif
                                    </td>

                                    <td>
                                        @if ($req->status == 'pending')
                                            <form action="{{ route('admin.video_requests.approve', $req->id) }}"
                                                method="POST" class="d-inline-flex align-items-center">
                                                @csrf
                                                <input type="number" name="hours"
                                                    class="form-control form-control-sm me-1" placeholder="Jam"
                                                    min="0" style="width:70px">
                                                <input type="number" name="minutes"
                                                    class="form-control form-control-sm me-1" placeholder="Menit"
                                                    min="0" max="59" value="0" style="width:70px">
                                                <button class="btn btn-success btn-sm me-1" type="submit">Setujui</button>
                                            </form>
                                            <form action="{{ route('admin.video_requests.reject', $req->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                <button class="btn btn-danger btn-sm" type="submit">Tolak</button>
                                            </form>
                                        @else
                                            <small>Tidak ada aksi</small>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-muted">Belum ada permintaan video.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
