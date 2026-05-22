@extends('admin.layouts.app')

@section('title', 'Data User')
@section('page_title', 'User')

@section('content')
    <h2 style="margin:0 0 10px;font-size:1.1rem;">Daftar User</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ ucfirst($item->role) }}</td>
                </tr>
            @empty
                <tr><td colspan="4">Belum ada user.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection

