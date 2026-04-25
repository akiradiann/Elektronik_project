@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; min-height: 80vh;">
    <div class="card" style="width: 100%; max-width: 400px;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <h1 style="font-size: 1.5rem;">Login Sistem Inventaris</h1>
            <p style="color: var(--text-muted); font-size: 0.875rem;">Silakan masuk untuk mengelola data</p>
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>
                @error('email') <span style="color: var(--danger); font-size: 0.75rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
                @error('password') <span style="color: var(--danger); font-size: 0.75rem;">{{ $message }}</span> @enderror
            </div>

            <div style="margin-top: 2rem;">
                <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;">Masuk</button>
            </div>
            
            <div style="margin-top: 1.5rem; text-align: center; font-size: 0.75rem; color: var(--text-muted);">
                Default: <strong>admin@toko.com</strong> / <strong>password</strong>
            </div>
        </form>
    </div>
</div>
@endsection
