<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'LibSpace') }} — Digital Library & Book Borrowing Platform</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        :root {
            --primary: #8B5CF6;
            --primary-dark: #7C3AED;
            --primary-light: #A78BFA;
            --secondary: #F59E0B;
            --accent: #EC4899;
            --success: #10B981;
            --warning: #F59E0B;
            --danger: #EF4444;
            --dark: #1E1B4B;
            --darker: #0F172A;
            --light: #F8FAFC;
            --gray: #64748B;
            --gray-light: #E2E8F0;
            --card-bg: rgba(255, 255, 255, 0.98);
            --bg-gradient-start: #F8FAFC;
            --bg-gradient-end: #E0E7FF;
            --text-primary: #1E1B4B;
            --text-secondary: #64748B;
            --border-color: rgba(139, 92, 246, 0.15);
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 10px 40px rgba(0, 0, 0, 0.12);
            --radius-sm: 12px;
            --radius-md: 20px;
            --radius-lg: 28px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            /* Footer variables */
            --footer-bg: #0F172A;
            --footer-text: rgba(255, 255, 255, 0.9);
            --footer-text-muted: rgba(255, 255, 255, 0.6);
            --footer-border: rgba(255, 255, 255, 0.1);
        }

        [data-theme="dark"] {
            --primary: #A78BFA;
            --primary-dark: #8B5CF6;
            --primary-light: #C4B5FD;
            --secondary: #FBBF24;
            --accent: #F472B6;
            --success: #34D399;
            --warning: #FBBF24;
            --danger: #F87171;
            --dark: #F3E8FF;
            --darker: #E9D5FF;
            --light: #1E1B4B;
            --gray: #94A3B8;
            --gray-light: #334155;
            --card-bg: rgba(30, 27, 75, 0.95);
            --bg-gradient-start: #0F172A;
            --bg-gradient-end: #1E1B4B;
            --text-primary: #F3E8FF;
            --text-secondary: #C4B5FD;
            --border-color: rgba(139, 92, 246, 0.25);
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.3);
            --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.4);
            --shadow-lg: 0 10px 40px rgba(0, 0, 0, 0.5);
            /* Footer dark theme */
            --footer-bg: #0B0F19;
            --footer-text: #F3E8FF;
            --footer-text-muted: #A78BFA;
            --footer-border: rgba(139, 92, 246, 0.2);
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

        /* Animated Books Background */
        .bg-elements {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .floating-book {
            position: absolute;
            opacity: 0.06;
            animation: floatBook 25s infinite linear;
        }

        @keyframes floatBook {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(80px, 60px) rotate(5deg); }
            50% { transform: translate(40px, 120px) rotate(-3deg); }
            75% { transform: translate(-60px, 40px) rotate(8deg); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes cardEntrance {
            from { opacity: 0; transform: translateY(50px) scale(0.95); }
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
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 0 48px;
            height: 80px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid var(--border-color);
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 100;
            transition: var(--transition);
        }

        [data-theme="dark"] .header {
            background: rgba(30, 27, 75, 0.95);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 22px;
            font-weight: 700;
            box-shadow: 0 6px 15px rgba(139, 92, 246, 0.3);
        }

        .logo-text {
            font-size: 28px;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-family: 'Playfair Display', serif;
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
            background: rgba(139, 92, 246, 0.1);
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
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(139, 92, 246, 0.4);
        }

        .theme-toggle {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: rgba(139, 92, 246, 0.1);
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
            background: rgba(139, 92, 246, 0.2);
        }

        .content-wrapper {
            max-width: 1400px;
            margin: 0 auto;
            padding: 48px 40px;
            width: 100%;
        }

        /* Hero Section - Book Themed */
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
            gap: 10px;
            background: rgba(139, 92, 246, 0.12);
            padding: 10px 22px;
            border-radius: 50px;
            width: fit-content;
            margin-bottom: 28px;
            font-size: 14px;
            font-weight: 600;
            color: var(--primary);
            backdrop-filter: blur(10px);
        }

        .hero-title {
            font-size: 56px;
            font-weight: 800;
            line-height: 1.15;
            margin-bottom: 28px;
            color: var(--text-primary);
            font-family: 'Playfair Display', serif;
        }

        .hero-title-gradient {
            background: linear-gradient(135deg, var(--primary), var(--secondary), var(--accent));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .hero-description {
            font-size: 18px;
            line-height: 1.7;
            color: var(--text-secondary);
            margin-bottom: 36px;
            max-width: 90%;
        }

        .hero-stats {
            display: flex;
            gap: 40px;
            margin-bottom: 45px;
        }

        .hero-stat {
            text-align: center;
        }

        .hero-stat-number {
            font-size: 38px;
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
            gap: 18px;
            flex-wrap: wrap;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 15px 36px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            text-decoration: none;
            border-radius: 60px;
            font-weight: 700;
            font-size: 16px;
            transition: var(--transition);
            box-shadow: 0 6px 20px rgba(139, 92, 246, 0.35);
            border: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(139, 92, 246, 0.45);
        }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 15px 36px;
            background: transparent;
            color: var(--primary);
            text-decoration: none;
            border-radius: 60px;
            font-weight: 700;
            font-size: 16px;
            transition: var(--transition);
            border: 2px solid var(--primary-light);
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            transform: translateY(-4px);
        }

        /* Book Visual Card */
        .hero-visual {
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.06), rgba(245, 158, 11, 0.06));
            border-radius: var(--radius-lg);
            padding: 30px;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: cardEntrance 0.8s ease;
        }

        .book-visual-card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 30px;
            box-shadow: var(--shadow-lg);
            width: 100%;
            max-width: 380px;
            border: 1px solid rgba(139, 92, 246, 0.2);
            position: relative;
            transition: var(--transition);
        }

        .book-visual-card::before {
            content: '';
            position: absolute;
            left: 20px;
            top: 20px;
            bottom: 20px;
            width: 4px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 4px;
            opacity: 0.6;
        }

        .libspace-logo-big {
            text-align: center;
            margin-bottom: 20px;
        }

        .libspace-logo-big span {
            font-size: 34px;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-family: 'Playfair Display', serif;
        }

        .book-cover-preview {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 16px;
            padding: 25px;
            text-align: center;
            margin: 20px 0;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .book-cover-preview i {
            font-size: 48px;
            margin-bottom: 12px;
            display: block;
        }

        .book-cover-preview h4 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .book-cover-preview p {
            font-size: 12px;
            opacity: 0.9;
        }

        .book-stats-mini {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
            padding: 16px 0;
            border-top: 1px solid var(--border-color);
            border-bottom: 1px solid var(--border-color);
        }

        .book-stats-mini div {
            text-align: center;
        }

        .book-stats-mini .number {
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

        /* Dashboard Cards */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin-bottom: 60px;
        }

        .dashboard-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            padding: 28px;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            border: 1px solid rgba(139, 92, 246, 0.15);
            backdrop-filter: blur(10px);
        }

        .dashboard-card:hover {
            transform: translateY(-8px);
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
            gap: 12px;
            color: var(--text-primary);
        }

        .card-title i {
            color: var(--primary);
            font-size: 24px;
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
            transform: translateX(5px);
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
            background: rgba(139, 92, 246, 0.04);
        }

        .activity-item:hover {
            background: rgba(139, 92, 246, 0.08);
            transform: translateX(5px);
        }

        .activity-icon {
            width: 42px;
            height: 42px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            flex-shrink: 0;
        }

        .activity-icon.return { background: linear-gradient(135deg, var(--success), #059669); }
        .activity-icon.overdue { background: linear-gradient(135deg, var(--warning), #D97706); }
        .activity-icon.borrow { background: linear-gradient(135deg, var(--primary), var(--secondary)); }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-weight: 700;
            font-size: 15px;
            margin-bottom: 5px;
            color: var(--text-primary);
        }

        .activity-desc {
            font-size: 13px;
            color: var(--text-secondary);
            margin-bottom: 5px;
        }

        .activity-time {
            font-size: 11px;
            color: var(--primary);
            font-weight: 600;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .stat-card {
            background: rgba(139, 92, 246, 0.05);
            border-radius: var(--radius-md);
            padding: 20px;
            text-align: center;
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            background: rgba(139, 92, 246, 0.1);
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
            font-weight: 500;
        }

        /* Books Grid */
        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 16px;
        }

        .book-card {
            background: rgba(139, 92, 246, 0.05);
            border-radius: var(--radius-md);
            padding: 20px;
            text-align: center;
            transition: var(--transition);
            cursor: pointer;
            position: relative;
        }

        .book-card:hover {
            transform: translateY(-6px);
            background: rgba(139, 92, 246, 0.1);
            box-shadow: var(--shadow-md);
        }

        .book-cover-mini {
            width: 70px;
            height: 90px;
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 28px;
            margin: 0 auto 12px;
            box-shadow: var(--shadow-sm);
        }

        .book-name {
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 8px;
            color: var(--text-primary);
        }

        .book-author {
            font-size: 11px;
            color: var(--text-secondary);
            margin-bottom: 10px;
        }

        .book-status {
            font-size: 11px;
            padding: 4px 12px;
            border-radius: 20px;
            display: inline-block;
            font-weight: 600;
        }

        .status-available {
            background: rgba(16, 185, 129, 0.15);
            color: var(--success);
        }

        .status-borrowed {
            background: rgba(239, 68, 68, 0.15);
            color: var(--danger);
        }

        /* Features Section */
        .features-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin: 60px 0;
        }

        .feature-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            padding: 35px 30px;
            text-align: center;
            transition: var(--transition);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(139, 92, 246, 0.1);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-light);
        }

        .feature-icon {
            width: 75px;
            height: 75px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 32px;
            margin: 0 auto 22px;
            box-shadow: 0 8px 20px rgba(139, 92, 246, 0.3);
        }

        .feature-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 14px;
            color: var(--text-primary);
        }

        .feature-desc {
            color: var(--text-secondary);
            line-height: 1.6;
        }

        /* Book Categories Section */
        .categories-section {
            margin: 60px 0 40px;
        }

        .section-title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 32px;
            position: relative;
            display: inline-block;
            color: var(--text-primary);
            font-family: 'Playfair Display', serif;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 70px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 2px;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .category-card {
            background: var(--card-bg);
            border-radius: var(--radius-md);
            padding: 25px 20px;
            text-align: center;
            transition: var(--transition);
            cursor: pointer;
            border: 1px solid rgba(139, 92, 246, 0.1);
        }

        .category-card:hover {
            transform: translateY(-5px);
            background: rgba(139, 92, 246, 0.08);
            border-color: var(--primary-light);
        }

        .category-icon {
            font-size: 40px;
            color: var(--primary);
            margin-bottom: 12px;
        }

        .category-name {
            font-weight: 700;
            font-size: 16px;
            color: var(--text-primary);
        }

        .category-count {
            font-size: 12px;
            color: var(--text-secondary);
            margin-top: 6px;
        }

        /* Footer - FIXED for dark mode */
        .footer {
            background: var(--footer-bg);
            color: var(--footer-text);
            padding: 50px 40px 35px;
            margin-top: 60px;
            transition: var(--transition);
            border-top: 1px solid var(--footer-border);
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

        .footer .logo-text {
            background: linear-gradient(135deg, var(--primary-light), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .footer .logo-icon {
            background: linear-gradient(135deg, var(--primary-light), var(--secondary));
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.4);
        }

        .footer-links {
            display: flex;
            gap: 35px;
            flex-wrap: wrap;
        }

        .footer-links a {
            color: var(--footer-text-muted);
            text-decoration: none;
            transition: var(--transition);
            font-weight: 500;
        }

        .footer-links a:hover {
            color: var(--primary-light);
            transform: translateY(-2px);
        }

        .copyright {
            text-align: center;
            margin-top: 45px;
            padding-top: 28px;
            border-top: 1px solid var(--footer-border);
            color: var(--footer-text-muted);
            font-size: 13px;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .hero-section {
                grid-template-columns: 1fr;
                gap: 50px;
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
                gap: 25px;
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
                justify-content: center;
            }
            .categories-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>

<div class="bg-elements">
    <i class="fas fa-book floating-book" style="font-size: 120px; top: 10%; left: -30px; animation-duration: 20s;"></i>
    <i class="fas fa-book-open floating-book" style="font-size: 90px; bottom: 15%; right: -20px; animation-duration: 25s;"></i>
    <i class="fas fa-graduation-cap floating-book" style="font-size: 100px; top: 40%; left: 80%; animation-duration: 22s;"></i>
    <i class="fas fa-library floating-book" style="font-size: 130px; bottom: 5%; left: 10%; animation-duration: 28s;"></i>
</div>

<div class="app-container">
    <header class="header">
        <div class="logo">
            <div class="logo-icon"><i class="fas fa-book-open"></i></div>
            <div class="logo-text">LibSpace</div>
        </div>
        <div class="header-actions">
            <div class="nav-links">
                <a href="#" class="nav-link">Catalog</a>
                <a href="#" class="nav-link">Genres</a>
                <a href="#" class="nav-link">Best Sellers</a>
                <a href="#" class="nav-link">About</a>
            </div>
            <button class="theme-toggle" id="themeToggle">
                <i class="fas fa-moon"></i>
            </button>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="nav-link btn-register">Dashboard</a>
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
                    <i class="fas fa-feather-alt"></i>
                    <span>Discover Your Next Adventure</span>
                </div>
                <h1 class="hero-title">
                    Digital Library<br>
                    <span class="hero-title-gradient">Borrow Books Instantly</span>
                </h1>
                <p class="hero-description">
                    LibSpace is your gateway to thousands of books. Borrow, read, and return with ease. 
                    Modern library management for the digital age.
                </p>
                <div class="hero-stats">
                    <div class="hero-stat">
                        <div class="hero-stat-number">5,000+</div>
                        <div class="hero-stat-label">Books Available</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-number">1,284</div>
                        <div class="hero-stat-label">Active Members</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-number">156</div>
                        <div class="hero-stat-label">Borrowed Now</div>
                    </div>
                </div>
                <div class="hero-buttons">
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-primary">
                            <i class="fas fa-book-reader"></i> Start Reading
                        </a>
                    @endif
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="btn-outline">
                            <i class="fas fa-search"></i> Explore Books
                        </a>
                    @endif
                </div>
            </div>
            <div class="hero-visual">
                <div class="book-visual-card">
                    <div class="libspace-logo-big">
                        <span>LIBSPACE</span>
                        <p style="font-size: 11px; color: var(--text-secondary); margin-top: 6px;">Digital Library</p>
                    </div>
                    <div class="book-cover-preview">
                        <i class="fas fa-book"></i>
                        <h4>"The Great Gatsby"</h4>
                        <p>F. Scott Fitzgerald</p>
                    </div>
                    <div class="book-stats-mini">
                        <div>
                            <div class="number">5,000+</div>
                            <div style="font-size: 11px;">Total Books</div>
                        </div>
                        <div>
                            <div class="number">48</div>
                            <div style="font-size: 11px;">Due This Week</div>
                        </div>
                        <div>
                            <div class="number">24</div>
                            <div style="font-size: 11px;">New Arrivals</div>
                        </div>
                    </div>
                    <div class="activity-preview">
                        <div class="activity-preview-item">
                            <div class="activity-dot"></div>
                            <span><strong>Emma Watson</strong> returned "Becoming"</span>
                            <span style="margin-left: auto; font-size: 10px;">5 min ago</span>
                        </div>
                        <div class="activity-preview-item">
                            <div class="activity-dot warning"></div>
                            <span><strong>"1984"</strong> - overdue by 2 days</span>
                            <span style="margin-left: auto; font-size: 10px;">1 hour ago</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dashboard Cards -->
        <div class="dashboard-grid">
            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-history"></i>
                        Recent Activity
                    </div>
                    <a href="{{ route('login') }}" class="card-action">View All <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-icon return">
                            <i class="fas fa-undo-alt"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">Book Returned</div>
                            <div class="activity-desc">Emma returned "Atomic Habits"</div>
                            <div class="activity-time">10 minutes ago</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon overdue">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">Overdue Notice</div>
                            <div class="activity-desc">"The Midnight Library" - 2 days late</div>
                            <div class="activity-time">1 hour ago</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon borrow">
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">New Borrowing</div>
                            <div class="activity-desc">Michael borrowed "Deep Work"</div>
                            <div class="activity-time">3 hours ago</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-chart-line"></i>
                        Library Stats
                    </div>
                    <a href="{{ route('login') }}" class="card-action">Details <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-card-value">5,284</div>
                        <div class="stat-card-label">Total Books</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-value">48</div>
                        <div class="stat-card-label">Due Soon</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-value">156</div>
                        <div class="stat-card-label">Currently Borrowed</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-value">94%</div>
                        <div class="stat-card-label">Return Rate</div>
                    </div>
                </div>
            </div>

            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-star"></i>
                        Popular Books
                    </div>
                    <a href="{{ route('login') }}" class="card-action">Browse <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="books-grid">
                    <div class="book-card">
                        <div class="book-cover-mini"><i class="fas fa-book"></i></div>
                        <div class="book-name">Atomic Habits</div>
                        <div class="book-author">James Clear</div>
                        <div class="book-status status-available">Available</div>
                    </div>
                    <div class="book-card">
                        <div class="book-cover-mini"><i class="fas fa-book-open"></i></div>
                        <div class="book-name">The Midnight Library</div>
                        <div class="book-author">Matt Haig</div>
                        <div class="book-status status-borrowed">Borrowed</div>
                    </div>
                    <div class="book-card">
                        <div class="book-cover-mini"><i class="fas fa-graduation-cap"></i></div>
                        <div class="book-name">Deep Work</div>
                        <div class="book-author">Cal Newport</div>
                        <div class="book-status status-available">Available</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Book Categories Section -->
        <div class="categories-section">
            <h2 class="section-title">Browse by Genre</h2>
            <div class="categories-grid">
                <div class="category-card">
                    <div class="category-icon"><i class="fas fa-robot"></i></div>
                    <div class="category-name">Fiction</div>
                    <div class="category-count">1,284 books</div>
                </div>
                <div class="category-card">
                    <div class="category-icon"><i class="fas fa-chart-line"></i></div>
                    <div class="category-name">Business</div>
                    <div class="category-count">856 books</div>
                </div>
                <div class="category-card">
                    <div class="category-icon"><i class="fas fa-flask"></i></div>
                    <div class="category-name">Science</div>
                    <div class="category-count">723 books</div>
                </div>
                <div class="category-card">
                    <div class="category-icon"><i class="fas fa-heart"></i></div>
                    <div class="category-name">Romance</div>
                    <div class="category-count">592 books</div>
                </div>
                <div class="category-card">
                    <div class="category-icon"><i class="fas fa-brain"></i></div>
                    <div class="category-name">Psychology</div>
                    <div class="category-count">445 books</div>
                </div>
                <div class="category-card">
                    <div class="category-icon"><i class="fas fa-code"></i></div>
                    <div class="category-name">Technology</div>
                    <div class="category-count">634 books</div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="features-section">
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-infinity"></i></div>
                <h3 class="feature-title">Unlimited Access</h3>
                <p class="feature-desc">Access thousands of books anytime, anywhere. No physical library visits needed.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-bell"></i></div>
                <h3 class="feature-title">Smart Reminders</h3>
                <p class="feature-desc">Get automatic notifications for due dates and never miss returning a book.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-chart-simple"></i></div>
                <h3 class="feature-title">Reading Analytics</h3>
                <p class="feature-desc">Track your reading habits, get personalized recommendations, and achieve your goals.</p>
            </div>
        </div>
    </main>

    <!-- Footer - Enhanced for Dark Mode -->
    <footer class="footer">
        <div class="footer-content">
            <div class="logo">
                <div class="logo-icon"><i class="fas fa-book-open"></i></div>
                <div class="logo-text">LibSpace</div>
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
                <a href="#">Contact Us</a>
                <a href="#">Help Center</a>
            </div>
        </div>
        <div class="copyright">
            &copy; 2025 LibSpace - Digital Library & Book Borrowing Platform. Read, Learn, Grow.
        </div>
    </footer>
</div>

<script>
    // Dark Mode Toggle
    (function() {
        const themeToggle = document.getElementById('themeToggle');
        const icon = themeToggle.querySelector('i');
        
        const savedTheme = localStorage.getItem('libspace-theme');
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
        
        themeToggle.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            
            if (currentTheme === 'dark') {
                document.documentElement.setAttribute('data-theme', 'light');
                localStorage.setItem('libspace-theme', 'light');
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
            } else {
                document.documentElement.setAttribute('data-theme', 'dark');
                localStorage.setItem('libspace-theme', 'dark');
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            }
        });
    })();
</script>

</body>
</html>