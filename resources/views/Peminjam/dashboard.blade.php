<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Forent - Dashboard Peminjam</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
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
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            color: var(--dark);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Layout Container */
        .app-container {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        /* Main Content dengan margin untuk sidebar */
        .main-content {
            flex: 1;
            margin-left: 280px; /* Sama dengan lebar sidebar */
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: var(--transition);
            width: calc(100% - 280px);
        }

        /* Responsive: jika sidebar disembunyikan */
        .sidebar-collapsed .main-content {
            margin-left: 0;
            width: 100%;
        }

        /* Glass Header */
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

        .notification-btn {
            position: relative;
            background: rgba(248, 249, 250, 0.8);
            border: 2px solid transparent;
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
            color: var(--primary);
            border-color: var(--primary-light);
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
            box-shadow: 0 2px 8px rgba(247, 37, 133, 0.4);
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            padding: 8px 16px;
            border-radius: var(--radius-lg);
            background: rgba(248, 249, 250, 0.8);
            border: 2px solid transparent;
            transition: var(--transition);
        }

        .user-menu:hover {
            background: white;
            border-color: var(--primary-light);
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
            box-shadow: 0 4px 8px rgba(67, 97, 238, 0.3);
        }

        /* Content */
        .content-wrapper {
            flex: 1;
            padding: 40px;
        }

        /* Welcome Section */
        .welcome-section {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: var(--radius-lg);
            padding: 32px;
            margin-bottom: 30px;
            color: white;
            box-shadow: var(--shadow-md);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .welcome-text h2 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .welcome-text p {
            font-size: 16px;
            opacity: 0.9;
        }

        /* Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--card-bg);
            border-radius: var(--radius-md);
            padding: 24px;
            box-shadow: var(--shadow-md);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: var(--transition);
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            flex-shrink: 0;
        }

        .icon-primary { background: linear-gradient(135deg, var(--primary), var(--secondary)); }
        .icon-success { background: linear-gradient(135deg, var(--success), #0ea5e9); }
        .icon-warning { background: linear-gradient(135deg, var(--warning), #f97316); }
        .icon-danger { background: linear-gradient(135deg, var(--danger), #e53e3e); }

        .stat-info h3 {
            font-size: 14px;
            color: var(--gray);
            margin-bottom: 4px;
            font-weight: 600;
        }

        .stat-info .number {
            font-size: 28px;
            font-weight: 700;
            color: var(--dark);
            line-height: 1;
        }

        .stat-info .desc {
            font-size: 12px;
            color: var(--gray);
            margin-top: 4px;
        }

        /* Premium Card Container */
        .dashboard-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            padding: 32px;
            box-shadow: var(--shadow-md);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: var(--transition);
            backdrop-filter: blur(10px);
            animation: cardEntrance 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
            opacity: 0;
            transform: translateY(20px);
            margin-bottom: 40px;
        }

        @keyframes cardEntrance {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .dashboard-card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-8px);
            border-color: var(--primary-light);
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

        /* Table Styling */
        .table-container {
            overflow-x: auto;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-sm);
            -webkit-overflow-scrolling: touch;
        }

        .peminjaman-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: white;
            border-radius: var(--radius-md);
            overflow: hidden;
        }

        .peminjaman-table thead {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            position: sticky;
            top: 0;
        }

        .peminjaman-table th {
            padding: 18px 20px;
            text-align: left;
            color: white;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        .peminjaman-table tbody tr {
            transition: var(--transition);
            border-bottom: 1px solid var(--gray-light);
        }

        .peminjaman-table tbody tr:last-child {
            border-bottom: none;
        }

        .peminjaman-table tbody tr:hover {
            background: rgba(67, 97, 238, 0.05);
            transform: translateX(4px);
        }

        .peminjaman-table td {
            padding: 20px 16px;
            color: var(--dark);
            font-size: 14px;
            vertical-align: middle;
        }

        /* Status Badges */
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        .status-dipinjam {
            background: linear-gradient(135deg, rgba(248, 150, 30, 0.15), rgba(248, 150, 30, 0.05));
            color: var(--warning);
            border: 2px solid rgba(248, 150, 30, 0.2);
        }

        .status-dikembalikan {
            background: linear-gradient(135deg, rgba(76, 201, 240, 0.15), rgba(76, 201, 240, 0.05));
            color: var(--success);
            border: 2px solid rgba(76, 201, 240, 0.2);
        }

        .status-menunggu {
            background: linear-gradient(135deg, rgba(108, 117, 125, 0.15), rgba(108, 117, 125, 0.05));
            color: var(--gray);
            border: 2px solid rgba(108, 117, 125, 0.2);
        }

        .status-terlambat {
            background: linear-gradient(135deg, rgba(249, 65, 68, 0.15), rgba(249, 65, 68, 0.05));
            color: var(--danger);
            border: 2px solid rgba(249, 65, 68, 0.2);
        }

        /* Stock Indicator */
        .stock-indicator {
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .stock-low { color: var(--danger); font-weight: 600; }
        .stock-medium { color: var(--warning); font-weight: 600; }
        .stock-high { color: var(--success); font-weight: 600; }

        /* Condition Badges */
        .condition-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .condition-baik { 
            background: rgba(76, 201, 240, 0.1); 
            color: var(--success);
            border: 1px solid rgba(76, 201, 240, 0.2);
        }

        .condition-rusak { 
            background: rgba(249, 65, 68, 0.1); 
            color: var(--danger);
            border: 1px solid rgba(249, 65, 68, 0.2);
        }

        .condition-perbaikan { 
            background: rgba(248, 150, 30, 0.1); 
            color: var(--warning);
            border: 1px solid rgba(248, 150, 30, 0.2);
        }

        /* Pinjam Form */
        .pinjam-form {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
        }

        .date-input {
            padding: 10px 14px;
            border: 2px solid var(--gray-light);
            border-radius: var(--radius-sm);
            font-size: 14px;
            transition: var(--transition);
            background: white;
        }

        .date-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }

        /* Action Buttons */
        .btn-pinjam {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 10px 20px;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 12px;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            white-space: nowrap;
        }

        .btn-pinjam:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        .btn-kembalikan {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: linear-gradient(135deg, var(--success), #0ea5e9);
            color: white;
            padding: 10px 20px;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 12px;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            white-space: nowrap;
        }

        .btn-kembalikan:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        /* Alert Message */
        .alert {
            padding: 16px 24px;
            border-radius: var(--radius-md);
            margin-bottom: 24px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(76, 201, 240, 0.15), rgba(76, 201, 240, 0.05));
            color: var(--success);
            border: 2px solid rgba(76, 201, 240, 0.2);
        }

        .alert-success i {
            color: var(--success);
        }

        .alert-danger {
            background: linear-gradient(135deg, rgba(249, 65, 68, 0.15), rgba(249, 65, 68, 0.05));
            color: var(--danger);
            border: 2px solid rgba(249, 65, 68, 0.2);
        }

        .alert-danger i {
            color: var(--danger);
        }

        /* Pagination */
        .pagination-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--gray-light);
        }

        .pagination {
            display: flex;
            gap: 8px;
            list-style: none;
            flex-wrap: wrap;
        }

        .pagination li {
            display: inline-flex;
        }

        .pagination a, .pagination span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 0 12px;
            border-radius: var(--radius-sm);
            background: white;
            color: var(--dark);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            border: 2px solid var(--gray-light);
            transition: var(--transition);
        }

        .pagination a:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            transform: translateY(-2px);
        }

        .pagination .active span {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-color: var(--primary);
        }

        /* Empty State */
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

        /* Sidebar Toggle Button untuk Mobile */
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            width: 48px;
            height: 48px;
            border-radius: var(--radius-sm);
            font-size: 20px;
            cursor: pointer;
            z-index: 1000;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
        }

        .sidebar-toggle:hover {
            transform: scale(1.1);
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
                padding: 24px;
            }
            
            .search-bar {
                display: none;
            }
            
            .stats-container {
                grid-template-columns: 1fr;
            }
            
            .card-header {
                flex-direction: column;
                gap: 16px;
                align-items: flex-start;
            }
            
            .pinjam-form {
                flex-direction: column;
                align-items: stretch;
            }
            
            .date-input {
                width: 100%;
            }
            
            .btn-pinjam, .btn-kembalikan {
                width: 100%;
                justify-content: center;
            }
            
            .peminjaman-table {
                font-size: 12px;
            }
            
            .peminjaman-table th,
            .peminjaman-table td {
                padding: 12px;
            }
        }

        @media (max-width: 480px) {
            .header-title {
                font-size: 22px;
            }
            
            .card-title {
                font-size: 18px;
            }
            
            .pagination {
                flex-wrap: wrap;
                justify-content: center;
            }
        }
    </style>
