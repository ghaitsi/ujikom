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

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

        .content-wrapper {
            flex: 1;
            padding: 40px;
        }

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
            cursor: pointer;
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

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
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

        .denda-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
        }

        .denda-lunas {
            background: rgba(76, 201, 240, 0.15);
            color: var(--success);
            border: 1px solid rgba(76, 201, 240, 0.3);
        }

        .denda-belum {
            background: rgba(249, 65, 68, 0.15);
            color: var(--danger);
            border: 1px solid rgba(249, 65, 68, 0.3);
        }

        .denda-tidak {
            background: rgba(108, 117, 125, 0.1);
            color: var(--gray);
            border: 1px solid rgba(108, 117, 125, 0.2);
        }

        .stock-indicator {
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .stock-low { color: var(--danger); font-weight: 600; }
        .stock-medium { color: var(--warning); font-weight: 600; }
        .stock-high { color: var(--success); font-weight: 600; }

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

        .btn-bayar-denda {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: linear-gradient(135deg, var(--danger), #c1121f);
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

        .btn-bayar-denda:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

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

        .alert-danger {
            background: linear-gradient(135deg, rgba(249, 65, 68, 0.15), rgba(249, 65, 68, 0.05));
            color: var(--danger);
            border: 2px solid rgba(249, 65, 68, 0.2);
        }

        .modal-overlay {
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
        }

        .modal-content {
            background: white;
            border-radius: var(--radius-lg);
            padding: 30px;
            max-width: 450px;
            width: 90%;
            box-shadow: var(--shadow-lg);
            animation: slideUp 0.3s ease;
        }

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

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid rgba(67, 97, 238, 0.1);
        }

        .modal-header h3 {
            font-size: 22px;
            font-weight: 700;
            color: var(--dark);
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--gray);
            transition: var(--transition);
        }

        .modal-close:hover {
            color: var(--danger);
        }

        .payment-details {
            background: #f8f9fa;
            padding: 20px;
            border-radius: var(--radius-md);
            margin-bottom: 20px;
        }

        .payment-details p {
            margin: 10px 0;
            font-size: 14px;
        }

        .payment-details .label {
            color: var(--gray);
            font-weight: 500;
        }

        .payment-details .value {
            font-weight: 700;
            color: var(--dark);
        }

        .payment-details .denda-value {
            font-size: 24px;
            color: var(--danger);
        }

        .manual-payment-input {
            margin-bottom: 20px;
        }

        .manual-payment-input label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark);
        }

        .manual-payment-input input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--gray-light);
            border-radius: var(--radius-sm);
            font-size: 16px;
            transition: var(--transition);
        }

        .manual-payment-input input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }

        .payment-info {
            font-size: 12px;
            color: var(--gray);
            margin-top: 5px;
        }

        .payment-info.warning {
            color: var(--danger);
        }

        .payment-info.success {
            color: var(--success);
        }

        .modal-actions {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        .modal-actions button {
            flex: 1;
            padding: 12px;
            border-radius: var(--radius-sm);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-confirm {
            background: linear-gradient(135deg, var(--success), #0ea5e9);
            color: white;
            border: none;
        }

        .btn-confirm:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        .btn-confirm:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .btn-cancel {
            background: var(--gray-light);
            color: var(--gray);
            border: none;
        }

        .btn-cancel:hover {
            background: var(--gray);
            color: white;
        }

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
            .btn-pinjam, .btn-bayar-denda {
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
            .modal-content {
                padding: 20px;
            }
        }
    </style>
</head>
<body class="font-sans antialiased">
    <button class="sidebar-toggle" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <div class="app-container" id="appContainer">
        @include('layouts.sidebarpeminjam')

        <main class="main-content" id="mainContent">
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

            <div class="content-wrapper">
                <div class="welcome-section animate__animated animate__fadeIn">
                    <div class="welcome-text">
                        <h2>Selamat Datang, {{ Auth::user()->name ?? 'Peminjam' }}!</h2>
                        <p>Lihat daftar alat, pinjam langsung, dan kelola peminjaman Anda di satu tempat</p>
                    </div>
                </div>

                <div class="stats-container">
                    @php
                        $totalAlatTersedia = App\Models\Alat::where('stok', '>', 0)->count();
                        $totalPeminjaman = auth()->check() ? auth()->user()->peminjaman()->count() : 0;
                        $totalDipinjam = auth()->check() ? auth()->user()->peminjaman()->where('status', 'dipinjam')->count() : 0;
                        $totalTerlambat = auth()->check() ? auth()->user()->peminjaman()
                            ->where('status', 'dipinjam')
                            ->whereDate('tanggal_rencana_kembali', '<', now())
                            ->count() : 0;
                        $totalDendaBelum = auth()->check() ? auth()->user()->peminjaman()
                            ->where('status_denda', 'belum_bayar')
                            ->where('denda', '>', 0)
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
                            <h3>Denda Belum Bayar</h3>
                            <div class="number">{{ $totalDendaBelum }}</div>
                            <div class="desc">Perlu segera dibayar</div>
                        </div>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success animate__animated animate__fadeIn">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger animate__animated animate__fadeIn">
                        <i class="fas fa-exclamation-triangle"></i>
                        {{ session('error') }}
                    </div>
                @endif

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

                <!-- Daftar Alat Tersedia -->
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
                            $alatTersedia = App\Models\Alat::where('stok', '>', 0)->latest()->get();
                        @endphp
                        
                        @if($alatTersedia->count() > 0)
                            <table class="peminjaman-table">
                                <thead>
                                    <tr>
                                        <th>Nama Alat</th>
                                        <th>Gambar</th>
                                        <th>Stok</th>
                                        <th>Kondisi</th>
                                        <th style="width: 300px;">Pinjam Sekarang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($alatTersedia as $a)
                                    <tr>
                                        <td>
                                            <div style="font-weight: 600;">{{ $a->nama_alat }}</div>
                                            @if($a->kategori)
                                                <div style="font-size: 12px; color: var(--gray); margin-top: 4px;">
                                                    {{ $a->kategori->nama_kategori }}
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <td>
                                            @if($a->gambar)
                                                <img src="{{ asset('storage/' . $a->gambar) }}"
                                                     alt="{{ $a->nama_alat }}"
                                                     style="width: 60px; height: 60px; object-fit: cover; border-radius: var(--radius-sm); box-shadow: var(--shadow-sm);">
                                            @else
                                                <div style="width: 60px; height: 60px; background: var(--gray-light); display: flex; align-items: center; justify-content: center; border-radius: var(--radius-sm);">
                                                    <i class="fas fa-image" style="color: var(--gray);"></i>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <td>
                                            <div class="stock-indicator {{ $a->stok <= 2 ? 'stock-low' : ($a->stok <= 5 ? 'stock-medium' : 'stock-high') }}">
                                                <i class="fas fa-box"></i> {{ $a->stok }} unit
                                            </div>
                                        </div>
                                        
                                        <td>
                                            @php
                                                $conditionClass = 'condition-baik';
                                                if(strpos(strtolower($a->kondisi), 'rusak') !== false) $conditionClass = 'condition-rusak';
                                                elseif(strpos(strtolower($a->kondisi), 'perbaikan') !== false) $conditionClass = 'condition-perbaikan';
                                            @endphp
                                            <span class="condition-badge {{ $conditionClass }}">
                                                <i class="fas {{ $conditionClass == 'condition-baik' ? 'fa-check-circle' : ($conditionClass == 'condition-rusak' ? 'fa-times-circle' : 'fa-tools') }}"></i>
                                                {{ $a->kondisi }}
                                            </span>
                                        </div>
                                        
                                        <td>
                                            <form method="POST" action="{{ route('peminjam.pinjam') }}" class="pinjam-form">
                                                @csrf
                                                <input type="hidden" name="id_alat" value="{{ $a->id_alat }}">
                                                
                                                <input type="date" 
                                                       name="tanggal_rencana_kembali" 
                                                       class="date-input" 
                                                       required
                                                       min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                                       value="{{ date('Y-m-d', strtotime('+7 days')) }}">
                                                
                                                <button type="submit" class="btn-pinjam">
                                                    <i class="fas fa-hand-paper"></i> Pinjam Alat
                                                </button>
                                            </form>
                                        </div>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="empty-state">
                                <div class="empty-icon"><i class="fas fa-tools"></i></div>
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
                            <table class="peminjaman-table">
                                <thead>
                                    <tr>
                                        <th>Alat</th>
                                        <th>Gambar</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Rencana Kembali</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Status</th>
                                        <th>Denda</th>
                                        <th>Status Denda</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($semuaPeminjaman as $r)
@php
    $today = now();
    $rencanaKembali = $r->tanggal_rencana_kembali;
    $tanggalKembali = $r->tanggal_kembali;

    $daysLeft = $today->diffInDays($rencanaKembali, false);
    $isTerlambat = $r->status == 'dipinjam' && $today->greaterThan($rencanaKembali);

    // ===============================
    // STATUS PINJAMAN
    // ===============================
    $statusClass = 'status-menunggu';

    if ($isTerlambat) {
        $statusClass = 'status-terlambat';
    } elseif ($r->status == 'dipinjam') {
        $statusClass = 'status-dipinjam';
    } elseif ($r->status == 'selesai') {
        $statusClass = 'status-dikembalikan';
    }

    // ===============================
    // HITUNG DENDA
    // ===============================
    if ($r->status == 'dipinjam' && $today->greaterThan($rencanaKembali)) {
        // realtime (belum dikembalikan)
        $hariTerlambat = ceil(abs($daysLeft));
        $denda = $hariTerlambat * 1000;
    } else {
        // ambil dari database (SUDAH FINAL)
        $denda = $r->denda ?? 0;
    }

    // ===============================
    // STATUS DENDA (FIX UTAMA)
    // ===============================
    if ($r->status == 'selesai') {
        if ($r->denda > 0) {
            $statusDenda = strtolower($r->status_denda ?? 'belum');
        } else {
            $statusDenda = 'tidak_ada';
        }
    } elseif ($isTerlambat) {
        $statusDenda = 'belum';
    } else {
        $statusDenda = 'tidak_ada';
    }

    // ===============================
    // BADGE STATUS DENDA
    // ===============================
    $dendaStatusClass = 'denda-tidak';
    $dendaStatusText = 'Tidak Ada';

    if ($denda > 0) {
        if ($statusDenda == 'lunas') {
            $dendaStatusClass = 'denda-lunas';
            $dendaStatusText = 'Lunas';
        } else {
            $dendaStatusClass = 'denda-belum';
            $dendaStatusText = 'Belum Bayar';
        }
    }
@endphp                                    <tr>
                                        <td>
                                            <div style="font-weight: 600;">{{ $r->alat->nama_alat ?? '-' }}</div>
                                            @if($r->alat && $r->alat->kategori)
                                                <div style="font-size: 12px; color: var(--gray); margin-top: 4px;">{{ $r->alat->kategori->nama_kategori }}</div>
                                            @endif
                                        </div>
                                        
                                        <td>
                                            @if($r->alat && $r->alat->gambar)
                                                <img src="{{ asset('storage/' . $r->alat->gambar) }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: var(--radius-sm); box-shadow: var(--shadow-sm);">  
                                            @else
                                                <div style="width: 60px; height: 60px; background: var(--gray-light); display: flex; align-items: center; justify-content: center; border-radius: var(--radius-sm);">
                                                    <i class="fas fa-image" style="color: var(--gray);"></i>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <td>{{ \Carbon\Carbon::parse($r->tanggal_pinjam)->format('d/m/Y') }}</div>
                                        
                                        <td>
                                            <div style="font-weight: 600;">{{ \Carbon\Carbon::parse($r->tanggal_rencana_kembali)->format('d/m/Y') }}</div>
                                            @if($r->status == 'dipinjam')
                                                @if($daysLeft > 0)
                                                    <div style="font-size: 12px; color: var(--success);"><i class="fas fa-clock"></i> {{ $daysLeft }} hari lagi</div>
                                                @elseif($daysLeft == 0)
                                                    <div style="font-size: 12px; color: var(--warning);"><i class="fas fa-exclamation-circle"></i> Hari ini</div>
                                                @else
                                                    <div style="font-size: 12px; color: var(--danger);"><i class="fas fa-exclamation-triangle"></i> {{ abs($daysLeft) }} hari terlambat</div>
                                                @endif
                                            @endif
                                        </div>
                                        
                                        <td>
                                            @if($tanggalKembali)
                                                <div style="font-weight: 600; color: var(--success);">{{ \Carbon\Carbon::parse($tanggalKembali)->format('d/m/Y') }}</div>
                                                <div style="font-size: 12px; color: var(--success);"><i class="fas fa-check-circle"></i> Sudah dikembalikan</div>
                                            @else
                                                <span style="color: var(--gray); font-style: italic;">-</span>
                                            @endif
                                        </div>
                                        
                                        <td>
                                            <span class="status-badge {{ $statusClass }}">
                                                <i class="fas {{ $statusClass == 'status-dipinjam' ? 'fa-clock' : ($statusClass == 'status-dikembalikan' ? 'fa-check-circle' : ($statusClass == 'status-terlambat' ? 'fa-exclamation-triangle' : 'fa-hourglass-half')) }}"></i>
                                                {{ ucfirst($r->status) }}
                                            </span>
                                        </div>
                                        
                                        <td>
                                            @if($denda > 0)
                                                <div style="color: var(--danger); font-weight: 700;">Rp {{ number_format($denda, 0, ',', '.') }}</div>
                                                <div style="font-size: 12px; color: var(--danger);">Terlambat {{ abs($daysLeft) }} hari</div>
                                            @else
                                                <span style="color: var(--success); font-weight: 600;">Tidak ada</span>
                                            @endif
                                        </div>

                                        <td>
                                            <span class="denda-status-badge {{ $dendaStatusClass }}">
                                                <i class="fas {{ $dendaStatusClass == 'denda-lunas' ? 'fa-check-circle' : ($dendaStatusClass == 'denda-belum' ? 'fa-exclamation-circle' : 'fa-minus-circle') }}"></i>
                                                {{ $dendaStatusText }}
                                            </span>
                                        </div>

                                        <td>
                                            @if($r->status == 'dipinjam')
                                                @if($denda > 0)
                                                    <button type="button" class="btn-bayar-denda" onclick="openPaymentModal({{ $r->id_peminjaman }}, '{{ addslashes($r->alat->nama_alat ?? 'Alat') }}', {{ $denda }})">
                                                        <i class="fas fa-money-bill"></i> Bayar & Kembalikan
                                                    </button>
                                                @else
                                                    <form method="POST" action="{{ route('peminjam.pengembalian.kembalikan', $r->id_peminjaman) }}" style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="btn-pinjam" style="background: linear-gradient(135deg, var(--success), #0ea5e9);">
                                                            <i class="fas fa-undo"></i> Kembalikan
                                                        </button>
                                                    </form>
                                                @endif
                                            @elseif($r->status == 'selesai' && $r->denda > 0 && $r->status_denda != 'lunas')
                                            @else
                                                <span style="color: var(--gray);">-</span>
                                            @endif
                                        </div>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="empty-state">
                                <div class="empty-icon"><i class="fas fa-history"></i></div>
                                <h3>Belum ada peminjaman</h3>
                                <p>Mulai dengan meminjam alat dari daftar alat tersedia di atas.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Pembayaran Denda -->
    <div id="paymentModal" class="modal-overlay" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-money-bill-wave"></i> Bayar Denda & Kembalikan Alat</h3>
                <button class="modal-close" onclick="closePaymentModal()">&times;</button>
            </div>
            <form id="paymentForm" method="POST" action="">
                @csrf
                @method('PUT')
                <input type="hidden" name="id_peminjaman" id="paymentLoanId">
                
                <div class="payment-details">
                    <p><span class="label">Alat:</span> <span class="value" id="paymentAlatName"></span></p>
                    <p><span class="label">Total Denda:</span> <span class="value denda-value" id="paymentDendaAmount"></span></p>
                    <p><span class="label">Info:</span> <span class="value" style="color: var(--success);">Setelah bayar, status akan diperbarui sesuai jumlah pembayaran</span></p>
                </div>
                
                <div class="manual-payment-input">
                    <label for="jumlah_bayar">Masukkan Jumlah Pembayaran (Tunai)</label>
                    <input type="number" 
                           id="jumlah_bayar" 
                           name="jumlah_bayar" 
                           class="payment-amount-input"
                           placeholder="Masukkan nominal pembayaran"
                           min="0"
                           step="1000"
                           oninput="validatePaymentAmount(this)">
                    <div id="paymentInfo" class="payment-info"></div>
                </div>
                
                <div class="modal-actions">
                    <button type="button" class="btn-cancel" onclick="closePaymentModal()">Batal</button>
                    <button type="submit" class="btn-confirm" id="confirmPaymentBtn">
                        <i class="fas fa-check-circle"></i> Bayar & Kembalikan Alat
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentDendaAmount = 0;
        let currentLoanId = null;

        const sidebarToggle = document.getElementById('sidebarToggle');
        const appContainer = document.getElementById('appContainer');

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                appContainer.classList.toggle('sidebar-collapsed');
                const icon = this.querySelector('i');
                icon.className = appContainer.classList.contains('sidebar-collapsed') ? 'fas fa-bars' : 'fas fa-times';
            });
        }

        const searchInput = document.querySelector('#globalSearchBar .search-input');
        
        function performSearch(searchTerm) {
            const allTables = document.querySelectorAll('.peminjaman-table');
            let found = false;
            
            allTables.forEach(table => {
                const rows = table.querySelectorAll('tbody tr');
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (searchTerm === '' || text.includes(searchTerm.toLowerCase())) {
                        row.style.display = '';
                        if (searchTerm !== '' && !found) {
                            row.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            found = true;
                        }
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
            
            if (searchTerm !== '' && !found) {
                showToast(`Tidak ditemukan dengan kata kunci: "${searchTerm}"`, 'warning');
            }
        }

        if (searchInput) {
            searchInput.addEventListener('keyup', function(e) {
                if (e.key === 'Enter') {
                    performSearch(this.value.trim());
                }
            });
            
            const searchBar = document.querySelector('#globalSearchBar');
            const searchBtn = document.createElement('button');
            searchBtn.innerHTML = '<i class="fas fa-search"></i>';
            searchBtn.style.cssText = `position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--primary); font-size: 16px; cursor: pointer; padding: 8px;`;
            
            if (searchBar && !searchBar.querySelector('button')) {
                searchBar.appendChild(searchBtn);
                searchBtn.addEventListener('click', () => performSearch(searchInput.value.trim()));
            }
        }

        function validatePaymentAmount(input) {
            let value = parseInt(input.value) || 0;
            const infoDiv = document.getElementById('paymentInfo');
            const confirmBtn = document.getElementById('confirmPaymentBtn');
            
            if (value > currentDendaAmount) {
                infoDiv.innerHTML = `<i class="fas fa-exclamation-circle"></i> Jumlah pembayaran melebihi denda! Maksimal Rp ${formatRupiah(currentDendaAmount)}`;
                infoDiv.className = 'payment-info warning';
                confirmBtn.disabled = true;
                confirmBtn.style.opacity = '0.6';
                confirmBtn.style.cursor = 'not-allowed';
            } else if (value > 0 && value < currentDendaAmount) {
                const kurang = currentDendaAmount - value;
                infoDiv.innerHTML = `<i class="fas fa-info-circle"></i> Pembayaran kurang Rp ${formatRupiah(kurang)}. Sisa denda akan tetap tercatat. Tetap bisa mengembalikan alat.`;
                infoDiv.className = 'payment-info';
                confirmBtn.disabled = false;
                confirmBtn.style.opacity = '1';
                confirmBtn.style.cursor = 'pointer';
            } else if (value === currentDendaAmount) {
                infoDiv.innerHTML = `<i class="fas fa-check-circle"></i> Pembayaran lunas! Status denda akan berubah menjadi LUNAS.`;
                infoDiv.className = 'payment-info success';
                confirmBtn.disabled = false;
                confirmBtn.style.opacity = '1';
                confirmBtn.style.cursor = 'pointer';
            } else if (value === 0) {
                infoDiv.innerHTML = `Masukkan nominal pembayaran`;
                infoDiv.className = 'payment-info';
                confirmBtn.disabled = true;
                confirmBtn.style.opacity = '0.6';
                confirmBtn.style.cursor = 'not-allowed';
            } else {
                infoDiv.innerHTML = `Pembayaran valid.`;
                infoDiv.className = 'payment-info success';
                confirmBtn.disabled = false;
                confirmBtn.style.opacity = '1';
                confirmBtn.style.cursor = 'pointer';
            }
        }

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(angka);
        }

        function openPaymentModal(loanId, alatName, denda) {
            currentLoanId = loanId;
            currentDendaAmount = denda;
            
            const modal = document.getElementById('paymentModal');
            const form = document.getElementById('paymentForm');
            const loanIdInput = document.getElementById('paymentLoanId');
            const alatNameSpan = document.getElementById('paymentAlatName');
            const dendaSpan = document.getElementById('paymentDendaAmount');
            const jumlahBayarInput = document.getElementById('jumlah_bayar');
            const infoDiv = document.getElementById('paymentInfo');
            
            form.action = `/peminjam/bayar-denda-kembalikan/${loanId}`;
            loanIdInput.value = loanId;
            alatNameSpan.textContent = alatName;
            dendaSpan.textContent = formatRupiah(denda);
            
            jumlahBayarInput.value = '';
            jumlahBayarInput.max = denda;
            infoDiv.innerHTML = 'Masukkan nominal pembayaran';
            infoDiv.className = 'payment-info';
            
            const confirmBtn = document.getElementById('confirmPaymentBtn');
            confirmBtn.disabled = true;
            confirmBtn.style.opacity = '0.6';
            confirmBtn.style.cursor = 'not-allowed';
            
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
        
        function closePaymentModal() {
            document.getElementById('paymentModal').style.display = 'none';
            document.body.style.overflow = '';
        }
        
        document.getElementById('paymentModal').addEventListener('click', function(e) {
            if (e.target === this) closePaymentModal();
        });
        
        const paymentForm = document.getElementById('paymentForm');
        if (paymentForm) {
            paymentForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const jumlahBayar = parseInt(document.getElementById('jumlah_bayar').value) || 0;
                
                if (jumlahBayar > currentDendaAmount) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: `Jumlah pembayaran tidak boleh melebihi denda! Maksimal Rp ${formatRupiah(currentDendaAmount)}`,
                        confirmButtonColor: '#4361ee'
                    });
                    return;
                }
                
                if (jumlahBayar <= 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Masukkan jumlah pembayaran yang valid!',
                        confirmButtonColor: '#4361ee'
                    });
                    return;
                }
                
                const submitBtn = this.querySelector('.btn-confirm');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
                submitBtn.disabled = true;
                
                const loanId = document.getElementById('paymentLoanId').value;
                
                fetch(`/peminjam/bayar-denda-kembalikan/${loanId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ 
                        jumlah_bayar: jumlahBayar,
                        _method: 'PUT'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message,
                            confirmButtonColor: '#4361ee'
                        }).then(() => window.location.reload());
                        closePaymentModal();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: data.message || 'Terjadi kesalahan',
                            confirmButtonColor: '#4361ee'
                        });
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan jaringan. Silakan coba lagi.',
                        confirmButtonColor: '#4361ee'
                    });
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                });
            });
        }

        const pinjamForms = document.querySelectorAll('.pinjam-form');
        
        pinjamForms.forEach(form => {
            const dateInput = form.querySelector('.date-input');
            
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            const tomorrowStr = tomorrow.toISOString().split('T')[0];
            
            if (dateInput && !dateInput.value) {
                const defaultDate = new Date();
                defaultDate.setDate(defaultDate.getDate() + 7);
                dateInput.value = defaultDate.toISOString().split('T')[0];
            }
            
            if (dateInput) {
                dateInput.min = tomorrowStr;
                
                dateInput.addEventListener('change', function() {
                    const selectedDate = new Date(this.value);
                    const today = new Date();
                    today.setHours(0, 0, 0, 0);
                    
                    if (selectedDate <= today) {
                        showToast('Tanggal rencana kembali harus setelah hari ini', 'error');
                        this.value = tomorrowStr;
                    }
                });
            }
            
            form.addEventListener('submit', function(e) {
                const row = this.closest('tr');
                const alatName = row.querySelector('td:first-child div')?.textContent || 'Alat';
                const returnDate = this.querySelector('.date-input').value;
                const returnDateFormatted = new Date(returnDate).toLocaleDateString('id-ID');
                
                if (!confirm(`Konfirmasi peminjaman:\n\nAlat: ${alatName}\nRencana Tanggal Kembali: ${returnDateFormatted}\n\nApakah data sudah benar?`)) {
                    e.preventDefault();
                    return false;
                }
                
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
                    submitBtn.disabled = true;
                }
                
                return true;
            });
        });

        const notificationBtn = document.getElementById('notificationBtn');
        if (notificationBtn) {
            notificationBtn.addEventListener('click', function() {
                const peminjamanSection = document.querySelectorAll('.dashboard-card')[1];
                if (peminjamanSection) peminjamanSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                showToast('Dialihkan ke peminjaman Anda', 'info');
            });
        }

        function showToast(message, type = 'info') {
            const existingToast = document.querySelector('.custom-toast');
            if (existingToast) existingToast.remove();
            
            const toast = document.createElement('div');
            toast.className = 'custom-toast';
            const bgColor = type === 'success' ? 'var(--success)' : type === 'error' ? 'var(--danger)' : type === 'warning' ? 'var(--warning)' : 'var(--primary)';
            toast.style.cssText = `position: fixed; top: 20px; right: 20px; background: ${bgColor}; color: white; padding: 16px 24px; border-radius: var(--radius-md); font-weight: 600; box-shadow: var(--shadow-lg); z-index: 10000; animation: slideInRight 0.3s ease; display: flex; align-items: center; gap: 12px; max-width: 400px;`;
            const icon = type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-times-circle' : type === 'warning' ? 'fa-exclamation-triangle' : 'fa-info-circle';
            toast.innerHTML = `<i class="fas ${icon}"></i><span>${message}</span>`;
            document.body.appendChild(toast);
            setTimeout(() => {
                toast.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => { if (toast.parentNode) toast.remove(); }, 300);
            }, 3000);
        }

        window.addEventListener('resize', function() {
            if (window.innerWidth > 1200 && appContainer) {
                appContainer.classList.remove('sidebar-collapsed');
                if (sidebarToggle) sidebarToggle.querySelector('i').className = 'fas fa-bars';
            }
        });

        if (!document.querySelector('#custom-animations')) {
            const style = document.createElement('style');
            style.id = 'custom-animations';
            style.textContent = `@keyframes slideInRight { from { opacity: 0; transform: translateX(100%); } to { opacity: 1; transform: translateX(0); } } @keyframes slideOutRight { from { opacity: 1; transform: translateX(0); } to { opacity: 0; transform: translateX(100%); } }`;
            document.head.appendChild(style);
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.peminjaman-table tbody tr').forEach(row => {
                row.addEventListener('mouseenter', function() { this.style.transform = 'translateX(4px)'; });
                row.addEventListener('mouseleave', function() { this.style.transform = ''; });
            });
            
            function updateNotificationBadge() {
                const badge = document.getElementById('notificationCount');
                if (badge) {
                    const totalCount = document.querySelectorAll('.status-badge.status-terlambat, .status-badge.status-dipinjam').length;
                    badge.textContent = totalCount;
                    badge.style.background = document.querySelector('.status-badge.status-terlambat') ? 'linear-gradient(135deg, var(--danger), var(--accent))' : document.querySelector('.status-badge.status-dipinjam') ? 'linear-gradient(135deg, var(--warning), var(--accent))' : 'linear-gradient(135deg, var(--accent), var(--danger))';
                }
            }
            updateNotificationBadge();
        });
    </script>
</body>
</html>