@extends('layouts.app')

@section('content')
    <header>
        <h1>Tambah Produk Baru</h1>
        <a href="{{ route('products.index') }}" class="btn btn-outline">Kembali</a>
    </header>

    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <form action="{{ route('products.store') }}" method="POST" novalidate>
            @csrf
            <div class="form-group">
                <label for="name">Nama Produk</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required>
                @error('name') <span style="color: var(--danger); font-size: 0.75rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="description">Deskripsi Produk</label>
                <textarea name="description" id="description" rows="4">{{ old('description') }}</textarea>
                @error('description') <span style="color: var(--danger); font-size: 0.75rem;">{{ $message }}</span> @enderror
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="price">Harga (Rp)</label>
                    <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" min="0" required>
                    @error('price') <span style="color: var(--danger); font-size: 0.75rem;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="stock">Stok Barang</label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock') }}" min="0" required>
                    @error('stock') <span style="color: var(--danger); font-size: 0.75rem;">{{ $message }}</span> @enderror
                </div>
            </div>

            <div style="margin-top: 1.5rem;">
                <button type="submit" class="btn btn-primary" style="width: 100%;">Simpan Produk</button>
            </div>
        </form>
    </div>
@endsection