</head>
<body class="font-sans antialiased">
    <!-- Sidebar Toggle Button -->
    <button class="sidebar-toggle" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- App Container -->
    <div class="app-container" id="appContainer">
        <!-- Include Sidebar Peminjam -->
        @include('layouts.sidebarpeminjam')

        <!-- Main Content -->
        <main class="main-content" id="mainContent">
            <!-- Glass Header -->
            <header class="header">
                <h1 class="header-title animate__animated animate__fadeIn">Dashboard Peminjam</h1>
                <div class="header-actions">
                    <div class="search-bar" id="globalSearchBar">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" placeholder="Cari alat atau riwayat...">
                    </div>
                    <button class="notification-btn" id="notificationBtn">
                        <i class="fas fa-bell"></i>
                        @php
                            $totalPeminjamanAktif = auth()->check() ? auth()->user()->peminjaman()->where('status', 'dipinjam')->count() : 0;
                        @endphp
                        <span class="notification-badge" id="notificationCount">{{ $totalPeminjamanAktif }}</span>
                    </button>
                    <div class="user-menu">
                        <div class="user-menu-avatar">
                            @auth
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            @else
                                PE
                            @endauth
                        </div>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="content-wrapper">
                <!-- Welcome Section -->
                <div class="welcome-section animate__animated animate__fadeIn">
                    <div class="welcome-text">
                        <h2>Selamat Datang, {{ Auth::user()->name ?? 'Peminjam' }}!</h2>
                        <p>Lihat daftar alat, pinjam langsung, dan kelola peminjaman Anda di satu tempat</p>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="stats-container">
                    @php
                        $totalAlatTersedia = App\Models\Alat::where('stok', '>', 0)->count();
                        $totalPeminjaman = auth()->check() ? auth()->user()->peminjaman()->count() : 0;
                        $totalDipinjam = auth()->check() ? auth()->user()->peminjaman()->where('status', 'dipinjam')->count() : 0;
                        $totalTerlambat = auth()->check() ? auth()->user()->peminjaman()
                            ->where('status', 'dipinjam')
                            ->whereDate('tanggal_kembali', '<', now())
                            ->count() : 0;
                    @endphp
                    
                    <div class="stat-card animate__animated animate__fadeInUp">
                        <div class="stat-icon icon-primary">
                            <i class="fas fa-toolbox"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Alat Tersedia</h3>
                            <div class="number">{{ $totalAlatTersedia }}</div>
                            <div class="desc">Alat siap dipinjam</div>
                        </div>
                    </div>

                    <div class="stat-card animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
                        <div class="stat-icon icon-success">
                            <i class="fas fa-history"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Total Peminjaman</h3>
                            <div class="number">{{ $totalPeminjaman }}</div>
                            <div class="desc">Semua riwayat</div>
                        </div>
                    </div>

                    <div class="stat-card animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
                        <div class="stat-icon icon-warning">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Sedang Dipinjam</h3>
                            <div class="number">{{ $totalDipinjam }}</div>
                            <div class="desc">Belum dikembalikan</div>
                        </div>
                    </div>

                    <div class="stat-card animate__animated animate__fadeInUp" style="animation-delay: 0.3s">
                        <div class="stat-icon icon-danger">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Terlambat</h3>
                            <div class="number">{{ $totalTerlambat }}</div>
                            <div class="desc">Belum dikembalikan</div>
                        </div>
                    </div>
                </div>

                <!-- Success Message -->
                @if(session('success'))
                    <div class="alert alert-success animate__animated animate__fadeIn">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Error Messages -->
                @if($errors->any())
                    <div class="alert alert-danger animate__animated animate__fadeIn">
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

                <!-- DAftar Alat Tersedia untuk Dipinjam -->
                <div class="dashboard-card animate__animated animate__fadeInUp">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-tools"></i>
                            Daftar Alat Tersedia
                        </h3>
                        <div class="action-buttons">
                            <span class="text-sm text-gray-600">
                                {{ $totalAlatTersedia }} alat siap dipinjam
                            </span>
                        </div>
                    </div>

                    <div class="table-container">
                        @php
                            $kategoriAlat = App\Models\Kategori::withCount(['alat' => function($query) {
                                $query->where('stok', '>', 0);
                            }])->get();
                            $alatTersedia = App\Models\Alat::where('stok', '>', 0)->latest()->get();
                        @endphp
                        
                        @if($alatTersedia->count() > 0)
                            <table class="peminjaman-table" aria-label="Daftar Alat Tersedia">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama Alat</th>
                                        <th scope="col">Gambar</th>
                                        <th scope="col">Stok</th>
                                        <th scope="col">Kondisi</th>
                                        <th scope="col" style="width: 300px;">Pinjam Sekarang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($alatTersedia as $a)
                                    <tr class="animate__animated animate__fadeIn" style="animation-delay: {{ $loop->index * 0.05 }}s">
                                        <td>
                                            <div style="font-weight: 600; color: var(--dark);">{{ $a->nama_alat }}</div>
                                            @if($a->kategori)
                                                <div style="font-size: 12px; color: var(--gray); margin-top: 4px;">
                                                    {{ $a->kategori->nama_kategori }}
                                                </div>
                                            @endif
                                        </td>

                                        <td>
                                            <img src="{{ asset('storage/' . $a->gambar) }}"
                                                 alt="Gambar {{ $a->nama_alat }}"
                                                 style="width: 60px; height: 60px; object-fit: cover; border-radius: var(--radius-sm); box-shadow: var(--shadow-sm);">  
                                        </td>

                                        <td>
                                            <div class="stock-indicator {{ 
                                                $a->stok <= 2 ? 'stock-low' : 
                                                ($a->stok <= 5 ? 'stock-medium' : 'stock-high') 
                                            }}">
                                                <i class="fas fa-box"></i>
                                                {{ $a->stok }} unit
                                            </div>
                                        </td>
                                        
                                        <td>
                                            @php
                                                $conditionClass = 'condition-baik';
                                                if(strpos(strtolower($a->kondisi), 'rusak') !== false) {
                                                    $conditionClass = 'condition-rusak';
                                                } elseif(strpos(strtolower($a->kondisi), 'perbaikan') !== false) {
                                                    $conditionClass = 'condition-perbaikan';
                                                }
                                            @endphp
                                            <span class="condition-badge {{ $conditionClass }}">
                                                @if($conditionClass == 'condition-baik')
                                                    <i class="fas fa-check-circle"></i>
                                                @elseif($conditionClass == 'condition-rusak')
                                                    <i class="fas fa-times-circle"></i>
                                                @else
                                                    <i class="fas fa-tools"></i>
                                                @endif
                                                {{ $a->kondisi }}
                                            </span>
                                        </td>
                                        
                                        <td>
                                            <form method="POST" 
                                                  action="{{ route('peminjam.pinjam') }}" 
                                                  class="pinjam-form">
                                                @csrf
                                                <input type="hidden" name="id_alat" value="{{ $a->id_alat }}">
                                                
                                                <input type="date" 
                                                       name="tanggal_kembali" 
                                                       class="date-input" 
                                                       required
                                                       min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                                       value="{{ date('Y-m-d', strtotime('+7 days')) }}"
                                                       title="Pilih tanggal rencana pengembalian">
                                                
                                                <button type="submit" class="btn-pinjam">
                                                    <i class="fas fa-hand-paper"></i>
                                                    Pinjam Alat
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="fas fa-tools"></i>
                                </div>
                                <h3>Tidak ada alat tersedia</h3>
                                <p>Semua alat sedang dipinjam atau dalam perbaikan. Silakan coba lagi nanti.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Peminjaman Aktif & Riwayat -->
                <div class="dashboard-card animate__animated animate__fadeInUp">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-history"></i>
                            Peminjaman Saya
                        </h3>
                        <div class="action-buttons">
                            <span class="text-sm text-gray-600">
                                {{ $totalDipinjam }} sedang dipinjam, {{ $totalTerlambat }} terlambat
                            </span>
                        </div>
                    </div>

                    <div class="table-container">
                        @php
                            $semuaPeminjaman = auth()->check() ? 
                                auth()->user()->peminjaman()
                                    ->with('alat')
                                    ->latest()
                                    ->get() : 
                                collect();
                        @endphp
                        
                        @if($semuaPeminjaman->count() > 0)
                            <table class="peminjaman-table" aria-label="Peminjaman Saya">
                                <thead>
                                    <tr>
                                        <th scope="col">Alat</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Gambar</th>
                                        <th scope="col">Tanggal Pinjam</th>
                                        <th scope="col">Rencana Kembali</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Denda</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($semuaPeminjaman as $r)
                                    @php
                                        $statusClass = 'status-menunggu';
                                        if($r->status == 'dipinjam') {
                                            $statusClass = 'status-dipinjam';
                                        } elseif($r->status == 'dikembalikan') {
                                            $statusClass = 'status-dikembalikan';
                                        } elseif($r->status == 'terlambat') {
                                            $statusClass = 'status-terlambat';
                                        }
                                        
                                        // Hitung hari tersisa atau terlambat
                                        $today = now();
                                        $rencanaKembali = \Carbon\Carbon::parse($r->tanggal_kembali);
                                        $daysLeft = $today->diffInDays($rencanaKembali, false);
                                    @endphp
                                    <tr class="animate__animated animate__fadeIn" style="animation-delay: {{ $loop->index * 0.05 }}s">
                                        <td>
                                            <div style="font-weight: 600; color: var(--dark);">
                                                {{ $r->alat->nama_alat ?? '-' }}
                                            </div>
                                        </td>
                                        

                                
                                <td> 
                                    <div style="font-weight: 600; color: var(--dark);">
                                        {{ $a->kategori->id_kategori ?? '-' }}
                                    </div>
                                
                                    </td>
                                        <td>
                                            @if($r->alat && $r->alat->gambar)
                                                <img src="{{ asset('storage/' . $r->alat->gambar) }}"
                                                     alt="Gambar {{ $r->alat->nama_alat }}"
                                                     style="width: 60px; height: 60px; object-fit: cover; border-radius: var(--radius-sm); box-shadow: var(--shadow-sm);">  
                                            @else
                                                <div style="width: 60px; height: 60px; background: var(--gray-light); display: flex; align-items: center; justify-content: center; border-radius: var(--radius-sm);">
                                                    <i class="fas fa-image" style="color: var(--gray);"></i>
                                                </div>
                                            @endif
                                        <td>
                                            <div style="font-weight: 600; color: var(--dark);">
                                                {{ $r->tanggal_pinjam }}
                                            </div>
                                        </td>
                                        
                                        <td>
                                            <div style="font-weight: 600; color: var(--dark);">
                                                {{ $r->tanggal_kembali }}
                                            </div>
                                            @if($r->status == 'dipinjam')
                                                @if($daysLeft > 0)
                                                    <div style="font-size: 12px; color: var(--success);">
                                                        <i class="fas fa-clock"></i>
                                                        {{ $daysLeft }} hari lagi
                                                    </div>
                                                @elseif($daysLeft == 0)
                                                    <div style="font-size: 12px; color: var(--warning);">
                                                        <i class="fas fa-exclamation-circle"></i>
                                                        Hari ini
                                                    </div>
                                                @else
                                                    <div style="font-size: 12px; color: var(--danger);">
                                                        <i class="fas fa-exclamation-triangle"></i>
                                                        {{ abs($daysLeft) }} hari terlambat
                                                    </div>
                                                @endif
                                            @endif
                                        </td>
                                        
                                        <td>
                                            <span class="status-badge {{ $statusClass }}">
                                                @if($statusClass == 'status-dipinjam')
                                                    <i class="fas fa-clock"></i>
                                                @elseif($statusClass == 'status-dikembalikan')
                                                    <i class="fas fa-check-circle"></i>
                                                @elseif($statusClass == 'status-terlambat')
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                @else
                                                    <i class="fas fa-hourglass-half"></i>
                                                @endif
                                                {{ $r->status }}
                                            </span>
                                        </td>
                                        
                                        <td>
    @php
        $denda = 0;
        if ($r->status == 'dipinjam' && $daysLeft < 0) {
            $denda = abs($daysLeft) * 2000;
        }
    @endphp

    @if($denda > 0)
        <div style="color: var(--danger); font-weight: 700;">
            Rp {{ number_format($denda, 0, ',', '.') }}
        </div>
        <div style="font-size: 12px; color: var(--danger);">
            Terlambat {{ abs($daysLeft) }} hari
        </div>
    @else
        <span style="color: var(--success); font-weight: 600;">Tidak ada</span>
    @endif
