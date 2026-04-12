<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Petugas - Aplikasi Peminjaman Alat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* ============================================================ */
        /* ROOT VARIABLES - PREMIUM DARK THEME */
        /* ============================================================ */
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

        /* ============================================================ */
        /* LAYOUT CONTAINER */
        /* ============================================================ */
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

        /* ============================================================ */
        /* HEADER PREMIUM */
        /* ============================================================ */
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

        /* ============================================================ */
        /* SEARCH BAR */
        /* ============================================================ */
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

        /* ============================================================ */
        /* NOTIFICATION BUTTON */
        /* ============================================================ */
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

        /* ============================================================ */
        /* USER MENU */
        /* ============================================================ */
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

        /* ============================================================ */
        /* DATE TIME DISPLAY */
        /* ============================================================ */
        .datetime-display {
            background: rgba(26, 26, 46, 0.6);
            padding: 8px 16px;
            border-radius: var(--radius-lg);
            border: 1px solid rgba(108, 99, 255, 0.2);
            text-align: center;
            margin-right: 10px;
        }

        .datetime-display .time {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary-light);
        }

        .datetime-display .date {
            font-size: 11px;
            color: var(--gray);
        }

        /* ============================================================ */
        /* CONTENT WRAPPER */
        /* ============================================================ */
        .content-wrapper {
            flex: 1;
            padding: 40px;
        }

        /* ============================================================ */
        /* WELCOME SECTION */
        /* ============================================================ */
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

        /* ============================================================ */
        /* BUTTONS */
        /* ============================================================ */
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

        .btn-sm {
            padding: 8px 16px;
            font-size: 13px;
            border-radius: var(--radius-sm);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--accent), #00B894);
            color: white;
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--warning), #FF9E00);
            color: var(--dark);
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger), #FF4757);
            color: white;
        }

        /* ============================================================ */
        /* STATS CARDS */
        /* ============================================================ */
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
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.05), transparent);
            transition: left 0.5s;
        }

        .stat-card:hover::before {
            left: 100%;
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
        .icon-info { background: linear-gradient(135deg, #4CC9F0, #4361EE); }
        .icon-purple { background: linear-gradient(135deg, #9B59B6, #8E44AD); }

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

        /* ============================================================ */
        /* CHART CONTAINER */
        /* ============================================================ */
        .chart-container {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            padding: 20px;
            margin-bottom: 30px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(108, 99, 255, 0.2);
        }

        .chart-title {
            font-size: 18px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .chart-bars {
            display: flex;
            justify-content: space-around;
            align-items: flex-end;
            height: 250px;
            gap: 20px;
        }

        .chart-bar-item {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .chart-bar {
            width: 100%;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: var(--radius-sm) var(--radius-sm) 0 0;
            transition: height 0.5s ease;
            position: relative;
            cursor: pointer;
        }

        .chart-bar:hover {
            opacity: 0.8;
        }

        .chart-bar-label {
            font-size: 12px;
            color: var(--gray);
            text-align: center;
        }

        .chart-bar-value {
            font-size: 14px;
            font-weight: 700;
            color: var(--light);
        }

        /* ============================================================ */
        /* DASHBOARD CARD */
        /* ============================================================ */
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

        /* ============================================================ */
        /* TABLE STYLING */
        /* ============================================================ */
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

        /* ============================================================ */
        /* STATUS BADGES */
        /* ============================================================ */
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

        .status-ditolak {
            background: rgba(142, 142, 160, 0.15);
            color: #8E8EA0;
            border: 1px solid rgba(142, 142, 160, 0.2);
        }

        /* ============================================================ */
        /* ACTION BUTTONS */
        /* ============================================================ */
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

        /* ============================================================ */
        /* ALERTS */
        /* ============================================================ */
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

        /* ============================================================ */
        /* USER AVATAR */
        /* ============================================================ */
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

        /* ============================================================ */
        /* EMPTY STATE */
        /* ============================================================ */
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

        /* ============================================================ */
        /* FOOTER */
        /* ============================================================ */
        .footer {
            text-align: center;
            padding: 25px;
            margin-top: 40px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            color: var(--gray);
            font-size: 14px;
        }

        /* ============================================================ */
        /* SIDEBAR TOGGLE */
        /* ============================================================ */
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

        /* ============================================================ */
        /* MODAL STYLES */
        /* ============================================================ */
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
            background: var(--dark-card);
            border-radius: var(--radius-lg);
            padding: 30px;
            max-width: 500px;
            width: 90%;
            border: 1px solid rgba(108, 99, 255, 0.3);
            box-shadow: var(--shadow-lg);
            animation: slideUp 0.3s ease;
            max-height: 80vh;
            overflow-y: auto;
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

        /* ============================================================ */
        /* TOAST NOTIFICATION */
        /* ============================================================ */
        .toast-notification {
            position: fixed;
            top: 30px;
            right: 30px;
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
        }

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

        /* ============================================================ */
        /* TOOLTIP */
        /* ============================================================ */
        [data-tooltip] {
            position: relative;
            cursor: pointer;
        }

        [data-tooltip]:before {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            padding: 5px 10px;
            background: var(--dark-card);
            color: var(--light);
            font-size: 12px;
            border-radius: var(--radius-sm);
            white-space: nowrap;
            z-index: 10;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s;
            margin-bottom: 5px;
            border: 1px solid var(--primary);
        }

        [data-tooltip]:hover:before {
            opacity: 1;
        }

        /* ============================================================ */
        /* RESPONSIVE */
        /* ============================================================ */
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
            
            .datetime-display {
                display: none;
            }
            
            .chart-bars {
                height: 200px;
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
                    <i class="fas fa-chalkboard-user"></i>
                    Dashboard Petugas
                </div>
                <div class="header-actions">
                    <!-- Date Time Display -->
                    <div class="datetime-display" id="datetimeDisplay">
                        <div class="time" id="currentTime">--:--:--</div>
                        <div class="date" id="currentDate">---, -- --- ----</div>
                    </div>
                    <div class="search-bar">
                        <input type="text" class="search-input" id="globalSearch" placeholder="Cari peminjaman, alat, atau peminjam...">
                        <i class="search-icon fas fa-search"></i>
                    </div>
                    <button class="notification-btn" id="notificationBtn" data-tooltip="Notifikasi">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge" id="notificationBadge">
                            @php
                                $peminjamanMenunggu = App\Models\Peminjaman::where('status', 'menunggu')->count();
                            @endphp
                            {{ $peminjamanMenunggu }}
                        </span>
                    </button>
                    <div class="user-menu" id="userMenuBtn" data-tooltip="Menu Pengguna">
                        <div class="user-menu-avatar">PT</div>
                        <span>Petugas Admin</span>
                        <i class="fas fa-chevron-down" style="font-size: 12px;"></i>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <div class="content-wrapper">
                <!-- Success Message -->
                @if(session('success'))
                    <div class="alert alert-success" id="successAlert">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Error Messages -->
                @if($errors->any())
                    <div class="alert alert-danger" id="errorAlert">
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
                        <h2>Selamat Datang, Petugas! 👋</h2>
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

                <!-- Stats Cards Row 1 -->
                <div class="stats-container">
                    @php
                        // Statistik untuk dashboard
                        $totalAlat = App\Models\Alat::count();
                        $peminjamanMenunggu = App\Models\Peminjaman::where('status', 'menunggu')->count();
                        $peminjamanDipinjam = App\Models\Peminjaman::where('status', 'dipinjam')->count();
                        $peminjamanTerlambat = App\Models\Peminjaman::where('status', 'dipinjam')
                            ->whereDate('tanggal_kembali', '<', now())
                            ->count();
                        $peminjamanBulanIni = App\Models\Peminjaman::whereMonth('created_at', now()->month)
                            ->whereYear('created_at', now()->year)
                            ->count();
                        // Menggunakan tanggal_kembali untuk jadwal pengembalian hari ini
                        $pengembalianHariIni = App\Models\Peminjaman::whereDate('tanggal_kembali', now())
                            ->where('status', 'dipinjam')
                            ->count();
                        $totalUsers = App\Models\User::where('role', 'user')->count();
                    @endphp
                    
                    <div class="stat-card" onclick="showAllTools()" data-tooltip="Lihat semua alat">
                        <div class="stat-icon icon-primary">
                            <i class="fas fa-tools"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Total Alat</h3>
                            <div class="number">{{ $totalAlat }}</div>
                            <div class="desc">Semua alat tersedia</div>
                        </div>
                    </div>
                    
                    <div class="stat-card" onclick="window.location.href='{{ route('petugas.peminjaman.index') }}?status=menunggu'" data-tooltip="Proses permintaan peminjaman">
                        <div class="stat-icon icon-warning">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Menunggu Persetujuan</h3>
                            <div class="number">{{ $peminjamanMenunggu }}</div>
                            <div class="desc">Butuh tindakan segera</div>
                        </div>
                    </div>
                    
                    <div class="stat-card" onclick="window.location.href='{{ route('petugas.peminjaman.index') }}?status=dipinjam'" data-tooltip="Lihat peminjaman aktif">
                        <div class="stat-icon icon-success">
                            <i class="fas fa-sync-alt"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Sedang Dipinjam</h3>
                            <div class="number">{{ $peminjamanDipinjam }}</div>
                            <div class="desc">Aktif saat ini</div>
                        </div>
                    </div>
                    
                    <div class="stat-card" onclick="showLateReturns()" data-tooltip="Lihat peminjaman terlambat">
                        <div class="stat-icon icon-danger">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Terlambat</h3>
                            <div class="number">{{ $peminjamanTerlambat }}</div>
                            <div class="desc">Perlu konfirmasi segera</div>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards Row 2 -->
                <div class="stats-container">
                    <div class="stat-card" onclick="showMonthlyReport()" data-tooltip="Statistik peminjaman bulan ini">
                        <div class="stat-icon icon-info">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Peminjaman Bulan Ini</h3>
                            <div class="number">{{ $peminjamanBulanIni }}</div>
                            <div class="desc">Periode {{ now()->format('F Y') }}</div>
                        </div>
                    </div>
                    
                    <div class="stat-card" onclick="showTodayReturns()" data-tooltip="Peminjaman yang harus dikembalikan hari ini">
                        <div class="stat-icon icon-success">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Jatuh Tempo Hari Ini</h3>
                            <div class="number">{{ $pengembalianHariIni }}</div>
                            <div class="desc">Harus dikembalikan hari ini</div>
                        </div>
                    </div>
                    
                    <div class="stat-card" onclick="showTotalUsers()" data-tooltip="Total pengguna terdaftar">
                        <div class="stat-icon icon-purple">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Total Pengguna</h3>
                            <div class="number">{{ $totalUsers }}</div>
                            <div class="desc">Terdaftar di sistem</div>
                        </div>
                    </div>
                    
                    <div class="stat-card" onclick="refreshData()" data-tooltip="Refresh data dashboard">
                        <div class="stat-icon icon-warning">
                            <i class="fas fa-sync-alt"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Refresh Data</h3>
                            <div class="number">
                                <i class="fas fa-arrow-rotate-right"></i>
                            </div>
                            <div class="desc">Perbarui tampilan</div>
                        </div>
                    </div>
                </div>

                <!-- Chart Section -->
                <div class="chart-container">
                    <div class="chart-header">
                        <div class="chart-title">
                            <i class="fas fa-chart-bar" style="color: var(--primary);"></i>
                            Statistik Peminjaman 7 Hari Terakhir
                        </div>
                        <div>
                            <span style="font-size: 12px; color: var(--gray);">
                                <i class="fas fa-chart-simple"></i> Grafik peminjaman harian
                            </span>
                        </div>
                    </div>
                    <div class="chart-bars" id="chartBars">
                        @php
                            $chartData = [];
                            for ($i = 6; $i >= 0; $i--) {
                                $date = now()->subDays($i);
                                $count = App\Models\Peminjaman::whereDate('created_at', $date)->count();
                                $maxCount = max(5, $peminjamanBulanIni > 0 ? $peminjamanBulanIni : 1);
                                $height = ($count / $maxCount) * 200;
                                $chartData[] = [
                                    'label' => $date->format('d/m'),
                                    'count' => $count,
                                    'height' => max(30, $height)
                                ];
                            }
                        @endphp
                        @foreach($chartData as $data)
                        <div class="chart-bar-item" data-tooltip="{{ $data['count'] }} peminjaman">
                            <div class="chart-bar" style="height: {{ $data['height'] }}px; width: 100%;"></div>
                            <div class="chart-bar-value">{{ $data['count'] }}</div>
                            <div class="chart-bar-label">{{ $data['label'] }}</div>
                        </div>
                        @endforeach
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
                            <button class="btn btn-sm btn-primary" onclick="openFilterModal()" data-tooltip="Filter berdasarkan status">
                                <i class="fas fa-filter"></i>
                                Filter
                            </button>
                            <button class="btn btn-sm btn-success" onclick="exportToExcel()" data-tooltip="Export ke Excel">
                                <i class="fas fa-file-excel"></i>
                                Export
                            </button>
                            <button class="btn btn-sm btn-outline" onclick="window.location.href='{{ route('petugas.peminjaman.index') }}'" data-tooltip="Lihat semua peminjaman">
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
                            <tbody id="tableBody">
                                @foreach($peminjaman as $item)
                                <tr data-status="{{ $item->status }}" data-id="{{ $item->id_peminjaman }}">
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
                                        {{ $item->tanggal_kembali ? \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') : '-' }}
                                        @if($item->status == 'dipinjam' && $item->tanggal_kembali)
                                            @php
                                                $today = \Carbon\Carbon::now();
                                                $rencanaKembali = \Carbon\Carbon::parse($item->tanggal_kembali);
                                                $daysLeft = $today->diffInDays($rencanaKembali, false);
                                            @endphp
                                            @if($daysLeft < 0)
                                                <div style="font-size: 11px; color: var(--danger); margin-top: 4px;">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    Terlambat {{ abs($daysLeft) }} hari
                                                </div>
                                            @elseif($daysLeft <= 2 && $daysLeft >= 0)
                                                <div style="font-size: 11px; color: var(--warning); margin-top: 4px;">
                                                    <i class="fas fa-hourglass-half"></i>
                                                    Tersisa {{ $daysLeft }} hari
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status == 'menunggu')
                                            <span class="status-badge status-menunggu">
                                                <i class="fas fa-hourglass-half"></i> Menunggu
                                            </span>
                                        @elseif ($item->status == 'dipinjam')
                                            <span class="status-badge status-dipinjam">
                                                <i class="fas fa-sync-alt"></i> Dipinjam
                                            </span>
                                        @elseif ($item->status == 'dikembalikan' || $item->status == 'selesai')
                                            <span class="status-badge status-selesai">
                                                <i class="fas fa-check-circle"></i> Selesai
                                            </span>
                                        @elseif ($item->status == 'ditolak')
                                            <span class="status-badge status-ditolak">
                                                <i class="fas fa-times-circle"></i> Ditolak
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status == 'menunggu')
                                            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                                                <form method="POST" action="{{ route('petugas.peminjaman.setujui', $item->id_peminjaman) }}" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn-action approve" onclick="return confirm('Setujui peminjaman ini?')" data-tooltip="Setujui peminjaman">
                                                        <i class="fas fa-check"></i> Setujui
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('petugas.peminjaman.tolak', $item->id_peminjaman) }}" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn-action reject" onclick="return confirm('Tolak peminjaman ini?')" data-tooltip="Tolak peminjaman">
                                                        <i class="fas fa-times"></i> Tolak
                                                    </button>
                                                </form>
                                            </div>
                                        @elseif ($item->status == 'dipinjam')
                                            <form method="POST" action="{{ route('petugas.pengembalian.konfirmasi', $item->id_peminjaman) }}" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn-action confirm" onclick="return confirm('Konfirmasi pengembalian alat ini?')" data-tooltip="Konfirmasi pengembalian">
                                                    <i class="fas fa-check-circle"></i> Konfirmasi
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
                    <div style="margin-top: 20px; text-align: center; font-size: 12px; color: var(--gray);">
                        <i class="fas fa-info-circle"></i> Menampilkan 10 data terbaru
                    </div>
                </section>

                <!-- Quick Actions Section -->
                <div class="stats-container">
                    <div class="stat-card" onclick="showPendingApprovals()" data-tooltip="Proses permintaan peminjaman">
                        <div class="stat-icon icon-primary">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Kelola Peminjaman</h3>
                            <div class="number">{{ $peminjamanMenunggu }}</div>
                            <div class="desc">Proses permintaan</div>
                        </div>
                    </div>
                    
                    <div class="stat-card" onclick="generateReport()" data-tooltip="Lihat laporan statistik">
                        <div class="stat-icon icon-success">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Laporan Statistik</h3>
                            <div class="number">
                                <i class="fas fa-chart-simple"></i>
                            </div>
                            <div class="desc">Grafik & Analisis</div>
                        </div>
                    </div>
                    
                    <div class="stat-card" onclick="showActiveLoans()" data-tooltip="Pantau peminjaman aktif">
                        <div class="stat-icon icon-warning">
                            <i class="fas fa-exchange-alt"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Pantau Pengembalian</h3>
                            <div class="number">{{ $peminjamanDipinjam }}</div>
                            <div class="desc">Konfirmasi pengembalian</div>
                        </div>
                    </div>
                    
                    <div class="stat-card" onclick="showLateReturnsModal()" data-tooltip="Lihat peminjaman terlambat">
                        <div class="stat-icon icon-danger">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Keterlambatan</h3>
                            <div class="number">{{ $peminjamanTerlambat }}</div>
                            <div class="desc">Perlu tindakan</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="footer">
                <p>Forent &copy; {{ date('Y') }} | Aplikasi Peminjaman Alat | Versi 2.0</p>
            </footer>
        </div>
    </div>

    <script>
        // ============================================================
        // GLOBAL VARIABLES
        // ============================================================
        let currentFilter = 'all';
        let autoRefreshInterval = null;
        let isAutoRefreshEnabled = false;

        // ============================================================
        // INITIALIZATION
        // ============================================================
        document.addEventListener('DOMContentLoaded', function() {
            setupEventListeners();
            animateCards();
            autoHideAlerts();
            setupSearch();
            updateNotificationBadgeColor();
            startRealTimeClock();
            loadUserSettings();
        });

        // ============================================================
        // REAL TIME CLOCK
        // ============================================================
        function startRealTimeClock() {
            updateDateTime();
            setInterval(updateDateTime, 1000);
        }

        function updateDateTime() {
            const now = new Date();
            const timeElement = document.getElementById('currentTime');
            const dateElement = document.getElementById('currentDate');
            
            if (timeElement) {
                timeElement.textContent = now.toLocaleTimeString('id-ID');
            }
            if (dateElement) {
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                dateElement.textContent = now.toLocaleDateString('id-ID', options);
            }
        }

        // ============================================================
        // LOAD USER SETTINGS
        // ============================================================
        function loadUserSettings() {
            const savedAutoRefresh = localStorage.getItem('autoRefreshEnabled');
            if (savedAutoRefresh === 'true') {
                enableAutoRefresh();
            }
        }

        function enableAutoRefresh() {
            if (autoRefreshInterval) clearInterval(autoRefreshInterval);
            autoRefreshInterval = setInterval(() => {
                refreshTable();
            }, 300000);
            isAutoRefreshEnabled = true;
            localStorage.setItem('autoRefreshEnabled', 'true');
            showToast('Auto-refresh data diaktifkan (setiap 5 menit)', 'success');
        }

        function disableAutoRefresh() {
            if (autoRefreshInterval) {
                clearInterval(autoRefreshInterval);
                autoRefreshInterval = null;
            }
            isAutoRefreshEnabled = false;
            localStorage.setItem('autoRefreshEnabled', 'false');
            showToast('Auto-refresh data dinonaktifkan', 'info');
        }

        // ============================================================
        // EVENT LISTENERS
        // ============================================================
        function setupEventListeners() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const appContainer = document.getElementById('appContainer');

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    appContainer.classList.toggle('sidebar-collapsed');
                    const icon = this.querySelector('i');
                    icon.className = appContainer.classList.contains('sidebar-collapsed') ? 'fas fa-bars' : 'fas fa-times';
                });
            }

            const notificationBtn = document.getElementById('notificationBtn');
            if (notificationBtn) {
                notificationBtn.addEventListener('click', showNotifications);
            }
            
            const quickActionBtn = document.getElementById('quickActionBtn');
            if (quickActionBtn) {
                quickActionBtn.addEventListener('click', showQuickActions);
            }
            
            const userMenuBtn = document.getElementById('userMenuBtn');
            if (userMenuBtn) {
                userMenuBtn.addEventListener('click', showUserMenu);
            }
        }

        // ============================================================
        // ANIMATIONS
        // ============================================================
        function animateCards() {
            const cards = document.querySelectorAll('.dashboard-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        }

        // ============================================================
        // AUTO HIDE ALERTS
        // ============================================================
        function autoHideAlerts() {
            const successAlert = document.getElementById('successAlert');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.opacity = '0';
                    setTimeout(() => {
                        if (successAlert) successAlert.style.display = 'none';
                    }, 300);
                }, 5000);
            }
            
            const errorAlert = document.getElementById('errorAlert');
            if (errorAlert) {
                setTimeout(() => {
                    errorAlert.style.opacity = '0';
                    setTimeout(() => {
                        if (errorAlert) errorAlert.style.display = 'none';
                    }, 8000);
                }, 8000);
            }
        }

        // ============================================================
        // SEARCH FUNCTIONALITY
        // ============================================================
        function setupSearch() {
            const searchInput = document.getElementById('globalSearch');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    performSearch(this.value.trim());
                });
            }
        }

        function performSearch(searchTerm) {
            const rows = document.querySelectorAll('#tableBody tr, .data-table tbody tr');
            
            if (!searchTerm) {
                rows.forEach(row => row.style.display = '');
                return;
            }

            const searchTermLower = searchTerm.toLowerCase();
            let visibleCount = 0;
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTermLower)) {
                    row.style.display = '';
                    row.style.backgroundColor = 'rgba(108, 99, 255, 0.2)';
                    visibleCount++;
                    setTimeout(() => {
                        row.style.backgroundColor = '';
                    }, 1000);
                } else {
                    row.style.display = 'none';
                }
            });
            
            if (visibleCount === 0) {
                showToast(`Tidak ditemukan dengan kata kunci: "${searchTerm}"`, 'warning');
            }
        }

        // ============================================================
        // FILTER MODAL
        // ============================================================
        function openFilterModal() {
            const filterOptions = [
                { label: 'Semua', value: 'all', icon: 'fa-list' },
                { label: 'Menunggu', value: 'menunggu', icon: 'fa-hourglass-half' },
                { label: 'Dipinjam', value: 'dipinjam', icon: 'fa-sync-alt' },
                { label: 'Terlambat', value: 'terlambat', icon: 'fa-exclamation-triangle' },
                { label: 'Selesai', value: 'dikembalikan', icon: 'fa-check-circle' },
                { label: 'Ditolak', value: 'ditolak', icon: 'fa-times-circle' }
            ];
            
            const modal = document.createElement('div');
            modal.className = 'modal-overlay';
            modal.innerHTML = `
                <div class="modal-content">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <h3 style="color: var(--light); font-size: 20px; font-weight: 700;">
                            <i class="fas fa-filter"></i> Filter Status
                        </h3>
                        <button onclick="closeModal()" 
                                style="background: none; border: none; color: var(--gray); cursor: pointer; font-size: 20px;">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div style="color: var(--light);">
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px;">
                            ${filterOptions.map(option => `
                                <label style="display: flex; align-items: center; gap: 12px; padding: 10px; cursor: pointer; 
                                             border-radius: var(--radius-sm); transition: var(--transition);
                                             background: ${currentFilter === option.value ? 'rgba(108, 99, 255, 0.2)' : 'transparent'};
                                             &:hover { background: rgba(108, 99, 255, 0.1); }">
                                    <input type="radio" name="statusFilter" value="${option.value}" 
                                           style="accent-color: var(--primary);" 
                                           ${option.value === currentFilter ? 'checked' : ''}>
                                    <i class="fas ${option.icon}" style="width: 20px;"></i>
                                    <span>${option.label}</span>
                                </label>
                            `).join('')}
                        </div>
                        <div style="display: flex; gap: 12px; margin-top: 20px;">
                            <button onclick="applyFilter()" class="btn btn-primary" style="flex: 1;">
                                <i class="fas fa-check"></i> Terapkan
                            </button>
                            <button onclick="resetFilter()" class="btn btn-outline" style="flex: 1;">
                                <i class="fas fa-undo"></i> Reset
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            document.body.appendChild(modal);
            
            const radioButtons = modal.querySelectorAll('input[name="statusFilter"]');
            radioButtons.forEach(radio => {
                radio.addEventListener('change', function() {
                    currentFilter = this.value;
                    const labels = modal.querySelectorAll('label');
                    labels.forEach(label => {
                        label.style.background = 'transparent';
                    });
                    this.closest('label').style.background = 'rgba(108, 99, 255, 0.2)';
                });
            });
        }

        function applyFilter() {
            const rows = document.querySelectorAll('#tableBody tr, .data-table tbody tr');
            let count = 0;
            
            rows.forEach(row => {
                if (currentFilter === 'all') {
                    row.style.display = '';
                    count++;
                } else if (currentFilter === 'terlambat') {
                    const statusElem = row.querySelector('.status-badge');
                    const isDipinjam = statusElem && statusElem.textContent.includes('Dipinjam');
                    const lateInfo = row.querySelector('[style*="color: var(--danger)"]');
                    if (isDipinjam && lateInfo) {
                        row.style.display = '';
                        count++;
                    } else {
                        row.style.display = 'none';
                    }
                } else {
                    const statusElem = row.querySelector('.status-badge');
                    if (statusElem) {
                        const statusText = statusElem.textContent.toLowerCase();
                        if (statusText.includes(currentFilter.toLowerCase())) {
                            row.style.display = '';
                            count++;
                        } else {
                            row.style.display = 'none';
                        }
                    }
                }
            });
            
            closeModal();
            showToast(`Menampilkan ${count} data dengan filter: ${getFilterLabel(currentFilter)}`, 'success');
        }

        function resetFilter() {
            currentFilter = 'all';
            const rows = document.querySelectorAll('#tableBody tr, .data-table tbody tr');
            rows.forEach(row => row.style.display = '');
            closeModal();
            showToast('Filter direset, menampilkan semua data', 'info');
        }

        function getFilterLabel(value) {
            const labels = {
                'all': 'Semua',
                'menunggu': 'Menunggu',
                'dipinjam': 'Dipinjam',
                'terlambat': 'Terlambat',
                'dikembalikan': 'Selesai',
                'ditolak': 'Ditolak'
            };
            return labels[value] || value;
        }

        // ============================================================
        // REFRESH TABLE
        // ============================================================
        function refreshTable() {
            showToast('Memperbarui data tabel...', 'info');
            setTimeout(() => {
                window.location.reload();
            }, 500);
        }

        function refreshData() {
            showToast('Memperbarui data dashboard...', 'info');
            setTimeout(() => {
                window.location.reload();
            }, 500);
        }

        // ============================================================
        // EXPORT DATA
        // ============================================================
        function exportToExcel() {
            const table = document.getElementById('loansTable');
            if (!table) {
                showToast('Tidak ada data untuk diexport', 'error');
                return;
            }
            
            let csv = [];
            const rows = table.querySelectorAll('tr');
            
            for (let i = 0; i < rows.length; i++) {
                const row = [], cols = rows[i].querySelectorAll('td, th');
                for (let j = 0; j < cols.length; j++) {
                    let text = cols[j].innerText.replace(/,/g, ';');
                    row.push(text);
                }
                csv.push(row.join(','));
            }
            
            const blob = new Blob(["\uFEFF" + csv.join('\n')], { type: 'text/csv;charset=utf-8;' });
            const link = document.createElement('a');
            const url = URL.createObjectURL(blob);
            link.href = url;
            link.setAttribute('download', `laporan_peminjaman_${new Date().toISOString().slice(0,19)}.csv`);
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            URL.revokeObjectURL(url);
            
            showToast('Data berhasil diexport ke CSV', 'success');
        }

        // ============================================================
        // NOTIFICATIONS
        // ============================================================
        function showNotifications() {
            @php
                $pendingLoans = App\Models\Peminjaman::where('status', 'menunggu')->with(['user', 'alat'])->get();
                $lateLoans = App\Models\Peminjaman::where('status', 'dipinjam')
                    ->whereDate('tanggal_kembali', '<', now())
                    ->with(['user', 'alat'])
                    ->get();
                $dueToday = App\Models\Peminjaman::whereDate('tanggal_kembali', now())
                    ->where('status', 'dipinjam')
                    ->with(['user', 'alat'])
                    ->get();
            @endphp
            
            let content = `
                <div style="max-height: 400px; overflow-y: auto;">
                    <div style="margin-bottom: 20px;">
                        <h4 style="color: var(--primary); margin-bottom: 10px;">
                            <i class="fas fa-clock"></i> Menunggu Persetujuan ({{ $pendingLoans->count() }})
                        </h4>
                        <div style="font-size: 13px;">
                            @if($pendingLoans->count() > 0)
                                @foreach($pendingLoans as $loan)
                                    <div style="padding: 10px; border-bottom: 1px solid rgba(255,255,255,0.05);">
                                        <strong>{{ $loan->user->name ?? '-' }}</strong> meminjam <strong>{{ $loan->alat->nama_alat ?? '-' }}</strong>
                                    </div>
                                @endforeach
                            @else
                                <div style="padding: 10px; color: var(--gray);">Tidak ada permintaan menunggu</div>
                            @endif
                        </div>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <h4 style="color: var(--warning); margin-bottom: 10px;">
                            <i class="fas fa-calendar-day"></i> Jatuh Tempo Hari Ini ({{ $dueToday->count() }})
                        </h4>
                        <div style="font-size: 13px;">
                            @if($dueToday->count() > 0)
                                @foreach($dueToday as $loan)
                                    <div style="padding: 10px; border-bottom: 1px solid rgba(255,255,255,0.05);">
                                        <strong>{{ $loan->user->name ?? '-' }}</strong> - {{ $loan->alat->nama_alat ?? '-' }}
                                        <span style="color: var(--warning);">(Harus dikembalikan hari ini)</span>
                                    </div>
                                @endforeach
                            @else
                                <div style="padding: 10px; color: var(--gray);">Tidak ada peminjaman yang jatuh tempo hari ini</div>
                            @endif
                        </div>
                    </div>
                    <div>
                        <h4 style="color: var(--danger); margin-bottom: 10px;">
                            <i class="fas fa-exclamation-triangle"></i> Peminjaman Terlambat ({{ $lateLoans->count() }})
                        </h4>
                        <div style="font-size: 13px;">
                            @if($lateLoans->count() > 0)
                                @foreach($lateLoans as $loan)
                                    <div style="padding: 10px; border-bottom: 1px solid rgba(255,255,255,0.05);">
                                        <strong>{{ $loan->user->name ?? '-' }}</strong> - {{ $loan->alat->nama_alat ?? '-' }}
                                        @php
                                            $daysLate = \Carbon\Carbon::parse($loan->tanggal_kembali)->diffInDays(now(), false);
                                        @endphp
                                        <span style="color: var(--danger);">(Terlambat {{ abs($daysLate) }} hari)</span>
                                    </div>
                                @endforeach
                            @else
                                <div style="padding: 10px; color: var(--gray);">Tidak ada peminjaman terlambat</div>
                            @endif
                        </div>
                    </div>
                </div>
            `;
            
            showModal('Notifikasi', content);
        }

        // ============================================================
        // MODAL UTILITIES
        // ============================================================
        function showModal(title, content) {
            closeModal();
            
            const modal = document.createElement('div');
            modal.className = 'modal-overlay';
            modal.innerHTML = `
                <div class="modal-content">
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
            const modal = document.querySelector('.modal-overlay');
            if (modal) modal.remove();
        }

        // ============================================================
        // TOAST NOTIFICATION
        // ============================================================
        function showToast(message, type = 'info') {
            const existingToast = document.getElementById('customToast');
            if (existingToast) existingToast.remove();
            
            const toast = document.createElement('div');
            toast.id = 'customToast';
            toast.className = 'toast-notification';
            
            const typeConfig = {
                'success': { bg: 'var(--accent)', icon: 'fa-check-circle' },
                'error': { bg: 'var(--danger)', icon: 'fa-times-circle' },
                'warning': { bg: 'var(--warning)', icon: 'fa-exclamation-triangle', color: 'var(--dark)' },
                'info': { bg: 'var(--primary)', icon: 'fa-info-circle' }
            };
            
            const config = typeConfig[type] || typeConfig.info;
            toast.style.background = config.bg;
            if (config.color) toast.style.color = config.color;
            
            toast.innerHTML = `
                <i class="fas ${config.icon}"></i>
                <span>${message}</span>
            `;
            
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => {
                    if (toast.parentNode) toast.remove();
                }, 300);
            }, 3000);
        }

        // ============================================================
        // QUICK ACTIONS
        // ============================================================
        function showQuickActions() {
            showModal('Tindakan Cepat', `
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    <button class="btn btn-primary" onclick="window.location.href='{{ route('petugas.peminjaman.index') }}?status=menunggu'" style="width: 100%; justify-content: center;">
                        <i class="fas fa-tasks"></i> Proses Peminjaman Menunggu
                    </button>
                    <button class="btn btn-success" onclick="window.location.href='{{ route('petugas.peminjaman.index') }}?status=dipinjam'" style="width: 100%; justify-content: center;">
                        <i class="fas fa-exchange-alt"></i> Konfirmasi Pengembalian
                    </button>
                    <button class="btn btn-warning" onclick="showLateReturnsModal()" style="width: 100%; justify-content: center;">
                        <i class="fas fa-exclamation-triangle"></i> Lihat Keterlambatan
                    </button>
                    <button class="btn btn-info" onclick="generateReport()" style="width: 100%; justify-content: center;">
                        <i class="fas fa-chart-pie"></i> Lihat Statistik
                    </button>
                    <button class="btn btn-outline" onclick="showSettings()" style="width: 100%; justify-content: center;">
                        <i class="fas fa-cog"></i> Pengaturan
                    </button>
                    <button class="btn btn-outline" onclick="closeModal()" style="width: 100%; justify-content: center;">
                        <i class="fas fa-times"></i> Tutup
                    </button>
                </div>
            `);
        }

        // ============================================================
        // USER MENU
        // ============================================================
        function showUserMenu() {
            showModal('Menu Pengguna', `
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    <button class="btn btn-outline" onclick="showProfile()" style="justify-content: flex-start;">
                        <i class="fas fa-user"></i> Profil Saya
                    </button>
                    <button class="btn btn-outline" onclick="showSettings()" style="justify-content: flex-start;">
                        <i class="fas fa-cog"></i> Pengaturan
                    </button>
                    <button class="btn btn-outline" onclick="showHelp()" style="justify-content: flex-start;">
                        <i class="fas fa-question-circle"></i> Bantuan
                    </button>
                    <hr style="border-color: rgba(255,255,255,0.1); margin: 10px 0;">
                    <form method="POST" action="{{ route('logout') }}" style="width: 100%;">
                        @csrf
                        <button type="submit" class="btn btn-outline" style="justify-content: flex-start; color: var(--danger); width: 100%;">
                            <i class="fas fa-sign-out-alt"></i> Keluar
                        </button>
                    </form>
                </div>
            `);
        }

        function showProfile() {
            closeModal();
            showModal('Profil Pengguna', `
                <div style="text-align: center;">
                    <div class="user-menu-avatar" style="width: 80px; height: 80px; font-size: 24px; margin: 0 auto 20px;">PT</div>
                    <h3 style="color: var(--light); margin-bottom: 5px;">Petugas Admin</h3>
                    <p style="color: var(--gray); margin-bottom: 20px;">Role: Petugas Peminjaman Alat</p>
                    <p style="color: var(--gray); font-size: 14px;">Bergabung sejak Januari 2024</p>
                    <p style="color: var(--gray); font-size: 14px;">Email: petugas@forent.com</p>
                    <hr style="border-color: rgba(255,255,255,0.1); margin: 20px 0;">
                    <div style="display: flex; gap: 10px;">
                        <button class="btn btn-primary" style="flex: 1;">Edit Profil</button>
                        <button class="btn btn-outline" onclick="closeModal()" style="flex: 1;">Tutup</button>
                    </div>
                </div>
            `);
        }

        function showSettings() {
            showModal('Pengaturan', `
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    <p style="color: var(--light); margin-bottom: 10px;">Pengaturan aplikasi:</p>
                    <button class="btn btn-outline" onclick="showNotificationSettings()" style="justify-content: flex-start;">
                        <i class="fas fa-bell"></i> Pengaturan Notifikasi
                    </button>
                    <button class="btn btn-outline" onclick="showDisplaySettings()" style="justify-content: flex-start;">
                        <i class="fas fa-palette"></i> Tema & Tampilan
                    </button>
                    <button class="btn btn-outline" onclick="showDataSettings()" style="justify-content: flex-start;">
                        <i class="fas fa-database"></i> Pengaturan Data
                    </button>
                    <button class="btn btn-outline" onclick="showAutoRefreshSettings()" style="justify-content: flex-start;">
                        <i class="fas fa-sync-alt"></i> Auto-Refresh Data
                    </button>
                </div>
            `);
        }

        function showAutoRefreshSettings() {
            showModal('Auto-Refresh Data', `
                <p style="color: var(--light); margin-bottom: 15px;">Atur refresh otomatis data:</p>
                <div style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 20px;">
                    <label style="display: flex; align-items: center; gap: 10px; color: var(--light); cursor: pointer;">
                        <input type="radio" name="autoRefresh" value="5" ${isAutoRefreshEnabled ? 'checked' : ''} style="accent-color: var(--primary);">
                        <span>Aktifkan Auto-Refresh (setiap 5 menit)</span>
                    </label>
                    <label style="display: flex; align-items: center; gap: 10px; color: var(--light); cursor: pointer;">
                        <input type="radio" name="autoRefresh" value="0" ${!isAutoRefreshEnabled ? 'checked' : ''} style="accent-color: var(--primary);">
                        <span>Nonaktifkan Auto-Refresh</span>
                    </label>
                </div>
                <button class="btn btn-primary" onclick="saveAutoRefreshSettings()" style="width: 100%;">
                    <i class="fas fa-save"></i> Simpan Pengaturan
                </button>
            `);
        }

        function saveAutoRefreshSettings() {
            const selected = document.querySelector('input[name="autoRefresh"]:checked');
            if (selected && selected.value === '5') {
                enableAutoRefresh();
            } else {
                disableAutoRefresh();
            }
            closeModal();
        }

        function showNotificationSettings() {
            showModal('Pengaturan Notifikasi', `
                <p style="color: var(--light); margin-bottom: 15px;">Atur preferensi notifikasi:</p>
                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <label style="display: flex; align-items: center; gap: 10px; color: var(--light); cursor: pointer;">
                        <input type="checkbox" checked style="accent-color: var(--primary);">
                        <span>Notifikasi peminjaman baru</span>
                    </label>
                    <label style="display: flex; align-items: center; gap: 10px; color: var(--light); cursor: pointer;">
                        <input type="checkbox" checked style="accent-color: var(--primary);">
                        <span>Pengingat pengembalian (H-2)</span>
                    </label>
                    <label style="display: flex; align-items: center; gap: 10px; color: var(--light); cursor: pointer;">
                        <input type="checkbox" checked style="accent-color: var(--primary);">
                        <span>Notifikasi keterlambatan</span>
                    </label>
                    <label style="display: flex; align-items: center; gap: 10px; color: var(--light); cursor: pointer;">
                        <input type="checkbox" style="accent-color: var(--primary);">
                        <span>Notifikasi suara</span>
                    </label>
                </div>
                <button class="btn btn-primary" onclick="saveNotificationSettings()" style="width: 100%; margin-top: 20px;">
                    <i class="fas fa-save"></i> Simpan Pengaturan
                </button>
            `);
        }

        function saveNotificationSettings() {
            showToast('Pengaturan notifikasi disimpan', 'success');
            closeModal();
        }

        function showDisplaySettings() {
            showModal('Tema & Tampilan', `
                <p style="color: var(--light); margin-bottom: 15px;">Pilih tema tampilan:</p>
                <div style="display: flex; gap: 10px; margin-bottom: 20px;">
                    <button class="btn btn-primary" onclick="setDarkTheme()" style="flex: 1;">Tema Gelap</button>
                    <button class="btn btn-outline" onclick="setLightTheme()" style="flex: 1;">Tema Terang</button>
                </div>
                <p style="color: var(--gray); font-size: 12px;">*Perubahan tema akan segera diterapkan</p>
            `);
        }

        function showDataSettings() {
            showModal('Pengaturan Data', `
                <p style="color: var(--light); margin-bottom: 15px;">Pengaturan tampilan data:</p>
                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <label style="display: flex; align-items: center; gap: 10px; color: var(--light); cursor: pointer;">
                        <input type="checkbox" checked style="accent-color: var(--primary);">
                        <span>Tampilkan 10 data per halaman</span>
                    </label>
                    <label style="display: flex; align-items: center; gap: 10px; color: var(--light); cursor: pointer;">
                        <input type="checkbox" style="accent-color: var(--primary);">
                        <span>Tampilkan ikon di menu</span>
                    </label>
                </div>
                <button class="btn btn-primary" onclick="saveDataSettings()" style="width: 100%; margin-top: 20px;">
                    <i class="fas fa-save"></i> Simpan Pengaturan
                </button>
            `);
        }

        function saveDataSettings() {
            showToast('Pengaturan data disimpan', 'success');
            closeModal();
        }

        function showHelp() {
            showModal('Bantuan & Panduan', `
                <div style="line-height: 1.8;">
                    <p><strong><i class="fas fa-question-circle"></i> Panduan Penggunaan Dashboard:</strong></p>
                    <ul style="margin-left: 20px; margin-top: 10px;">
                        <li><strong>📋 Kelola Peminjaman</strong> - Klik "Setujui" untuk menyetujui, "Tolak" untuk menolak</li>
                        <li><strong>🔄 Konfirmasi Pengembalian</strong> - Klik "Konfirmasi" saat peminjam mengembalikan alat</li>
                        <li><strong>🔍 Pencarian</strong> - Gunakan search bar untuk mencari data spesifik</li>
                        <li><strong>🎯 Filter</strong> - Klik tombol Filter untuk menyaring data berdasarkan status</li>
                        <li><strong>📊 Statistik</strong> - Lihat ringkasan data di card statistik</li>
                        <li><strong>📈 Grafik</strong> - Pantau tren peminjaman melalui grafik batang</li>
                        <li><strong>📎 Export Data</strong> - Export data ke format CSV/Excel</li>
                        <li><strong>🔔 Notifikasi</strong> - Dapatkan pemberitahuan peminjaman baru dan keterlambatan</li>
                    </ul>
                    <hr style="border-color: rgba(255,255,255,0.1); margin: 15px 0;">
                    <p><strong>💡 Tips:</strong> Gunakan fitur auto-refresh untuk selalu mendapatkan data terbaru secara otomatis.</p>
                    <p style="margin-top: 15px;"><strong>📞 Kontak Dukungan:</strong> admin@forent.com | (021) 1234-5678</p>
                </div>
            `);
        }

        function setDarkTheme() {
            showToast('Tema gelap sudah aktif', 'success');
            closeModal();
        }

        function setLightTheme() {
            showToast('Fitur tema terang akan segera tersedia', 'info');
            closeModal();
        }

        // ============================================================
        // STATISTICS & REPORTS
        // ============================================================
        function showMonthlyReport() {
            @php
                $monthlyStats = [];
                for ($i = 5; $i >= 0; $i--) {
                    $month = now()->subMonths($i);
                    $count = App\Models\Peminjaman::whereMonth('created_at', $month->month)
                        ->whereYear('created_at', $month->year)
                        ->count();
                    $monthlyStats[] = [
                        'month' => $month->format('M Y'),
                        'count' => $count
                    ];
                }
            @endphp
            
            let content = `
                <div style="text-align: center;">
                    <p style="color: var(--light); margin-bottom: 20px;">Statistik peminjaman 6 bulan terakhir:</p>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 20px;">
            `;
            
            @foreach($monthlyStats as $stat)
                content += `
                    <div style="background: rgba(108,99,255,0.1); padding: 15px; border-radius: var(--radius-md);">
                        <div style="font-size: 20px; font-weight: 800; color: var(--primary);">{{ $stat['count'] }}</div>
                        <div style="font-size: 11px; color: var(--gray);">{{ $stat['month'] }}</div>
                    </div>
                `;
            @endforeach
            
            content += `
                    </div>
                    <button class="btn btn-primary" onclick="generateReport()" style="width: 100%;">
                        <i class="fas fa-chart-line"></i> Lihat Detail Laporan
                    </button>
                </div>
            `;
            
            showModal('Laporan Bulanan', content);
        }

        function generateReport() {
            window.location.href = '{{ route("petugas.laporan") }}';
        }

        function showTodayReturns() {
            showModal('Jatuh Tempo Hari Ini', `
                <div style="text-align: center; padding: 20px;">
                    <i class="fas fa-calendar-day" style="font-size: 48px; color: var(--warning); margin-bottom: 15px;"></i>
                    <p style="color: var(--light);">Peminjaman yang harus dikembalikan hari ini: <strong>{{ $pengembalianHariIni }}</strong></p>
                    <button class="btn btn-primary" onclick="window.location.href='{{ route('petugas.peminjaman.index') }}?status=dipinjam'" style="margin-top: 20px; width: 100%;">
                        <i class="fas fa-list"></i> Lihat Detail
                    </button>
                </div>
            `);
        }

        function showTotalUsers() {
            showToast('Total pengguna terdaftar: {{ $totalUsers }}', 'info');
        }

        // ============================================================
        // UTILITY FUNCTIONS
        // ============================================================
        function updateNotificationBadgeColor() {
            const badge = document.getElementById('notificationBadge');
            if (badge) {
                const count = parseInt(badge.textContent) || 0;
                if (count > 5) {
                    badge.style.background = 'linear-gradient(135deg, var(--danger), var(--secondary))';
                } else if (count > 0) {
                    badge.style.background = 'linear-gradient(135deg, var(--warning), var(--secondary))';
                }
            }
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

        function showPendingApprovals() {
            window.location.href = '{{ route("petugas.peminjaman.index") }}?status=menunggu';
        }

        function showLateReturnsModal() {
            @php
                $lateLoans = App\Models\Peminjaman::where('status', 'dipinjam')
                    ->whereDate('tanggal_kembali', '<', now())
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
                        $daysLate = \Carbon\Carbon::parse($loan->tanggal_kembali)->diffInDays(now(), false);
                    @endphp
                    content += `
                        <div style="background: rgba(255, 107, 107, 0.1); padding: 12px; border-radius: var(--radius-sm); margin-bottom: 10px;">
                            <div style="font-weight: 600; color: var(--light);">{{ $loan->alat->nama_alat ?? 'Alat' }}</div>
                            <div style="font-size: 12px; color: var(--gray);">Peminjam: {{ $loan->user->name ?? '-' }}</div>
                            <div style="font-size: 12px; color: var(--danger);">
                                <i class="fas fa-clock"></i> Terlambat {{ abs($daysLate) }} hari
                            </div>
                            <div style="margin-top: 10px;">
                                <button class="btn-action confirm" onclick="markAsReturned('{{ $loan->id_peminjaman }}')" style="font-size: 11px; padding: 5px 10px;">
                                    <i class="fas fa-check"></i> Konfirmasi Pengembalian
                                </button>
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
            
            showModal('Peminjaman Terlambat', content);
        }

        function markAsReturned(loanId) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `{{ url('petugas/pengembalian/konfirmasi') }}/${loanId}`;
            
            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';
            form.appendChild(csrf);
            
            document.body.appendChild(form);
            if (confirm('Konfirmasi pengembalian alat ini?')) {
                form.submit();
            }
            closeModal();
        }
    </script>
</body>
</html>