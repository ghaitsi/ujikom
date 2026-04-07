<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Forent') }} — Smart Tool Rental Platform</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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
            --bg-gradient-start: #f5f7fa;
            --bg-gradient-end: #e4e8f0;
            --text-primary: #1a1a2e;
            --text-secondary: #6c757d;
            --border-color: rgba(67, 97, 238, 0.1);
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.12);
            --shadow-lg: 0 10px 40px rgba(0, 0, 0, 0.15);
            --radius-sm: 10px;
            --radius-md: 16px;
            --radius-lg: 24px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Dark Theme Variables */
        [data-theme="dark"] {
            --primary: #5f7ef2;
            --primary-dark: #4a6ae0;
            --primary-light: #6c8df5;
            --secondary: #8b5cf6;
            --accent: #f43f8e;
            --success: #5fd9ff;
            --warning: #faa543;
            --danger: #fc5a5e;
            --dark: #e5e7eb;
            --darker: #f3f4f6;
            --light: #1f2937;
            --gray: #9ca3af;
            --gray-light: #374151;
            --card-bg: rgba(31, 41, 55, 0.95);
            --bg-gradient-start: #0f0f1a;
            --bg-gradient-end: #1a1a2e;
            --text-primary: #f3f4f6;
            --text-secondary: #9ca3af;
            --border-color: rgba(95, 126, 242, 0.2);
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.3);
            --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.4);
            --shadow-lg: 0 10px 40px rgba(0, 0, 0, 0.5);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, var(--bg-gradient-start) 0%, var(--bg-gradient-end) 100%);
            color: var(--text-primary);
            min-height: 100vh;
            overflow-x: hidden;
            transition: var(--transition);
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

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-4px); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes cardEntrance {
            from { opacity: 0; transform: translateY(40px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* Main Container */
        .app-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Glass Header */
        .header {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(20px);
            padding: 0 48px;
            height: 80px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 100;
            transition: var(--transition);
        }

        [data-theme="dark"] .header {
            background: rgba(31, 41, 55, 0.92);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 22px;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
        }

        .logo-text {
            font-size: 26px;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nav-links {
            display: flex;
            gap: 12px;
            margin-right: 16px;
        }

        .nav-link {
            padding: 8px 20px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            border-radius: 40px;
            transition: var(--transition);
            background: transparent;
            color: var(--text-secondary);
        }

        .nav-link:hover {
            color: var(--primary);
            background: rgba(67, 97, 238, 0.08);
        }

        .btn-login {
            background: transparent;
            border: 2px solid var(--primary-light);
            color: var(--primary);
        }

        .btn-login:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .btn-register {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.4);
        }

        /* Theme Toggle Button */
        .theme-toggle {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: rgba(67, 97, 238, 0.1);
            border: 1px solid var(--border-color);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            font-size: 20px;
            color: var(--primary);
        }

        .theme-toggle:hover {
            transform: rotate(15deg);
            background: rgba(67, 97, 238, 0.2);
        }

        /* Content */
        .content-wrapper {
            max-width: 1400px;
            margin: 0 auto;
            padding: 48px 40px;
            width: 100%;
        }

        /* Premium Hero Section */
        .hero-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            margin-bottom: 80px;
            animation: fadeInUp 0.8s ease;
        }

        .hero-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(67, 97, 238, 0.1);
            padding: 8px 20px;
            border-radius: 40px;
            width: fit-content;
            margin-bottom: 24px;
            font-size: 14px;
            font-weight: 600;
            color: var(--primary);
        }

        .hero-badge i {
            font-size: 14px;
        }

        .hero-title {
            font-size: 52px;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 24px;
            color: var(--text-primary);
        }

        .hero-title-gradient {
            background: linear-gradient(135deg, var(--primary), var(--secondary), var(--accent));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .hero-description {
            font-size: 18px;
            line-height: 1.6;
            color: var(--text-secondary);
            margin-bottom: 32px;
            max-width: 90%;
        }

        .hero-stats {
            display: flex;
            gap: 32px;
            margin-bottom: 40px;
        }

        .hero-stat {
            text-align: center;
        }

        .hero-stat-number {
            font-size: 36px;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            line-height: 1;
        }

        .hero-stat-label {
            font-size: 14px;
            color: var(--text-secondary);
            font-weight: 500;
            margin-top: 8px;
        }

        .hero-buttons {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 32px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
            border: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(67, 97, 238, 0.4);
        }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 32px;
            background: transparent;
            color: var(--primary);
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            transition: var(--transition);
            border: 2px solid var(--primary-light);
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            transform: translateY(-3px);
        }

        /* Hero Visual */
        .hero-visual {
            background: linear-gradient(135deg, rgba(67, 97, 238, 0.05), rgba(114, 9, 183, 0.05));
            border-radius: var(--radius-lg);
            padding: 40px;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: cardEntrance 0.8s ease;
        }

        .visual-card {
            background: var(--card-bg);
            border-radius: var(--radius-md);
            padding: 32px;
            box-shadow: var(--shadow-lg);
            width: 100%;
            max-width: 380px;
            border: 1px solid rgba(255,255,255,0.3);
            backdrop-filter: blur(10px);
            transition: var(--transition);
        }

        .forent-logo-big {
            text-align: center;
            margin-bottom: 24px;
        }

        .forent-logo-big span {
            font-size: 32px;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .tool-stats-mini {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
            padding: 16px 0;
            border-top: 1px solid var(--border-color);
            border-bottom: 1px solid var(--border-color);
        }

        .tool-stats-mini div {
            text-align: center;
        }

        .tool-stats-mini .number {
            font-size: 24px;
            font-weight: 800;
            color: var(--primary);
        }

        .activity-preview {
            margin-top: 20px;
        }

        .activity-preview-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            font-size: 13px;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-secondary);
        }

        .activity-preview-item:last-child {
            border-bottom: none;
        }

        .activity-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--success);
        }

        .activity-dot.warning {
            background: var(--warning);
        }

        /* Dashboard Cards Grid */
        .section-title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 32px;
            position: relative;
            display: inline-block;
            color: var(--text-primary);
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 2px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
            gap: 30px;
            margin-bottom: 60px;
        }

        .dashboard-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            padding: 28px;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
        }

        .dashboard-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-light);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 2px solid var(--border-color);
        }

        .card-title {
            font-size: 20px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-primary);
        }

        .card-title i {
            color: var(--primary);
            font-size: 22px;
        }

        .card-action {
            color: var(--primary);
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: var(--transition);
        }

        .card-action:hover {
            color: var(--secondary);
            transform: translateX(4px);
        }

        /* Activity List */
        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 12px;
            border-radius: var(--radius-sm);
            transition: var(--transition);
            background: rgba(248, 249, 250, 0.6);
        }

        [data-theme="dark"] .activity-item {
            background: rgba(55, 65, 81, 0.6);
        }

        .activity-item:hover {
            background: var(--card-bg);
            transform: translateX(4px);
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

        .activity-icon.return { background: linear-gradient(135deg, var(--success), #2c9c8c); }
        .activity-icon.overdue { background: linear-gradient(135deg, var(--warning), #e67e22); }
        .activity-icon.rent { background: linear-gradient(135deg, var(--primary), var(--secondary)); }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 4px;
            color: var(--text-primary);
        }

        .activity-desc {
            font-size: 13px;
            color: var(--text-secondary);
            margin-bottom: 4px;
        }

        .activity-time {
            font-size: 11px;
            color: var(--primary);
            font-weight: 500;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .stat-card {
            background: rgba(248, 249, 250, 0.8);
            border-radius: var(--radius-md);
            padding: 20px;
            text-align: center;
            transition: var(--transition);
        }

        [data-theme="dark"] .stat-card {
            background: rgba(55, 65, 81, 0.6);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            background: var(--card-bg);
            box-shadow: var(--shadow-sm);
        }

        .stat-card-value {
            font-size: 32px;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .stat-card-label {
            font-size: 13px;
            color: var(--text-secondary);
            margin-top: 8px;
        }

        /* Tools Grid Preview */
        .tools-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 16px;
        }

        .tool-card {
            background: rgba(248, 249, 250, 0.6);
            border-radius: var(--radius-md);
            padding: 20px;
            text-align: center;
            transition: var(--transition);
            cursor: pointer;
        }

        [data-theme="dark"] .tool-card {
            background: rgba(55, 65, 81, 0.6);
        }

        .tool-card:hover {
            transform: translateY(-4px);
            background: var(--card-bg);
            box-shadow: var(--shadow-sm);
        }

        .tool-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            margin: 0 auto 12px;
        }

        .tool-name {
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 8px;
            color: var(--text-primary);
        }

        .tool-status {
            font-size: 12px;
            padding: 4px 12px;
            border-radius: 20px;
            display: inline-block;
            font-weight: 600;
        }

        .status-available {
            background: rgba(76, 201, 240, 0.15);
            color: var(--success);
        }

        .status-rented {
            background: rgba(249, 65, 68, 0.15);
            color: var(--danger);
        }

        /* Feature Section */
        .features-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin: 60px 0;
        }

        .feature-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            padding: 32px;
            text-align: center;
            transition: var(--transition);
            backdrop-filter: blur(10px);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 28px;
            margin: 0 auto 20px;
        }

        .feature-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--text-primary);
        }

        .feature-desc {
            color: var(--text-secondary);
            line-height: 1.5;
        }

        /* Footer */
        .footer {
            background: var(--darker);
            color: white;
            padding: 48px 40px 32px;
            margin-top: 60px;
            transition: var(--transition);
        }

        [data-theme="dark"] .footer {
            background: #111827;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 24px;
        }

        .footer-links {
            display: flex;
            gap: 32px;
        }

        .footer-links a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: var(--transition);
        }

        .footer-links a:hover {
            color: var(--primary-light);
        }

        .copyright {
            text-align: center;
            margin-top: 40px;
            padding-top: 24px;
            border-top: 1px solid rgba(255,255,255,0.1);
            color: rgba(255,255,255,0.5);
            font-size: 13px;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .hero-section {
                grid-template-columns: 1fr;
                gap: 40px;
            }
            .hero-title {
                font-size: 42px;
            }
            .content-wrapper {
                padding: 32px 24px;
            }
            .header {
                padding: 0 24px;
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 32px;
            }
            .hero-description {
                max-width: 100%;
            }
            .hero-stats {
                flex-wrap: wrap;
                gap: 20px;
            }
            .nav-links {
                display: none;
            }
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
            .stats-grid {
                grid-template-columns: 1fr;
            }
            .footer-content {
                flex-direction: column;
                text-align: center;
            }
            .footer-links {
                flex-wrap: wrap;
                justify-content: center;
            }
        }
    </style>
