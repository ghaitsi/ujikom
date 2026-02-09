<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Forent - {{ __('Dashboard') }}</title>

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

        /* Animated Background Elements */
        .bg-elements {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .bg-circle {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-light), transparent);
            opacity: 0.1;
            animation: float 20s infinite linear;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(100px, 50px) rotate(90deg); }
            50% { transform: translate(50px, 100px) rotate(180deg); }
            75% { transform: translate(-50px, 50px) rotate(270deg); }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-4px); }
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
            animation: bounce 2s infinite;
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

        /* Premium Welcome Card */
        .welcome-card {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: var(--radius-lg);
            padding: 48px;
            color: white;
            margin-bottom: 40px;
            box-shadow: var(--shadow-lg);
            position: relative;
            overflow: hidden;
            animation: cardEntrance 0.8s cubic-bezier(0.4, 0, 0.2, 1);
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

        .welcome-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent), var(--success), var(--primary-light));
        }

        .welcome-content h1 {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 12px;
            line-height: 1.2;
        }

        .welcome-content p {
            font-size: 18px;
            opacity: 0.9;
            margin-bottom: 32px;
            max-width: 600px;
        }

        .welcome-stats {
            display: flex;
            gap: 40px;
        }

        .welcome-stat {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: var(--radius-md);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: var(--transition);
            min-width: 220px;
        }

        .welcome-stat:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            transition: var(--transition);
        }

        .welcome-stat:hover .stat-icon {
            transform: scale(1.1) rotate(5deg);
            background: rgba(255, 255, 255, 0.2);
        }

        .stat-info h3 {
            font-size: 14px;
            font-weight: 600;
            opacity: 0.8;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 800;
        }

        /* Dashboard Grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        /* Premium Dashboard Card */
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
        }

        .dashboard-card:nth-child(1) { animation-delay: 0.1s; }
        .dashboard-card:nth-child(2) { animation-delay: 0.2s; }
        .dashboard-card:nth-child(3) { animation-delay: 0.3s; }

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

        .card-action {
            color: var(--primary);
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
        }

        .card-action:hover {
            color: var(--secondary);
            gap: 12px;
        }

        /* Recent Activity */
        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            padding: 20px;
            border-radius: var(--radius-md);
            background: rgba(248, 249, 250, 0.8);
            transition: var(--transition);
            border: 1px solid transparent;
            animation: fadeIn 0.5s ease forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateX(-10px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .activity-item:hover {
            background: white;
            border-color: var(--primary-light);
            transform: translateX(8px);
            box-shadow: var(--shadow-sm);
        }

        .activity-icon {
            width: 44px;
            height: 44px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            flex-shrink: 0;
        }

        .activity-icon.return {
            background: linear-gradient(135deg, var(--success), #38b2ac);
        }

        .activity-icon.overdue {
            background: linear-gradient(135deg, var(--danger), #e53e3e);
        }

        .activity-icon.new {
            background: linear-gradient(135deg, var(--accent), #d53f8c);
        }

        .activity-icon.rent {
            background: linear-gradient(135deg, var(--primary), #4299e1);
        }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-size: 15px;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 6px;
        }

        .activity-desc {
            font-size: 14px;
            color: var(--gray);
            margin-bottom: 8px;
        }

        .activity-time {
            font-size: 13px;
            color: var(--primary);
            font-weight: 500;
        }

        /* Premium Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 20px;
        }

        .stat-card {
            background: linear-gradient(135deg, rgba(248, 249, 250, 0.9), white);
            border-radius: var(--radius-md);
            padding: 24px;
            text-align: center;
            transition: var(--transition);
            border: 1px solid rgba(255, 255, 255, 0.5);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
        }

        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-lg);
            background: white;
        }

        .stat-card-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            margin: 0 auto 20px;
            transition: var(--transition);
        }

        .stat-card:hover .stat-card-icon {
            transform: scale(1.1) rotate(10deg);
        }

        .stat-card-value {
            font-size: 36px;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 8px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .stat-card-label {
            font-size: 14px;
            color: var(--gray);
            font-weight: 500;
        }

        /* Premium Tools Grid */
        .tools-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 24px;
        }

        .tool-card {
            background: linear-gradient(135deg, rgba(248, 249, 250, 0.9), white);
            border-radius: var(--radius-md);
            padding: 24px;
            text-align: center;
            transition: var(--transition);
            border: 1px solid rgba(255, 255, 255, 0.5);
            position: relative;
            overflow: hidden;
            cursor: pointer;
            animation: fadeInUp 0.5s ease forwards;
            opacity: 0;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .tool-card:nth-child(1) { animation-delay: 0.1s; }
        .tool-card:nth-child(2) { animation-delay: 0.2s; }
        .tool-card:nth-child(3) { animation-delay: 0.3s; }
        .tool-card:nth-child(4) { animation-delay: 0.4s; }
        .tool-card:nth-child(5) { animation-delay: 0.5s; }
        .tool-card:nth-child(6) { animation-delay: 0.6s; }

        .tool-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-light);
        }

        .tool-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .tool-card:hover::before {
            transform: scaleX(1);
        }

        .tool-icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 28px;
            margin: 0 auto 20px;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
        }

        .tool-card:hover .tool-icon {
            transform: scale(1.1) rotate(10deg);
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.4);
        }

        .tool-name {
            font-size: 18px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 12px;
        }

        .tool-status {
            font-size: 14px;
            padding: 8px 16px;
            border-radius: 20px;
            display: inline-block;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .status-available {
            background: linear-gradient(135deg, rgba(76, 201, 240, 0.15), rgba(76, 201, 240, 0.05));
            color: var(--success);
            border: 2px solid rgba(76, 201, 240, 0.2);
        }

        .status-rented {
            background: linear-gradient(135deg, rgba(249, 65, 68, 0.15), rgba(249, 65, 68, 0.05));
            color: var(--danger);
            border: 2px solid rgba(249, 65, 68, 0.2);
        }

        .status-maintenance {
            background: linear-gradient(135deg, rgba(248, 150, 30, 0.15), rgba(248, 150, 30, 0.05));
            color: var(--warning);
            border: 2px solid rgba(248, 150, 30, 0.2);
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
            
            .welcome-stats {
                flex-wrap: wrap;
                gap: 20px;
            }
            
            .welcome-stat {
                min-width: 200px;
                flex: 1;
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
            
            .welcome-card {
                padding: 32px 24px;
            }
            
            .welcome-content h1 {
                font-size: 28px;
            }
            
            .dashboard-grid {
                grid-template-columns: 1fr;
                gap: 24px;
            }
            
            .search-bar {
                display: none;
            }
            
            .tools-grid {
                grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
                gap: 16px;
            }
        }

        @media (max-width: 480px) {
            .welcome-stats {
                flex-direction: column;
            }
            
            .welcome-stat {
                width: 100%;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body class="font-sans antialiased">
    <!-- Background Elements -->
    <div class="bg-elements" id="bgElements"></div>

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
                <h1 class="header-title animate__animated animate__fadeIn">Dashboard</h1>
                <div class="header-actions">
                    <div class="search-bar">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" placeholder="Cari alat, pelanggan, atau transaksi...">
                    </div>
                    <button class="notification-btn">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">5</span>
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
                <!-- Premium Welcome Card -->
                <div class="welcome-card">
                    <div class="welcome-content">
                        <h1 class="animate__animated animate__fadeInDown">
                            @auth
                                Selamat Datang, {{ Auth::user()->name }}! 👋
                            @else
                                Selamat Datang di Forent! 👋
                            @endauth
                        </h1>
                        <p class="animate__animated animate__fadeIn animate__delay-1s">
                            Kelola peminjaman alat dengan mudah dan efisien di Forent Dashboard
                        </p>
                        <div class="welcome-stats animate__animated animate__fadeInUp animate__delay-2s">
                            <div class="welcome-stat">
                                <div class="stat-icon">
                                    <i class="fas fa-tools"></i>
                                </div>
                                <div class="stat-info">
                                    <h3>Total Alat</h3>
                                    <div class="stat-value">48</div>
                                </div>
                            </div>
                            <div class="welcome-stat">
                                <div class="stat-icon">
                                    <i class="fas fa-handshake"></i>
                                </div>
                                <div class="stat-info">
                                    <h3>Sedang Dipinjam</h3>
                                    <div class="stat-value">12</div>
                                </div>
                            </div>
                            <div class="welcome-stat">
                                <div class="stat-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="stat-info">
                                    <h3>Pelanggan Aktif</h3>
                                    <div class="stat-value">86</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dashboard Grid -->
                <div class="dashboard-grid">
                    <!-- Recent Activity -->
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h3 class="card-title">Aktivitas Terbaru</h3>
                            <a href="{{ url('/aktivitas') }}" class="card-action">
                                Lihat semua
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                        <div class="activity-list">
                            <div class="activity-item">
                                <div class="activity-icon return">
                                    <i class="fas fa-undo"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">Pengembalian Alat</div>
                                    <div class="activity-desc">Budi mengembalikan Bor Listrik</div>
                                    <div class="activity-time">10 menit lalu</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon overdue">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">Peminjaman Terlambat</div>
                                    <div class="activity-desc">Gerinda Tangan - 2 hari terlambat</div>
                                    <div class="activity-time">1 jam lalu</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon new">
                                    <i class="fas fa-plus-circle"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">Alat Baru Ditambahkan</div>
                                    <div class="activity-desc">Kompresor Angin 2PK</div>
                                    <div class="activity-time">2 jam lalu</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon rent">
                                    <i class="fas fa-handshake"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">Peminjaman Baru</div>
                                    <div class="activity-desc">Siti meminjam Tangga Alumunium</div>
                                    <div class="activity-time">3 jam lalu</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h3 class="card-title">Statistik Cepat</h3>
                        </div>
                        <div class="stats-grid">
                            <div class="stat-card">
                                <div class="stat-card-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="stat-card-value">36</div>
                                <div class="stat-card-label">Alat Tersedia</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-card-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="stat-card-value">8</div>
                                <div class="stat-card-label">Akan Kembali</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-card-icon">
                                    <i class="fas fa-tools"></i>
                                </div>
                                <div class="stat-card-value">4</div>
                                <div class="stat-card-label">Perbaikan</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Alat Tersedia -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <h3 class="card-title">Alat Tersedia</h3>
                        <a href="{{ url('/alat') }}" class="card-action">
                            Lihat semua
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                    <div class="tools-grid">
                        <div class="tool-card">
                            <div class="tool-icon">
                                <i class="fas fa-hammer"></i>
                            </div>
                            <div class="tool-name">Jack Hammer</div>
                            <div class="tool-status status-available">Tersedia</div>
                        </div>
                        <div class="tool-card">
                            <div class="tool-icon">
                                <i class="fas fa-screwdriver"></i>
                            </div>
                            <div class="tool-name">Bor Listrik</div>
                            <div class="tool-status status-available">Tersedia</div>
                        </div>
                        <div class="tool-card">
                            <div class="tool-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            <div class="tool-name">Gerinda Tangan</div>
                            <div class="tool-status status-rented">Dipinjam</div>
                        </div>
                        <div class="tool-card">
                            <div class="tool-icon">
                                <i class="fas fa-compress-arrows-alt"></i>
                            </div>
                            <div class="tool-name">Kompresor</div>
                            <div class="tool-status status-maintenance">Perbaikan</div>
                        </div>
                        <div class="tool-card">
                            <div class="tool-icon">
                                <i class="fas fa-ruler-combined"></i>
                            </div>
                            <div class="tool-name">Laser Level</div>
                            <div class="tool-status status-available">Tersedia</div>
                        </div>
                        <div class="tool-card">
                            <div class="tool-icon">
                                <i class="fas fa-fan"></i>
                            </div>
                            <div class="tool-name">Blower</div>
                            <div class="tool-status status-available">Tersedia</div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Create animated background elements
        function createBackgroundElements() {
            const container = document.getElementById('bgElements');
            for (let i = 0; i < 15; i++) {
                const circle = document.createElement('div');
                circle.className = 'bg-circle';
                
                const size = Math.random() * 200 + 50;
                const posX = Math.random() * 100;
                const posY = Math.random() * 100;
                const duration = Math.random() * 20 + 20;
                const delay = Math.random() * 5;
                
                circle.style.width = `${size}px`;
                circle.style.height = `${size}px`;
                circle.style.left = `${posX}%`;
                circle.style.top = `${posY}%`;
                circle.style.animationDuration = `${duration}s`;
                circle.style.animationDelay = `${delay}s`;
                
                container.appendChild(circle);
            }
        }

        // Initialize background
        createBackgroundElements();

        // Toggle sidebar untuk mobile
        const sidebarToggle = document.getElementById('sidebarToggle');
        const appContainer = document.getElementById('appContainer');
        const mainContent = document.getElementById('mainContent');

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
            searchInput.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            searchInput.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        }

        // Update real-time data
        function updateRealTimeData() {
            const statCards = document.querySelectorAll('.stat-card-value');
            if (statCards.length >= 4) {
                // Simulate real-time updates
                const available = Math.floor(Math.random() * 10) + 32;
                const pending = Math.floor(Math.random() * 5) + 6;
                const income = (Math.random() * 0.5 + 3.8).toFixed(1);
                
                statCards[0].textContent = available;
                statCards[1].textContent = pending;
                statCards[3].textContent = `${income}Jt`;
                
                // Add animation
                statCards.forEach(stat => {
                    stat.style.animation = 'none';
                    setTimeout(() => {
                        stat.style.animation = 'pulse 0.5s ease';
                    }, 10);
                });
            }
        }

        // Update every 15 seconds
        setInterval(updateRealTimeData, 15000);

        // Add interactive effects to tool cards
        document.querySelectorAll('.tool-card').forEach(card => {
            card.addEventListener('click', function() {
                const toolName = this.querySelector('.tool-name').textContent;
                const status = this.querySelector('.tool-status').textContent;
                
                // Create tooltip effect
                const tooltip = document.createElement('div');
                tooltip.textContent = `${toolName} - ${status}`;
                tooltip.style.cssText = `
                    position: absolute;
                    background: linear-gradient(135deg, var(--primary), var(--secondary));
                    color: white;
                    padding: 12px 20px;
                    border-radius: var(--radius-sm);
                    font-weight: 600;
                    z-index: 100;
                    box-shadow: var(--shadow-lg);
                    animation: fadeIn 0.3s ease;
                `;
                
                const rect = this.getBoundingClientRect();
                tooltip.style.top = `${rect.top - 60}px`;
                tooltip.style.left = `${rect.left + rect.width/2 - 80}px`;
                
                document.body.appendChild(tooltip);
                
                setTimeout(() => {
                    tooltip.style.animation = 'fadeOut 0.3s ease';
                    setTimeout(() => tooltip.remove(), 300);
                }, 2000);
            });
        });

        // Add fade out animation for tooltip
        const fadeOutTooltipStyle = document.createElement('style');
        fadeOutTooltipStyle.textContent = `
            @keyframes fadeOut {
                from { opacity: 1; transform: translateY(0); }
                to { opacity: 0; transform: translateY(-10px); }
            }
        `;
        document.head.appendChild(fadeOutTooltipStyle);

        // User menu functionality
        const userMenu = document.querySelector('.user-menu');
        if (userMenu) {
            userMenu.addEventListener('click', function() {
                alert('Fitur user menu akan ditampilkan di sini');
            });
        }

        // Notification button functionality
        const notificationBtn = document.querySelector('.notification-btn');
        if (notificationBtn) {
            notificationBtn.addEventListener('click', function() {
                alert('Notifikasi akan ditampilkan di sini');
            });
        }

        // Initialize with some animations
        setTimeout(() => {
            updateRealTimeData();
            
            // Animate welcome stats
            document.querySelectorAll('.welcome-stat').forEach((stat, index) => {
                setTimeout(() => {
                    stat.style.animation = 'pulse 0.5s ease';
                }, index * 100 + 500);
            });
        }, 1000);

        // Add keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + K for search
            if (searchInput && (e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                searchInput.focus();
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 1200) {
                appContainer.classList.remove('sidebar-collapsed');
                if (sidebarToggle) {
                    sidebarToggle.querySelector('i').className = 'fas fa-bars';
                }
            }
        });
    </script>
</body>
</html>