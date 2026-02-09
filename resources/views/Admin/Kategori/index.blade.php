<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Forent - Manajemen Kategori</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
        /* ===== VARIABLES & RESET ===== */
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --primary-light: #4895ef;
            --secondary: #7209b7;
            --accent: #f72585;
            --success: #4cc9f0;
            --warning: #f8961e;
            --danger: #f94144;
            --dark: #1a1a2e;
            --darker: #16213e;
            --light: #f8f9fa;
            --gray: #6c757d;
            --gray-light: #e9ecef;
            --card-bg: rgba(255, 255, 255, 0.95);
            --sidebar-bg: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.12);
            --shadow-lg: 0 10px 40px rgba(0, 0, 0, 0.15);
            --radius-sm: 10px;
            --radius-md: 16px;
            --radius-lg: 24px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            color: var(--dark);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ===== LAYOUT ===== */
        .app-container {
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
            margin-left: 280px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: var(--transition);
            width: calc(100% - 280px);
        }

        .sidebar-collapsed .main-content {
            margin-left: 0;
            width: 100%;
        }

        /* ===== HEADER ===== */
        .header {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            padding: 0 40px;
            height: 80px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .header-title {
            font-size: 28px;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            position: relative;
            padding-left: 20px;
        }

        .header-title::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 6px;
            height: 30px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 3px;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        /* ===== SEARCH ===== */
        .search-bar {
            position: relative;
            width: 320px;
        }

        .search-input {
            width: 100%;
            padding: 14px 20px 14px 48px;
            background: rgba(248, 249, 250, 0.8);
            border: 2px solid transparent;
            border-radius: var(--radius-lg);
            font-size: 15px;
            color: var(--dark);
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            font-size: 18px;
            transition: var(--transition);
        }

        .search-input:focus + .search-icon {
            color: var(--primary);
        }

        /* ===== CONTENT ===== */
        .content-wrapper {
            flex: 1;
            padding: 40px;
        }

        /* ===== MAIN CARD ===== */
        .dashboard-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            padding: 32px;
            box-shadow: var(--shadow-md);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: var(--transition);
            backdrop-filter: blur(10px);
            margin-bottom: 40px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
            padding-bottom: 16px;
            border-bottom: 2px solid rgba(67, 97, 238, 0.1);
        }

        .card-title {
            font-size: 22px;
            font-weight: 700;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-title::before {
            content: '';
            width: 8px;
            height: 24px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 4px;
        }

        /* ===== BUTTONS ===== */
        .action-buttons {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 12px 24px;
            border-radius: var(--radius-md);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            border: none;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* ===== SUCCESS MESSAGE ===== */
        .success-message {
            background: linear-gradient(135deg, rgba(76, 201, 240, 0.1), rgba(76, 201, 240, 0.05));
            border: 2px solid rgba(76, 201, 240, 0.2);
            border-radius: var(--radius-md);
            padding: 20px;
            margin-bottom: 28px;
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .success-title {
            color: var(--success);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
        }

        /* ===== TABLE ===== */
        .table-container {
            overflow-x: auto;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-sm);
            -webkit-overflow-scrolling: touch;
        }

        .kategori-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: var(--radius-md);
            overflow: hidden;
            min-width: 600px;
        }

        .kategori-table thead {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }

        .kategori-table th {
            padding: 18px 20px;
            text-align: left;
            color: white;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        .kategori-table tbody tr {
            border-bottom: 1px solid var(--gray-light);
            transition: var(--transition);
        }

        .kategori-table tbody tr:last-child {
            border-bottom: none;
        }

        .kategori-table tbody tr:hover {
            background: rgba(67, 97, 238, 0.05);
        }

        .kategori-table td {
            padding: 18px 20px;
            color: var(--dark);
            font-size: 14px;
            vertical-align: middle;
        }

        .kategori-id {
            font-family: 'Monaco', 'Courier New', monospace;
            color: var(--gray);
            font-weight: 600;
        }

        .kategori-name {
            font-weight: 600;
            color: var(--dark);
        }

        /* ===== ACTION BUTTONS ===== */
        .action-cell {
            display: flex;
            gap: 8px;
        }

        .btn-edit, .btn-delete {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 12px;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            white-space: nowrap;
        }

        .btn-edit {
            background: linear-gradient(135deg, var(--warning), #f97316);
            color: white;
        }

        .btn-delete {
            background: linear-gradient(135deg, var(--danger), #dc2626);
            color: white;
        }

        .btn-edit:hover, .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--gray);
        }

        .empty-icon {
            font-size: 64px;
            color: var(--gray-light);
            margin-bottom: 20px;
        }

        .empty-state h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: var(--dark);
        }

        .empty-state p {
            font-size: 14px;
            max-width: 400px;
            margin: 0 auto 20px;
        }

        /* ===== PAGINATION ===== */
        .pagination-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--gray-light);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1200px) {
            .main-content {
                margin-left: 0;
                width: 100%;
            }
            
            .search-bar {
                width: 240px;
            }
        }

        @media (max-width: 768px) {
            .header {
                padding: 0 20px;
                height: 70px;
            }
            
            .content-wrapper {
                padding: 20px;
            }
            
            .dashboard-card {
                padding: 20px;
            }
            
            .card-header {
                flex-direction: column;
                gap: 16px;
                align-items: flex-start;
            }
            
            .action-cell {
                flex-direction: column;
            }
            
            .kategori-table th,
            .kategori-table td {
                padding: 12px;
            }
            
            .kategori-table {
                min-width: 500px;
            }
        }

        @media (max-width: 480px) {
            .header-title {
                font-size: 22px;
            }
            
            .search-bar {
                display: none;
            }
            
            .action-buttons {
                width: 100%;
                flex-direction: column;
                gap: 10px;
            }
            
            .btn-primary {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="app-container" id="appContainer">
        @include('layouts.sidebar')

        <main class="main-content" id="mainContent">
            <header class="header">
                <h1 class="header-title animate__animated animate__fadeIn">Manajemen Kategori</h1>
                <div class="header-actions">
                    <div class="search-bar">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" placeholder="Cari kategori..." id="globalSearch">
                    </div>
                    <button class="notification-btn" aria-label="Notifikasi">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </button>
                    <div class="user-menu">
                        <div class="user-menu-avatar">
                            @auth
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            @else
                                GU
                            @endauth
                        </div>
                    </div>
                </div>
            </header>

            <div class="content-wrapper">
                <!-- Success Message -->
                @if(session('success'))
                    <div class="success-message">
                        <div class="success-title">
                            <i class="fas fa-check-circle"></i>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                <!-- Main Card -->
                <div class="dashboard-card animate__animated animate__fadeInUp">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-list-alt" aria-hidden="true"></i>
                            Daftar Kategori
                        </h2>
                        <div class="action-buttons">
                            <a href="{{ route('admin.kategori.create') }}" class="btn-primary">
                                <i class="fas fa-plus"></i>
                                Tambah Kategori
                            </a>
                        </div>
                    </div>

                    <!-- Search -->
                    <div style="margin-bottom: 24px;">
                        <input type="text" class="search-input" id="searchInput" placeholder="Cari nama kategori..." style="width: 100%;">
                    </div>

                    <!-- Table - HANYA 4 FIELD -->
                    <div class="table-container">
                        @if($kategori->count() > 0)
                            <table class="kategori-table" aria-label="Daftar kategori">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 80px;">ID</th>
                                        <th scope="col">Nama Kategori</th>
                                        <th scope="col">Dibuat</th>
                                        <th scope="col">Diperbarui</th>
                                        <th scope="col" style="width: 150px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kategori as $k)
                                    <tr class="animate__animated animate__fadeIn" style="animation-delay: {{ $loop->index * 0.05 }}s">
                                        <td>
                                            <span class="kategori-id">#{{ $k->id_kategori }}</span>
                                        </td>
                                        <td>
                                            <div class="kategori-name">{{ $k->nama_kategori }}</div>
                                        </td>
                                        <td>
                                            <div style="font-weight: 600; color: var(--dark);">
                                                {{ $k->created_at->format('d M Y') }}
                                            </div>
                                            <small style="font-size: 12px; color: var(--gray);">
                                                {{ $k->created_at->format('H:i') }}
                                            </small>
                                        </td>
                                        <td>
                                            <div style="font-weight: 600; color: var(--dark);">
                                                {{ $k->updated_at->format('d M Y') }}
                                            </div>
                                            <small style="font-size: 12px; color: var(--gray);">
                                                {{ $k->updated_at->format('H:i') }}
                                            </small>
                                        </td>
                                        <td>
                                            <div class="action-cell">
                                                <a href="{{ route('admin.kategori.edit', $k->id_kategori) }}" class="btn-edit" aria-label="Edit kategori {{ $k->nama_kategori }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('admin.kategori.destroy', $k->id_kategori) }}" method="POST" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-delete" aria-label="Hapus kategori {{ $k->nama_kategori }}" onclick="return confirm('Hapus kategori ini?')">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="fas fa-tags"></i>
                                </div>
                                <h3>Tidak ada kategori</h3>
                                <p>Belum ada kategori yang ditambahkan. Mulai dengan menambahkan kategori baru.</p>
                                <a href="{{ route('admin.kategori.create') }}" class="btn-primary">
                                    <i class="fas fa-plus"></i>
                                    Tambah Kategori Pertama
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Pagination -->
                    @if($kategori->count() > 0)
                        <div class="pagination-container">
                            {{ $kategori->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>

    <script>
        // ===== SEARCH FUNCTIONALITY =====
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const globalSearch = document.getElementById('globalSearch');
            
            function performSearch(searchTerm) {
                const rows = document.querySelectorAll('.kategori-table tbody tr');
                let found = false;
                
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(searchTerm.toLowerCase())) {
                        row.style.display = '';
                        if (!found) {
                            row.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            found = true;
                        }
                    } else {
                        row.style.display = 'none';
                    }
                });
            }
            
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    performSearch(e.target.value.trim());
                });
            }
            
            if (globalSearch) {
                globalSearch.addEventListener('input', function(e) {
                    performSearch(e.target.value.trim());
                });
            }
            
            // Delete confirmation
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
                        e.preventDefault();
                        return false;
                    }
                    
                    const deleteBtn = this.querySelector('.btn-delete');
                    if (deleteBtn) {
                        deleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';
                        deleteBtn.disabled = true;
                    }
                    
                    return true;
                });
            });
            
            // Keyboard shortcut for search
            document.addEventListener('keydown', function(e) {
                if (e.ctrlKey && e.key === 'f') {
                    e.preventDefault();
                    const searchInput = document.getElementById('searchInput') || document.getElementById('globalSearch');
                    if (searchInput) {
                        searchInput.focus();
                        searchInput.select();
                    }
                }
            });
        });
    </script>
</body>
</html>