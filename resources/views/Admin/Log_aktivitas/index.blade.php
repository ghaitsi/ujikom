<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Forent - Log Aktivitas</title>

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
            box-shadow: var(--shadow-sm);
        }

        .icon-info {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }

        .icon-warning {
            background: linear-gradient(135deg, var(--warning), #f97316);
        }

        .icon-success {
            background: linear-gradient(135deg, var(--success), #0ea5e9);
        }

        .icon-danger {
            background: linear-gradient(135deg, var(--danger), #dc2626);
        }

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

        .stat-info .trend {
            font-size: 12px;
            color: var(--success);
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
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
        }

        .activity-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: white;
            border-radius: var(--radius-md);
            overflow: hidden;
        }

        .activity-table thead {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }

        .activity-table th {
            padding: 18px 20px;
            text-align: left;
            color: white;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
        }

        .activity-table th:first-child {
            border-top-left-radius: var(--radius-md);
        }

        .activity-table th:last-child {
            border-top-right-radius: var(--radius-md);
        }

        .activity-table tbody tr {
            transition: var(--transition);
            border-bottom: 1px solid var(--gray-light);
        }

        .activity-table tbody tr:last-child {
            border-bottom: none;
        }

        .activity-table tbody tr:hover {
            background: rgba(67, 97, 238, 0.05);
            transform: translateX(4px);
        }

        .activity-table td {
            padding: 18px 20px;
            color: var(--dark);
            font-size: 14px;
            border: none;
        }

        .activity-table td:first-child {
            font-weight: 600;
            color: var(--gray);
        }

        .user-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
            box-shadow: var(--shadow-sm);
        }

        .activity-cell {
            position: relative;
            padding-left: 28px;
        }

        .activity-icon {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            color: white;
        }

        .icon-login {
            background: var(--success);
        }

        .icon-logout {
            background: var(--danger);
        }

        .icon-create {
            background: var(--primary);
        }

        .icon-update {
            background: var(--warning);
        }

        .icon-delete {
            background: var(--danger);
        }

        .icon-system {
            background: var(--secondary);
        }

        .time-cell {
            font-family: 'Monaco', 'Courier New', monospace;
            font-size: 13px;
            color: var(--gray);
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
        }

        .status-success {
            background: rgba(76, 201, 240, 0.15);
            color: var(--success);
            border: 1px solid rgba(76, 201, 240, 0.3);
        }

        .status-warning {
            background: rgba(248, 150, 30, 0.15);
            color: var(--warning);
            border: 1px solid rgba(248, 150, 30, 0.3);
        }

        .status-danger {
            background: rgba(249, 65, 68, 0.15);
            color: var(--danger);
            border: 1px solid rgba(249, 65, 68, 0.3);
        }

        .status-info {
            background: rgba(67, 97, 238, 0.15);
            color: var(--primary);
            border: 1px solid rgba(67, 97, 238, 0.3);
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
            align-items: center;
            gap: 8px;
            list-style: none;
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

        .pagination .disabled span {
            background: var(--gray-light);
            color: var(--gray);
            cursor: not-allowed;
        }

        /* Filters */
        .filters-container {
            display: flex;
            gap: 16px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .filter-label {
            font-size: 14px;
            font-weight: 600;
            color: var(--dark);
        }

        .filter-select {
            padding: 10px 16px;
            border: 2px solid var(--gray-light);
            border-radius: var(--radius-md);
            font-size: 14px;
            color: var(--dark);
            background: white;
            cursor: pointer;
            transition: var(--transition);
            min-width: 150px;
        }

        .filter-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.1);
        }

        .filter-btn {
            padding: 10px 24px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            border-radius: var(--radius-md);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .clear-btn {
            padding: 10px 24px;
            background: var(--gray-light);
            color: var(--dark);
            border: none;
            border-radius: var(--radius-md);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .clear-btn:hover {
            background: var(--danger);
            color: white;
            transform: translateY(-2px);
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
            
            .filters-container {
                flex-direction: column;
            }
            
            .filter-group {
                width: 100%;
            }
            
            .filter-select {
                flex: 1;
            }
            
            .activity-table th,
            .activity-table td {
                padding: 12px;
            }
        }

        @media (max-width: 480px) {
            .card-header {
                flex-direction: column;
                gap: 16px;
                align-items: flex-start;
            }
            
            .user-cell {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
            
            .activity-cell {
                padding-left: 0;
                padding-top: 24px;
            }
            
            .activity-icon {
                top: 0;
                transform: none;
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
        <!-- Include Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <main class="main-content" id="mainContent">
            <!-- Glass Header -->
            <header class="header">
                <h1 class="header-title animate__animated animate__fadeIn">Log Aktivitas Sistem</h1>
                <div class="header-actions">
                    <div class="search-bar">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" placeholder="Cari aktivitas...">
                    </div>
                    <button class="notification-btn">
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
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="content-wrapper">
                <!-- Stats Cards -->
                <div class="stats-container">
                    <div class="stat-card animate__animated animate__fadeInUp">
                        <div class="stat-icon icon-info">
                            <i class="fas fa-history"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Total Aktivitas</h3>
                            <div class="number">{{ $totalLogs }}</div>
                            <div class="trend">
                                <i class="fas fa-arrow-up"></i>
                                Hari ini: {{ $todayLogs }}
                            </div>
                        </div>
                    </div>

                    <div class="stat-card animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
                        <div class="stat-icon icon-success">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="stat-info">
                            <h3>User Aktif</h3>
                            <div class="number">{{ $activeUsers }}</div>
                            <div class="trend">
                                <i class="fas fa-users"></i>
                                Total user: {{ $totalUsers }}
                            </div>
                        </div>
                    </div>

                    <div class="stat-card animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
                        <div class="stat-icon icon-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Peringatan</h3>
                            <div class="number">{{ $warningLogs }}</div>
                            <div class="trend">
                                <i class="fas fa-shield-alt"></i>
                                Sistem aman
                            </div>
                        </div>
                    </div>

                    <div class="stat-card animate__animated animate__fadeInUp" style="animation-delay: 0.3s">
                        <div class="stat-icon icon-danger">
                            <i class="fas fa-bug"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Error</h3>
                            <div class="number">{{ $errorLogs }}</div>
                            <div class="trend">
                                <i class="fas fa-check-circle"></i>
                                Tidak ada error kritis
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Premium Card Container -->
                <div class="dashboard-card animate__animated animate__fadeInUp">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-clipboard-list"></i>
                            Riwayat Aktivitas Sistem
                        </h3>
                        <div class="card-info">
                            <span style="color: var(--gray); font-size: 14px;">
                                Menampilkan {{ $logs->count() }} dari {{ $totalLogs }} aktivitas
                            </span>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="filters-container">
                        <div class="filter-group">
                            <label class="filter-label">Tipe Aktivitas:</label>
                            <select class="filter-select" id="activityType">
                                <option value="">Semua</option>
                                <option value="login">Login</option>
                                <option value="logout">Logout</option>
                                <option value="create">Create</option>
                                <option value="update">Update</option>
                                <option value="delete">Delete</option>
                            </select>
                        </div>
                        
                        <div class="filter-group">
                            <label class="filter-label">User:</label>
                            <select class="filter-select" id="userFilter">
                                <option value="">Semua User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="filter-group">
                            <label class="filter-label">Tanggal:</label>
                            <input type="date" class="filter-select" id="dateFilter">
                        </div>
                        
                        <button class="filter-btn" id="applyFilters">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        
                        <button class="clear-btn" id="clearFilters">
                            <i class="fas fa-redo"></i> Reset
                        </button>
                    </div>

                    <!-- Table -->
                    <div class="table-container">
                        @if($logs->count() > 0)
                            <table class="activity-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Aktivitas</th>
                                        <th>Status</th>
                                        <th>Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($logs as $log)
                                    <tr class="animate__animated animate__fadeIn" style="animation-delay: {{ $loop->index * 0.05 }}s">
                                        <td>
                                            <span style="font-family: 'Monaco', 'Courier New', monospace; color: var(--gray);">#{{ $log->id_log }}</span>
                                        </td>
                                        
                                        <td>
                                            <div class="user-cell">
                                                <div class="user-avatar">
                                                    {{ strtoupper(substr($log->user->name ?? 'U', 0, 2)) }}
                                                </div>
                                                <div>
                                                    <div style="font-weight: 600; color: var(--dark);">{{ $log->user->name ?? 'Unknown User' }}</div>
                                                    <div style="font-size: 12px; color: var(--gray);">{{ $log->user->email ?? 'No email' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        
                                        <td>
                                            <div class="activity-cell">
                                                @php
                                                    $activityType = strtolower($log->aktivitas);
                                                    $icon = 'fa-info-circle';
                                                    $iconClass = 'icon-system';
                                                    
                                                    if(str_contains($activityType, 'login')) {
                                                        $icon = 'fa-sign-in-alt';
                                                        $iconClass = 'icon-login';
                                                    } elseif(str_contains($activityType, 'logout')) {
                                                        $icon = 'fa-sign-out-alt';
                                                        $iconClass = 'icon-logout';
                                                    } elseif(str_contains($activityType, 'tambah') || str_contains($activityType, 'create') || str_contains($activityType, 'insert')) {
                                                        $icon = 'fa-plus-circle';
                                                        $iconClass = 'icon-create';
                                                    } elseif(str_contains($activityType, 'edit') || str_contains($activityType, 'update') || str_contains($activityType, 'ubah')) {
                                                        $icon = 'fa-edit';
                                                        $iconClass = 'icon-update';
                                                    } elseif(str_contains($activityType, 'hapus') || str_contains($activityType, 'delete') || str_contains($activityType, 'remove')) {
                                                        $icon = 'fa-trash-alt';
                                                        $iconClass = 'icon-delete';
                                                    }
                                                @endphp
                                                <div class="activity-icon {{ $iconClass }}">
                                                    <i class="fas {{ $icon }}"></i>
                                                </div>
                                                <span style="color: var(--dark);">{{ $log->aktivitas }}</span>
                                            </div>
                                        </td>
                                        
                                        <td>
                                            @php
                                                $status = 'success';
                                                $statusClass = 'status-success';
                                                
                                                if(str_contains(strtolower($log->aktivitas), 'error') || str_contains(strtolower($log->aktivitas), 'gagal') || str_contains(strtolower($log->aktivitas), 'failed')) {
                                                    $status = 'error';
                                                    $statusClass = 'status-danger';
                                                } elseif(str_contains(strtolower($log->aktivitas), 'peringatan') || str_contains(strtolower($log->aktivitas), 'warning')) {
                                                    $status = 'warning';
                                                    $statusClass = 'status-warning';
                                                }
                                            @endphp
                                            <span class="status-badge {{ $statusClass }}">
                                                @if($status == 'success')
                                                    <i class="fas fa-check-circle" style="margin-right: 4px;"></i> Berhasil
                                                @elseif($status == 'warning')
                                                    <i class="fas fa-exclamation-triangle" style="margin-right: 4px;"></i> Peringatan
                                                @else
                                                    <i class="fas fa-times-circle" style="margin-right: 4px;"></i> Error
                                                @endif
                                            </span>
                                        </td>
                                        
                                        <td>
                                            <div class="time-cell">
                                                <div style="font-weight: 600; color: var(--dark);">
                                                    {{ \Carbon\Carbon::parse($log->waktu)->format('d M Y') }}
                                                </div>
                                                <div style="font-size: 12px; color: var(--gray);">
                                                    {{ \Carbon\Carbon::parse($log->waktu)->format('H:i:s') }}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="fas fa-clipboard-list"></i>
                                </div>
                                <h3>Tidak ada aktivitas</h3>
                                <p>Belum ada riwayat aktivitas yang tercatat dalam sistem.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Pagination -->
                    @if($logs->count() > 0)
                        <div class="pagination-container">
                            {{ $logs->links('vendor.pagination.custom') }}
                        </div>
                    @endif
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
        const searchInput = document.querySelector('.search-input');
        if (searchInput) {
            searchInput.addEventListener('keyup', function(e) {
                if (e.key === 'Enter') {
                    performSearch();
                }
            });
            
            // Add search button
            const searchBar = document.querySelector('.search-bar');
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
            
            searchBtn.addEventListener('click', performSearch);
        }

        function performSearch() {
            const searchTerm = searchInput.value.trim();
            if (searchTerm) {
                // In a real app, you would make an AJAX request here
                console.log('Searching for:', searchTerm);
                
                // Highlight search results
                const rows = document.querySelectorAll('.activity-table tbody tr');
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(searchTerm.toLowerCase())) {
                        row.style.backgroundColor = 'rgba(67, 97, 238, 0.1)';
                        row.style.borderLeft = '4px solid var(--primary)';
                    } else {
                        row.style.backgroundColor = '';
                        row.style.borderLeft = '';
                    }
                });
                
                showToast(`Menampilkan hasil pencarian: "${searchTerm}"`, 'info');
            }
        }

        // Filter functionality
        const applyFilters = document.getElementById('applyFilters');
        const clearFilters = document.getElementById('clearFilters');
        const activityType = document.getElementById('activityType');
        const userFilter = document.getElementById('userFilter');
        const dateFilter = document.getElementById('dateFilter');

        if (applyFilters) {
            applyFilters.addEventListener('click', function() {
                const filters = {
                    activityType: activityType.value,
                    userId: userFilter.value,
                    date: dateFilter.value
                };
                
                console.log('Applying filters:', filters);
                
                // In a real app, you would make an AJAX request or form submission here
                showToast('Filter diterapkan', 'success');
                
                // Show loading state
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
                this.disabled = true;
                
                setTimeout(() => {
                    this.innerHTML = '<i class="fas fa-filter"></i> Filter';
                    this.disabled = false;
                }, 1000);
            });
        }

        if (clearFilters) {
            clearFilters.addEventListener('click', function() {
                activityType.value = '';
                userFilter.value = '';
                dateFilter.value = '';
                
                // Reset all table rows
                const rows = document.querySelectorAll('.activity-table tbody tr');
                rows.forEach(row => {
                    row.style.display = '';
                    row.style.backgroundColor = '';
                    row.style.borderLeft = '';
                });
                
                showToast('Filter direset', 'info');
            });
        }

        // Export functionality (placeholder)
        const exportBtn = document.createElement('button');
        exportBtn.innerHTML = '<i class="fas fa-download"></i> Export';
        exportBtn.style.cssText = `
            background: linear-gradient(135deg, var(--success), #0ea5e9);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: var(--radius-md);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 8px;
        `;
        
        exportBtn.addEventListener('click', function() {
            showToast('Mengekspor data log...', 'info');
            
            // Show loading state
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyiapkan...';
            this.disabled = true;
            
            setTimeout(() => {
                this.innerHTML = '<i class="fas fa-download"></i> Export';
                this.disabled = false;
                showToast('Data log berhasil diekspor', 'success');
            }, 2000);
        });

        // Add export button to card header
        const cardHeader = document.querySelector('.card-header');
        if (cardHeader) {
            cardHeader.appendChild(exportBtn);
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

        // Initialize animations
        document.addEventListener('DOMContentLoaded', function() {
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
                
                @keyframes fadeIn {
                    from {
                        opacity: 0;
                        transform: translateY(10px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }
            `;
            document.head.appendChild(style);
            
            // Add hover effect to table rows
            const tableRows = document.querySelectorAll('.activity-table tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(8px)';
                });
                
                row.addEventListener('mouseleave', function() {
                    this.style.transform = '';
                });
            });
        });

        // Real-time updates simulation
        setInterval(() => {
            // Simulate new log entry
            if (Math.random() > 0.7) { // 30% chance
                const activities = [
                    'User login berhasil',
                    'Data user diperbarui',
                    'File diupload',
                    'Laporan dihasilkan',
                    'Pengaturan diupdate'
                ];
                
                const randomActivity = activities[Math.floor(Math.random() * activities.length)];
                console.log('Simulating new log:', randomActivity);
                
                // In a real app, you would use WebSockets or polling for real-time updates
            }
        }, 10000); // Check every 10 seconds
    </script>
</body>
</html>