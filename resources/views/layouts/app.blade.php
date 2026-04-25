<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Inventaris Elektronik</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text-main);
            line-height: 1.5;
            padding: 2rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        header {
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        h1 {
            font-size: 1.875rem;
            font-weight: 700;
            color: var(--text-main);
        }

        .card {
            background: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
            border: none;
            font-size: 0.875rem;
        }

        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-hover); }

        .btn-danger { background: var(--danger); color: white; }
        .btn-danger:hover { opacity: 0.9; }

        .btn-warning { background: var(--warning); color: white; }
        .btn-warning:hover { opacity: 0.9; }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--text-main);
        }
        .btn-outline:hover { background: var(--bg); }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th {
            text-align: left;
            padding: 0.75rem 1rem;
            background: var(--bg);
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            border-bottom: 1px solid var(--border);
        }

        td {
            padding: 1rem;
            border-bottom: 1px solid var(--border);
            font-size: 0.875rem;
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .alert-success { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }

        form .form-group {
            margin-bottom: 1.25rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-main);
            font-size: 0.875rem;
        }

        input, textarea {
            width: 100%;
            padding: 0.625rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-family: inherit;
            font-size: 0.875rem;
        }

        input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .actions {
            display: flex;
            gap: 0.5rem;
        }

        .pagination {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
        }

        .pagination nav {
            display: flex;
            align-items: center;
        }

        .pagination nav > div:first-child {
            display: none !important; /* Sembunyikan info "Showing X of Y" */
        }

        .pagination nav > div:last-child {
            display: flex !important;
            flex-direction: row !important;
            gap: 1.5rem;
        }

        .pagination a, .pagination span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            min-width: 2.5rem;
            height: 2.5rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            text-decoration: none;
            color: var(--text-main);
            font-size: 0.875rem;
            background: white;
            transition: all 0.2s;
        }

        .pagination a:hover {
            background: var(--bg);
            border-color: var(--primary);
            color: var(--primary);
        }

        .pagination .active, .pagination [aria-current="page"] span {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .pagination svg {
            width: 1.25rem;
            height: 1.25rem;
        }

        .search-bar {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .badge {
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-positive { background: #dcfce7; color: #166534; }
        .badge-zero { background: #fee2e2; color: #991b1b; }

        @media (max-width: 768px) {
            body { padding: 1rem; }
            header { flex-direction: column; align-items: flex-start; gap: 1rem; }
            .search-bar { flex-direction: column; }
        }
    </style>
</head>
<body>
    <div class="container">
        @auth
            <div style="display: flex; justify-content: flex-end; align-items: center; gap: 1rem; margin-bottom: 1rem; font-size: 0.875rem;">
                <span style="color: var(--text-muted);">Masuk sebagai: <strong>{{ auth()->user()->name }}</strong></span>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-outline" style="padding: 0.25rem 0.75rem; font-size: 0.75rem;">Keluar</button>
                </form>
            </div>
        @endauth

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>
