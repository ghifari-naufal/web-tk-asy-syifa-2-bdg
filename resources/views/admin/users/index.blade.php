{{-- resources/views/admin/users/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3>Daftar Orang Tua</h3>

    <table class="table table-bordered mt-3">
        <thead class="table-primary">
            <tr>
                <th>Nama</th>
                <th>No. HP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->phone ?? $user->no_hp }}</td>
                <td>
                    <form action="{{ route('admin.users.resetPasswordWA', $user) }}" method="POST"
                          onsubmit="return confirm('Reset password & buka WhatsApp untuk {{ $user->name }}?')">
                        @csrf
                        <button type="submit" class="btn btn-warning btn-sm">
                            Reset Password & Kirim WA
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
