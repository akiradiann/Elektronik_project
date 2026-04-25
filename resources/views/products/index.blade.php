@extends('layouts.app')

@section('content')
    <header>
        <h1>Daftar Produk Elektronik</h1>
        <div class="actions">
            <a href="{{ route('products.export.pdf') }}" class="btn btn-outline">Unduh PDF</a>
            <a href="{{ route('products.export.excel') }}" class="btn btn-outline">Unduh XLSX</a>
            <a href="{{ route('products.create') }}" class="btn btn-primary">Tambah Produk</a>
        </div>
    </header>

    <div class="card">
        <form action="{{ route('products.index') }}" method="GET" class="search-bar">
            <input type="text" name="search" placeholder="Cari nama atau deskripsi produk..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
            @if(request('search'))
                <a href="{{ route('products.index') }}" class="btn btn-outline">Reset</a>
            @endif
        </form>

        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        @php
                            $sort = request('sort');
                            $order = request('order') == 'asc' ? 'desc' : 'asc';
                            
                            function sortIcon($column, $currentSort) {
                                if ($currentSort != $column) return '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="opacity: 0.3; margin-left: 4px;"><path d="M7 15l5 5 5-5M7 9l5-5 5 5"/></svg>';
                                if (request('order') == 'asc') return '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-left: 4px;"><path d="M18 15l-6-6-6 6"/></svg>';
                                return '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-left: 4px;"><path d="M6 9l6 6 6-6"/></svg>';
                            }
                        @endphp
                        <th><a href="{{ request()->fullUrlWithQuery(['sort' => 'id', 'order' => $order]) }}" style="display: flex; align-items: center;">ID {!! sortIcon('id', $sort) !!}</a></th>
                        <th><a href="{{ request()->fullUrlWithQuery(['sort' => 'name', 'order' => $order]) }}" style="display: flex; align-items: center;">Nama Produk {!! sortIcon('name', $sort) !!}</a></th>
                        <th><a href="{{ request()->fullUrlWithQuery(['sort' => 'description', 'order' => $order]) }}" style="display: flex; align-items: center;">Deskripsi {!! sortIcon('description', $sort) !!}</a></th>
                        <th><a href="{{ request()->fullUrlWithQuery(['sort' => 'price', 'order' => $order]) }}" style="display: flex; align-items: center;">Harga {!! sortIcon('price', $sort) !!}</a></th>
                        <th><a href="{{ request()->fullUrlWithQuery(['sort' => 'stock', 'order' => $order]) }}" style="display: flex; align-items: center;">Stok {!! sortIcon('stock', $sort) !!}</a></th>
                        <th><a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at', 'order' => $order]) }}" style="display: flex; align-items: center;">Dibuat {!! sortIcon('created_at', $sort) !!}</a></th>
                        <th><a href="{{ request()->fullUrlWithQuery(['sort' => 'updated_at', 'order' => $order]) }}" style="display: flex; align-items: center;">Diperbarui {!! sortIcon('updated_at', $sort) !!}</a></th>
                        <th style="text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td style="font-weight: 500;">{{ $product->name }}</td>
                            <td style="color: var(--text-muted);">{{ Str::limit($product->description, 30) }}</td>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge {{ $product->stock > 0 ? 'badge-positive' : 'badge-zero' }}">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <td style="color: var(--text-muted); font-size: 0.75rem;">{{ $product->created_at->format('d/m/y') }}</td>
                            <td style="color: var(--text-muted); font-size: 0.75rem;">{{ $product->updated_at->format('d/m/y') }}</td>
                            <td style="text-align: right;">
                                <div class="actions" style="justify-content: flex-end;">
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-outline" style="padding: 0.25rem 0.5rem; font-size: 0.75rem;">Lihat</a>
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning" style="padding: 0.25rem 0.5rem; font-size: 0.75rem;">Edit</a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="padding: 0.25rem 0.5rem; font-size: 0.75rem;">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 3rem; color: var(--text-muted);">
                                Tidak ada produk ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination">
            {{ $products->links('pagination::simple-default') }}
        </div>
    </div>
@endsection
@push('scripts')
<script>
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data produk ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                background: '#ffffff',
                customClass: {
                    popup: 'rounded-xl'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
</script>
<style>
    .rounded-xl {
        border-radius: 12px !important;
    }
</style>
@endpush
