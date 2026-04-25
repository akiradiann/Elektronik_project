@extends('layouts.app')

@section('content')
    <header>
        <h1>Detail Produk: {{ $product->name }}</h1>
        <a href="{{ route('products.index') }}" class="btn btn-outline">Kembali</a>
    </header>

    <div class="card" style="max-width: 800px; margin: 0 auto;">
        <h3 style="font-size: 1.25rem; margin-bottom: 1.5rem; border-bottom: 1px solid var(--border); padding-bottom: 0.75rem;">Informasi Produk</h3>
        
        <div style="display: grid; gap: 1.5rem;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                <div>
                    <label style="color: var(--text-muted); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em;">Nama Produk</label>
                    <p style="font-weight: 600; font-size: 1.125rem;">{{ $product->name }}</p>
                </div>
                <div>
                    <label style="color: var(--text-muted); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em;">Harga Produk</label>
                    <p style="font-weight: 700; font-size: 1.125rem; color: var(--primary);">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                <div>
                    <label style="color: var(--text-muted); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em;">Stok Barang</label>
                    <p>
                        <span class="badge {{ $product->stock > 0 ? 'badge-positive' : 'badge-zero' }}">
                            {{ $product->stock }} unit tersedia
                        </span>
                    </p>
                </div>
                <div>
                    <label style="color: var(--text-muted); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em;">Deskripsi</label>
                    <p style="white-space: pre-line;">{{ $product->description ?: 'Tidak ada deskripsi.' }}</p>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; border-top: 1px solid var(--border); pt: 1.5rem; padding-top: 1.5rem;">
                <div>
                    <label style="color: var(--text-muted); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em;">Tanggal Dibuat</label>
                    <p style="font-size: 0.875rem;">{{ $product->created_at->format('d F Y, H:i') }}</p>
                </div>
                <div>
                    <label style="color: var(--text-muted); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em;">Terakhir Diperbarui</label>
                    <p style="font-size: 0.875rem;">{{ $product->updated_at->format('d F Y, H:i') }}</p>
                </div>
            </div>

            <div style="margin-top: 1.5rem; display: flex; gap: 1rem;">
                <a href="{{ route('products.edit', $product) }}" class="btn btn-warning" style="flex: 1; justify-content: center;">Edit Data</a>
                <form action="{{ route('products.destroy', $product) }}" method="POST" style="flex: 1;" onsubmit="return confirm('Hapus produk ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="width: 100%; justify-content: center;">Hapus Produk</button>
                </form>
            </div>
        </div>
    </div>
@endsection
