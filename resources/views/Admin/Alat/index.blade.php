<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LibTrack - Koleksi Buku</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800|playfair:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- SweetAlert2 CSS & JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
        :root {
            --primary: #2c5f8a;
            --primary-dark: #1e3a5f;
            --primary-light: #4a7c9e;
            --secondary: #6b4c7a;
            --secondary-light: #8b6b9a;
            --accent: #d4a373;
            --success: #2d6a4f;
            --warning: #e9c46a;
            --danger: #e76f51;
            --dark: #2d3e50;
            --darker: #1a2a3a;
            --light: #fef9e8;
            --gray: #8a9ba8;
            --gray-light: #e8e0d0;
            --card-bg: rgba(253, 246, 227, 0.95);
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.06);
            --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 40px rgba(0, 0, 0, 0.12);
            --shadow-xl: 0 20px 60px rgba(0, 0, 0, 0.15);
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
            background: rgba(253, 246, 227, 0.95);
            backdrop-filter: blur(20px);
            padding: 0 32px;
            height: 72px;
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
            font-size: 24px;
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
            font-size: 24px;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        /* Search Bar */
        .search-wrapper {
            position: relative;
            width: 300px;
        }

        .search-input {
            width: 100%;
            padding: 10px 16px 10px 42px;
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid #d4a373;
            border-radius: var(--radius-lg);
            font-size: 14px;
            color: var(--dark);
            transition: var(--transition);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--secondary);
            background: white;
            box-shadow: 0 0 0 3px rgba(107, 76, 122, 0.1);
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
            background: rgba(0, 0, 0, 0.05);
            padding: 3px 8px;
            border-radius: 8px;
            font-size: 10px;
            color: var(--gray);
            font-weight: 600;
        }

        /* Notification */
        .notification-btn {
            position: relative;
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid #d4a373;
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
            color: var(--secondary);
            border-color: var(--secondary);
            transform: scale(1.05);
            box-shadow: var(--shadow-sm);
        }

        .notification-badge {
            position: absolute;
            top: -2px;
            right: -2px;
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

        /* User Menu */
        .user-menu {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 6px 12px;
            border-radius: var(--radius-lg);
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid #d4a373;
            transition: var(--transition);
        }

        .user-menu:hover {
            background: white;
            border-color: var(--secondary);
            transform: translateY(-1px);
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
            font-weight: 700;
            font-size: 12px;
        }

        /* Content */
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
            border: 1px solid #d4a373;
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .stat-card::before {
            content: '📖';
            position: absolute;
            bottom: -10px;
            right: -10px;
            font-size: 50px;
            opacity: 0.05;
            pointer-events: none;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
            border-color: var(--secondary);
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
        .icon-success { background: linear-gradient(135deg, var(--success), #1f8a62); }
        .icon-warning { background: linear-gradient(135deg, var(--warning), #d4a13e); }
        .icon-danger { background: linear-gradient(135deg, var(--danger), #d95b3c); }

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

        /* Add Button */
        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 12px 28px;
            border-radius: var(--radius-md);
            text-decoration: none;
            font-weight: 700;
            font-size: 14px;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(107, 76, 122, 0.3);
            margin-bottom: 24px;
            border: none;
            cursor: pointer;
        }

        .btn-add:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(107, 76, 122, 0.4);
            gap: 14px;
        }

        /* ============================================================ */
        /* CARD GRID - TAMPILAN UTAMA */
        /* ============================================================ */
        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 28px;
            margin-bottom: 40px;
        }

        .book-card {
            background: var(--card-bg);
            border-radius: var(--radius-xl);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            border: 1px solid #d4a373;
            position: relative;
            animation: cardFadeIn 0.6s ease forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        @keyframes cardFadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .book-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
            border-color: var(--secondary);
        }

        /* Book Cover */
        .book-cover {
            position: relative;
            height: 220px;
            overflow: hidden;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .book-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .book-card:hover .book-cover img {
            transform: scale(1.05);
        }

        .book-cover-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(44, 95, 138, 0.8), rgba(107, 76, 122, 0.8));
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: var(--transition);
        }

        .book-card:hover .book-cover-overlay {
            opacity: 1;
        }

        .preview-icon {
            width: 50px;
            height: 50px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 20px;
            transform: scale(0.8);
            transition: var(--transition);
        }

        .book-card:hover .preview-icon {
            transform: scale(1);
        }

        /* No Image Placeholder */
        .no-image-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }

        .no-image-placeholder i {
            font-size: 60px;
            margin-bottom: 10px;
        }

        .no-image-placeholder span {
            font-size: 12px;
            font-weight: 500;
        }

        /* Book Info */
        .book-info {
            padding: 20px;
        }

        .book-title {
            font-size: 18px;
            font-weight: 800;
            font-family: 'Playfair', serif;
            color: var(--dark);
            margin-bottom: 8px;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .book-author {
            font-size: 13px;
            color: var(--secondary);
            font-weight: 600;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .book-author i {
            font-size: 12px;
        }

        .book-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px dashed #e8e0d0;
        }

        .book-stock {
            background: rgba(45, 106, 79, 0.15);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            color: var(--success);
        }

        .book-id {
            font-family: monospace;
            font-size: 11px;
            color: var(--gray);
            background: rgba(142, 142, 160, 0.1);
            padding: 4px 10px;
            border-radius: 20px;
        }

        .book-details {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 16px;
        }

        .detail-item {
            flex: 1;
            min-width: 100px;
        }

        .detail-label {
            font-size: 10px;
            color: var(--gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .detail-value {
            font-size: 13px;
            font-weight: 600;
            color: var(--dark);
        }

        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
        }

        .status-available {
            background: rgba(45, 106, 79, 0.15);
            color: var(--success);
            border: 1px solid rgba(45, 106, 79, 0.3);
        }

        .status-borrowed {
            background: rgba(231, 111, 81, 0.15);
            color: var(--danger);
            border: 1px solid rgba(231, 111, 81, 0.3);
        }

        .status-repair {
            background: rgba(233, 196, 106, 0.2);
            color: #b8860b;
            border: 1px solid rgba(233, 196, 106, 0.3);
        }

        /* Action Buttons on Card - DIPERBAIKI & DIPERBESAR */
        .card-actions {
            display: flex;
            gap: 12px;
            padding: 16px 20px 20px;
            border-top: 1px solid #e8e0d0;
            background: rgba(253, 246, 227, 0.8);
        }

        .btn-card {
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 12px 0;
            border-radius: var(--radius-md);
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .btn-card:hover::before {
            left: 100%;
        }

        .btn-edit-card {
            background: linear-gradient(135deg, var(--warning), #d4a13e);
            color: var(--dark);
            box-shadow: 0 2px 8px rgba(233, 196, 106, 0.3);
        }

        .btn-edit-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(233, 196, 106, 0.4);
            gap: 14px;
        }

        .btn-delete-card {
            background: linear-gradient(135deg, var(--danger), #d95b3c);
            color: white;
            box-shadow: 0 2px 8px rgba(231, 111, 81, 0.3);
        }

        .btn-delete-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(231, 111, 81, 0.4);
            gap: 14px;
        }

        .btn-detail-card {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: 0 2px 8px rgba(107, 76, 122, 0.3);
        }

        .btn-detail-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(107, 76, 122, 0.4);
            gap: 14px;
        }

        /* Quick Action Floating Button */
        .fab-container {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 100;
        }

        .fab-button {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            cursor: pointer;
            box-shadow: var(--shadow-lg);
            transition: var(--transition);
            border: none;
        }

        .fab-button:hover {
            transform: scale(1.1);
            box-shadow: var(--shadow-xl);
        }

        /* Pagination */
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 2px solid rgba(107, 76, 122, 0.2);
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
            min-width: 38px;
            height: 38px;
            padding: 0 12px;
            border-radius: var(--radius-sm);
            background: white;
            color: var(--dark);
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
            border: 1px solid #d4a373;
            transition: var(--transition);
        }

        .pagination a:hover {
            background: var(--secondary);
            color: white;
            border-color: var(--secondary);
        }

        .pagination .active span {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-color: transparent;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: var(--card-bg);
            border-radius: var(--radius-xl);
            border: 1px solid #d4a373;
        }

        .empty-icon {
            font-size: 64px;
            color: #d4a373;
            margin-bottom: 20px;
        }

        .empty-state h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: var(--dark);
        }

        .empty-state p {
            color: var(--gray);
        }

        /* Loading Overlay */
        .loading-overlay {
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
            z-index: 9999;
            display: none;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 3px solid #e8e0d0;
            border-top-color: var(--secondary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
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
            border-radius: var(--radius-md);
            font-size: 20px;
            cursor: pointer;
            z-index: 1000;
            box-shadow: var(--shadow-md);
        }

        /* Toast Custom */
        .toast-custom {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--dark);
            color: white;
            padding: 12px 24px;
            border-radius: var(--radius-md);
            font-weight: 600;
            z-index: 1000;
            animation: fadeInUp 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateX(-50%) translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }
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
            .search-wrapper {
                display: none;
            }
            .stats-container {
                grid-template-columns: 1fr;
            }
            .books-grid {
                grid-template-columns: 1fr;
            }
            .pagination-container {
                flex-direction: column;
                align-items: center;
            }
            .card-actions {
                flex-direction: column;
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
    <!-- Sidebar Toggle Button -->
    <button class="sidebar-toggle" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- App Container -->
    <div class="app-container" id="appContainer">
        @include('layouts.sidebar')

        <main class="main-content" id="mainContent">
            <header class="header">
                <h1 class="header-title">Koleksi Buku</h1>
                <div class="header-actions">
                    <div class="search-wrapper">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" id="searchInput" placeholder="Cari judul atau penulis...">
                        <span class="search-shortcut">⌘K</span>
                    </div>
                    <button class="notification-btn" id="notificationBtn">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </button>
                    <div class="user-menu" id="userMenu">
                        <div class="user-menu-avatar">
                            @auth
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            @else
                                AD
                            @endauth
                        </div>
                        <span>{{ Auth::user()->name ?? 'Admin' }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </header>

            <div class="content-wrapper">
                <!-- Stats Cards -->
                <div class="stats-container">
                    <div class="stat-card" onclick="filterByStatus('all')">
                        <div class="stat-icon icon-primary"><i class="fas fa-book"></i></div>
                        <div class="stat-info">
                            <h3>Total Buku</h3>
                            <div class="number">{{ $alat->total() }}</div>
                        </div>
                    </div>
                    <div class="stat-card" onclick="filterByStatus('tersedia')">
                        <div class="stat-icon icon-success"><i class="fas fa-check-circle"></i></div>
                        <div class="stat-info">
                            <h3>Tersedia</h3>
                            <div class="number">{{ $alat->where('status', 'tersedia')->count() }}</div>
                        </div>
                    </div>
                    <div class="stat-card" onclick="filterByStatus('dipinjam')">
                        <div class="stat-icon icon-warning"><i class="fas fa-book-open"></i></div>
                        <div class="stat-info">
                            <h3>Dipinjam</h3>
                            <div class="number">{{ $alat->where('status', 'dipinjam')->count() }}</div>
                        </div>
                    </div>
                    <div class="stat-card" onclick="filterByStatus('perbaikan')">
                        <div class="stat-icon icon-danger"><i class="fas fa-wrench"></i></div>
                        <div class="stat-info">
                            <h3>Perbaikan</h3>
                            <div class="number">{{ $alat->where('status', 'perbaikan')->count() }}</div>
                        </div>
                    </div>
                </div>

                <!-- Add Button -->
                <a href="{{ route('admin.alat.create') }}" class="btn-add" id="addBookBtn">
                    <i class="fas fa-plus"></i> Tambah Buku Baru
                </a>

                <!-- Books Grid - CARD VIEW -->
                @if($alat->count() > 0)
                    <div class="books-grid" id="booksGrid">
                        @foreach($alat as $book)
                            <div class="book-card" data-book-id="{{ $book->id_alat }}" data-book-title="{{ $book->nama_alat }}" data-book-author="{{ $book->penulis }}" data-book-status="{{ $book->status }}">
                                <div class="book-cover" onclick="showImagePreview('{{ $book->gambar ? asset('storage/'.$book->gambar) : '' }}', '{{ $book->nama_alat }}')">
                                    @if($book->gambar)
                                        <img src="{{ asset('storage/'.$book->gambar) }}" alt="{{ $book->nama_alat }}" onerror="this.onerror=null; this.parentElement.innerHTML=this.parentElement.querySelector('.no-image-placeholder').outerHTML;">
                                        <div class="book-cover-overlay">
                                            <div class="preview-icon">
                                                <i class="fas fa-search"></i>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="no-image-placeholder" style="display: {{ $book->gambar ? 'none' : 'flex' }}">
                                        <i class="fas fa-book"></i>
                                        <span>{{ substr($book->nama_alat, 0, 2) }}</span>
                                    </div>
                                </div>
                                <div class="book-info">
                                    <h3 class="book-title">{{ $book->nama_alat }}</h3>
                                    <div class="book-author">
                                        <i class="fas fa-user-edit"></i> {{ $book->penulis ?? 'Unknown Author' }}
                                    </div>
                                    <div class="book-meta">
                                        <span class="book-stock"><i class="fas fa-copy"></i> Stok: {{ $book->stok }}</span>
                                        <span class="book-id">#{{ $book->id_alat }}</span>
                                    </div>
                                    <div class="book-details">
                                        <div class="detail-item">
                                            <div class="detail-label"><i class="fas fa-calendar"></i> Terbit</div>
                                            <div class="detail-value">{{ $book->tanggal_terbit ? \Carbon\Carbon::parse($book->tanggal_terbit)->format('Y') : '-' }}</div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-label"><i class="fas fa-map-marker-alt"></i> Tempat</div>
                                            <div class="detail-value">{{ $book->tempat_terbit ?? '-' }}</div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-label"><i class="fas fa-tag"></i> Genre</div>
                                            <div class="detail-value">{{ $book->kategori->nama_kategori ?? '-' }}</div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-label"><i class="fas fa-microchip"></i> Kondisi</div>
                                            <div class="detail-value">{{ $book->kondisi ?? '-' }}</div>
                                        </div>
                                    </div>
                                    <div>
                                        @php
                                            $statusClass = 'status-available';
                                            $statusIcon = 'fa-check-circle';
                                            $statusText = 'Tersedia';
                                            if($book->status == 'dipinjam') {
                                                $statusClass = 'status-borrowed';
                                                $statusIcon = 'fa-book-open';
                                                $statusText = 'Dipinjam';
                                            } elseif($book->status == 'perbaikan') {
                                                $statusClass = 'status-repair';
                                                $statusIcon = 'fa-wrench';
                                                $statusText = 'Perbaikan';
                                            }
                                        @endphp
                                        <span class="status-badge {{ $statusClass }}">
                                            <i class="fas {{ $statusIcon }}"></i> {{ $statusText }}
                                        </span>
                                    </div>
                                </div>
                                <div class="card-actions">
                                    <button type="button" class="btn-card btn-detail-card" onclick="showBookDetail({{ $book->id_alat }})">
                                        <i class="fas fa-info-circle"></i> Detail
                                    </button>
                                    <a href="{{ route('admin.alat.edit', $book->id_alat) }}" class="btn-card btn-edit-card">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button type="button" class="btn-card btn-delete-card delete-book" data-id="{{ $book->id_alat }}" data-name="{{ $book->nama_alat }}">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($alat->hasPages())
                    <div class="pagination-container">
                        <div class="pagination-info">
                            <i class="fas fa-chart-bar"></i>
                            Menampilkan {{ $alat->firstItem() }} - {{ $alat->lastItem() }} dari {{ $alat->total() }} buku
                        </div>
                        <div class="pagination">
                            {{ $alat->appends(request()->query())->links() }}
                        </div>
                    </div>
                    @endif
                @else
                    <div class="empty-state">
                        <div class="empty-icon"><i class="fas fa-book"></i></div>
                        <h3>Belum Ada Buku</h3>
                        <p>Mulai dengan menambahkan buku baru ke koleksi perpustakaan.</p>
                        <a href="{{ route('admin.alat.create') }}" class="btn-add" style="display: inline-flex; margin-top: 16px;">
                            <i class="fas fa-plus"></i> Tambah Buku Pertama
                        </a>
                    </div>
                @endif
            </div>
        </main>
    </div>

    <!-- Floating Action Button -->
    <div class="fab-container">
        <button class="fab-button" id="fabButton">
            <i class="fas fa-plus"></i>
        </button>
    </div>

    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <script>
        // Loading functions
        function showLoading() {
            document.getElementById('loadingOverlay').style.display = 'flex';
        }
        function hideLoading() {
            document.getElementById('loadingOverlay').style.display = 'none';
        }

        // Show Toast
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = 'toast-custom';
            toast.style.background = type === 'success' ? '#2d6a4f' : type === 'error' ? '#e76f51' : type === 'warning' ? '#e9c46a' : '#2c5f8a';
            toast.style.color = type === 'warning' ? '#2d3e50' : 'white';
            toast.innerHTML = `<i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : type === 'warning' ? 'fa-exclamation-triangle' : 'fa-info-circle'}"></i> ${message}`;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }

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
                    const cards = document.querySelectorAll('.book-card');
                    let visibleCount = 0;
                    
                    cards.forEach(card => {
                        const title = card.dataset.bookTitle?.toLowerCase() || '';
                        const author = card.dataset.bookAuthor?.toLowerCase() || '';
                        if (title.includes(term) || author.includes(term)) {
                            card.style.display = '';
                            visibleCount++;
                        } else {
                            card.style.display = 'none';
                        }
                    });
                    
                    if (term && visibleCount === 0) {
                        showToast(`Tidak ditemukan buku dengan kata "${term}"`, 'warning');
                    }
                }, 300);
            });
        }

        // Filter by status from stat cards
        function filterByStatus(status) {
            const cards = document.querySelectorAll('.book-card');
            let visibleCount = 0;
            
            cards.forEach(card => {
                if (status === 'all') {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    const bookStatus = card.dataset.bookStatus;
                    if (bookStatus === status) {
                        card.style.display = '';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                }
            });
            
            if (visibleCount === 0) {
                showToast(`Tidak ada buku dengan status ${status}`, 'info');
            } else {
                showToast(`Menampilkan ${visibleCount} buku`, 'success');
            }
        }

        // Image preview with SweetAlert
        function showImagePreview(imgSrc, bookTitle) {
            if (imgSrc) {
                Swal.fire({
                    title: `<i class="fas fa-book"></i> ${bookTitle}`,
                    imageUrl: imgSrc,
                    imageAlt: bookTitle,
                    imageWidth: '80%',
                    imageHeight: 'auto',
                    background: '#fdf6e3',
                    confirmButtonColor: '#2c5f8a',
                    confirmButtonText: '<i class="fas fa-check"></i> Tutup',
                    showClass: { popup: 'animate__animated animate__zoomIn' }
                });
            } else {
                Swal.fire({
                    title: '<i class="fas fa-image"></i> Tidak Ada Cover',
                    text: `Belum ada cover untuk buku "${bookTitle}"`,
                    icon: 'info',
                    confirmButtonColor: '#2c5f8a',
                    background: '#fdf6e3'
                });
            }
        }

        // Show book detail with SweetAlert
        function showBookDetail(bookId) {
            // Fetch book detail via AJAX or just show modal
            Swal.fire({
                title: '<i class="fas fa-info-circle"></i> Detail Buku',
                html: `
                    <div style="text-align: left;">
                        <p><strong>ID Buku:</strong> ${bookId}</p>
                        <p><strong>Informasi lengkap dapat dilihat di halaman edit</strong></p>
                    </div>
                `,
                icon: 'info',
                confirmButtonColor: '#2c5f8a',
                confirmButtonText: '<i class="fas fa-arrow-right"></i> Lihat Detail',
                showCancelButton: true,
                cancelButtonText: '<i class="fas fa-times"></i> Tutup',
                background: '#fdf6e3'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `{{ url('admin/alat') }}/${bookId}/edit`;
                }
            });
        }

        // Delete book with SweetAlert
        const deleteButtons = document.querySelectorAll('.delete-book');
        deleteButtons.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                const bookId = this.dataset.id;
                const bookName = this.dataset.name;
                
                Swal.fire({
                    title: '<i class="fas fa-exclamation-triangle"></i> Hapus Buku?',
                    html: `
                        <div style="text-align: center;">
                            <div style="background: rgba(231, 111, 81, 0.1); width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                                <i class="fas fa-trash-alt" style="font-size: 40px; color: #e76f51;"></i>
                            </div>
                            <p style="font-size: 16px;">Anda akan menghapus buku</p>
                            <p style="font-weight: 800; font-size: 20px; color: #e76f51; margin: 10px 0;">"${bookName}"</p>
                            <p style="color: #8a9ba8; font-size: 13px; padding: 12px; background: rgba(0,0,0,0.03); border-radius: 12px;">
                                <i class="fas fa-exclamation-circle"></i> Tindakan ini tidak dapat dibatalkan! Data akan hilang permanen.
                            </p>
                        </div>
                    `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '<i class="fas fa-trash"></i> Ya, Hapus!',
                    cancelButtonText: '<i class="fas fa-times"></i> Batal',
                    confirmButtonColor: '#e76f51',
                    cancelButtonColor: '#8a9ba8',
                    background: '#fdf6e3',
                    showClass: { popup: 'animate__animated animate__shakeX' }
                }).then((result) => {
                    if (result.isConfirmed) {
                        showLoading();
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = `{{ url('admin/alat') }}/${bookId}`;
                        form.innerHTML = `@csrf @method('DELETE')`;
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });

        // Add Book Button with SweetAlert confirmation
        const addBookBtn = document.getElementById('addBookBtn');
        if (addBookBtn) {
            addBookBtn.addEventListener('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '<i class="fas fa-plus-circle"></i> Tambah Buku Baru',
                    html: `
                        <div style="text-align: center;">
                            <div style="background: linear-gradient(135deg, #2c5f8a, #6b4c7a); width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                                <i class="fas fa-book" style="font-size: 40px; color: white;"></i>
                            </div>
                            <p style="color: #8a9ba8; margin-bottom: 10px;">Anda akan menambahkan buku baru ke dalam koleksi perpustakaan.</p>
                            <p style="color: #2c5f8a; font-weight: 600; background: rgba(44,95,138,0.1); padding: 10px; border-radius: 12px;">
                                <i class="fas fa-info-circle"></i> Lengkapi informasi buku pada halaman berikutnya
                            </p>
                        </div>
                    `,
                    icon: 'info',
                    confirmButtonText: '<i class="fas fa-arrow-right"></i> Lanjutkan',
                    confirmButtonColor: '#2c5f8a',
                    showCancelButton: true,
                    cancelButtonText: '<i class="fas fa-times"></i> Batal',
                    cancelButtonColor: '#8a9ba8',
                    background: '#fdf6e3',
                    showClass: { popup: 'animate__animated animate__zoomIn' }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = addBookBtn.getAttribute('href');
                    }
                });
            });
        }

        // Floating Action Button
        const fabButton = document.getElementById('fabButton');
        if (fabButton) {
            fabButton.addEventListener('click', function() {
                Swal.fire({
                    title: '<i class="fas fa-bolt"></i> Aksi Cepat',
                    html: `
                        <div style="display: flex; flex-direction: column; gap: 12px;">
                            <button class="btn-card btn-edit-card" style="width: 100%; padding: 12px;" onclick="window.location.href='{{ route('admin.alat.create') }}'">
                                <i class="fas fa-plus"></i> Tambah Buku
                            </button>
                            <button class="btn-card" style="width: 100%; padding: 12px; background: linear-gradient(135deg, #e9c46a, #d4a13e); color: #2d3e50;" onclick="window.location.href='{{ route('admin.peminjaman.index') }}'">
                                <i class="fas fa-hand-peace"></i> Kelola Peminjaman
                            </button>
                        </div>
                    `,
                    showConfirmButton: false,
                    showCloseButton: true,
                    background: '#fdf6e3',
                    customClass: { popup: 'animate__animated animate__fadeInUp' }
                });
            });
        }

        // Notification button
        const notificationBtn = document.getElementById('notificationBtn');
        if (notificationBtn) {
            notificationBtn.addEventListener('click', function() {
                Swal.fire({
                    title: '<i class="fas fa-bell"></i> Notifikasi',
                    html: `
                        <div style="text-align: left; max-height: 400px; overflow-y: auto;">
                            <div style="padding: 12px; border-bottom: 1px solid #e8e0d0;">
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div style="width: 40px; height: 40px; background: rgba(45,106,79,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-check-circle" style="color: #2d6a4f;"></i>
                                    </div>
                                    <div>
                                        <strong>Buku Baru Ditambahkan</strong>
                                        <p style="font-size: 12px; color: #8a9ba8;">Atomic Habits - 2 jam yang lalu</p>
                                    </div>
                                </div>
                            </div>
                            <div style="padding: 12px; border-bottom: 1px solid #e8e0d0;">
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div style="width: 40px; height: 40px; background: rgba(233,196,106,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-exclamation-triangle" style="color: #e9c46a;"></i>
                                    </div>
                                    <div>
                                        <strong>Stok Menipis</strong>
                                        <p style="font-size: 12px; color: #8a9ba8;">Bumi Manusia tersisa 2 eksemplar</p>
                                    </div>
                                </div>
                            </div>
                            <div style="padding: 12px;">
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div style="width: 40px; height: 40px; background: rgba(231,111,81,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-clock" style="color: #e76f51;"></i>
                                    </div>
                                    <div>
                                        <strong>Peminjaman Terlambat</strong>
                                        <p style="font-size: 12px; color: #8a9ba8;">Laskar Pelangi - 3 hari terlambat</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `,
                    confirmButtonText: '<i class="fas fa-check"></i> Tutup',
                    confirmButtonColor: '#2c5f8a',
                    background: '#fdf6e3'
                });
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
                            <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #2c5f8a, #6b4c7a); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                                <i class="fas fa-user" style="font-size: 40px; color: white;"></i>
                            </div>
                            <h3 style="font-weight: 800;">{{ Auth::user()->name ?? 'Admin' }}</h3>
                            <p style="color: #8a9ba8;">{{ Auth::user()->email ?? 'admin@libtrack.com' }}</p>
                            <p style="color: #2c5f8a; font-weight: 600; margin-top: 10px;">Administrator</p>
                        </div>
                    `,
                    showCancelButton: true,
                    confirmButtonText: '<i class="fas fa-cog"></i> Pengaturan',
                    cancelButtonText: '<i class="fas fa-sign-out-alt"></i> Logout',
                    confirmButtonColor: '#2c5f8a',
                    cancelButtonColor: '#e76f51',
                    background: '#fdf6e3'
                }).then((result) => {
                    if (result.isConfirmed) {
                        showToast('Fitur pengaturan sedang dalam pengembangan', 'info');
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire({
                            title: '<i class="fas fa-sign-out-alt"></i> Konfirmasi Logout',
                            text: 'Apakah Anda yakin ingin keluar?',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: '<i class="fas fa-check"></i> Ya, Keluar',
                            cancelButtonText: '<i class="fas fa-times"></i> Batal',
                            confirmButtonColor: '#e76f51',
                            cancelButtonColor: '#2c5f8a',
                            background: '#fdf6e3'
                        }).then((logoutResult) => {
                            if (logoutResult.isConfirmed) {
                                showLoading();
                                window.location.href = '{{ route("logout") }}';
                            }
                        });
                    }
                });
            });
        }

        // Keyboard shortcut Ctrl+K for search
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                if (searchInput) searchInput.focus();
            }
        });

        // Success message from session with SweetAlert
        @if(session('success'))
        Swal.fire({
            title: '<i class="fas fa-check-circle"></i> Berhasil!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonColor: '#2c5f8a',
            timer: 3000,
            timerProgressBar: true,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            background: '#fdf6e3'
        });
        @endif

        // Error message from session
        @if(session('error'))
        Swal.fire({
            title: '<i class="fas fa-exclamation-circle"></i> Gagal!',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonColor: '#e76f51',
            background: '#fdf6e3'
        });
        @endif

        // Animation delay for cards
        const cards = document.querySelectorAll('.book-card');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.05}s`;
        });
    </script>
</body>
</html>