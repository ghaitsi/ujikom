<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LibTrack - Pengembalian Buku</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800|playfair:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --primary: #3b6e8c;
            --primary-dark: #2c556d;
            --primary-light: #5c8da8;
            --secondary: #8b5e7e;
            --secondary-light: #a87c9a;
            --accent: #d4a373;
            --success: #4a7c6f;
            --warning: #c9a03d;
            --danger: #c97b5e;
            --dark: #3a4a5a;
            --darker: #2a3a48;
            --light: #fefaf0;
            --gray: #8a9aa8;
            --gray-light: #e8e2d5;
            --card-bg: rgba(254, 250, 240, 0.96);
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.04);
            --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 10px 40px rgba(0, 0, 0, 0.12);
            --radius-sm: 10px;
            --radius-md: 16px;
            --radius-lg: 24px;
            --radius-xl: 32px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #f5e6ca 0%, #e8d5b7 100%);
            color: var(--dark);
            min-height: 100vh;
            overflow-x: hidden;
            font-family: 'Inter', sans-serif;
        }

        /* Layout Container */
        .app-container {
            display: flex;
            min-height: 100vh;
            position: relative;
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

        /* Glass Header */
        .header {
            background: rgba(254, 250, 240, 0.92);
            backdrop-filter: blur(12px);
            padding: 0 32px;
            height: 72px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(212, 163, 115, 0.2);
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .header-title {
            font-size: 24px;
            font-weight: 700;
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
            left: -8px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 24px;
            opacity: 0.7;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .search-wrapper {
            position: relative;
            width: 300px;
        }

        .search-input {
            width: 100%;
            padding: 10px 16px 10px 42px;
            background: rgba(255, 255, 255, 0.85);
            border: 1px solid rgba(212, 163, 115, 0.3);
            border-radius: 40px;
            font-size: 14px;
            color: var(--dark);
            transition: var(--transition);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary-light);
            background: white;
            box-shadow: 0 0 0 3px rgba(59, 110, 140, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            font-size: 14px;
        }

        .search-shortcut {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.04);
            padding: 2px 6px;
            border-radius: 6px;
            font-size: 10px;
            color: var(--gray);
            font-weight: 600;
        }

        .notification-btn {
            position: relative;
            background: rgba(255, 255, 255, 0.85);
            border: 1px solid rgba(212, 163, 115, 0.3);
            color: var(--gray);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            font-size: 18px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .notification-btn:hover {
            background: white;
            color: var(--primary);
            border-color: var(--primary-light);
            transform: scale(1.05);
        }

        .notification-badge {
            position: absolute;
            top: -3px;
            right: -3px;
            background: linear-gradient(135deg, var(--accent), var(--danger));
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 6px 12px;
            border-radius: 40px;
            background: rgba(255, 255, 255, 0.85);
            border: 1px solid rgba(212, 163, 115, 0.3);
            transition: var(--transition);
        }

        .user-menu:hover {
            background: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        .user-menu-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 12px;
        }

        .content-wrapper {
            flex: 1;
            padding: 32px;
        }

        /* Welcome Section */
        .welcome-section {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: var(--radius-xl);
            padding: 32px;
            margin-bottom: 32px;
            color: white;
            box-shadow: var(--shadow-md);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .welcome-text h2 {
            font-size: 28px;
            font-weight: 700;
            font-family: 'Playfair', serif;
            margin-bottom: 8px;
        }

        .welcome-text p {
            font-size: 14px;
            opacity: 0.85;
        }

        /* Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            padding: 20px;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 16px;
            border: 1px solid rgba(212, 163, 115, 0.15);
            cursor: pointer;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
            border-color: rgba(212, 163, 115, 0.3);
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            flex-shrink: 0;
        }

        .icon-primary { background: linear-gradient(145deg, var(--primary), var(--primary-dark)); }
        .icon-success { background: linear-gradient(145deg, var(--success), #3a6b5e); }
        .icon-warning { background: linear-gradient(145deg, var(--warning), #b88a2d); }
        .icon-danger { background: linear-gradient(145deg, var(--danger), #b86a4a); }

        .stat-info h3 {
            font-size: 11px;
            color: var(--gray);
            margin-bottom: 4px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .stat-info .number {
            font-size: 28px;
            font-weight: 800;
            color: var(--dark);
            line-height: 1;
        }

        .stat-info .desc {
            font-size: 11px;
            color: var(--gray);
            margin-top: 4px;
        }

        /* Dashboard Card */
        .dashboard-card {
            background: var(--card-bg);
            border-radius: var(--radius-xl);
            padding: 24px;
            box-shadow: var(--shadow-md);
            border: 1px solid rgba(212, 163, 115, 0.15);
            transition: var(--transition);
            margin-bottom: 40px;
        }

        .dashboard-card:hover {
            box-shadow: var(--shadow-lg);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 2px solid rgba(212, 163, 115, 0.25);
            flex-wrap: wrap;
            gap: 12px;
        }

        .card-title {
            font-size: 20px;
            font-weight: 700;
            font-family: 'Playfair', serif;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-title i {
            color: var(--primary);
        }

        /* Table */
        .table-container {
            overflow-x: auto;
            border-radius: var(--radius-md);
        }

        .peminjaman-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: var(--radius-md);
            overflow: hidden;
            min-width: 800px;
        }

        .peminjaman-table thead {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }

        .peminjaman-table th {
            padding: 14px 16px;
            text-align: left;
            color: white;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .peminjaman-table tbody tr {
            border-bottom: 1px solid #eef2f5;
            transition: var(--transition);
        }

        .peminjaman-table tbody tr:hover {
            background: rgba(107, 76, 122, 0.04);
        }

        .peminjaman-table td {
            padding: 14px 16px;
            color: var(--dark);
            font-size: 13px;
            vertical-align: middle;
        }

        /* Status Badges */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .status-dipinjam {
            background: rgba(233, 196, 106, 0.2);
            color: #b8860b;
        }

        .status-terlambat {
            background: rgba(201, 123, 94, 0.2);
            color: var(--danger);
        }

        .btn-kembalikan {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: linear-gradient(135deg, var(--success), #3a6b5e);
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 12px;
            border: none;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-kembalikan:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(74, 124, 111, 0.3);
            gap: 8px;
        }

        /* Alert */
        .alert {
            padding: 14px 20px;
            border-radius: var(--radius-md);
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-left: 4px solid;
            animation: slideIn 0.3s ease;
        }

        .alert-success {
            background: rgba(74, 124, 111, 0.1);
            border-left-color: var(--success);
            color: var(--success);
        }

        .alert-danger {
            background: rgba(201, 123, 94, 0.1);
            border-left-color: var(--danger);
            color: var(--danger);
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--gray);
        }

        .empty-icon {
            font-size: 64px;
            color: #d4a373;
            margin-bottom: 16px;
        }

        .empty-state h3 {
            font-size: 18px;
            margin-bottom: 8px;
            color: var(--dark);
        }

        /* Image Thumbnail */
        .book-cover {
            width: 60px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .no-image {
            width: 60px;
            height: 70px;
            background: #e8e2d5;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            font-size: 10px;
            color: var(--gray);
        }

        /* Sidebar Toggle */
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            font-size: 20px;
            cursor: pointer;
            z-index: 1000;
            box-shadow: var(--shadow-md);
        }

        /* Toast */
        .toast-notification {
            position: fixed;
            bottom: 30px;
            right: 30px;
            padding: 12px 20px;
            border-radius: var(--radius-md);
            font-weight: 600;
            box-shadow: var(--shadow-lg);
            z-index: 1100;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideInBottom 0.3s ease;
        }

        @keyframes slideInBottom {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideOutBottom {
            from { opacity: 1; transform: translateY(0); }
            to { opacity: 0; transform: translateY(50px); }
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .main-content {
                margin-left: 0;
                width: 100%;
            }
            .sidebar-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .stats-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .header {
                padding: 0 20px;
                height: 64px;
            }
            .content-wrapper {
                padding: 20px;
            }
            .dashboard-card {
                padding: 20px;
            }
            .search-wrapper {
                display: none;
            }
            .stats-container {
                grid-template-columns: 1fr;
            }
            .welcome-section {
                flex-direction: column;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .header-title {
                font-size: 18px;
            }
            .user-menu span {
                display: none;
            }
        }
    </style>
</head>
<body>
    <button class="sidebar-toggle" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <div class="app-container" id="appContainer">
        @include('layouts.sidebarpeminjam')

        <main class="main-content" id="mainContent">
            <header class="header">
                <h1 class="header-title">Pengembalian Buku</h1>
                <div class="header-actions">
                    <div class="search-wrapper">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" id="searchInput" placeholder="Cari buku...">
                        <span class="search-shortcut">⌘K</span>
                    </div>
                    <button class="notification-btn" id="notificationBtn">
                        <i class="fas fa-bell"></i>
                        @php
                            $totalPeminjamanAktif = auth()->check() ? auth()->user()->peminjaman()->where('status', 'dipinjam')->count() : 0;
                        @endphp
                        <span class="notification-badge">{{ $totalPeminjamanAktif }}</span>
                    </button>
                    <div class="user-menu" id="userMenu">
                        <div class="user-menu-avatar">
                            @auth {{ strtoupper(substr(Auth::user()->name, 0, 2)) }} @else PE @endauth
                        </div>
                        <span>{{ Auth::user()->name ?? 'Peminjam' }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </header>

            <div class="content-wrapper">
                <!-- Welcome Section -->
                <div class="welcome-section">
                    <div class="welcome-text">
                        <h2>Kembalikan Buku, {{ Auth::user()->name ?? 'Peminjam' }}! 📚</h2>
                        <p>Kembalikan buku yang sedang Anda pinjam di sini. Pastikan buku dalam kondisi baik</p>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="stats-container">
                    @php
                        $totalDipinjam = auth()->check() ? auth()->user()->peminjaman()->where('status', 'dipinjam')->count() : 0;
                        $totalTerlambat = auth()->check() ? auth()->user()->peminjaman()
                            ->where('status', 'dipinjam')
                            ->whereDate('tanggal_kembali', '<', now())
                            ->count() : 0;
                        $totalDikembalikan = auth()->check() ? auth()->user()->peminjaman()->where('status', 'dikembalikan')->count() : 0;
                        $totalPeminjaman = auth()->check() ? auth()->user()->peminjaman()->count() : 0;
                    @endphp
                    
                    <div class="stat-card" onclick="scrollToSection('activeLoans')">
                        <div class="stat-icon icon-warning"><i class="fas fa-book-open"></i></div>
                        <div class="stat-info">
                            <h3>Sedang Dipinjam</h3>
                            <div class="number">{{ $totalDipinjam }}</div>
                            <div class="desc">Belum dikembalikan</div>
                        </div>
                    </div>

                    <div class="stat-card" onclick="scrollToSection('activeLoans')">
                        <div class="stat-icon icon-danger"><i class="fas fa-exclamation-triangle"></i></div>
                        <div class="stat-info">
                            <h3>Terlambat</h3>
                            <div class="number">{{ $totalTerlambat }}</div>
                            <div class="desc">Perlu segera dikembalikan</div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon icon-success"><i class="fas fa-check-circle"></i></div>
                        <div class="stat-info">
                            <h3>Sudah Dikembalikan</h3>
                            <div class="number">{{ $totalDikembalikan }}</div>
                            <div class="desc">Riwayat pengembalian</div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon icon-primary"><i class="fas fa-history"></i></div>
                        <div class="stat-info">
                            <h3>Total Peminjaman</h3>
                            <div class="number">{{ $totalPeminjaman }}</div>
                            <div class="desc">Semua riwayat</div>
                        </div>
                    </div>
                </div>

                <!-- Alert Messages -->
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                        <div>
                            <strong>Terjadi kesalahan:</strong>
                            <ul style="margin-top: 8px; margin-left: 20px;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <!-- Peminjaman Aktif untuk Dikembalikan -->
                <div class="dashboard-card" id="activeLoans">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-book"></i> Buku yang Sedang Dipinjam</h3>
                        <div class="card-info">
                            <span style="font-size: 13px; color: var(--gray);">{{ $totalDipinjam }} buku perlu dikembalikan</span>
                        </div>
                    </div>

                    <div class="table-container">
                        @php
                            $peminjamanAktif = auth()->check() ? 
                                auth()->user()->peminjaman()
                                    ->with('alat')
                                    ->where('status', 'dipinjam')
                                    ->latest()
                                    ->get() : 
                                collect();
                        @endphp
                        
                        @if($peminjamanAktif->count() > 0)
                            <table class="peminjaman-table">
                                <thead>
                                    <tr>
                                        <th>Judul Buku</th>
                                        <th>Cover</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Rencana Kembali</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach($peminjamanAktif as $loan)
                                    @php
                                        $today = now();
                                        $rencanaKembali = \Carbon\Carbon::parse($loan->tanggal_kembali);
                                        $daysLeft = $today->diffInDays($rencanaKembali, false);
                                        $isLate = $daysLeft < 0;
                                        $statusClass = $isLate ? 'status-terlambat' : 'status-dipinjam';
                                        $statusText = $isLate ? 'Terlambat' : 'Dipinjam';
                                    @endphp
                                    <tr data-search="{{ $loan->alat->nama_alat ?? '' }} {{ $loan->id_peminjaman }}">
                                        <td><strong>{{ $loan->alat->nama_alat ?? '-' }}</strong><br><small style="color: var(--gray);">{{ $loan->alat->kategori->nama_kategori ?? '' }}</small></td>
                                        <td>
                                            @if($loan->alat && $loan->alat->gambar)
                                                <img src="{{ asset('storage/' . $loan->alat->gambar) }}" class="book-cover" alt="Cover">
                                            @else
                                                <div class="no-image"><i class="fas fa-book"></i></div>
                                            @endif
                                        </div>
                                        <td>{{ \Carbon\Carbon::parse($loan->tanggal_pinjam)->format('d/m/Y') }}</div>
                                        <td>
                                            <div><strong>{{ \Carbon\Carbon::parse($loan->tanggal_kembali)->format('d/m/Y') }}</strong></div>
                                            @if($daysLeft > 0)
                                                <small style="color: var(--success);">{{ $daysLeft }} hari lagi</small>
                                            @elseif($daysLeft == 0)
                                                <small style="color: var(--warning);"><i class="fas fa-exclamation-circle"></i> Hari ini</small>
                                            @else
                                                <small style="color: var(--danger);"><i class="fas fa-exclamation-triangle"></i> {{ abs($daysLeft) }} hari terlambat</small>
                                            @endif
                                        </div>
                                        <td><span class="status-badge {{ $statusClass }}"><i class="fas {{ $isLate ? 'fa-exclamation-triangle' : 'fa-clock' }}"></i> {{ $statusText }}</span></td>
                                        <td>
                                            <form method="POST" action="{{ route('peminjam.pengembalian.kembalikan', $loan->id_peminjaman) }}" class="return-form">
                                                @csrf
                                                <button type="submit" class="btn-kembalikan">
                                                    <i class="fas fa-undo-alt"></i> Kembalikan
                                                </button>
                                            </form>
                                        </div>
                                    </tr>
                                    @endforeach
                                </tbody>
                             </div>
                        @else
                            <div class="empty-state">
                                <div class="empty-icon"><i class="fas fa-check-circle"></i></div>
                                <h3>Tidak ada buku yang dipinjam</h3>
                                <p>Anda tidak memiliki buku yang sedang dipinjam saat ini.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Toggle sidebar
        const sidebarToggle = document.getElementById('sidebarToggle');
        const appContainer = document.getElementById('appContainer');
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                appContainer.classList.toggle('sidebar-collapsed');
            });
        }

        // Scroll to section
        function scrollToSection(sectionId) {
            const section = document.getElementById(sectionId);
            if (section) {
                section.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }

        // Search functionality
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            let searchTimeout;
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    const term = this.value.toLowerCase();
                    const rows = document.querySelectorAll('#tableBody tr');
                    let visibleCount = 0;
                    
                    rows.forEach(row => {
                        const text = row.dataset.search?.toLowerCase() || row.textContent.toLowerCase();
                        if (term === '' || text.includes(term)) {
                            row.style.display = '';
                            visibleCount++;
                        } else {
                            row.style.display = 'none';
                        }
                    });
                    
                    if (term && visibleCount === 0) {
                        showToast(`Tidak ditemukan dengan kata "${term}"`, 'warning');
                    }
                }, 300);
            });
        }

        // Return form confirmation with SweetAlert
        const returnForms = document.querySelectorAll('.return-form');
        returnForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const bookName = this.closest('tr')?.querySelector('td:first-child strong')?.textContent || 'Buku';
                
                Swal.fire({
                    title: '<i class="fas fa-undo-alt"></i> Konfirmasi Pengembalian',
                    html: `
                        <div style="text-align: center;">
                            <div style="background: linear-gradient(135deg, #4a7c6f, #3a6b5e); width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                                <i class="fas fa-book" style="font-size: 30px; color: white;"></i>
                            </div>
                            <p>Anda akan mengembalikan buku</p>
                            <p style="font-weight: 800; font-size: 18px; margin: 10px 0;">"${bookName}"</p>
                            <p style="color: #8a9aa8;">Pastikan buku dalam kondisi baik sebelum dikembalikan.</p>
                        </div>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: '<i class="fas fa-check"></i> Ya, Kembalikan!',
                    cancelButtonText: '<i class="fas fa-times"></i> Batal',
                    confirmButtonColor: '#4a7c6f',
                    cancelButtonColor: '#8a9aa8',
                    background: '#fefaf0'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Toast notification
        function showToast(message, type = 'info') {
            const existing = document.querySelector('.toast-notification');
            if (existing) existing.remove();
            
            const toast = document.createElement('div');
            toast.className = 'toast-notification';
            toast.style.background = type === 'success' ? '#4a7c6f' : type === 'error' ? '#c97b5e' : type === 'warning' ? '#e9c46a' : '#3b6e8c';
            toast.style.color = type === 'warning' ? '#2d3e50' : 'white';
            toast.innerHTML = `<i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-times-circle' : type === 'warning' ? 'fa-exclamation-triangle' : 'fa-info-circle'}"></i><span>${message}</span>`;
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.style.animation = 'slideOutBottom 0.3s ease';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Notification button
        const notificationBtn = document.getElementById('notificationBtn');
        if (notificationBtn) {
            notificationBtn.addEventListener('click', function() {
                scrollToSection('activeLoans');
            });
        }

        // User menu
        const userMenu = document.getElementById('userMenu');
        if (userMenu) {
            userMenu.addEventListener('click', function() {
                Swal.fire({
                    title: '<i class="fas fa-user-circle"></i> Akun Saya',
                    html: `
                        <div style="text-align: center;">
                            <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #3b6e8c, #8b5e7e); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                                <i class="fas fa-user" style="font-size: 40px; color: white;"></i>
                            </div>
                            <h3 style="font-weight: 800;">{{ Auth::user()->name ?? 'Peminjam' }}</h3>
                            <p style="color: #8a9aa8;">{{ Auth::user()->email ?? 'peminjam@libtrack.com' }}</p>
                        </div>
                    `,
                    showCancelButton: true,
                    confirmButtonText: '<i class="fas fa-sign-out-alt"></i> Logout',
                    cancelButtonText: '<i class="fas fa-times"></i> Tutup',
                    confirmButtonColor: '#c97b5e',
                    cancelButtonColor: '#8a9aa8',
                    background: '#fefaf0'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '{{ route("logout") }}';
                    }
                });
            });
        }

        // Keyboard shortcut Ctrl+K
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                if (searchInput) searchInput.focus();
            }
        });

        // Success message with SweetAlert
        @if(session('success'))
        Swal.fire({
            title: '<i class="fas fa-check-circle"></i> Berhasil!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonColor: '#4a7c6f',
            timer: 3000,
            timerProgressBar: true,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            background: '#fefaf0'
        });
        @endif
    </script>
</body>
</html>