</td>

<td>
    @if($denda > 0)
        <form method="POST" action="{{ route('peminjam.bayar.denda', $r->id) }}">
            @csrf
            <button type="submit" class="btn-pinjam" style="background: linear-gradient(135deg, var(--danger), #c1121f);">
                <i class="fas fa-money-bill"></i>
                Bayar
            </button>
        </form>
    @elseif($r->status == 'dipinjam')
        <form method="POST" action="{{ route('peminjam.kembalikan', $r->id) }}">
            @csrf
            <button type="submit" class="btn-kembalikan">
                <i class="fas fa-undo"></i>
                Kembalikan
            </button>
        </form>
    @else
        <span style="color: var(--gray);">-</span>
    @endif
</td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="fas fa-history"></i>
                                </div>
                                <h3>Belum ada peminjaman</h3>
                                <p>Mulai dengan meminjam alat dari daftar alat tersedia di atas.</p>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </main>
    </div>

    <script>
        // Toggle sidebar untuk mobile
        const sidebarToggle = document.getElementById('sidebarToggle');
        const appContainer = document.getElementById('appContainer');

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                appContainer.classList.toggle('sidebar-collapsed');
                
                // Update icon toggle
                const icon = this.querySelector('i');
                if (appContainer.classList.contains('sidebar-collapsed')) {
                    icon.className = 'fas fa-bars';
                } else {
                    icon.className = 'fas fa-times';
                }
            });
        }

        // Search functionality
        const searchInput = document.querySelector('#globalSearchBar .search-input');
        
        function performSearch(searchTerm) {
            if (searchTerm) {
                const tableRows = document.querySelectorAll('.peminjaman-table tbody tr');
                let found = false;
                
                tableRows.forEach(row => {
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
                
                if (!found) {
                    showToast(`Tidak ditemukan dengan kata kunci: "${searchTerm}"`, 'warning');
                }
            } else {
                // Reset all rows
                const allRows = document.querySelectorAll('.peminjaman-table tbody tr');
                allRows.forEach(row => {
                    row.style.display = '';
                });
            }
        }

        if (searchInput) {
            searchInput.addEventListener('keyup', function(e) {
                if (e.key === 'Enter') {
                    performSearch(this.value.trim());
                }
            });
            
            // Add search button
            const searchBar = document.querySelector('#globalSearchBar');
            const searchBtn = document.createElement('button');
            searchBtn.innerHTML = '<i class="fas fa-search"></i>';
            searchBtn.style.cssText = `
                position: absolute;
                right: 10px;
                top: 50%;
                transform: translateY(-50%);
                background: none;
                border: none;
                color: var(--primary);
                font-size: 16px;
                cursor: pointer;
                padding: 8px;
                transition: var(--transition);
            `;
            
            searchBar.appendChild(searchBtn);
            
            searchBtn.addEventListener('click', () => performSearch(searchInput.value.trim()));
        }

        // Pinjam form validation
        const pinjamForms = document.querySelectorAll('.pinjam-form');
        
        pinjamForms.forEach(form => {
            const dateInput = form.querySelector('.date-input');
            
            // Set minimum date to tomorrow
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            const tomorrowStr = tomorrow.toISOString().split('T')[0];
            
            if (dateInput && !dateInput.value) {
                // Set default to 7 days from now
                const defaultDate = new Date();
                defaultDate.setDate(defaultDate.getDate() + 7);
                dateInput.value = defaultDate.toISOString().split('T')[0];
            }
            
            if (dateInput) {
                dateInput.min = tomorrowStr;
                
                dateInput.addEventListener('change', function() {
                    const selectedDate = new Date(this.value);
                    const today = new Date();
                    
                    if (selectedDate <= today) {
                        showToast('Tanggal kembali harus setelah hari ini', 'error');
                        this.value = tomorrowStr;
                    }
                });
            }
            
            form.addEventListener('submit', function(e) {
                const alatName = this.closest('tr').querySelector('td:first-child div').textContent;
                const returnDate = this.querySelector('.date-input').value;
                const returnDateFormatted = new Date(returnDate).toLocaleDateString('id-ID');
                
                if (!confirm(`Konfirmasi peminjaman:\n\nAlat: ${alatName}\nTanggal Kembali: ${returnDateFormatted}\n\nApakah data sudah benar?`)) {
                    e.preventDefault();
                    return false;
                }
                
                // Show loading
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
                    submitBtn.disabled = true;
                }
                
                return true;
            });
        });

        // Notification button click
        const notificationBtn = document.getElementById('notificationBtn');
        if (notificationBtn) {
            notificationBtn.addEventListener('click', function() {
                // Scroll to peminjaman aktif
                const peminjamanSection = document.querySelectorAll('.dashboard-card')[1];
                if (peminjamanSection) {
                    peminjamanSection.scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'start' 
                    });
                    
                    showToast('Dialihkan ke peminjaman Anda', 'info');
                }
            });
        }

        // Toast notification function
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? 'var(--success)' : type === 'error' ? 'var(--danger)' : type === 'warning' ? 'var(--warning)' : 'var(--primary)'};
                color: white;
                padding: 16px 24px;
                border-radius: var(--radius-md);
                font-weight: 600;
                box-shadow: var(--shadow-lg);
                z-index: 9999;
                animation: slideInRight 0.3s ease;
                display: flex;
                align-items: center;
                gap: 12px;
                max-width: 400px;
            `;
            
            const icon = type === 'success' ? 'fas fa-check-circle' : type === 'error' ? 'fas fa-times-circle' : type === 'warning' ? 'fas fa-exclamation-triangle' : 'fas fa-info-circle';
            toast.innerHTML = `
                <i class="${icon}"></i>
                <span>${message}</span>
            `;
            
            document.body.appendChild(toast);
            
            // Auto remove after 3 seconds
            setTimeout(() => {
                toast.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }, 3000);
        }

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 1200) {
                appContainer.classList.remove('sidebar-collapsed');
                if (sidebarToggle) {
                    sidebarToggle.querySelector('i').className = 'fas fa-bars';
                }
            }
        });

        // Add custom animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideInRight {
                from {
                    opacity: 0;
                    transform: translateX(100%);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }
            
            @keyframes slideOutRight {
                from {
                    opacity: 1;
                    transform: translateX(0);
                }
                to {
                    opacity: 0;
                    transform: translateX(100%);
                }
            }
        `;
        document.head.appendChild(style);
        
        // Add hover effect to table rows
        document.addEventListener('DOMContentLoaded', function() {
            const tableRows = document.querySelectorAll('.peminjaman-table tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(4px)';
                });
                
                row.addEventListener('mouseleave', function() {
                    this.style.transform = '';
                });
            });
            
            // Auto-refresh notification badge
            function updateNotificationBadge() {
                const overdueItems = document.querySelectorAll('.status-badge.status-terlambat').length;
                const activeItems = document.querySelectorAll('.status-badge.status-dipinjam').length;
                const totalCount = overdueItems + activeItems;
                
                const badge = document.getElementById('notificationCount');
                if (badge) {
                    badge.textContent = totalCount;
                    
                    // Change color based on count
                    if (overdueItems > 0) {
                        badge.style.background = 'linear-gradient(135deg, var(--danger), var(--accent))';
                    } else if (activeItems > 0) {
                        badge.style.background = 'linear-gradient(135deg, var(--warning), var(--accent))';
                    }
                }
            }
            
            // Update notification badge on page load
            updateNotificationBadge();
        });
    </script>
</body>
</html>