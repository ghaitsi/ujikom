<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LibTrack - Manajemen Genre Buku</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800|playfair:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
        /* ===== VARIABLES & RESET ===== */
        :root {
            --primary: #2c3e50;
            --primary-dark: #1a252f;
            --primary-light: #34495e;
            --secondary: #8e44ad;
            --accent: #e67e22;
            --success: #27ae60;
            --warning: #f39c12;
            --danger: #e74c3c;
            --dark: #2c3e50;
            --darker: #1a252f;
            --light: #fdf6e3;
            --gray: #7f8c8d;
            --gray-light: #ecf0f1;
            --card-bg: rgba(253, 246, 227, 0.95);
            --sidebar-bg: linear-gradient(180deg, #2c3e50 0%, #1a252f 100%);
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
            background: linear-gradient(135deg, #f5e6ca 0%, #e8d5b7 100%);
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
            background: rgba(253, 246, 227, 0.95);
            backdrop-filter: blur(20px);
            padding: 0 40px;
            height: 80px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #d4a373;
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .header-title {
            font-size: 28px;
            font-weight: 800;
            font-family: 'Playfair', serif;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            position: relative;
            padding-left: 20px;
        }

        .header-title::before {
            content: '📚';
            position: absolute;
            left: -10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 28px;
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
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid #d4a373;
            border-radius: var(--radius-lg);
            font-size: 15px;
            color: var(--dark);
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--secondary);
            background: white;
            box-shadow: 0 0 0 4px rgba(142, 68, 173, 0.1);
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
            color: var(--secondary);
        }

        /* ===== NOTIFICATION & USER ===== */
        .notification-btn {
            position: relative;
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid #d4a373;
            color: var(--gray);
            width: 48px;
            height: 48px;
            border-radius: 50%;
            font-size: 20px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .notification-btn:hover {
            background: white;
            color: var(--secondary);
            border-color: var(--secondary);
            transform: rotate(15deg) scale(1.1);
            box-shadow: var(--shadow-md);
        }

        .notification-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: linear-gradient(135deg, var(--accent), var(--danger));
            color: white;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(230, 126, 34, 0.4);
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            padding: 8px 16px;
            border-radius: var(--radius-lg);
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid #d4a373;
            transition: var(--transition);
        }

        .user-menu:hover {
            background: white;
            border-color: var(--secondary);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .user-menu-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 16px;
            box-shadow: 0 4px 8px rgba(44, 62, 80, 0.3);
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
            border: 1px solid #d4a373;
            transition: var(--transition);
            backdrop-filter: blur(10px);
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
        }

        .dashboard-card::before {
            content: '📖';
            position: absolute;
            bottom: -20px;
            right: -20px;
            font-size: 100px;
            opacity: 0.05;
            pointer-events: none;
        }

        .dashboard-card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-4px);
            border-color: var(--secondary);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
            padding-bottom: 16px;
            border-bottom: 2px solid rgba(142, 68, 173, 0.2);
        }

        .card-title {
            font-size: 22px;
            font-weight: 700;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: 'Playfair', serif;
        }

        .card-title::before {
            content: '📚';
            font-size: 24px;
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
            box-shadow: 0 4px 12px rgba(142, 68, 173, 0.4);
            gap: 12px;
        }

        /* ===== SUCCESS MESSAGE ===== */
        .success-message {
            background: linear-gradient(135deg, rgba(39, 174, 96, 0.1), rgba(39, 174, 96, 0.05));
            border: 2px solid rgba(39, 174, 96, 0.2);
            border-radius: var(--radius-md);
            padding: 20px;
            margin-bottom: 28px;
            animation: slideIn 0.5s ease;
            border-left: 4px solid var(--success);
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
            background: rgba(142, 68, 173, 0.05);
        }

        .kategori-table td {
            padding: 18px 20px;
            color: var(--dark);
            font-size: 14px;
            vertical-align: middle;
        }

        .kategori-id {
            font-family: 'Monaco', 'Courier New', monospace;
            color: var(--secondary);
            font-weight: 600;
            background: rgba(142, 68, 173, 0.1);
            padding: 4px 8px;
            border-radius: 6px;
            display: inline-block;
            font-size: 12px;
        }

        .kategori-name {
            font-weight: 600;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .genre-icon {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
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
            background: linear-gradient(135deg, var(--warning), #e67e22);
            color: white;
        }

        .btn-delete {
            background: linear-gradient(135deg, var(--danger), #c0392b);
            color: white;
        }

        .btn-edit:hover, .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        /* ===== SEARCH INPUT STYLE ===== */
        .search-wrapper {
            margin-bottom: 24px;
            position: relative;
        }

        .search-wrapper .search-input {
            padding-left: 45px;
            background: white;
        }

        .search-wrapper .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            font-size: 16px;
            pointer-events: none;
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

        .pagination-container nav {
            display: flex;
            gap: 8px;
        }

        .pagination-container .pagination {
            display: flex;
            gap: 8px;
            list-style: none;
        }

        .pagination-container .page-item .page-link {
            padding: 8px 14px;
            border-radius: var(--radius-sm);
            background: white;
            border: 1px solid #d4a373;
            color: var(--primary);
            text-decoration: none;
            transition: var(--transition);
        }

        .pagination-container .page-item.active .page-link {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-color: transparent;
        }

        .pagination-container .page-item .page-link:hover {
            background: var(--secondary);
            color: white;
            border-color: var(--secondary);
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
                <h1 class="header-title animate__animated animate__fadeIn">Manajemen Genre Buku</h1>
                <div class="header-actions">
                    <div class="search-bar">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" placeholder="Cari genre..." id="globalSearch">
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
                        <i class="fas fa-chevron-down" style="font-size: 12px; color: var(--gray);"></i>
                    </div>
                </div>
            </header>

            <div class="content-wrapper">
                <!-- Success Message -->
                @if(session('success'))
                    <div class="success-message animate__animated animate__fadeIn">
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
                            Daftar Genre Buku
                        </h2>
                        <div class="action-buttons">
                            <a href="{{ route('admin.kategori.create') }}" class="btn-primary">
                                <i class="fas fa-plus"></i>
                                Tambah Genre
                            </a>
                        </div>
                    </div>

                    <!-- Search -->
                    <div class="search-wrapper">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" id="searchInput" placeholder="Cari nama genre...">
                    </div>

                    <!-- Table -->
                    <div class="table-container">
                        @if($kategori->count() > 0)
                            <table class="kategori-table" aria-label="Daftar genre buku">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 80px;">ID</th>
                                        <th scope="col">Genre Buku</th>
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
                                            <div class="kategori-name">
                                                <div class="genre-icon">
                                                    <i class="fas fa-tag"></i>
                                                </div>
                                                {{ $k->nama_kategori }}
                                            </div>
                                        </td>
                                        <td>
                                            <div style="font-weight: 600; color: var(--dark);">
                                                {{ $k->created_at->format('d M Y') }}
                                            </div>
                                            <small style="font-size: 11px; color: var(--gray);">
                                                {{ $k->created_at->format('H:i') }}
                                            </small>
                                         </td>
                                        <td>
                                            <div style="font-weight: 600; color: var(--dark);">
                                                {{ $k->updated_at->format('d M Y') }}
                                            </div>
                                            <small style="font-size: 11px; color: var(--gray);">
                                                {{ $k->updated_at->format('H:i') }}
                                            </small>
                                         </td>
                                        <td>
                                            <div class="action-cell">
                                                <a href="{{ route('admin.kategori.edit', $k->id_kategori) }}" class="btn-edit" aria-label="Edit genre {{ $k->nama_kategori }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('admin.kategori.destroy', $k->id_kategori) }}" method="POST" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-delete" aria-label="Hapus genre {{ $k->nama_kategori }}" onclick="return confirm('Apakah Anda yakin ingin menghapus genre ini?')">
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
                                    <i class="fas fa-book"></i>
                                </div>
                                <h3>Belum Ada Genre Buku</h3>
                                <p>Tambahkan genre buku seperti Fiksi, Non-Fiksi, Sains, Sejarah, dan lainnya untuk memudahkan pengelompokan koleksi buku.</p>
                                <a href="{{ route('admin.kategori.create') }}" class="btn-primary">
                                    <i class="fas fa-plus"></i>
                                    Tambah Genre Pertama
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
            const rows = document.querySelectorAll('.kategori-table tbody tr');
            
            function performSearch(searchTerm) {
                let visibleCount = 0;
                
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (searchTerm === '' || text.includes(searchTerm.toLowerCase())) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });
                
                // Show empty message if no results
                const tableContainer = document.querySelector('.table-container');
                const existingEmptyMsg = document.querySelector('.search-empty-message');
                
                if (visibleCount === 0 && searchTerm !== '') {
                    if (!existingEmptyMsg) {
                        const emptyMsg = document.createElement('div');
                        emptyMsg.className = 'empty-state search-empty-message';
                        emptyMsg.style.padding = '40px';
                        emptyMsg.innerHTML = `
                            <div class="empty-icon">
                                <i class="fas fa-search"></i>
                            </div>
                            <h3>Tidak ditemukan</h3>
                            <p>Tidak ada genre "${searchTerm}" dalam daftar.</p>
                        `;
                        tableContainer.appendChild(emptyMsg);
                    }
                } else {
                    if (existingEmptyMsg) {
                        existingEmptyMsg.remove();
                    }
                }
            }
            
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    performSearch(e.target.value.trim());
                });
            }
            
            if (globalSearch) {
                globalSearch.addEventListener('input', function(e) {
                    performSearch(e.target.value.trim());
                    if (searchInput) {
                        searchInput.value = e.target.value;
                    }
                });
            }
            
            // Delete confirmation with loading state
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('Apakah Anda yakin ingin menghapus genre ini?\nBuku dengan genre ini akan kehilangan kategori.')) {
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
            
            // Keyboard shortcut for search (Ctrl+F)
            document.addEventListener('keydown', function(e) {
                if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
                    e.preventDefault();
                    const searchInput = document.getElementById('searchInput') || document.getElementById('globalSearch');
                    if (searchInput) {
                        searchInput.focus();
                        searchInput.select();
                    }
                }
            });
            
            // Animation for table rows
            rows.forEach((row, index) => {
                row.style.animationDelay = `${index * 0.03}s`;
            });
        });
    </script>
</body>
</html>