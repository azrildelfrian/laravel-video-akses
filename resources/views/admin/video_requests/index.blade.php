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
            <div class="card-header d-flex justify-content-between">
                <h6>Daftar Permintaan Akses Video</h6>
            </div>
            <div class="card-body">
                <table class="table table-striped text-center align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Video</th>
                            <th>Status</th>
                            <th>Permintaan Pada</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
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
                                @if ($req->status == 'pending')
                                    <td>
                                        <form action="{{ route('admin.video_requests.approve', $req->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <label for="jam">Jam</label>
                                            <input type="number" name="hours" class="form-control form-control-sm"
                                                placeholder="Jam" min="0" style="width:80px">
                                            <label for="menit">Menit</label>
                                            <input type="number" name="minutes" class="form-control form-control-sm"
                                                placeholder="Menit" min="0" max="59" value="0"
                                                style="width:80px">
                                    </td>
                                    <td>
                                        <button class="btn btn-success btn-sm" type="submit">Setujui</button>
                                        </form>
                                        <form action="{{ route('admin.video_requests.reject', $req->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button class="btn btn-danger btn-sm" type="submit">Tolak</button>
                                        </form>
                                    </td>
                                @else
                                    <td>
                                        -
                                    </td>
                                    <td>
                                        <small>Tidak ada aksi</small>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-muted">Belum ada permintaan video.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
