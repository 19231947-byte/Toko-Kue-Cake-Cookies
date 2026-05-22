@extends('admin.layouts.app')

@section('title', 'Edit Kategori')
@section('page_title', 'Edit Kategori')

@section('content')
    <div class="card" style="max-width:620px;">
        <form action="{{ route('admin.kategori.update', $kategori) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="field">
                <label for="nama_kategori">Nama Kategori</label>
                <input type="text" id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
                @error('nama_kategori') <div class="error">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection

