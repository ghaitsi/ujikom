<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Petugas - Aplikasi Peminjaman Alat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6C63FF;
            --primary-dark: #524FD9;
            --primary-light: #8B85FF;
            --secondary: #FF6B8B;
            --accent: #00D4AA;
            --success: #4CC9F0;
            --warning: #FFD166;
            --danger: #FF6B6B;
            --dark: #0F0F1E;
            --darker: #070711;
            --dark-card: #1A1A2E;
            --dark-card-hover: #21213A;
            --light: #E2E2E8;
            --gray: #8A8A9D;
            --gray-dark: #5A5A6B;
            --card-bg: rgba(26, 26, 46, 0.8);
            --sidebar-bg: linear-gradient(180deg, #0F0F1E 0%, #070711 100%);
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.3);
            --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.4);
            --shadow-lg: 0 10px 40px rgba(0, 0, 0, 0.5);
            --radius-sm: 10px;
            --radius-md: 16px;
            --radius-lg: 24px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --glass: rgba(15, 15, 30, 0.7);
            --glass-light: rgba(255, 255, 255, 0.05);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, var(--darker) 0%, var(--dark) 100%);
            color: var(--light);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Layout Container */
        .app-container {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
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
            background: var(--glass);
            backdrop-filter: blur(20px);
            padding: 0 40px;
            height: 80px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .header-title {
            font-size: 28px;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--accent));
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
            background: linear-gradient(135deg, var(--primary), var(--accent));
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
            background: rgba(26, 26, 46, 0.6);
            border: 2px solid rgba(108, 99, 255, 0.2);
            border-radius: var(--radius-lg);
            font-size: 15px;
            color: var(--light);
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
        }

        .search-input::placeholder {
            color: var(--gray);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            background: var(--dark-card);
            box-shadow: 0 0 0 4px rgba(108, 99, 255, 0.2);
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
            background: rgba(26, 26, 46, 0.6);
            border: 2px solid rgba(108, 99, 255, 0.2);
            color: var(--light);
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
            background: var(--dark-card);
            color: var(--primary);
            border-color: var(--primary);
            transform: rotate(15deg) scale(1.1);
            box-shadow: var(--shadow-md);
        }

        .notification-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: linear-gradient(135deg, var(--secondary), var(--danger));
            color: white;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(255, 107, 107, 0.5);
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            padding: 8px 16px;
            border-radius: var(--radius-lg);
            background: rgba(26, 26, 46, 0.6);
            border: 2px solid rgba(108, 99, 255, 0.2);
            transition: var(--transition);
        }

        .user-menu:hover {
            background: var(--dark-card);
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .user-menu-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 16px;
            box-shadow: 0 4px 8px rgba(108, 99, 255, 0.3);
        }

        /* Content */
        .content-wrapper {
            flex: 1;
            padding: 40px;
        }

        /* Welcome Section */
        .welcome-section {
            background: linear-gradient(135deg, rgba(108, 99, 255, 0.2), rgba(0, 212, 170, 0.2));
            border-radius: var(--radius-lg);
            padding: 32px;
            margin-bottom: 30px;
            color: var(--light);
            box-shadow: var(--shadow-md);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgba(108, 99, 255, 0.3);
            backdrop-filter: blur(10px);
        }

        .welcome-text h2 {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 8px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .welcome-text p {
            font-size: 16px;
            color: var(--gray);
            max-width: 600px;
        }

        .welcome-actions {
            display: flex;
            gap: 16px;
        }

        .btn {
            padding: 12px 24px;
            border-radius: var(--radius-md);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
        }

        .btn-outline {
            background: transparent;
            color: var(--light);
            border: 2px solid rgba(108, 99, 255, 0.5);
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
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
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: var(--transition);
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            gap: 20px;
            cursor: pointer;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary);
            background: var(--dark-card-hover);
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
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .icon-primary { background: linear-gradient(135deg, var(--primary), var(--primary-dark)); }
        .icon-success { background: linear-gradient(135deg, var(--accent), #00B894); }
        .icon-warning { background: linear-gradient(135deg, var(--warning), #FF9E00); }
        .icon-danger { background: linear-gradient(135deg, var(--danger), #FF4757); }

        .stat-info h3 {
            font-size: 14px;
            color: var(--gray);
            margin-bottom: 4px;
            font-weight: 600;
        }

        .stat-info .number {
            font-size: 28px;
            font-weight: 800;
            color: var(--light);
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
            border: 1px solid rgba(255, 255, 255, 0.05);
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
            border-color: var(--primary);
            background: var(--dark-card-hover);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
            padding-bottom: 16px;
            border-bottom: 2px solid rgba(108, 99, 255, 0.2);
        }

        .card-title {
            font-size: 22px;
            font-weight: 700;
            color: var(--light);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-title::before {
            content: '';
            width: 8px;
            height: 24px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 4px;
        }

        .card-actions {
            display: flex;
            gap: 12px;
        }

        .btn-sm {
            padding: 8px 16px;
            font-size: 13px;
            border-radius: var(--radius-sm);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--accent), #00B894);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger), #FF4757);
            color: white;
        }

        /* Table Styling */
        .table-container {
            overflow-x: auto;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-sm);
            -webkit-overflow-scrolling: touch;
            background: rgba(15, 15, 30, 0.5);
        }

        .data-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: transparent;
            border-radius: var(--radius-md);
            overflow: hidden;
        }

        .data-table thead {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            position: sticky;
            top: 0;
        }

        .data-table th {
            padding: 18px 20px;
            text-align: left;
            color: white;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        .data-table tbody tr {
            transition: var(--transition);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .data-table tbody tr:last-child {
            border-bottom: none;
        }

        .data-table tbody tr:hover {
            background: rgba(108, 99, 255, 0.1);
            transform: translateX(4px);
        }

        .data-table td {
            padding: 20px 16px;
            color: var(--light);
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

        .status-menunggu {
            background: rgba(142, 142, 160, 0.2);
            color: #8E8EA0;
            border: 1px solid rgba(142, 142, 160, 0.3);
        }

        .status-dipinjam {
            background: rgba(255, 209, 102, 0.2);
            color: var(--warning);
            border: 1px solid rgba(255, 209, 102, 0.3);
        }

        .status-selesai {
            background: rgba(76, 201, 240, 0.2);
            color: var(--success);
            border: 1px solid rgba(76, 201, 240, 0.3);
        }

        .status-terlambat {
            background: rgba(255, 107, 107, 0.2);
            color: var(--danger);
            border: 1px solid rgba(255, 107, 107, 0.3);
        }

        /* Action Buttons */
        .btn-action {
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
            white-space: nowrap;
        }

        .btn-action.approve {
            background: linear-gradient(135deg, var(--accent), #00B894);
            color: white;
        }

        .btn-action.reject {
            background: linear-gradient(135deg, var(--danger), #FF4757);
            color: white;
        }

        .btn-action.confirm {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
        }

        .btn-action:hover {
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
            background: rgba(0, 212, 170, 0.15);
            color: var(--accent);
            border: 1px solid rgba(0, 212, 170, 0.3);
        }

        .alert-danger {
            background: rgba(255, 107, 107, 0.15);
            color: var(--danger);
            border: 1px solid rgba(255, 107, 107, 0.3);
        }

        .alert-success i {
            color: var(--accent);
        }

        /* User Avatar */
        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--gray);
        }

        .empty-icon {
            font-size: 64px;
            color: var(--gray-dark);
            margin-bottom: 20px;
        }

        .empty-state h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: var(--light);
        }

        .empty-state p {
            font-size: 14px;
            max-width: 400px;
            margin: 0 auto 20px;
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 25px;
            margin-top: 40px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            color: var(--gray);
            font-size: 14px;
        }

        /* Sidebar Toggle Button untuk Mobile */
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            width: 48px;
            height: 48px;
            border-radius: var(--radius-sm);
            font-size: 20px;
            cursor: pointer;
            z-index: 1001;
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
            
            .welcome-section {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }
            
            .welcome-actions {
                flex-direction: column;
                width: 100%;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
            
            .data-table {
                font-size: 12px;
            }
            
            .data-table th,
            .data-table td {
                padding: 12px;
            }
            
            .user-menu {
                padding: 6px 12px;
            }
            
            .user-menu-avatar {
                width: 32px;
                height: 32px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .header-title {
                font-size: 22px;
            }
            
            .card-title {
                font-size: 18px;
            }
            
            .welcome-text h2 {
                font-size: 24px;
            }
            
            .user-menu span:not(.user-menu-avatar) {
                display: none;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar Toggle Button -->
    <button class="sidebar-toggle" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- App Container -->
    <div class="app-container" id="appContainer">
        
        <!-- Include Sidebar dari layout -->
        @include('layouts.sidebarpetugas')

        <!-- Main Content -->
        <div class="main-content" id="mainContent">
            
            <!-- Header -->
            <header class="header">
                <div class="header-title">
                    Dashboard Petugas
                </div>
                <div class="header-actions">
                    <div class="search-bar">
                        <input type="text" class="search-input" placeholder="Cari peminjaman, alat, atau peminjam...">
                        <i class="search-icon fas fa-search"></i>
                    </div>
                    <button class="notification-btn">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">
                            @php
                                $peminjamanMenunggu = App\Models\Peminjaman::where('status', 'menunggu')->count();
                            @endphp
                            {{ $peminjamanMenunggu }}
                        </span>
                    </button>
                    <div class="user-menu">
                        <div class="user-menu-avatar">PT</div>
                        <span>Petugas Admin</span>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <div class="content-wrapper">
                <!-- Success Message -->
                @if(session('success'))
                    <div class="alert alert-success animate__animated animate__fadeIn" id="successAlert">
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

                <!-- Welcome Section -->
                <section class="welcome-section">
                    <div class="welcome-text">
                        <h2>Selamat Datang, Petugas!</h2>
                        <p>Kelola peminjaman alat dengan mudah. Ada <strong>{{ $peminjamanMenunggu }} permintaan peminjaman</strong> yang menunggu persetujuan Anda.</p>
                    </div>
                    <div class="welcome-actions">
                        <button class="btn btn-outline" onclick="window.location.href='{{ route('petugas.laporan') }}'">
                            <i class="fas fa-print"></i>
                            Cetak Laporan
                        </button>
                        <button class="btn btn-primary" id="quickActionBtn">
                            <i class="fas fa-bolt"></i>
                            Tindakan Cepat
                        </button>
                    </div>
                </section>

                <!-- Stats Cards -->
                <div class="stats-container">
                    @php
                        // Statistik untuk dashboard
                        $totalAlat = App\Models\Alat::count();
                        $peminjamanMenunggu = App\Models\Peminjaman::where('status', 'menunggu')->count();
                        $peminjamanDipinjam = App\Models\Peminjaman::where('status', 'dipinjam')->count();
                        $peminjamanTerlambat = App\Models\Peminjaman::where('status', 'dipinjam')
                            ->whereDate('tanggal_rencana_kembali', '<', now())
                            ->count();
                        $peminjamanBulanIni = App\Models\Peminjaman::whereMonth('created_at', now()->month)
                            ->whereYear('created_at', now()->year)
                            ->count();
                    @endphp
                    
                    <div class="stat-card" onclick="showAllTools()">
                        <div class="stat-icon icon-primary">
                            <i class="fas fa-tools"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Total Alat</h3>
                            <div class="number">{{ $totalAlat }}</div>
                            <div class="desc">Semua alat tersedia</div>
                        </div>
                    </div>
                    
                    <div class="stat-card" onclick="window.location.href='{{ route('petugas.peminjaman.index') }}?status=menunggu'">
                        <div class="stat-icon icon-warning">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Menunggu Persetujuan</h3>
                            <div class="number">{{ $peminjamanMenunggu }}</div>
                            <div class="desc">Butuh tindakan segera</div>
                        </div>
                    </div>
                    
                    <div class="stat-card" onclick="window.location.href='{{ route('petugas.peminjaman.index') }}?status=dipinjam'">
                        <div class="stat-icon icon-success">
                            <i class="fas fa-sync-alt"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Sedang Dipinjam</h3>
                            <div class="number">{{ $peminjamanDipinjam }}</div>
                            <div class="desc">Aktif saat ini</div>
                        </div>
                    </div>
                    
                    <div class="stat-card" onclick="showLateReturns()">
                        <div class="stat-icon icon-danger">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Terlambat</h3>
                            <div class="number">{{ $peminjamanTerlambat }}</div>
                            <div class="desc">Perlu penagihan denda</div>
                        </div>
                    </div>
                </div>

                <!-- Peminjaman Table -->
                <section class="dashboard-card" style="animation-delay: 0.1s;">
                    <div class="card-header">
                        <div class="card-title">
                            <i class="fas fa-calendar-alt"></i>
                            Data Peminjaman Terbaru
                        </div>
                        <div class="card-actions">
                            <button class="btn btn-sm btn-primary" onclick="filterTable()">
                                <i class="fas fa-filter"></i>
                                Filter
                            </button>
                            <button class="btn btn-sm btn-outline" onclick="window.location.href='{{ route('petugas.peminjaman.index') }}'">
                                <i class="fas fa-list"></i>
                                Lihat Semua
                            </button>
                        </div>
                    </div>
                    <div class="table-container">
                        @php
                            $peminjaman = App\Models\Peminjaman::with(['user', 'alat'])
                                ->orderBy('created_at', 'desc')
                                ->limit(10)
                                ->get();
                        @endphp
                        
                        @if($peminjaman->count() > 0)
                        <table class="data-table" id="loansTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Peminjam</th>
                                    <th>Alat</th>
                                    <th>Tgl Pinjam</th>
                                    <th>Rencana Kembali</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($peminjaman as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 12px;">
                                            <div class="user-avatar">
                                                {{ strtoupper(substr($item->user->name ?? 'U', 0, 2)) }}
                                            </div>
                                            <div>
                                                <div style="font-weight: 600;">{{ $item->user->name ?? '-' }}</div>
                                                <div style="font-size: 12px; color: var(--gray);">{{ $item->user->email ?? '-' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->alat->nama_alat ?? '-' }}</td>
                                    <td>{{ $item->tanggal_pinjam ? \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') : '-' }}</td>
                                    <td>
                                        {{ $item->tanggal_rencana_kembali ? \Carbon\Carbon::parse($item->tanggal_rencana_kembali)->format('d M Y') : '-' }}
                                        @if($item->status == 'dipinjam' && $item->tanggal_rencana_kembali)
                                            @php
                                                $today = \Carbon\Carbon::now();
                                                $rencanaKembali = \Carbon\Carbon::parse($item->tanggal_rencana_kembali);
                                                $daysLeft = $today->diffInDays($rencanaKembali, false);
                                            @endphp
                                            @if($daysLeft < 0)
                                                <div style="font-size: 11px; color: var(--danger); margin-top: 4px;">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    {{ abs($daysLeft) }} hari terlambat
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status == 'menunggu')
                                            <span class="status-badge status-menunggu">
                                                <i class="fas fa-clock mr-1"></i>Menunggu
                                            </span>
                                        @elseif ($item->status == 'dipinjam')
                                            <span class="status-badge status-dipinjam">
                                                <i class="fas fa-sync-alt mr-1"></i>Dipinjam
                                            </span>
                                        @elseif ($item->status == 'dikembalikan')
                                            <span class="status-badge status-selesai">
                                                <i class="fas fa-check-circle mr-1"></i>Selesai
                                            </span>
                                        @elseif ($item->status == 'terlambat')
                                            <span class="status-badge status-terlambat">
                                                <i class="fas fa-exclamation-triangle mr-1"></i>Terlambat
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status == 'menunggu')
                                            <div style="display: flex; gap: 8px;">
                                                <form method="POST" action="{{ route('petugas.peminjaman.setujui', $item->id_peminjaman) }}">
                                                    @csrf
                                                    <button type="submit" class="btn-action approve" onclick="return confirm('Setujui peminjaman ini?')">
                                                        <i class="fas fa-check"></i>
                                                        Setujui
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('petugas.peminjaman.tolak', $item->id_peminjaman) }}">
                                                    @csrf
                                                    <button type="submit" class="btn-action reject" onclick="return confirm('Tolak peminjaman ini?')">
                                                        <i class="fas fa-times"></i>
                                                        Tolak
                                                    </button>
                                                </form>
                                            </div>
                                        @elseif ($item->status == 'dipinjam')
                                            <form method="POST" action="{{ route('petugas.pengembalian.konfirmasi', $item->id_peminjaman) }}">
                                                @csrf
                                                <button type="submit" class="btn-action confirm" onclick="return confirm('Konfirmasi pengembalian alat ini?')">
                                                    <i class="fas fa-check-circle"></i>
                                                    Konfirmasi
                                                </button>
                                            </form>
                                        @else
                                            <span style="font-size: 12px; color: var(--gray); font-style: italic;">Tidak ada aksi</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="fas fa-calendar-times"></i>
                            </div>
                            <h3>Tidak ada data peminjaman</h3>
                            <p>Belum ada peminjaman yang tercatat.</p>
                            <button class="btn btn-primary" onclick="window.location.href='{{ route('petugas.peminjaman.index') }}'">
                                <i class="fas fa-plus"></i>
                                Lihat Semua Peminjaman
                            </button>
                        </div>
                        @endif
                    </div>
                </section>

                <!-- Quick Actions -->
                <div class="stats-container">
                    <div class="stat-card" onclick="window.location.href='{{ route('petugas.peminjaman.index') }}?status=menunggu'">
                        <div class="stat-icon icon-primary">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Kelola Peminjaman</h3>
                            <div class="number">{{ $peminjamanMenunggu }}</div>
                            <div class="desc">Proses permintaan</div>
                        </div>
                    </div>
                    
                    <div class="stat-card" onclick="window.location.href='{{ route('petugas.laporan') }}'">
                        <div class="stat-icon icon-success">
                            <i class="fas fa-print"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Cetak Laporan</h3>
                            <div class="number">PDF/XLS</div>
                            <div class="desc">Export laporan bulanan</div>
                        </div>
                    </div>
                    
                    <div class="stat-card" onclick="showActiveLoans()">
                        <div class="stat-icon icon-warning">
                            <i class="fas fa-exchange-alt"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Pantau Pengembalian</h3>
                            <div class="number">{{ $peminjamanDipinjam }}</div>
                            <div class="desc">Konfirmasi pengembalian</div>
                        </div>
                    </div>
                    
                    <div class="stat-card" onclick="showLateReturnsModal()">
                        <div class="stat-icon icon-danger">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Kelola Denda</h3>
                            <div class="number">{{ $peminjamanTerlambat }}</div>
                            <div class="desc">Tagih keterlambatan</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="footer">
                <p>Aplikasi Peminjaman Alat &copy; {{ date('Y') }} - Pra Uji Kompetensi Keahlian Rekayasa Perangkat Lunak</p>
                <p>SMK Negeri 1 Jakarta | Versi 1.0.0</p>
            </footer>
        </div>
    </div>

    <script>
        // Inisialisasi halaman
        document.addEventListener('DOMContentLoaded', function() {
            // Setup event listeners
            setupEventListeners();
            
            // Animate cards
            animateCards();
            
            // Auto-hide success alert
            autoHideAlerts();
            
            // Setup search functionality
            setupSearch();
            
            // Update notification badge color
            updateNotificationBadgeColor();
        });

        // Setup event listeners
        function setupEventListeners() {
            // Toggle sidebar untuk mobile
            const sidebarToggle = document.getElementById('sidebarToggle');
            const appContainer = document.getElementById('appContainer');

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    appContainer.classList.toggle('sidebar-collapsed');
                    const icon = this.querySelector('i');
                    icon.className = appContainer.classList.contains('sidebar-collapsed') ? 'fas fa-bars' : 'fas fa-times';
                });
            }

            // Notification button
            const notificationBtn = document.querySelector('.notification-btn');
            if (notificationBtn) {
                notificationBtn.addEventListener('click', function() {
                    const count = this.querySelector('.notification-badge').textContent;
                    showToast(`Anda memiliki ${count} peminjaman menunggu persetujuan`, 'info');
                });
            }
            
            // Quick action button
            const quickActionBtn = document.getElementById('quickActionBtn');
            if (quickActionBtn) {
                quickActionBtn.addEventListener('click', showQuickActions);
            }
            
            // User menu
            const userMenu = document.querySelector('.user-menu');
            if (userMenu) {
                userMenu.addEventListener('click', showUserMenu);
            }
        }

        // Animate cards
        function animateCards() {
            const cards = document.querySelectorAll('.dashboard-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        }

        // Auto-hide alerts
        function autoHideAlerts() {
            const successAlert = document.getElementById('successAlert');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.opacity = '0';
                    setTimeout(() => {
                        successAlert.style.display = 'none';
                    }, 300);
                }, 5000);
            }
            
            const errorAlert = document.querySelector('.alert-danger');
            if (errorAlert) {
                setTimeout(() => {
                    errorAlert.style.opacity = '0';
                    setTimeout(() => {
                        errorAlert.style.display = 'none';
                    }, 300);
                }, 8000);
            }
        }

        // Setup search functionality
        function setupSearch() {
            const searchInput = document.querySelector('.search-input');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    performSearch(this.value.trim());
                });
                
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        performSearch(this.value.trim());
                    }
                });
            }
        }

        // Search functionality
        function performSearch(searchTerm) {
            if (!searchTerm) {
                // Reset all rows
                const rows = document.querySelectorAll('.data-table tbody tr');
                rows.forEach(row => row.style.display = '');
                return;
            }

            const rows = document.querySelectorAll('.data-table tbody tr');
            let found = false;
            const searchTermLower = searchTerm.toLowerCase();
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTermLower)) {
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
        }

        // Filter table function
        function filterTable() {
            const filterOptions = [
                { label: 'Semua', value: 'all' },
                { label: 'Menunggu', value: 'menunggu' },
                { label: 'Dipinjam', value: 'dipinjam' },
                { label: 'Terlambat', value: 'terlambat' },
                { label: 'Selesai', value: 'dikembalikan' }
            ];
            
            // Create modal for filter
            const filterModal = document.createElement('div');
            filterModal.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.7);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 9999;
                backdrop-filter: blur(5px);
                animation: fadeIn 0.3s ease;
            `;
            
            filterModal.innerHTML = `
                <div style="background: var(--dark-card); border-radius: var(--radius-lg); 
                           padding: 30px; max-width: 400px; width: 90%; 
                           border: 1px solid rgba(108, 99, 255, 0.3);
                           box-shadow: var(--shadow-lg); animation: slideUp 0.3s ease;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <h3 style="color: var(--light); font-size: 20px; font-weight: 700;">Filter Status</h3>
                        <button onclick="this.parentElement.parentElement.parentElement.remove()" 
                                style="background: none; border: none; color: var(--gray); cursor: pointer; font-size: 20px;">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div style="color: var(--light);">
                        <div style="display: flex; flex-direction: column; gap: 12px;">
                            ${filterOptions.map(option => `
                                <label style="display: flex; align-items: center; gap: 12px; padding: 10px; cursor: pointer; 
                                             border-radius: var(--radius-sm); transition: var(--transition);
                                             &:hover { background: rgba(108, 99, 255, 0.1); }">
                                    <input type="radio" name="statusFilter" value="${option.value}" 
                                           style="accent-color: var(--primary);" 
                                           ${option.value === 'all' ? 'checked' : ''}
                                           onchange="applyFilter('${option.value}')">
                                    <span>${option.label}</span>
                                </label>
                            `).join('')}
                        </div>
                        <button onclick="resetFilter()" 
                                style="margin-top: 20px; width: 100%; padding: 12px; 
                                       background: transparent; border: 1px solid var(--gray); 
                                       color: var(--gray); border-radius: var(--radius-md); cursor: pointer;">
                            Reset Filter
                        </button>
                    </div>
                </div>
            `;
            
            document.body.appendChild(filterModal);
            
            // Add animation styles
            const style = document.createElement('style');
            style.textContent = `
                @keyframes fadeIn {
                    from { opacity: 0; }
                    to { opacity: 1; }
                }
                @keyframes slideUp {
                    from { 
                        opacity: 0;
                        transform: translateY(30px) scale(0.95);
                    }
                    to { 
                        opacity: 1;
                        transform: translateY(0) scale(1);
                    }
                }
            `;
            document.head.appendChild(style);
        }

        function applyFilter(filterValue) {
            const rows = document.querySelectorAll('.data-table tbody tr');
            let count = 0;
            
            rows.forEach(row => {
                if (filterValue === 'all') {
                    row.style.display = '';
                    count++;
                } else {
                    const statusBadge = row.querySelector('.status-badge');
                    if (statusBadge) {
                        const statusClass = statusBadge.className;
                        if (statusClass.includes(`status-${filterValue}`)) {
                            row.style.display = '';
                            count++;
                        } else {
                            row.style.display = 'none';
                        }
                    }
                }
            });
            
            // Close modal
            const modal = document.querySelector('div[style*="position: fixed"]');
            if (modal) modal.remove();
            
            showToast(`Menampilkan ${count} data dengan filter: ${getFilterLabel(filterValue)}`, 'success');
        }

        function resetFilter() {
            const rows = document.querySelectorAll('.data-table tbody tr');
            rows.forEach(row => row.style.display = '');
            
            const modal = document.querySelector('div[style*="position: fixed"]');
            if (modal) modal.remove();
            
            showToast('Filter direset', 'info');
        }

        function getFilterLabel(value) {
            const labels = {
                'all': 'Semua',
                'menunggu': 'Menunggu',
                'dipinjam': 'Dipinjam',
                'terlambat': 'Terlambat',
                'dikembalikan': 'Selesai'
            };
            return labels[value] || value;
        }

        // Quick actions modal
        function showQuickActions() {
            const modal = document.createElement('div');
            modal.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.7);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 9999;
                backdrop-filter: blur(5px);
            `;
            
            modal.innerHTML = `
                <div style="background: var(--dark-card); border-radius: var(--radius-lg); 
                           padding: 30px; max-width: 500px; width: 90%; 
                           border: 1px solid rgba(108, 99, 255, 0.3);
                           box-shadow: var(--shadow-lg);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <h3 style="color: var(--light); font-size: 20px; font-weight: 700;">Tindakan Cepat</h3>
                        <button onclick="this.parentElement.parentElement.parentElement.remove()" 
                                style="background: none; border: none; color: var(--gray); cursor: pointer; font-size: 20px;">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        <button class="btn btn-primary" onclick="window.location.href='{{ route('petugas.peminjaman.index') }}?status=menunggu'">
                            <i class="fas fa-tasks"></i> Proses Peminjaman Menunggu
                        </button>
                        <button class="btn btn-success" onclick="window.location.href='{{ route('petugas.peminjaman.index') }}?status=dipinjam'">
                            <i class="fas fa-exchange-alt"></i> Konfirmasi Pengembalian
                        </button>
                        <button class="btn btn-warning" onclick="showLateReturnsModal()">
                            <i class="fas fa-money-bill-wave"></i> Kelola Denda
                        </button>
                        <button class="btn btn-outline" onclick="this.parentElement.parentElement.parentElement.remove()">
                            <i class="fas fa-times"></i> Tutup
                        </button>
                    </div>
                </div>
            `;
            
            document.body.appendChild(modal);
        }

        // User menu
        function showUserMenu() {
            const modal = document.createElement('div');
            modal.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.7);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 9999;
                backdrop-filter: blur(5px);
            `;
            
            modal.innerHTML = `
                <div style="background: var(--dark-card); border-radius: var(--radius-lg); 
                           padding: 30px; max-width: 400px; width: 90%; 
                           border: 1px solid rgba(108, 99, 255, 0.3);
                           box-shadow: var(--shadow-lg);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <h3 style="color: var(--light); font-size: 20px; font-weight: 700;">Menu Pengguna</h3>
                        <button onclick="this.parentElement.parentElement.parentElement.remove()" 
                                style="background: none; border: none; color: var(--gray); cursor: pointer; font-size: 20px;">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        <button class="btn btn-outline" onclick="showProfile()" 
                                style="justify-content: flex-start;">
                            <i class="fas fa-user"></i> Profil Saya
                        </button>
                        <button class="btn btn-outline" onclick="showSettings()" 
                                style="justify-content: flex-start;">
                            <i class="fas fa-cog"></i> Pengaturan
                        </button>
                        <form method="POST" action="{{ route('logout') }}" style="width: 100%;">
                            @csrf
                            <button type="submit" class="btn btn-outline" 
                                    style="justify-content: flex-start; color: var(--danger); width: 100%;">
                                <i class="fas fa-sign-out-alt"></i> Keluar
                            </button>
                        </form>
                    </div>
                </div>
            `;
            
            document.body.appendChild(modal);
        }

        function showProfile() {
            const modal = document.querySelector('div[style*="position: fixed"]');
            if (modal) modal.remove();
            
            showModal('Profil Pengguna', 
                `<div style="text-align: center;">
                    <div class="user-menu-avatar" style="width: 80px; height: 80px; font-size: 24px; margin: 0 auto 20px;">PT</div>
                    <h3 style="color: var(--light); margin-bottom: 5px;">Petugas Admin</h3>
                    <p style="color: var(--gray); margin-bottom: 20px;">Role: Petugas Peminjaman Alat</p>
                    <p style="color: var(--gray); font-size: 14px;">Bergabung sejak Januari 2024</p>
                 </div>`
            );
        }

        function showSettings() {
            showModal('Pengaturan', 
                `<div style="display: flex; flex-direction: column; gap: 12px;">
                    <p style="color: var(--light);">Pengaturan aplikasi:</p>
                    <button class="btn btn-outline" onclick="showNotificationSettings()">
                        <i class="fas fa-bell"></i> Pengaturan Notifikasi
                    </button>
                    <button class="btn btn-outline" onclick="showDisplaySettings()">
                        <i class="fas fa-palette"></i> Tema & Tampilan
                    </button>
                    <button class="btn btn-outline" onclick="closeModal()">
                        <i class="fas fa-times"></i> Tutup
                    </button>
                 </div>`
            );
        }

        function showNotificationSettings() {
            showModal('Pengaturan Notifikasi', 
                `<p style="color: var(--light); margin-bottom: 15px;">Atur preferensi notifikasi:</p>
                 <div style="display: flex; flex-direction: column; gap: 10px;">
                    <label style="display: flex; align-items: center; gap: 10px; color: var(--light);">
                        <input type="checkbox" checked style="accent-color: var(--primary);">
                        <span>Notifikasi peminjaman baru</span>
                    </label>
                    <label style="display: flex; align-items: center; gap: 10px; color: var(--light);">
                        <input type="checkbox" checked style="accent-color: var(--primary);">
                        <span>Pengingat pengembalian</span>
                    </label>
                    <label style="display: flex; align-items: center; gap: 10px; color: var(--light);">
                        <input type="checkbox" checked style="accent-color: var(--primary);">
                        <span>Notifikasi keterlambatan</span>
                    </label>
                 </div>`
            );
        }

        function showDisplaySettings() {
            showModal('Tema & Tampilan', 
                `<p style="color: var(--light); margin-bottom: 15px;">Pilih tema tampilan:</p>
                 <div style="display: flex; gap: 10px; margin-bottom: 20px;">
                    <button class="btn btn-primary" onclick="setDarkTheme()" style="flex: 1;">Tema Gelap</button>
                    <button class="btn btn-outline" onclick="setLightTheme()" style="flex: 1;">Tema Terang</button>
                 </div>
                 <p style="color: var(--light); font-size: 14px;">*Perubahan tema memerlukan refresh halaman</p>`
            );
        }

        function setDarkTheme() {
            showToast('Tema gelap diterapkan', 'success');
            closeModal();
        }

        function setLightTheme() {
            showToast('Tema terang diterapkan', 'success');
            closeModal();
        }

        // Modal utility functions
        function showModal(title, content) {
            // Remove existing modal
            const existingModal = document.querySelector('div[style*="position: fixed"]');
            if (existingModal) existingModal.remove();
            
            const modal = document.createElement('div');
            modal.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.7);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 9999;
                backdrop-filter: blur(5px);
                animation: fadeIn 0.3s ease;
            `;
            
            modal.innerHTML = `
                <div style="background: var(--dark-card); border-radius: var(--radius-lg); 
                           padding: 30px; max-width: 500px; width: 90%; 
                           border: 1px solid rgba(108, 99, 255, 0.3);
                           box-shadow: var(--shadow-lg); animation: slideUp 0.3s ease;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <h3 style="color: var(--light); font-size: 20px; font-weight: 700;">${title}</h3>
                        <button onclick="closeModal()" 
                                style="background: none; border: none; color: var(--gray); cursor: pointer; font-size: 20px;">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div style="color: var(--light);">
                        ${content}
                    </div>
                </div>
            `;
            
            document.body.appendChild(modal);
        }

        function closeModal() {
            const modal = document.querySelector('div[style*="position: fixed"]');
            if (modal) {
                modal.style.animation = 'fadeOut 0.3s ease';
                setTimeout(() => modal.remove(), 300);
            }
        }

        // Toast notification function
        function showToast(message, type = 'info') {
            // Remove existing toast
            const existingToast = document.getElementById('customToast');
            if (existingToast) existingToast.remove();
            
            const toast = document.createElement('div');
            toast.id = 'customToast';
            
            const typeConfig = {
                'success': { bg: 'var(--accent)', icon: 'fa-check-circle' },
                'error': { bg: 'var(--danger)', icon: 'fa-times-circle' },
                'warning': { bg: 'var(--warning)', icon: 'fa-exclamation-triangle' },
                'info': { bg: 'var(--primary)', icon: 'fa-info-circle' }
            };
            
            const config = typeConfig[type] || typeConfig.info;
            
            toast.style.cssText = `
                position: fixed;
                top: 30px;
                right: 30px;
                background: ${config.bg};
                color: white;
                padding: 16px 24px;
                border-radius: var(--radius-md);
                font-weight: 600;
                box-shadow: var(--shadow-lg);
                z-index: 10000;
                animation: slideInRight 0.3s ease;
                display: flex;
                align-items: center;
                gap: 12px;
                max-width: 400px;
                min-width: 300px;
            `;
            
            toast.innerHTML = `
                <i class="fas ${config.icon}"></i>
                <span>${message}</span>
            `;
            
            document.body.appendChild(toast);
            
            // Add animation styles
            const style = document.createElement('style');
            if (!document.querySelector('#toast-animations')) {
                style.id = 'toast-animations';
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
                    @keyframes fadeOut {
                        from { opacity: 1; }
                        to { opacity: 0; }
                    }
                `;
                document.head.appendChild(style);
            }
            
            // Auto remove after 3 seconds
            setTimeout(() => {
                toast.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => {
                    if (toast.parentNode) toast.remove();
                }, 300);
            }, 3000);
        }

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 1200) {
                document.getElementById('appContainer').classList.remove('sidebar-collapsed');
                const sidebarToggle = document.getElementById('sidebarToggle');
                if (sidebarToggle) {
                    sidebarToggle.querySelector('i').className = 'fas fa-bars';
                }
            }
        });

        // Update notification badge color
        function updateNotificationBadgeColor() {
            const badge = document.querySelector('.notification-badge');
            if (badge) {
                const count = parseInt(badge.textContent) || 0;
                if (count > 5) {
                    badge.style.background = 'linear-gradient(135deg, var(--danger), var(--secondary))';
                } else if (count > 0) {
                    badge.style.background = 'linear-gradient(135deg, var(--warning), var(--secondary))';
                }
            }
        }

        // Additional utility functions
        function showAllTools() {
            showToast('Fitur daftar alat akan segera tersedia', 'info');
        }

        function showLateReturns() {
            showToast('Mengarahkan ke halaman keterlambatan...', 'info');
            setTimeout(() => {
                window.location.href = '{{ route("petugas.peminjaman.index") }}?status=dipinjam';
            }, 1000);
        }

        function showActiveLoans() {
            showToast('Mengarahkan ke halaman peminjaman aktif...', 'info');
            setTimeout(() => {
                window.location.href = '{{ route("petugas.peminjaman.index") }}?status=dipinjam';
            }, 1000);
        }

        function showLateReturnsModal() {
            @php
                $lateLoans = App\Models\Peminjaman::where('status', 'dipinjam')
                    ->whereDate('tanggal_rencana_kembali', '<', now())
                    ->with(['user', 'alat'])
                    ->get();
            @endphp
            
            let content = `
                <p style="color: var(--light); margin-bottom: 15px;">Ada {{ $lateLoans->count() }} peminjaman terlambat:</p>
                <div style="max-height: 300px; overflow-y: auto;">
            `;
            
            @if($lateLoans->count() > 0)
                @foreach($lateLoans as $loan)
                    @php
                        $daysLate = \Carbon\Carbon::parse($loan->tanggal_rencana_kembali)->diffInDays(now(), false);
                        $denda = $daysLate * 5000; // Contoh: Rp 5.000 per hari
                    @endphp
                    content += `
                        <div style="background: rgba(255, 107, 107, 0.1); padding: 12px; border-radius: var(--radius-sm); margin-bottom: 10px;">
                            <div style="font-weight: 600; color: var(--light);">{{ $loan->alat->nama_alat ?? 'Alat' }}</div>
                            <div style="font-size: 12px; color: var(--gray);">Peminjam: {{ $loan->user->name }}</div>
                            <div style="font-size: 12px; color: var(--danger);">
                                <i class="fas fa-clock"></i> Terlambat {{ abs($daysLate) }} hari
                            </div>
                            <div style="font-size: 12px; color: var(--warning); margin-top: 5px;">
                                <i class="fas fa-money-bill-wave"></i> Denda: Rp {{ number_format($denda, 0, ',', '.') }}
                            </div>
                        </div>
                    `;
                @endforeach
            @else
                content += `
                    <div style="text-align: center; padding: 20px; color: var(--gray);">
                        <i class="fas fa-check-circle" style="font-size: 48px; margin-bottom: 15px;"></i>
                        <p>Tidak ada peminjaman terlambat</p>
                    </div>
                `;
            @endif
            
            content += `</div>`;
            
            showModal('Kelola Denda', content);
        }

        // Refresh page function
        function refreshPage() {
            showToast('Memperbarui data...', 'info');
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        }
    </script>
</body>
</html>