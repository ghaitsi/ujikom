<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Forent - {{ __('Dashboard') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Chart.js untuk grafik -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
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
            font-weight: 800;
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
            flex-wrap: wrap;
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
            min-width: 200px;
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
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            margin-bottom: 40px;
        }

        /* Chart Container Premium */
        .chart-container {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            padding: 28px;
            box-shadow: var(--shadow-md);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: var(--transition);
            backdrop-filter: blur(10px);
            animation: cardEntrance 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
            opacity: 0;
            transform: translateY(20px);
            animation-delay: 0.15s;
        }

        .chart-container:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-4px);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 2px solid rgba(67, 97, 238, 0.1);
        }

        .chart-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .chart-title i {
            color: var(--primary);
            font-size: 22px;
        }

        .chart-period {
            display: flex;
            gap: 8px;
        }

        .period-btn {
            padding: 6px 14px;
            border-radius: var(--radius-sm);
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            background: rgba(248, 249, 250, 0.8);
            border: 1px solid transparent;
            color: var(--gray);
        }

        .period-btn.active {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: var(--shadow-sm);
        }

        .period-btn:hover:not(.active) {
            background: rgba(67, 97, 238, 0.1);
            color: var(--primary);
            border-color: var(--primary-light);
        }

        .chart-wrapper {
            position: relative;
            height: 320px;
            width: 100%;
        }

        canvas {
            max-height: 300px;
            width: 100% !important;
        }

        /* Chart Stats Summary */
        .chart-stats {
            display: flex;
            justify-content: space-around;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }

        .chart-stat-item {
            text-align: center;
        }

        .chart-stat-label {
            font-size: 12px;
            color: var(--gray);
            margin-bottom: 4px;
        }

        .chart-stat-value {
            font-size: 18px;
            font-weight: 700;
            color: var(--dark);
        }

        .chart-stat-value i {
            font-size: 14px;
            margin-right: 4px;
        }

        .trend-up { color: var(--success); }
        .trend-down { color: var(--danger); }

        /* Premium Dashboard Card */
        .dashboard-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            padding: 28px;
            box-shadow: var(--shadow-md);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: var(--transition);
            backdrop-filter: blur(10px);
            animation: cardEntrance 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .dashboard-card:nth-child(1) { animation-delay: 0.2s; }
        .dashboard-card:nth-child(2) { animation-delay: 0.25s; }

        .dashboard-card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-4px);
            border-color: var(--primary-light);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 2px solid rgba(67, 97, 238, 0.1);
        }

        .card-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-title::before {
            content: '';
            width: 6px;
            height: 20px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 3px;
        }

        .card-action {
            color: var(--primary);
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: var(--transition);
        }

        .card-action:hover {
            color: var(--secondary);
            gap: 10px;
        }

        /* Recent Activity */
        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 16px;
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
            transform: translateX(6px);
            box-shadow: var(--shadow-sm);
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 16px;
            flex-shrink: 0;
        }

        .activity-icon.return { background: linear-gradient(135deg, var(--success), #38b2ac); }
        .activity-icon.overdue { background: linear-gradient(135deg, var(--danger), #e53e3e); }
        .activity-icon.new { background: linear-gradient(135deg, var(--accent), #d53f8c); }
        .activity-icon.rent { background: linear-gradient(135deg, var(--primary), #4299e1); }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 4px;
        }

        .activity-desc {
            font-size: 13px;
            color: var(--gray);
            margin-bottom: 6px;
        }

        .activity-time {
            font-size: 11px;
            color: var(--primary);
            font-weight: 500;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 16px;
        }

        .stat-card {
            background: linear-gradient(135deg, rgba(248, 249, 250, 0.9), white);
            border-radius: var(--radius-md);
            padding: 20px;
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
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
            background: white;
        }

        .stat-card-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            margin: 0 auto 16px;
            transition: var(--transition);
        }

        .stat-card:hover .stat-card-icon {
            transform: scale(1.05) rotate(5deg);
        }

        .stat-card-value {
            font-size: 28px;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 6px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .stat-card-label {
            font-size: 12px;
            color: var(--gray);
            font-weight: 500;
        }

        /* Tools Grid */
        .tools-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        .tool-card {
            background: linear-gradient(135deg, rgba(248, 249, 250, 0.9), white);
            border-radius: var(--radius-md);
            padding: 20px;
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

        .tool-card:nth-child(1) { animation-delay: 0.3s; }
        .tool-card:nth-child(2) { animation-delay: 0.35s; }
        .tool-card:nth-child(3) { animation-delay: 0.4s; }
        .tool-card:nth-child(4) { animation-delay: 0.45s; }
        .tool-card:nth-child(5) { animation-delay: 0.5s; }
        .tool-card:nth-child(6) { animation-delay: 0.55s; }

        .tool-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary-light);
        }

        .tool-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .tool-card:hover::before {
            transform: scaleX(1);
        }

        .tool-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            margin: 0 auto 16px;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
        }

        .tool-card:hover .tool-icon {
            transform: scale(1.05) rotate(5deg);
        }

        .tool-name {
            font-size: 16px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 10px;
        }

        .tool-status {
            font-size: 12px;
            padding: 6px 12px;
            border-radius: 20px;
            display: inline-block;
            font-weight: 600;
        }

        .status-available {
            background: rgba(76, 201, 240, 0.15);
            color: var(--success);
            border: 1px solid rgba(76, 201, 240, 0.2);
        }

        .status-rented {
            background: rgba(249, 65, 68, 0.15);
            color: var(--danger);
            border: 1px solid rgba(249, 65, 68, 0.2);
        }

        .status-maintenance {
            background: rgba(248, 150, 30, 0.15);
            color: var(--warning);
            border: 1px solid rgba(248, 150, 30, 0.2);
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
            
            .dashboard-grid {
                grid-template-columns: 1fr;
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
            
            .search-bar {
                display: none;
            }
            
            .chart-wrapper {
                height: 260px;
            }
            
            .chart-stats {
                flex-wrap: wrap;
                gap: 12px;
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
            
            .chart-period {
                flex-wrap: wrap;
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
                                Selamat Datang, {{ Auth::user()->name }}
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
                                    <div class="stat-value" id="totalAlat">48</div>
                                </div>
                            </div>
                            <div class="welcome-stat">
                                <div class="stat-icon">
                                    <i class="fas fa-handshake"></i>
                                </div>
                                <div class="stat-info">
                                    <h3>Sedang Dipinjam</h3>
                                    <div class="stat-value" id="sedangDipinjam">12</div>
                                </div>
                            </div>
                            <div class="welcome-stat">
                                <div class="stat-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="stat-info">
                                    <h3>Pelanggan Aktif</h3>
                                    <div class="stat-value" id="pelangganAktif">86</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grafik Peminjaman Premium -->
                <div class="chart-container">
                    <div class="chart-header">
                        <div class="chart-title">
                            <i class="fas fa-chart-line"></i>
                            Statistik Peminjaman
                        </div>
                        <div class="chart-period">
                            <button class="period-btn active" data-period="week">Minggu Ini</button>
                            <button class="period-btn" data-period="month">Bulan Ini</button>
                            <button class="period-btn" data-period="year">Tahun Ini</button>
                        </div>
                    </div>
                    <div class="chart-wrapper">
                        <canvas id="loansChart"></canvas>
                    </div>
                    <div class="chart-stats">
                        <div class="chart-stat-item">
                            <div class="chart-stat-label">Total Peminjaman</div>
                            <div class="chart-stat-value" id="totalLoans">0</div>
                        </div>
                        <div class="chart-stat-item">
                            <div class="chart-stat-label">Rata-rata per Hari</div>
                            <div class="chart-stat-value" id="avgPerDay">0</div>
                        </div>
                        <div class="chart-stat-item">
                            <div class="chart-stat-label">Tren</div>
                            <div class="chart-stat-value" id="trend">
                                <i class="fas fa-chart-line"></i>
                                <span>0%</span>
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
                        <div class="activity-list" id="activityList">
                            <!-- Activity items will be populated by JavaScript -->
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h3 class="card-title">Statistik Cepat</h3>
                        </div>
                        <div class="stats-grid" id="statsGrid">
                            <!-- Stats will be populated by JavaScript -->
                        </div>
                    </div>
                </div>

                <!-- Alat Tersedia -->
                <div class="dashboard-card" style="margin-bottom: 0;">
                    <div class="card-header">
                        <h3 class="card-title">Alat Tersedia</h3>
                        <a href="{{ url('/alat') }}" class="card-action">
                            Lihat semua
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>

                    @php
                        $alatList = $alat ?? \App\Models\Alat::latest()->take(6)->get();
                    @endphp

                    <div class="tools-grid" id="toolsGrid">
                        @forelse($alatList as $a)
                        <div class="tool-card" data-tool-id="{{ $a->id_alat }}">
                            <div class="tool-icon">
                                <i class="fas fa-tools"></i>
                            </div>
                            <div class="tool-name">
                                {{ $a->nama_alat }}
                            </div>
                            @php
                                $statusClass = 'status-available';
                                if($a->status == 'dipinjam'){
                                    $statusClass = 'status-rented';
                                } elseif($a->status == 'perbaikan'){
                                    $statusClass = 'status-maintenance';
                                }
                            @endphp
                            <div class="tool-status {{ $statusClass }}">
                                {{ ucfirst($a->status) }}
                            </div>
                        </div>
                        @empty
                            <p style="padding: 20px;">Tidak ada data alat</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Data peminjaman untuk grafik (contoh data - nanti bisa dari database)
        const chartData = {
            week: {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                data: [12, 19, 15, 17, 22, 14, 18],
                total: 117,
                avg: 16.7,
                trend: '+8.2'
            },
            month: {
                labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
                data: [45, 52, 48, 61],
                total: 206,
                avg: 51.5,
                trend: '+15.3'
            },
            year: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
                data: [120, 135, 148, 162, 158, 175, 190, 185, 178, 192, 205, 220],
                total: 2168,
                avg: 180.7,
                trend: '+12.5'
            }
        };

        let currentChart = null;
        let currentPeriod = 'week';

        // Inisialisasi grafik
        function initChart() {
            const ctx = document.getElementById('loansChart').getContext('2d');
            const data = chartData[currentPeriod];
            
            currentChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Jumlah Peminjaman',
                        data: data.data,
                        borderColor: 'rgb(67, 97, 238)',
                        backgroundColor: 'rgba(67, 97, 238, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: 'rgb(67, 97, 238)',
                        pointBorderColor: 'white',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7,
                        pointHoverBackgroundColor: 'rgb(114, 9, 183)'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(26, 26, 46, 0.9)',
                            titleColor: '#fff',
                            bodyColor: '#e2e8f0',
                            borderColor: '#4361ee',
                            borderWidth: 1,
                            callbacks: {
                                label: function(context) {
                                    return `Peminjaman: ${context.raw} kali`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            ticks: {
                                stepSize: 1
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    }
                }
            });
            
            updateChartStats(data);
        }

        // Update statistik grafik
        function updateChartStats(data) {
            document.getElementById('totalLoans').textContent = data.total;
            document.getElementById('avgPerDay').textContent = data.avg;
            
            const trendEl = document.getElementById('trend');
            const trendValue = parseFloat(data.trend);
            trendEl.innerHTML = `
                <i class="fas fa-chart-${trendValue >= 0 ? 'line trend-up' : 'line trend-down'}"></i>
                <span class="${trendValue >= 0 ? 'trend-up' : 'trend-down'}">${trendValue}%</span>
            `;
        }

        // Ganti periode grafik
        function changePeriod(period) {
            currentPeriod = period;
            const data = chartData[period];
            
            if (currentChart) {
                currentChart.data.labels = data.labels;
                currentChart.data.datasets[0].data = data.data;
                currentChart.update();
                updateChartStats(data);
            }
            
            // Update active button style
            document.querySelectorAll('.period-btn').forEach(btn => {
                btn.classList.remove('active');
                if (btn.getAttribute('data-period') === period) {
                    btn.classList.add('active');
                }
            });
        }

        // Data aktivitas
        const activities = [
            { type: 'return', title: 'Pengembalian Alat', desc: 'Budi mengembalikan Bor Listrik', time: '10 menit lalu', icon: 'fa-undo' },
            { type: 'overdue', title: 'Peminjaman Terlambat', desc: 'Gerinda Tangan - 2 hari terlambat', time: '1 jam lalu', icon: 'fa-exclamation-triangle' },
            { type: 'new', title: 'Alat Baru Ditambahkan', desc: 'Kompresor Angin 2PK', time: '2 jam lalu', icon: 'fa-plus-circle' },
            { type: 'rent', title: 'Peminjaman Baru', desc: 'Siti meminjam Tangga Alumunium', time: '3 jam lalu', icon: 'fa-handshake' }
        ];

        // Data statistik
        const stats = [
            { icon: 'fa-check-circle', value: '36', label: 'Alat Tersedia', color: 'success' },
            { icon: 'fa-clock', value: '8', label: 'Akan Kembali', color: 'warning' },
            { icon: 'fa-tools', value: '4', label: 'Perbaikan', color: 'danger' },
            { icon: 'fa-chart-line', value: '+23%', label: 'Pertumbuhan', color: 'primary' }
        ];

        // Render aktivitas
        function renderActivities() {
            const container = document.getElementById('activityList');
            container.innerHTML = activities.map(act => `
                <div class="activity-item">
                    <div class="activity-icon ${act.type}">
                        <i class="fas ${act.icon}"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">${act.title}</div>
                        <div class="activity-desc">${act.desc}</div>
                        <div class="activity-time">${act.time}</div>
                    </div>
                </div>
            `).join('');
        }

        // Render statistik
        function renderStats() {
            const container = document.getElementById('statsGrid');
            container.innerHTML = stats.map(stat => `
                <div class="stat-card">
                    <div class="stat-card-icon">
                        <i class="fas ${stat.icon}"></i>
                    </div>
                    <div class="stat-card-value">${stat.value}</div>
                    <div class="stat-card-label">${stat.label}</div>
                </div>
            `).join('');
        }

        // Animasi angka pada welcome stats
        function animateNumber(element, target, duration = 1000) {
            const start = 0;
            const increment = target / (duration / 16);
            let current = start;
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    element.textContent = target;
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current);
                }
            }, 16);
        }

        // Update real-time data
        function updateRealTimeData() {
            // Simulasi update data real-time
            const randomAvailable = Math.floor(Math.random() * 10) + 32;
            const randomRented = Math.floor(Math.random() * 8) + 8;
            const randomUsers = Math.floor(Math.random() * 20) + 70;
            
            animateNumber(document.getElementById('totalAlat'), randomAvailable);
            animateNumber(document.getElementById('sedangDipinjam'), randomRented);
            animateNumber(document.getElementById('pelangganAktif'), randomUsers);
        }

        // Tool card click effect
        function initToolCards() {
            document.querySelectorAll('.tool-card').forEach(card => {
                card.addEventListener('click', function() {
                    const toolName = this.querySelector('.tool-name').textContent;
                    const status = this.querySelector('.tool-status').textContent;
                    
                    // Create toast notification
                    const toast = document.createElement('div');
                    toast.textContent = `${toolName} - ${status}`;
                    toast.style.cssText = `
                        position: fixed;
                        bottom: 30px;
                        right: 30px;
                        background: linear-gradient(135deg, var(--primary), var(--secondary));
                        color: white;
                        padding: 12px 24px;
                        border-radius: var(--radius-md);
                        font-weight: 600;
                        z-index: 1000;
                        animation: slideInRight 0.3s ease;
                        box-shadow: var(--shadow-lg);
                    `;
                    
                    document.body.appendChild(toast);
                    
                    setTimeout(() => {
                        toast.style.animation = 'slideOutRight 0.3s ease';
                        setTimeout(() => toast.remove(), 300);
                    }, 2000);
                });
            });
        }

        // Create animated background elements
        function createBackgroundElements() {
            const container = document.getElementById('bgElements');
            for (let i = 0; i < 12; i++) {
                const circle = document.createElement('div');
                circle.className = 'bg-circle';
                
                const size = Math.random() * 150 + 50;
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

        // Initialize all
        document.addEventListener('DOMContentLoaded', function() {
            createBackgroundElements();
            initChart();
            renderActivities();
            renderStats();
            initToolCards();
            
            // Set interval untuk update data real-time
            setInterval(updateRealTimeData, 15000);
            
            // Animasi awal untuk welcome stats
            setTimeout(() => {
                updateRealTimeData();
            }, 500);
        });

        // Period button event listeners
        document.querySelectorAll('.period-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const period = this.getAttribute('data-period');
                changePeriod(period);
            });
        });

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

        // Search functionality
        const searchInput = document.querySelector('.search-input');
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const toolCards = document.querySelectorAll('.tool-card');
                
                toolCards.forEach(card => {
                    const toolName = card.querySelector('.tool-name').textContent.toLowerCase();
                    if (toolName.includes(searchTerm)) {
                        card.style.display = '';
                        card.style.animation = 'fadeInUp 0.3s ease forwards';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        }

        // User menu click
        const userMenu = document.querySelector('.user-menu');
        if (userMenu) {
            userMenu.addEventListener('click', function() {
                alert('Fitur user menu akan ditampilkan di sini');
            });
        }

        // Notification click
        const notificationBtn = document.querySelector('.notification-btn');
        if (notificationBtn) {
            notificationBtn.addEventListener('click', function() {
                alert('Notifikasi akan ditampilkan di sini');
            });
        }

        // Keyboard shortcut
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                if (searchInput) searchInput.focus();
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