</head>
<body>

<div class="bg-elements">
    <div class="bg-circle" style="width: 300px; height: 300px; top: -100px; right: -100px;"></div>
    <div class="bg-circle" style="width: 500px; height: 500px; bottom: -200px; left: -150px; animation-duration: 25s;"></div>
    <div class="bg-circle" style="width: 200px; height: 200px; top: 40%; left: 20%; animation-duration: 18s;"></div>
</div>

<div class="app-container">
    <!-- Header with Login/Register & Theme Toggle -->
    <header class="header">
        <div class="logo">
            <div class="logo-icon">F</div>
            <div class="logo-text">Forent</div>
        </div>
        <div class="header-actions">
            <div class="nav-links">
                <a href="#" class="nav-link">Features</a>
                <a href="#" class="nav-link">How it works</a>
                <a href="#" class="nav-link">Pricing</a>
            </div>
            <button class="theme-toggle" id="themeToggle" aria-label="Toggle dark mode">
                <i class="fas fa-moon"></i>
            </button>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="nav-link btn-register" style="background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white;">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="nav-link btn-login">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="nav-link btn-register">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </header>

    <main class="content-wrapper">
        <!-- Hero Section -->
        <div class="hero-section">
            <div class="hero-content">
                <div class="hero-badge">
                    <i class="fas fa-bolt"></i>
                    <span>Smart Rental Management Platform</span>
                </div>
                <h1 class="hero-title">
                    Kelola Peminjaman Alat<br>
                    <span class="hero-title-gradient">dengan Mudah & Efisien</span>
                </h1>
                <p class="hero-description">
                    Forent membantu Anda mengelola inventaris alat, melacak peminjaman, 
                    dan memantau pengembalian secara real-time. Solusi lengkap untuk bisnis rental modern.
                </p>
                <div class="hero-stats">
                    <div class="hero-stat">
                        <div class="hero-stat-number">36+</div>
                        <div class="hero-stat-label">Alat Tersedia</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-number">8</div>
                        <div class="hero-stat-label">Akan Kembali</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-number">24/7</div>
                        <div class="hero-stat-label">Monitoring</div>
                    </div>
                </div>
                <div class="hero-buttons">
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-primary">
                            <i class="fas fa-rocket"></i> Mulai Sekarang
                        </a>
                    @endif
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="btn-outline">
                            <i class="fas fa-chart-line"></i> Lihat Dashboard
                        </a>
                    @endif
                </div>
            </div>
            <div class="hero-visual">
                <div class="visual-card">
                    <div class="forent-logo-big">
                        <span>FORENT</span>
                        <p style="font-size: 12px; color: var(--text-secondary); margin-top: 4px;">Rental Management</p>
                    </div>
                    <div class="tool-stats-mini">
                        <div>
                            <div class="number">36</div>
                            <div style="font-size: 11px;">Alat Tersedia</div>
                        </div>
                        <div>
                            <div class="number">8</div>
                            <div style="font-size: 11px;">Akan Kembali</div>
                        </div>
                        <div>
                            <div class="number">24</div>
                            <div style="font-size: 11px;">Active</div>
                        </div>
                    </div>
                    <div class="activity-preview">
                        <div class="activity-preview-item">
                            <div class="activity-dot"></div>
                            <span><strong>Budi</strong> mengembalikan Bor Listrik</span>
                            <span style="margin-left: auto; font-size: 10px;">10 menit lalu</span>
                        </div>
                        <div class="activity-preview-item">
                            <div class="activity-dot warning"></div>
                            <span><strong>Gerinda Tangan</strong> - 2 hari terlambat</span>
                            <span style="margin-left: auto; font-size: 10px;">1 jam lalu</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dashboard Preview Cards -->
        <div class="dashboard-grid">
            <!-- Aktivitas Terbaru Card -->
            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-clock"></i>
                        Aktivitas Terbaru
                    </div>
                    <a href="{{ route('login') }}" class="card-action">Lihat semua <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-icon return">
                            <i class="fas fa-undo-alt"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">Pengembalian Alat</div>
                            <div class="activity-desc">Budi mengembalikan Bor Listrik</div>
                            <div class="activity-time">10 menit yang lalu</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon overdue">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">Peminjaman Terlambat</div>
                            <div class="activity-desc">Gerinda Tangan - 2 hari terlambat</div>
                            <div class="activity-time">1 jam yang lalu</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon rent">
                            <i class="fas fa-hand-holding"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">Peminjaman Baru</div>
                            <div class="activity-desc">Mesin Bor - dipinjam oleh Ani</div>
                            <div class="activity-time">3 jam yang lalu</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistik Cepat Card -->
            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-chart-pie"></i>
                        Statistik Cepat
                    </div>
                    <a href="{{ route('login') }}" class="card-action">Detail <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-card-value">36</div>
                        <div class="stat-card-label">Alat Tersedia</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-value">8</div>
                        <div class="stat-card-label">Akan Kembali</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-value">12</div>
                        <div class="stat-card-label">Sedang Dipinjam</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-value">94%</div>
                        <div class="stat-card-label">Tingkat Pengembalian</div>
                    </div>
                </div>
            </div>

            <!-- Alat Populer Card -->
            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-tools"></i>
                        Alat Populer
                    </div>
                    <a href="{{ route('login') }}" class="card-action">Kelola <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="tools-grid">
                    <div class="tool-card">
                        <div class="tool-icon"><i class="fas fa-drill"></i></div>
                        <div class="tool-name">Bor Listrik</div>
                        <div class="tool-status status-available">Tersedia</div>
                    </div>
                    <div class="tool-card">
                        <div class="tool-icon"><i class="fas fa-angle-double-up"></i></div>
                        <div class="tool-name">Gerinda Tangan</div>
                        <div class="tool-status status-rented">Dipinjam</div>
                    </div>
                    <div class="tool-card">
                        <div class="tool-icon"><i class="fas fa-gavel"></i></div>
                        <div class="tool-name">Mesin Bor</div>
                        <div class="tool-status status-available">Tersedia</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="features-section">
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
                <h3 class="feature-title">Real-time Monitoring</h3>
                <p class="feature-desc">Pantau status peminjaman dan ketersediaan alat secara langsung dengan dashboard interaktif.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-bell"></i></div>
                <h3 class="feature-title">Smart Notifikasi</h3>
                <p class="feature-desc">Dapatkan notifikasi otomatis untuk pengembalian terlambat dan aktivitas penting lainnya.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-chart-simple"></i></div>
                <h3 class="feature-title">Laporan Lengkap</h3>
                <p class="feature-desc">Analisis data peminjaman, generate laporan, dan optimalkan manajemen inventaris Anda.</p>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="logo">
                <div class="logo-icon" style="background: white; color: var(--primary);">F</div>
                <div style="font-weight: 700; font-size: 20px;">Forent</div>
            </div>
            <div class="footer-links">
                @if (Route::has('login'))
                    <a href="{{ route('login') }}">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endif
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Contact</a>
            </div>
        </div>
        <div class="copyright">
            &copy; 2025 Forent - Smart Tool Rental Management Platform. All rights reserved.
        </div>
    </footer>
</div>

<script>
    // Dark Mode Toggle Functionality
    (function() {
        const themeToggle = document.getElementById('themeToggle');
        const icon = themeToggle.querySelector('i');
        
        // Check for saved theme preference
        const savedTheme = localStorage.getItem('forent-theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        
        if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
            document.documentElement.setAttribute('data-theme', 'dark');
            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');
        } else {
            document.documentElement.setAttribute('data-theme', 'light');
            icon.classList.remove('fa-sun');
            icon.classList.add('fa-moon');
        }
        
        // Toggle theme on click
        themeToggle.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            
            if (currentTheme === 'dark') {
                document.documentElement.setAttribute('data-theme', 'light');
                localStorage.setItem('forent-theme', 'light');
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
            } else {
                document.documentElement.setAttribute('data-theme', 'dark');
                localStorage.setItem('forent-theme', 'dark');
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            }
        });
    })();
</script>

</body>
</html>