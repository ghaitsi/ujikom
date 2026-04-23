<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LibTrack - Data Peminjaman Buku</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800|playfair:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
        :root {
            --primary: #2c7da0;
            --primary-dark: #1f5e7a;
            --primary-light: #4a9fc9;
            --secondary: #7b5c8e;
            --secondary-light: #9b7aae;
            --accent: #e2a55a;
            --success: #3a9b7a;
            --warning: #f0b84d;
            --danger: #e86f4f;
            --dark: #2c3e50;
            --darker: #1a2a3a;
            --light: #ffffff;
            --gray: #6c7a8a;
            --gray-light: #eef2f5;
            --card-bg: rgba(255, 255, 255, 0.96);
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.04);
            --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 10px 40px rgba(0, 0, 0, 0.12);
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
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
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
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 0 32px;
            height: 72px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
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

        .search-bar {
            position: relative;
            width: 300px;
        }

        .search-input {
            width: 100%;
            padding: 10px 16px 10px 42px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 40px;
            font-size: 14px;
            color: var(--dark);
            transition: var(--transition);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(44, 125, 160, 0.1);
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
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.05);
            padding: 2px 6px;
            border-radius: 6px;
            font-size: 10px;
            color: var(--gray);
        }

        .notification-btn {
            position: relative;
            background: white;
            border: 1px solid #e2e8f0;
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
            background: var(--primary);
            color: white;
            transform: scale(1.05);
            border-color: var(--primary);
        }

        .notification-badge {
            position: absolute;
            top: -4px;
            right: -4px;
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
            background: white;
            border: 1px solid #e2e8f0;
            transition: var(--transition);
        }

        .user-menu:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .user-menu:hover .user-menu-avatar {
            background: white;
            color: var(--primary);
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
            font-weight: 700;
            font-size: 12px;
            transition: var(--transition);
        }

        .content-wrapper {
            flex: 1;
            padding: 32px;
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
            border: 1px solid #e2e8f0;
            cursor: pointer;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary);
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

        .icon-primary { background: linear-gradient(135deg, var(--primary), var(--primary-dark)); }
        .icon-success { background: linear-gradient(135deg, var(--success), #2d7a5e); }
        .icon-warning { background: linear-gradient(135deg, var(--warning), #d49a2d); }
        .icon-danger { background: linear-gradient(135deg, var(--danger), #c95a3a); }

        .stat-info h3 {
            font-size: 12px;
            color: var(--gray);
            margin-bottom: 4px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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
            border: 1px solid #e2e8f0;
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
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 2px solid rgba(44, 125, 160, 0.1);
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

        .info-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            background: rgba(44, 125, 160, 0.1);
            border-radius: 40px;
            color: var(--primary);
            font-size: 12px;
            font-weight: 600;
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
            min-width: 900px;
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
            background: rgba(44, 125, 160, 0.04);
        }

        .peminjaman-table td {
            padding: 14px 16px;
            color: var(--dark);
            font-size: 13px;
            vertical-align: middle;
        }

        /* Badges */
        .id-badge {
            display: inline-block;
            padding: 3px 8px;
            background: rgba(44, 125, 160, 0.1);
            color: var(--primary);
            border-radius: 6px;
            font-weight: 600;
            font-size: 11px;
            font-family: monospace;
        }

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
            background: rgba(240, 184, 77, 0.15);
            color: #b88a2d;
        }

        .status-dikembalikan {
            background: rgba(58, 155, 122, 0.12);
            color: var(--success);
        }

        .status-terlambat {
            background: rgba(232, 111, 79, 0.12);
            color: var(--danger);
        }

        .status-selesai {
            background: rgba(58, 155, 122, 0.12);
            color: var(--success);
        }

        /* User & Alat Info */
        .user-info, .alat-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .user-name, .alat-name {
            font-weight: 600;
            color: var(--dark);
        }

        .user-email, .alat-id {
            font-size: 11px;
            color: var(--gray);
        }

        .date-cell {
            font-family: monospace;
        }

        .date-primary {
            font-weight: 600;
            color: var(--dark);
        }

        .date-secondary {
            font-size: 11px;
            color: var(--gray);
        }

        /* Button Detail */
        .btn-detail-view {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 11px;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
        }

        .btn-detail-view:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(44, 125, 160, 0.3);
        }

        /* Pagination */
        .pagination-wrapper {
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #eef2f5;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        .pagination-info {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--gray);
            font-size: 13px;
        }

        .pagination {
            display: flex;
            gap: 8px;
            list-style: none;
        }

        .pagination a, .pagination span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 10px;
            border-radius: 8px;
            background: white;
            color: var(--dark);
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
            border: 1px solid #e2e8f0;
            transition: var(--transition);
        }

        .pagination a:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .pagination .active span {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-color: transparent;
        }

        .per-page-selector {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .per-page-selector select {
            padding: 6px 10px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            background: white;
            font-weight: 600;
        }

        /* Modal */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            visibility: hidden;
            opacity: 0;
            transition: var(--transition);
        }

        .modal.show {
            visibility: visible;
            opacity: 1;
        }

        .modal-content {
            background: white;
            border-radius: var(--radius-xl);
            padding: 24px;
            max-width: 500px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
            transform: scale(0.9);
            transition: transform 0.3s ease;
        }

        .modal.show .modal-content {
            transform: scale(1);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 2px solid rgba(44, 125, 160, 0.1);
        }

        .modal-header h3 {
            font-size: 20px;
            font-weight: 700;
            font-family: 'Playfair', serif;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: var(--gray);
            transition: var(--transition);
        }

        .modal-close:hover {
            color: var(--danger);
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 20px;
        }

        .detail-item {
            background: #f8fafc;
            padding: 12px;
            border-radius: var(--radius-md);
            border: 1px solid #eef2f5;
        }

        .detail-label {
            font-size: 10px;
            color: var(--gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .detail-value {
            font-weight: 700;
            color: var(--dark);
        }

        .detail-row {
            display: flex;
            padding: 10px 0;
            border-bottom: 1px solid #eef2f5;
        }

        .detail-row .label {
            width: 120px;
            color: var(--gray);
            font-size: 13px;
        }

        .detail-row .value {
            flex: 1;
            font-weight: 600;
            color: var(--dark);
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
            padding-top: 16px;
            border-top: 1px solid #eef2f5;
        }

        .btn-close-modal {
            padding: 8px 20px;
            background: #eef2f5;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-close-modal:hover {
            background: var(--gray);
            color: white;
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
            background: rgba(58, 155, 122, 0.1);
            border-left-color: var(--success);
            color: var(--success);
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
            color: #e2e8f0;
            margin-bottom: 16px;
        }

        .empty-state h3 {
            font-size: 18px;
            margin-bottom: 8px;
            color: var(--dark);
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
            .search-bar {
                display: none;
            }
            .stats-container {
                grid-template-columns: 1fr;
            }
            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }
            .pagination-wrapper {
                flex-direction: column;
                align-items: center;
            }
            .detail-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .header-title {
                font-size: 18px;
            }
            .user-menu span {
                display: none;
            }
            .detail-row {
                flex-direction: column;
                gap: 4px;
            }
            .detail-row .label {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <button class="sidebar-toggle" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <div class="app-container" id="appContainer">
        @include('layouts.sidebar')

        <main class="main-content" id="mainContent">
            <header class="header">
                <h1 class="header-title">Data Peminjaman Buku</h1>
                <div class="header-actions">
                    <div class="search-bar">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" id="searchInput" placeholder="Cari peminjaman...">
                        <span class="search-shortcut">⌘K</span>
                    </div>
                    <button class="notification-btn" id="notificationBtn">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </button>
                    <div class="user-menu" id="userMenu">
                        <div class="user-menu-avatar">
                            @auth {{ strtoupper(substr(Auth::user()->name, 0, 2)) }} @else AD @endauth
                        </div>
                        <span>{{ Auth::user()->name ?? 'Admin' }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </header>

            <div class="content-wrapper">
                <!-- Stats Cards -->
                <div class="stats-container">
                    <div class="stat-card">
                        <div class="stat-icon icon-primary"><i class="fas fa-calendar-alt"></i></div>
                        <div class="stat-info">
                            <h3>Total Peminjaman</h3>
                            <div class="number">{{ $totalPeminjaman ?? $data->total() }}</div>
                            <div class="desc">Semua peminjaman</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon icon-success"><i class="fas fa-check-circle"></i></div>
                        <div class="stat-info">
                            <h3>Selesai</h3>
                            <div class="number">{{ $selesai ?? 0 }}</div>
                            <div class="desc">Peminjaman selesai</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon icon-warning"><i class="fas fa-book-open"></i></div>
                        <div class="stat-info">
                            <h3>Dipinjam</h3>
                            <div class="number">{{ $dipinjam ?? 0 }}</div>
                            <div class="desc">Masih dipinjam</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon icon-danger"><i class="fas fa-exclamation-triangle"></i></div>
                        <div class="stat-info">
                            <h3>Terlambat</h3>
                            <div class="number">{{ $terlambat ?? 0 }}</div>
                            <div class="desc">Melewati batas</div>
                        </div>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success animate__animated animate__fadeIn">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                <!-- Dashboard Card -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-list-alt"></i> Daftar Peminjaman</h3>
                        <div class="info-badge"><i class="fas fa-eye"></i> Mode Lihat Saja</div>
                    </div>

                    <div class="table-container">
                        @if($data->count() > 0)
                            <table class="peminjaman-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Peminjam</th>
                                        <th>Buku</th>
                                        <th>Tgl Pinjam</th>
                                        <th>Rencana Kembali</th>
                                        <th>Sisa Waktu</th>
                                        <th>Status</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach($data as $row)
                                    @php
                                        $today = now()->startOfDay();
                                        $rencanaKembali = \Carbon\Carbon::parse($row->tanggal_kembali)->startOfDay();
                                        $selisihHari = $today->diffInDays($rencanaKembali, false);
                                        
                                        if($row->status == 'selesai' || $row->status == 'dikembalikan') {
                                            $statusClass = 'status-selesai';
                                            $statusIcon = 'fa-check-circle';
                                            $statusText = 'Selesai';
                                        } elseif($row->status == 'terlambat' || $selisihHari < 0) {
                                            $statusClass = 'status-terlambat';
                                            $statusIcon = 'fa-exclamation-triangle';
                                            $statusText = 'Terlambat';
                                        } else {
                                            $statusClass = 'status-dipinjam';
                                            $statusIcon = 'fa-clock';
                                            $statusText = 'Dipinjam';
                                        }
                                    @endphp
                                    <tr data-search="{{ $row->user->name ?? '' }} {{ $row->alat->nama_alat ?? '' }} {{ $row->id_peminjaman }}">
                                        <td><span class="id-badge">#{{ $row->id_peminjaman }}</span></td>
                                        <td><div class="user-info"><span class="user-name">{{ $row->user->name ?? '-' }}</span><span class="user-email">{{ $row->user->email ?? '' }}</span></div></td>
                                        <td><div class="alat-info"><span class="alat-name">{{ $row->alat->nama_alat ?? '-' }}</span><span class="alat-id">ID: {{ $row->alat->id_alat ?? '' }}</span></div></td>
                                        <td><div class="date-cell"><div class="date-primary">{{ \Carbon\Carbon::parse($row->tanggal_pinjam)->format('d/m/Y') }}</div><div class="date-secondary">{{ \Carbon\Carbon::parse($row->tanggal_pinjam)->format('H:i') }} WIB</div></div></td>
                                        <td><div class="date-primary">{{ \Carbon\Carbon::parse($row->tanggal_kembali)->format('d/m/Y') }}</div></td>
                                        <td>@if(in_array($row->status, ['selesai', 'dikembalikan']))<span class="date-primary" style="color: var(--gray);">-</span>@elseif($selisihHari > 0)<span style="color: var(--success);">{{ $selisihHari }} hari</span><div class="date-secondary">Tersisa</div>@elseif($selisihHari == 0)<span style="color: var(--warning);">Hari ini</span><div class="date-secondary">Batas akhir</div>@else<span style="color: var(--danger);">{{ abs($selisihHari) }} hari</span><div class="date-secondary">Terlambat</div>@endif</div>
                                        <td><span class="status-badge {{ $statusClass }}"><i class="fas {{ $statusIcon }}"></i> {{ $statusText }}</span></td>
                                        <td><button class="btn-detail-view" onclick='showDetail({{ json_encode($row) }}, {{ $selisihHari }})'><i class="fas fa-info-circle"></i> Detail</button></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="empty-state"><div class="empty-icon"><i class="fas fa-calendar-alt"></i></div><h3>Tidak ada data peminjaman</h3><p>Belum ada peminjaman yang tercatat.</p></div>
                        @endif
                    </div>

                    <!-- Pagination -->
                    @if(method_exists($data, 'links') && $data->hasPages())
                    <div class="pagination-wrapper">
                        <div class="pagination-info"><i class="fas fa-chart-bar"></i> Menampilkan {{ $data->firstItem() }} - {{ $data->lastItem() }} dari {{ $data->total() }} data</div>
                        <div class="pagination">{{ $data->appends(request()->query())->links() }}</div>
                        <div class="per-page-selector"><label>Tampilkan:</label><select id="perPage" onchange="changePerPage(this.value)"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select><span>data</span></div>
                    </div>
                    @endif
                </div>
            </div>
        </main>
    </div>

    <!-- Detail Modal -->
    <div class="modal" id="detailModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-info-circle"></i> Detail Peminjaman</h3>
                <button class="modal-close" onclick="closeModal()"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="detail-grid">
                    <div class="detail-item"><div class="detail-label">ID Peminjaman</div><div class="detail-value" id="detailId">-</div></div>
                    <div class="detail-item"><div class="detail-label">Status</div><div class="detail-value" id="detailStatus">-</div></div>
                </div>
                <div class="detail-row"><span class="label">Peminjam</span><span class="value" id="detailUser">-</span></div>
                <div class="detail-row"><span class="label">Email</span><span class="value" id="detailEmail">-</span></div>
                <div class="detail-row"><span class="label">Judul Buku</span><span class="value" id="detailAlat">-</span></div>
                <div class="detail-row"><span class="label">ID Buku</span><span class="value" id="detailAlatId">-</span></div>
                <div class="detail-row"><span class="label">Tanggal Pinjam</span><span class="value" id="detailTglPinjam">-</span></div>
                <div class="detail-row"><span class="label">Rencana Kembali</span><span class="value" id="detailRencanaKembali">-</span></div>
                <div class="detail-row"><span class="label">Tanggal Kembali</span><span class="value" id="detailTglKembali">-</span></div>
                <div class="detail-row"><span class="label">Sisa Waktu</span><span class="value" id="detailSisaWaktu">-</span></div>
            </div>
            <div class="modal-footer"><button class="btn-close-modal" onclick="closeModal()"><i class="fas fa-times"></i> Tutup</button></div>
        </div>
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
                        showToast(`Tidak ditemukan data dengan kata "${term}"`, 'warning');
                    }
                }, 300);
            });
        }

        // Per page selector
        function changePerPage(value) {
            const url = new URL(window.location.href);
            url.searchParams.set('per_page', value);
            window.location.href = url.toString();
        }

        // Modal functions
        function showDetail(row, selisihHari) {
            document.getElementById('detailId').innerHTML = `#${row.id_peminjaman}`;
            
            let statusText = row.status;
            let statusColor = '';
            if (row.status == 'selesai' || row.status == 'dikembalikan') statusColor = '#3a9b7a';
            else if (row.status == 'terlambat' || selisihHari < 0) statusColor = '#e86f4f';
            else statusColor = '#f0b84d';
            
            document.getElementById('detailStatus').innerHTML = `<span style="color: ${statusColor}; font-weight: 700;">${statusText}</span>`;
            document.getElementById('detailUser').innerHTML = row.user?.name || '-';
            document.getElementById('detailEmail').innerHTML = row.user?.email || '-';
            document.getElementById('detailAlat').innerHTML = row.alat?.nama_alat || '-';
            document.getElementById('detailAlatId').innerHTML = row.alat?.id_alat || '-';
            document.getElementById('detailTglPinjam').innerHTML = new Date(row.tanggal_pinjam).toLocaleString('id-ID');
            document.getElementById('detailRencanaKembali').innerHTML = new Date(row.tanggal_kembali).toLocaleDateString('id-ID');
            document.getElementById('detailTglKembali').innerHTML = row.tanggal_kembali ? new Date(row.tanggal_kembali).toLocaleString('id-ID') : '-';
            
            let sisaWaktu = '';
            if (row.status == 'selesai' || row.status == 'dikembalikan') {
                sisaWaktu = '-';
            } else if (selisihHari > 0) {
                sisaWaktu = `<span style="color: #3a9b7a;">${selisihHari} hari tersisa</span>`;
            } else if (selisihHari == 0) {
                sisaWaktu = `<span style="color: #f0b84d;">Batas akhir hari ini</span>`;
            } else {
                sisaWaktu = `<span style="color: #e86f4f;">${Math.abs(selisihHari)} hari terlambat</span>`;
            }
            document.getElementById('detailSisaWaktu').innerHTML = sisaWaktu;
            
            document.getElementById('detailModal').classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('detailModal').classList.remove('show');
            document.body.style.overflow = '';
        }

        // Close modal on outside click
        document.getElementById('detailModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        // Toast notification
        function showToast(message, type = 'info') {
            const existing = document.querySelector('.toast-notification');
            if (existing) existing.remove();
            
            const toast = document.createElement('div');
            toast.className = 'toast-notification';
            toast.style.background = type === 'success' ? '#3a9b7a' : type === 'error' ? '#e86f4f' : type === 'warning' ? '#f0b84d' : '#2c7da0';
            toast.style.color = type === 'warning' ? '#2c3e50' : 'white';
            toast.innerHTML = `<i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-times-circle' : type === 'warning' ? 'fa-exclamation-triangle' : 'fa-info-circle'}"></i><span>${message}</span>`;
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.style.animation = 'slideOutBottom 0.3s ease';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                if (searchInput) searchInput.focus();
            }
            if (e.key === 'Escape') closeModal();
        });
    </script>
</body>
</html>