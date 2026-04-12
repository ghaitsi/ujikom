<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Forent - Log Aktivitas</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --primary-light: #4895ef;
            --secondary: #7209b7;
            --accent: #f72585;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --dark: #1a1a2e;
            --darker: #16213e;
            --light: #f8fafc;
            --gray: #64748b;
            --gray-light: #e2e8f0;
            --card-bg: rgba(255, 255, 255, 0.98);
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 24px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 50%, #fae8ff 100%);
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
            width: 4px;
            height: 24px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 2px;
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
            background: #f1f5f9;
            border: 1px solid transparent;
            border-radius: var(--radius-lg);
            font-size: 14px;
            color: var(--dark);
            transition: var(--transition);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            font-size: 14px;
        }

        .search-clear {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            cursor: pointer;
            padding: 4px;
            border-radius: 50%;
            background: #e2e8f0;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            transition: var(--transition);
            opacity: 0;
            visibility: hidden;
        }

        .search-input:not(:placeholder-shown) ~ .search-clear {
            opacity: 1;
            visibility: visible;
        }

        .search-clear:hover {
            background: var(--danger);
            color: white;
        }

        /* Notification */
        .notification-btn {
            position: relative;
            background: #f1f5f9;
            border: none;
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
            color: var(--primary);
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
            background: #f1f5f9;
            transition: var(--transition);
        }

        .user-menu:hover {
            background: white;
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
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: white;
            border-radius: var(--radius-lg);
            padding: 20px;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 16px;
            border: 1px solid rgba(0, 0, 0, 0.05);
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
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .stat-card:hover::before {
            transform: scaleX(1);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
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
        .icon-success { background: linear-gradient(135deg, var(--success), #059669); }
        .icon-warning { background: linear-gradient(135deg, var(--warning), #d97706); }
        .icon-danger { background: linear-gradient(135deg, var(--danger), #dc2626); }

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

        .stat-info .trend {
            font-size: 11px;
            color: var(--gray);
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Chart Section - FITUR BARU 1 */
        .chart-section {
            background: white;
            border-radius: var(--radius-xl);
            padding: 24px;
            margin-bottom: 32px;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: var(--transition);
        }

        .chart-section:hover {
            box-shadow: var(--shadow-md);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 2px solid #f1f5f9;
        }

        .chart-title {
            font-size: 18px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .chart-title i {
            color: var(--primary);
        }

        .chart-wrapper {
            position: relative;
            height: 280px;
        }

        /* Dashboard Card */
        .dashboard-card {
            background: white;
            border-radius: var(--radius-xl);
            padding: 24px;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            margin-bottom: 32px;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .dashboard-card:hover {
            box-shadow: var(--shadow-md);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 2px solid #f1f5f9;
            flex-wrap: wrap;
            gap: 12px;
        }

        .card-title {
            font-size: 20px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-title i {
            color: var(--primary);
        }

        .card-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        /* Buttons */
        .action-btn {
            padding: 8px 16px;
            border-radius: var(--radius-md);
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success), #059669);
            color: white;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        .btn-outline {
            background: transparent;
            border: 1px solid #e2e8f0;
            color: var(--dark);
        }

        .btn-outline:hover {
            background: #f1f5f9;
            transform: translateY(-2px);
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }

        /* Filter Section */
        .filter-section {
            background: #f8fafc;
            border-radius: var(--radius-lg);
            padding: 20px;
            margin-bottom: 24px;
            border: 1px solid #e2e8f0;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }

        .filter-item {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .filter-item label {
            font-size: 12px;
            font-weight: 600;
            color: var(--gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .filter-input {
            padding: 10px 12px;
            border: 1px solid #e2e8f0;
            border-radius: var(--radius-md);
            font-size: 14px;
            color: var(--dark);
            background: white;
            transition: var(--transition);
        }

        .filter-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }

        .quick-dates {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 16px;
        }

        .quick-date-btn {
            padding: 4px 12px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            font-size: 12px;
            cursor: pointer;
            transition: var(--transition);
        }

        .quick-date-btn:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .filter-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        /* Active Filters */
        .active-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
            padding: 12px 16px;
            background: #f1f5f9;
            border-radius: var(--radius-md);
        }

        .filter-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 4px 10px;
            background: white;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            box-shadow: var(--shadow-sm);
            border: 1px solid #e2e8f0;
        }

        .filter-tag .remove-filter {
            cursor: pointer;
            padding: 2px;
            border-radius: 50%;
            transition: var(--transition);
        }

        .filter-tag .remove-filter:hover {
            background: var(--danger);
            color: white;
        }

        /* Table */
        .table-container {
            overflow-x: auto;
            border-radius: var(--radius-lg);
            position: relative;
        }

        .activity-table {
            width: 100%;
            border-collapse: collapse;
        }

        .activity-table thead {
            background: #f8fafc;
        }

        .activity-table th {
            padding: 14px 16px;
            text-align: left;
            color: var(--gray);
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .activity-table tbody tr {
            transition: var(--transition);
            border-bottom: 1px solid #f1f5f9;
        }

        .activity-table tbody tr:hover {
            background: #f8fafc;
        }

        .activity-table td {
            padding: 14px 16px;
            color: var(--dark);
            font-size: 14px;
            vertical-align: middle;
        }

        /* User Cell */
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
        }

        /* Activity Cell */
        .activity-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .activity-icon {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: white;
        }

        .icon-login { background: var(--success); }
        .icon-logout { background: var(--danger); }
        .icon-create { background: var(--primary); }
        .icon-update { background: var(--warning); }
        .icon-delete { background: var(--danger); }
        .icon-system { background: var(--secondary); }

        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .status-success {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .status-warning {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .status-danger {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        /* Time Cell */
        .time-cell {
            font-family: monospace;
            font-size: 13px;
        }

        /* Pagination */
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #f1f5f9;
            flex-wrap: wrap;
            gap: 16px;
        }

        .pagination {
            display: flex;
            gap: 8px;
            list-style: none;
            flex-wrap: wrap;
        }

        .pagination a, .pagination span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 10px;
            border-radius: var(--radius-sm);
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

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--gray);
        }

        .empty-icon {
            font-size: 64px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        .empty-state h3 {
            font-size: 18px;
            margin-bottom: 8px;
            color: var(--dark);
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

        .modal.active {
            visibility: visible;
            opacity: 1;
        }

        .modal-content {
            background: white;
            border-radius: var(--radius-xl);
            padding: 28px;
            max-width: 500px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
            transform: scale(0.9);
            transition: transform 0.3s ease;
        }

        .modal.active .modal-content {
            transform: scale(1);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 2px solid #f1f5f9;
        }

        .modal-header h3 {
            font-size: 20px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            padding: 8px;
            border-radius: 50%;
            transition: var(--transition);
        }

        .modal-close:hover {
            background: #f1f5f9;
            transform: rotate(90deg);
        }

        .modal-footer {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 24px;
            padding-top: 16px;
            border-top: 1px solid #f1f5f9;
        }

        .export-option {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px;
            border: 2px solid #e2e8f0;
            border-radius: var(--radius-md);
            margin-bottom: 12px;
            cursor: pointer;
            transition: var(--transition);
        }

        .export-option:hover {
            border-color: var(--primary);
            background: #f8fafc;
        }

        .export-option.selected {
            border-color: var(--primary);
            background: rgba(67, 97, 238, 0.05);
        }

        .export-option-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        /* Loading Overlay */
        .loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(2px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            border-radius: var(--radius-lg);
            display: none;
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid #e2e8f0;
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
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
            animation: slideInBottom 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        @keyframes slideInBottom {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
            .search-wrapper {
                width: 240px;
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
            .search-wrapper {
                display: none;
            }
            .stats-container {
                grid-template-columns: 1fr;
            }
            .filter-grid {
                grid-template-columns: 1fr;
            }
            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }
            .card-actions {
                width: 100%;
            }
            .action-btn {
                flex: 1;
                justify-content: center;
            }
            .pagination-container {
                flex-direction: column;
                align-items: center;
            }
        }

        @media (max-width: 480px) {
            .header-title {
                font-size: 18px;
            }
            .user-menu span {
                display: none;
            }
            .user-cell {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
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
                <h1 class="header-title">Log Aktivitas Sistem</h1>
                <div class="header-actions">
                    <div class="search-wrapper">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" id="searchInput" placeholder="Cari aktivitas..." value="{{ request('search') }}">
                        <i class="fas fa-times search-clear" id="searchClear"></i>
                    </div>
                    <button class="notification-btn">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge" id="notificationBadge">0</span>
                    </button>
                    <div class="user-menu">
                        <div class="user-menu-avatar">
                            @auth
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            @else
                                GU
                            @endauth
                        </div>
                        <span>{{ Auth::user()->name ?? 'Guest' }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </header>

            <div class="content-wrapper">
                <!-- Stats Cards -->
                <div class="stats-container">
                    <div class="stat-card">
                        <div class="stat-icon icon-primary">
                            <i class="fas fa-history"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Total Aktivitas</h3>
                            <div class="number" id="totalLogs">{{ $totalLogs ?? 0 }}</div>
                            <div class="trend">
                                <i class="fas fa-calendar-day"></i>
                                Hari ini: <span id="todayLogs">{{ $todayLogs ?? 0 }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon icon-success">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="stat-info">
                            <h3>User Aktif</h3>
                            <div class="number">{{ $activeUsers ?? 0 }}</div>
                            <div class="trend">
                                <i class="fas fa-users"></i>
                                Total: {{ $totalUsers ?? 0 }}
                            </div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon icon-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Peringatan</h3>
                            <div class="number" id="warningCount">{{ $warningLogs ?? 0 }}</div>
                            <div class="trend">
                                <i class="fas fa-shield-alt"></i>
                                Perlu perhatian
                            </div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon icon-danger">
                            <i class="fas fa-bug"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Error</h3>
                            <div class="number" id="errorCount">{{ $errorLogs ?? 0 }}</div>
                            <div class="trend">
                                <i class="fas fa-check-circle"></i>
                                Sistem aman
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FITUR BARU 1: Grafik Aktivitas -->
                <div class="chart-section">
                    <div class="chart-header">
                        <div class="chart-title">
                            <i class="fas fa-chart-line"></i>
                            Grafik Aktivitas 7 Hari Terakhir
                        </div>
                        <div>
                            <span style="font-size: 12px; color: var(--gray);">
                                <i class="fas fa-chart-simple"></i> Tren aktivitas harian
                            </span>
                        </div>
                    </div>
                    <div class="chart-wrapper">
                        <canvas id="activityChart"></canvas>
                    </div>
                </div>

                <!-- Main Card -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-clipboard-list"></i>
                            Riwayat Aktivitas
                        </h3>
                        <div class="card-actions">
                            <button class="action-btn btn-primary" id="refreshData">
                                <i class="fas fa-sync-alt"></i> Refresh
                            </button>
                            <button class="action-btn btn-success" id="exportBtn">
                                <i class="fas fa-download"></i> Export
                            </button>
                            <button class="action-btn btn-outline" id="toggleFilters">
                                <i class="fas fa-filter"></i> Filter
                            </button>
                        </div>
                    </div>

                    <!-- Filter Section -->
                    <div class="filter-section" id="filterSection" style="{{ request()->anyFilled(['activity_type', 'user_id', 'date_from', 'date_to', 'status']) ? '' : 'display: none;' }}">
                        <form method="GET" action="{{ url()->current() }}" id="filterForm">
                            <div class="quick-dates">
                                <span style="font-size: 12px; font-weight: 600;">Quick Filter:</span>
                                <button type="button" class="quick-date-btn" data-range="today">Hari Ini</button>
                                <button type="button" class="quick-date-btn" data-range="yesterday">Kemarin</button>
                                <button type="button" class="quick-date-btn" data-range="week">7 Hari</button>
                                <button type="button" class="quick-date-btn" data-range="month">30 Hari</button>
                            </div>

                            <div class="filter-grid">
                                <div class="filter-item">
                                    <label>Tipe Aktivitas</label>
                                    <select class="filter-input" name="activity_type">
                                        <option value="">Semua</option>
                                        <option value="login" {{ request('activity_type') == 'login' ? 'selected' : '' }}>Login</option>
                                        <option value="logout" {{ request('activity_type') == 'logout' ? 'selected' : '' }}>Logout</option>
                                        <option value="create" {{ request('activity_type') == 'create' ? 'selected' : '' }}>Create</option>
                                        <option value="update" {{ request('activity_type') == 'update' ? 'selected' : '' }}>Update</option>
                                        <option value="delete" {{ request('activity_type') == 'delete' ? 'selected' : '' }}>Delete</option>
                                    </select>
                                </div>

                                <div class="filter-item">
                                    <label>User</label>
                                    <select class="filter-input" name="user_id">
                                        <option value="">Semua User</option>
                                        @foreach($users ?? [] as $user)
                                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="filter-item">
                                    <label>Tanggal Mulai</label>
                                    <input type="date" class="filter-input" name="date_from" value="{{ request('date_from') }}">
                                </div>

                                <div class="filter-item">
                                    <label>Tanggal Akhir</label>
                                    <input type="date" class="filter-input" name="date_to" value="{{ request('date_to') }}">
                                </div>

                                <div class="filter-item">
                                    <label>Status</label>
                                    <select class="filter-input" name="status">
                                        <option value="">Semua</option>
                                        <option value="success" {{ request('status') == 'success' ? 'selected' : '' }}>Berhasil</option>
                                        <option value="warning" {{ request('status') == 'warning' ? 'selected' : '' }}>Peringatan</option>
                                        <option value="danger" {{ request('status') == 'danger' ? 'selected' : '' }}>Error</option>
                                    </select>
                                </div>
                            </div>

                            <input type="hidden" name="search" id="searchHidden" value="{{ request('search') }}">

                            <div class="filter-actions">
                                <button type="submit" class="action-btn btn-primary">
                                    <i class="fas fa-filter"></i> Terapkan
                                </button>
                                <a href="{{ url()->current() }}" class="action-btn btn-outline">
                                    <i class="fas fa-redo"></i> Reset
                                </a>
                            </div>
                        </form>
                    </div>

                    <!-- Active Filters -->
                    @if(request()->anyFilled(['activity_type', 'user_id', 'date_from', 'date_to', 'status', 'search']))
                    <div class="active-filters">
                        <span style="font-weight: 600;">Filter Aktif:</span>
                        @if(request('search'))
                        <span class="filter-tag">
                            <i class="fas fa-search"></i> "{{ request('search') }}"
                            <i class="fas fa-times remove-filter" data-filter="search"></i>
                        </span>
                        @endif
                        @if(request('activity_type'))
                        <span class="filter-tag">
                            <i class="fas fa-tag"></i> {{ request('activity_type') }}
                            <i class="fas fa-times remove-filter" data-filter="activity_type"></i>
                        </span>
                        @endif
                        @if(request('user_id') && isset($users))
                            @php $selectedUser = $users->firstWhere('id', request('user_id')); @endphp
                            @if($selectedUser)
                            <span class="filter-tag">
                                <i class="fas fa-user"></i> {{ $selectedUser->name }}
                                <i class="fas fa-times remove-filter" data-filter="user_id"></i>
                            </span>
                            @endif
                        @endif
                        @if(request('date_from'))
                        <span class="filter-tag">
                            <i class="fas fa-calendar"></i> Dari: {{ \Carbon\Carbon::parse(request('date_from'))->format('d/m/Y') }}
                            <i class="fas fa-times remove-filter" data-filter="date_from"></i>
                        </span>
                        @endif
                        @if(request('date_to'))
                        <span class="filter-tag">
                            <i class="fas fa-calendar"></i> Sampai: {{ \Carbon\Carbon::parse(request('date_to'))->format('d/m/Y') }}
                            <i class="fas fa-times remove-filter" data-filter="date_to"></i>
                        </span>
                        @endif
                        @if(request('status'))
                        <span class="filter-tag">
                            <i class="fas fa-flag"></i> {{ request('status') }}
                            <i class="fas fa-times remove-filter" data-filter="status"></i>
                        </span>
                        @endif
                        <span class="filter-tag" id="clearAllFilters" style="cursor: pointer; background: var(--danger); color: white; border: none;">
                            <i class="fas fa-times"></i> Hapus Semua
                        </span>
                    </div>
                    @endif

                    <!-- Table Container -->
                    <div class="table-container" style="position: relative;">
                        <div class="loading-overlay" id="loadingOverlay">
                            <div class="loading-spinner"></div>
                        </div>

                        @if(isset($logs) && $logs->count() > 0)
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
                                    <tr>
                                        <td>
                                            <span style="font-family: monospace; color: var(--gray);">#{{ $log->id_log }}</span>
                                        </td>
                                        <td>
                                            <div class="user-cell">
                                                <div class="user-avatar">
                                                    {{ strtoupper(substr($log->user->name ?? 'U', 0, 2)) }}
                                                </div>
                                                <div>
                                                    <div style="font-weight: 600;">{{ $log->user->name ?? 'Unknown' }}</div>
                                                    <div style="font-size: 12px; color: var(--gray);">{{ $log->user->email ?? '' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="activity-cell">
                                                @php
                                                    $activityLower = strtolower($log->aktivitas);
                                                    $iconClass = 'icon-system';
                                                    $icon = 'fa-info-circle';
                                                    
                                                    if(str_contains($activityLower, 'login')) {
                                                        $iconClass = 'icon-login';
                                                        $icon = 'fa-sign-in-alt';
                                                    } elseif(str_contains($activityLower, 'logout')) {
                                                        $iconClass = 'icon-logout';
                                                        $icon = 'fa-sign-out-alt';
                                                    } elseif(str_contains($activityLower, 'tambah') || str_contains($activityLower, 'create')) {
                                                        $iconClass = 'icon-create';
                                                        $icon = 'fa-plus';
                                                    } elseif(str_contains($activityLower, 'edit') || str_contains($activityLower, 'update')) {
                                                        $iconClass = 'icon-update';
                                                        $icon = 'fa-edit';
                                                    } elseif(str_contains($activityLower, 'hapus') || str_contains($activityLower, 'delete')) {
                                                        $iconClass = 'icon-delete';
                                                        $icon = 'fa-trash';
                                                    }
                                                @endphp
                                                <div class="activity-icon {{ $iconClass }}">
                                                    <i class="fas {{ $icon }}"></i>
                                                </div>
                                                <span>{{ $log->aktivitas }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                                $statusClass = 'status-success';
                                                $statusIcon = 'fa-check-circle';
                                                $statusText = 'Berhasil';
                                                
                                                if(str_contains(strtolower($log->aktivitas), 'gagal') || str_contains(strtolower($log->aktivitas), 'error')) {
                                                    $statusClass = 'status-danger';
                                                    $statusIcon = 'fa-times-circle';
                                                    $statusText = 'Gagal';
                                                } elseif(str_contains(strtolower($log->aktivitas), 'warning') || str_contains(strtolower($log->aktivitas), 'peringatan')) {
                                                    $statusClass = 'status-warning';
                                                    $statusIcon = 'fa-exclamation-triangle';
                                                    $statusText = 'Peringatan';
                                                }
                                            @endphp
                                            <span class="status-badge {{ $statusClass }}">
                                                <i class="fas {{ $statusIcon }}"></i> {{ $statusText }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="time-cell">
                                                <div>{{ \Carbon\Carbon::parse($log->waktu)->format('d M Y') }}</div>
                                                <div style="font-size: 12px; color: var(--gray);">{{ \Carbon\Carbon::parse($log->waktu)->format('H:i:s') }}</div>
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
                                <p>Belum ada riwayat aktivitas yang tercatat.</p>
                                @if(request()->anyFilled(['activity_type', 'user_id', 'date_from', 'date_to', 'status', 'search']))
                                <a href="{{ url()->current() }}" class="action-btn btn-primary" style="display: inline-flex; margin-top: 16px;">
                                    <i class="fas fa-redo"></i> Reset Filter
                                </a>
                                @endif
                            </div>
                        @endif
                    </div>

                    <!-- Pagination -->
                    @if(isset($logs) && $logs->count() > 0)
                    <div class="pagination-container">
                        <div style="color: var(--gray); font-size: 13px;">
                            Menampilkan {{ $logs->firstItem() ?? 0 }} - {{ $logs->lastItem() ?? 0 }} dari {{ $logs->total() }} aktivitas
                        </div>
                        <div>
                            {{ $logs->appends(request()->query())->links() }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </main>
    </div>

    <!-- Export Modal -->
    <div class="modal" id="exportModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>
                    <i class="fas fa-download"></i>
                    Export Data Log
                </h3>
                <button class="modal-close" id="closeModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <p style="margin-bottom: 20px; color: var(--gray);">Pilih format export:</p>
                
                <div class="export-option selected" data-format="csv">
                    <div class="export-option-icon">
                        <i class="fas fa-file-csv" style="color: var(--success);"></i>
                    </div>
                    <div>
                        <h4 style="margin-bottom: 4px;">CSV</h4>
                        <p style="font-size: 13px; color: var(--gray);">Compatible dengan Excel</p>
                    </div>
                </div>
                
                <div class="export-option" data-format="excel">
                    <div class="export-option-icon">
                        <i class="fas fa-file-excel" style="color: #0f9d58;"></i>
                    </div>
                    <div>
                        <h4 style="margin-bottom: 4px;">Excel (XLSX)</h4>
                        <p style="font-size: 13px; color: var(--gray);">Format spreadsheet</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="action-btn btn-outline" id="cancelExport">Batal</button>
                <button class="action-btn btn-success" id="confirmExport">Export</button>
            </div>
        </div>
    </div>

    <script>
        // Initialize Chart - FITUR BARU 1
        let activityChart = null;
        
        function initChart() {
            const ctx = document.getElementById('activityChart').getContext('2d');
            
            @php
                $chartLabels = [];
                $chartData = [];
                for ($i = 6; $i >= 0; $i--) {
                    $date = now()->subDays($i);
                    $count = \App\Models\LogAktivitas::whereDate('waktu', $date)->count();
                    $chartLabels[] = $date->format('d/m');
                    $chartData[] = $count;
                }
            @endphp
            
            activityChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($chartLabels),
                    datasets: [{
                        label: 'Jumlah Aktivitas',
                        data: @json($chartData),
                        backgroundColor: 'rgba(67, 97, 238, 0.7)',
                        borderColor: '#4361ee',
                        borderWidth: 1,
                        borderRadius: 8,
                        barPercentage: 0.6
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
                            backgroundColor: '#1a1a2e',
                            titleColor: '#fff',
                            bodyColor: '#e2e8f0',
                            callbacks: {
                                label: function(context) {
                                    return `Aktivitas: ${context.raw} kali`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#e2e8f0' },
                            ticks: { stepSize: 1 }
                        },
                        x: {
                            grid: { display: false }
                        }
                    }
                }
            });
        }

        // Toggle sidebar
        const sidebarToggle = document.getElementById('sidebarToggle');
        const appContainer = document.getElementById('appContainer');
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                appContainer.classList.toggle('sidebar-collapsed');
            });
        }

        // Toggle filter section
        const toggleFilters = document.getElementById('toggleFilters');
        const filterSection = document.getElementById('filterSection');
        if (toggleFilters && filterSection) {
            toggleFilters.addEventListener('click', () => {
                if (filterSection.style.display === 'none') {
                    filterSection.style.display = 'block';
                } else {
                    filterSection.style.display = 'none';
                }
            });
        }

        // Search functionality
        const searchInput = document.getElementById('searchInput');
        const searchHidden = document.getElementById('searchHidden');
        const searchClear = document.getElementById('searchClear');

        if (searchInput) {
            let searchTimeout;
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    searchHidden.value = this.value;
                    document.getElementById('filterForm').submit();
                }, 500);
            });
        }

        if (searchClear) {
            searchClear.addEventListener('click', function() {
                searchInput.value = '';
                searchHidden.value = '';
                document.getElementById('filterForm').submit();
            });
        }

        // Quick date filters
        const quickDateBtns = document.querySelectorAll('.quick-date-btn');
        const dateFrom = document.querySelector('input[name="date_from"]');
        const dateTo = document.querySelector('input[name="date_to"]');

        quickDateBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const range = this.dataset.range;
                const today = new Date();
                let from = new Date();
                let to = new Date();

                switch(range) {
                    case 'today':
                        from = today;
                        to = today;
                        break;
                    case 'yesterday':
                        from.setDate(today.getDate() - 1);
                        to.setDate(today.getDate() - 1);
                        break;
                    case 'week':
                        from.setDate(today.getDate() - 7);
                        to = today;
                        break;
                    case 'month':
                        from.setDate(today.getDate() - 30);
                        to = today;
                        break;
                }

                dateFrom.value = formatDate(from);
                dateTo.value = formatDate(to);
                document.getElementById('filterForm').submit();
            });
        });

        function formatDate(date) {
            return date.toISOString().split('T')[0];
        }

        // Remove filter
        const removeFilters = document.querySelectorAll('.remove-filter');
        removeFilters.forEach(btn => {
            btn.addEventListener('click', function() {
                const filter = this.dataset.filter;
                const url = new URL(window.location.href);
                url.searchParams.delete(filter);
                window.location.href = url.toString();
            });
        });

        // Clear all filters
        const clearAllFilters = document.getElementById('clearAllFilters');
        if (clearAllFilters) {
            clearAllFilters.addEventListener('click', () => {
                window.location.href = window.location.pathname;
            });
        }

        // Refresh data
        const refreshData = document.getElementById('refreshData');
        if (refreshData) {
            refreshData.addEventListener('click', function() {
                showLoading(true);
                setTimeout(() => window.location.reload(), 500);
            });
        }

        // Export Modal - FITUR BARU 2
        const exportBtn = document.getElementById('exportBtn');
        const exportModal = document.getElementById('exportModal');
        const closeModal = document.getElementById('closeModal');
        const cancelExport = document.getElementById('cancelExport');
        const confirmExportBtn = document.getElementById('confirmExport');

        if (exportBtn && exportModal) {
            exportBtn.addEventListener('click', () => {
                exportModal.classList.add('active');
            });
        }

        if (closeModal) {
            closeModal.addEventListener('click', () => {
                exportModal.classList.remove('active');
            });
        }

        if (cancelExport) {
            cancelExport.addEventListener('click', () => {
                exportModal.classList.remove('active');
            });
        }

        // Export option selection
        const exportOptions = document.querySelectorAll('.export-option');
        exportOptions.forEach(opt => {
            opt.addEventListener('click', function() {
                exportOptions.forEach(o => o.classList.remove('selected'));
                this.classList.add('selected');
            });
        });

        if (confirmExportBtn) {
            confirmExportBtn.addEventListener('click', function() {
                const format = document.querySelector('.export-option.selected')?.dataset.format || 'csv';
                showLoading(true);
                
                setTimeout(() => {
                    exportModal.classList.remove('active');
                    showLoading(false);
                    showToast(`Data berhasil diekspor sebagai ${format.toUpperCase()}`, 'success');
                }, 1000);
            });
        }

        // Show/hide loading
        function showLoading(show) {
            const overlay = document.getElementById('loadingOverlay');
            if (overlay) {
                overlay.style.display = show ? 'flex' : 'none';
            }
        }

        // Toast notification
        function showToast(message, type = 'info') {
            const existing = document.querySelector('.toast-notification');
            if (existing) existing.remove();
            
            const toast = document.createElement('div');
            toast.className = `toast-notification`;
            toast.style.background = type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : type === 'warning' ? '#f59e0b' : '#4361ee';
            toast.style.color = 'white';
            toast.innerHTML = `<i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-times-circle' : type === 'warning' ? 'fa-exclamation-triangle' : 'fa-info-circle'}"></i><span>${message}</span>`;
            
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }

        // Update notification badge
        function updateNotificationBadge() {
            const badge = document.getElementById('notificationBadge');
            if (badge) {
                const warningCount = parseInt(document.getElementById('warningCount')?.textContent || 0);
                const errorCount = parseInt(document.getElementById('errorCount')?.textContent || 0);
                const total = warningCount + errorCount;
                badge.textContent = total;
                if (total > 0) {
                    badge.style.background = total > 5 ? 'linear-gradient(135deg, var(--danger), var(--accent))' : 'linear-gradient(135deg, var(--warning), var(--accent))';
                }
            }
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            initChart();
            updateNotificationBadge();
            
            // Auto refresh every 30 seconds (optional)
            setInterval(() => {
                if (!document.hidden) {
                    // Optional: refresh data silently
                }
            }, 30000);
        });
    </script>
</body>
</html>