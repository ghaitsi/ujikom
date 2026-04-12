<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Forent - Data Peminjaman</title>

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

        /* Info Badge - View Only Mode */
        .info-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            background: rgba(67, 97, 238, 0.08);
            border-radius: 999px;
            color: var(--primary);
            font-size: 13px;
            font-weight: 600;
            border: 1px solid rgba(67, 97, 238, 0.2);
        }

        .info-badge i {
            color: var(--primary);
        }

        /* Premium Table Styling */
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
            min-width: 1100px;
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

        /* ID Styling */
        .id-badge {
            display: inline-block;
            padding: 4px 8px;
            background: rgba(67, 97, 238, 0.1);
            color: var(--primary);
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 12px;
            border: 1px solid rgba(67, 97, 238, 0.2);
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
            white-space: nowrap;
            gap: 6px;
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

        .status-terlambat {
            background: linear-gradient(135deg, rgba(249, 65, 68, 0.15), rgba(249, 65, 68, 0.05));
            color: var(--danger);
            border: 2px solid rgba(249, 65, 68, 0.2);
        }

        .status-selesai {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.15), rgba(16, 185, 129, 0.05));
            color: #10b981;
            border: 2px solid rgba(16, 185, 129, 0.2);
        }

        /* User & Alat Info */
        .user-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .user-name {
            font-weight: 600;
            color: var(--dark);
        }

        .user-email {
            font-size: 12px;
            color: var(--gray);
        }

        .alat-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .alat-name {
            font-weight: 600;
            color: var(--dark);
        }

        .alat-id {
            font-size: 12px;
            color: var(--gray);
        }

        /* Date Styling */
        .date-cell {
            font-family: 'Monaco', 'Courier New', monospace;
            font-size: 13px;
        }

        .date-primary {
            font-weight: 600;
            color: var(--dark);
        }

        .date-secondary {
            font-size: 12px;
            color: var(--gray);
        }

        /* Detail Button - Hanya Lihat Detail */
        .btn-detail-view {
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
            text-decoration: none;
            white-space: nowrap;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
        }

        .btn-detail-view:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
        }

        .btn-detail-view i {
            font-size: 12px;
        }

        /* Empty State - Tanpa Tombol Tambah */
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
            margin: 0 auto;
            color: var(--gray);
        }

        /* ===== PREMIUM PAGINATION STYLING ===== */
        .pagination-wrapper {
            margin-top: 32px;
            padding-top: 24px;
            border-top: 2px solid rgba(67, 97, 238, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
        }

        .pagination-info {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 16px;
            background: rgba(67, 97, 238, 0.03);
            border-radius: 100px;
            color: var(--gray);
            font-size: 13px;
            font-weight: 500;
        }

        .pagination-info i {
            color: var(--primary);
            font-size: 14px;
        }

        .pagination {
            display: flex;
            align-items: center;
            gap: 8px;
            list-style: none;
            flex-wrap: wrap;
            justify-content: center;
            margin: 0;
            padding: 0;
        }

        .pagination-item {
            display: inline-flex;
        }

        .pagination-link,
        .pagination-current {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 44px;
            height: 44px;
            padding: 0 12px;
            border-radius: 12px;
            background: white;
            color: var(--dark);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            border: 2px solid transparent;
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
            position: relative;
            overflow: hidden;
        }

        .pagination-link {
            border-color: var(--gray-light);
        }

        .pagination-link::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(67, 97, 238, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
            z-index: 0;
        }

        .pagination-link:hover::before {
            width: 300px;
            height: 300px;
        }

        .pagination-link:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            color: var(--primary);
        }

        .pagination-link i {
            position: relative;
            z-index: 1;
            font-size: 14px;
        }

        .pagination-current {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
            transform: scale(1.05);
        }

        .pagination-current::after {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 14px;
            z-index: -1;
            opacity: 0.5;
            filter: blur(8px);
        }

        .pagination-dots {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 44px;
            height: 44px;
            color: var(--gray);
            font-weight: 600;
            font-size: 18px;
            letter-spacing: 2px;
        }

        .pagination-nav {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 0 8px;
        }

        .pagination-nav .pagination-link {
            min-width: 44px;
            background: white;
        }

        .pagination-nav .pagination-link:first-child i {
            margin-right: 4px;
        }

        .pagination-nav .pagination-link:last-child i {
            margin-left: 4px;
        }

        /* Per-page selector */
        .per-page-selector {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-left: 16px;
        }

        .per-page-selector select {
            padding: 8px 12px;
            border-radius: 10px;
            border: 2px solid var(--gray-light);
            background: white;
            color: var(--dark);
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            transition: var(--transition);
            outline: none;
        }

        .per-page-selector select:hover {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }

        .per-page-selector select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }

        .per-page-selector label {
            color: var(--gray);
            font-size: 13px;
            font-weight: 500;
        }

        /* Detail Modal - View Only */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(8px);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            animation: fadeIn 0.3s ease;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: var(--radius-lg);
            padding: 32px;
            max-width: 550px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: var(--shadow-lg);
            animation: slideUp 0.4s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 2px solid rgba(67, 97, 238, 0.1);
        }

        .modal-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .modal-title i {
            color: var(--primary);
        }

        .modal-close {
            background: none;
            border: none;
            color: var(--gray);
            font-size: 20px;
            cursor: pointer;
            transition: var(--transition);
        }

        .modal-close:hover {
            color: var(--danger);
            transform: rotate(90deg);
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 20px;
        }

        .detail-item {
            background: rgba(67, 97, 238, 0.03);
            border-radius: var(--radius-md);
            padding: 16px;
            border: 1px solid rgba(67, 97, 238, 0.1);
        }

        .detail-label {
            font-size: 11px;
            text-transform: uppercase;
            color: var(--gray);
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .detail-value {
            font-size: 16px;
            font-weight: 700;
            color: var(--dark);
        }

        .detail-sub {
            font-size: 12px;
            color: var(--gray);
            margin-top: 4px;
        }

        .detail-row {
            display: flex;
            padding: 12px 0;
            border-bottom: 1px solid var(--gray-light);
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-row .label {
            width: 140px;
            color: var(--gray);
            font-size: 14px;
        }

        .detail-row .value {
            flex: 1;
            color: var(--dark);
            font-weight: 600;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            margin-top: 24px;
            padding-top: 16px;
            border-top: 1px solid var(--gray-light);
        }

        .btn-close-modal {
            padding: 10px 24px;
            background: var(--gray-light);
            color: var(--dark);
            border: none;
            border-radius: var(--radius-md);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-close-modal:hover {
            background: var(--gray);
            color: white;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Alert Message */
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

        @media (max-width: 992px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }
            
            .pagination-wrapper {
                flex-direction: column;
                align-items: center;
                gap: 16px;
            }
            
            .per-page-selector {
                margin-left: 0;
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
            
            .btn-detail-view {
                width: 100%;
                justify-content: center;
            }
            
            .peminjaman-table th,
            .peminjaman-table td {
                padding: 12px;
            }

            .modal-content {
                padding: 24px;
            }

            .pagination {
                gap: 4px;
            }

            .pagination-link,
            .pagination-current {
                min-width: 38px;
                height: 38px;
                padding: 0 8px;
                font-size: 13px;
            }

            .pagination-dots {
                min-width: 38px;
                height: 38px;
            }
        }

        @media (max-width: 480px) {
            .header-title {
                font-size: 22px;
            }
            
            .user-menu {
                padding: 6px 12px;
            }
            
            .user-menu-avatar {
                width: 32px;
                height: 32px;
                font-size: 14px;
            }
            
            .peminjaman-table {
                font-size: 12px;
            }

            .detail-row {
                flex-direction: column;
                gap: 4px;
            }

            .detail-row .label {
                width: 100%;
            }

            .pagination-info {
                flex-wrap: wrap;
                justify-content: center;
                text-align: center;
            }

            .per-page-selector {
                width: 100%;
                justify-content: center;
            }
        }

        /* Loading Skeleton */
        .skeleton {
            animation: skeleton-loading 1s linear infinite alternate;
        }

        @keyframes skeleton-loading {
            0% { background-color: hsl(200, 20%, 90%); }
            100% { background-color: hsl(200, 20%, 95%); }
        }
    </style>
</head>
<body>
    <!-- Sidebar Toggle Button -->
    <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle Sidebar">
        <i class="fas fa-bars"></i>
    </button>

    <!-- App Container -->
    <div class="app-container" id="appContainer">
        <!-- Include Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <main class="main-content" id="mainContent">
            <!-- Glass Header -->
            <header class="header animate__animated animate__fadeIn">
                <h1 class="header-title">
                    <i class="fas fa-box" aria-hidden="true" style="margin-right: 10px;"></i>
                    Data Peminjaman
                </h1>
                <div class="header-actions">
                    <div class="search-bar" role="search">
                        <i class="fas fa-search search-icon" aria-hidden="true"></i>
                        <input type="text" class="search-input" id="searchInput" placeholder="Cari peminjaman... (Ctrl+K)" aria-label="Pencarian peminjaman">
                    </div>
                    <button class="notification-btn" id="notificationBtn" aria-label="Notifikasi">
                        <i class="fas fa-bell" aria-hidden="true"></i>
                        <span class="notification-badge" aria-label="3 notifikasi baru">3</span>
                    </button>
                    <div class="user-menu" id="userMenu" role="button" tabindex="0" aria-label="Menu pengguna">
                        <div class="user-menu-avatar" aria-hidden="true">
                            @auth
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            @else
                                GU
                            @endauth
                        </div>
                        <div style="display: flex; flex-direction: column; align-items: flex-start;">
                            <span style="font-weight: 600; font-size: 14px; color: var(--dark);">
                                @auth
                                    {{ Auth::user()->name }}
                                @else
                                    Guest User
                                @endauth
                            </span>
                            <span style="font-size: 12px; color: var(--gray);">Viewer</span>
                        </div>
                        <i class="fas fa-chevron-down" style="color: var(--gray); font-size: 12px;" aria-hidden="true"></i>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="content-wrapper">
                <!-- Stats Cards -->
                <div class="stats-container">
                    <div class="stat-card animate__animated animate__fadeInUp">
                        <div class="stat-icon icon-primary" aria-hidden="true">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Total Peminjaman</h3>
                            <div class="number">{{ $totalPeminjaman ?? $data->total() }}</div>
                            <div class="desc">Semua peminjaman</div>
                        </div>
                    </div>

                    <div class="stat-card animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
                        <div class="stat-icon icon-success" aria-hidden="true">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Selesai</h3>
                            <div class="number">{{ $selesai ?? 0 }}</div>
                            <div class="desc">Peminjaman selesai</div>
                        </div>
                    </div>

                    <div class="stat-card animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
                        <div class="stat-icon icon-warning" aria-hidden="true">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Dipinjam</h3>
                            <div class="number">{{ $dipinjam ?? 0 }}</div>
                            <div class="desc">Masih dipinjam</div>
                        </div>
                    </div>

                    <div class="stat-card animate__animated animate__fadeInUp" style="animation-delay: 0.3s">
                        <div class="stat-icon icon-danger" aria-hidden="true">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Terlambat</h3>
                            <div class="number">{{ $terlambat ?? 0 }}</div>
                            <div class="desc">Melewati batas</div>
                        </div>
                    </div>
                </div>

                <!-- Success Message -->
                @if(session('success'))
                    <div class="alert alert-success animate__animated animate__fadeIn" role="alert">
                        <i class="fas fa-check-circle" aria-hidden="true"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Premium Card Container - Tanpa Tombol Tambah -->
                <div class="dashboard-card animate__animated animate__fadeInUp">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-list-alt" aria-hidden="true"></i>
                            Daftar Peminjaman
                        </h3>
                        <div class="info-badge">
                            <i class="fas fa-eye" aria-hidden="true"></i>
                            Mode Lihat Saja
                        </div>
                    </div>

                    <!-- Table - Tanpa Kolom Aksi -->
                    <div class="table-container">
                        @if($data->count() > 0)
                            <table class="peminjaman-table">
                                <caption class="sr-only">Daftar peminjaman alat</caption>
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">User</th>
                                        <th scope="col">Alat</th>
                                        <th scope="col">Tanggal Pinjam</th>
                                        <th scope="col">Rencana Kembali</th>
                                        <th scope="col">Sisa Waktu</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $row)
                                    @php
                                        // RESET KE AWAL HARI UNTUK MENGHINDARI DESIMAL
                                        $today = now()->startOfDay();
                                        $rencanaKembali = \Carbon\Carbon::parse($row->tanggal_kembali)->startOfDay();
                                        
                                        // HITUNG SELISIH HARI (INTEGER)
                                        $selisihHari = $today->diffInDays($rencanaKembali, false);
                                        
                                        // TENTUKAN STATUS
                                        $statusClass = '';
                                        $statusIcon = '';
                                        $statusText = '';
                                        
                                        // PRIORITAS 1: SELESAI
                                        if($row->status == 'selesai') {
                                            $statusClass = 'status-selesai';
                                            $statusIcon = 'fa-check-double';
                                            $statusText = 'Selesai';
                                        }
                                        // PRIORITAS 2: DIKEMBALIKAN
                                        elseif($row->status == 'dikembalikan') {
                                            $statusClass = 'status-dikembalikan';
                                            $statusIcon = 'fa-check-circle';
                                            $statusText = 'Dikembalikan';
                                        }
                                        // PRIORITAS 3: TERLAMBAT (berdasarkan status atau perhitungan)
                                        elseif($row->status == 'terlambat' || $selisihHari < 0) {
                                            $statusClass = 'status-terlambat';
                                            $statusIcon = 'fa-exclamation-triangle';
                                            $statusText = 'Terlambat';
                                        }
                                        // PRIORITAS 4: DIPINJAM (default)
                                        else {
                                            $statusClass = 'status-dipinjam';
                                            $statusIcon = 'fa-clock';
                                            $statusText = 'Dipinjam';
                                        }
                                    @endphp
                                    <tr class="animate__animated animate__fadeIn" style="animation-delay: {{ $loop->index * 0.05 }}s">
                                        <td>
                                            <span class="id-badge">#{{ $row->id_peminjaman }}</span>
                                        </td>
                                        
                                        <td>
                                            <div class="user-info">
                                                <div class="user-name">{{ $row->user->name ?? '-' }}</div>
                                                <div class="user-email">{{ $row->user->email ?? '' }}</div>
                                            </div>
                                        </td>
                                        
                                        <td>
                                            <div class="alat-info">
                                                <div class="alat-name">{{ $row->alat->nama_alat ?? '-' }}</div>
                                                <div class="alat-id">ID: {{ $row->alat->id_alat ?? '' }}</div>
                                            </div>
                                        </td>
                                        
                                        <td>
                                            <div class="date-cell">
                                                <div class="date-primary">{{ \Carbon\Carbon::parse($row->tanggal_pinjam)->format('d/m/Y') }}</div>
                                                @if($row->created_at)
                                                    <div class="date-secondary">{{ $row->created_at->format('H:i') }} WIB</div>
                                                @endif
                                            </div>
                                        </td>
                                        
                                        <td>
                                            <div class="date-cell">
                                                <div class="date-primary">{{ \Carbon\Carbon::parse($row->tanggal_kembali)->format('d/m/Y') }}</div>
                                            </div>
                                        </td>
                                        
                                        <td>
                                            <div class="date-cell">
                                                @if(in_array($row->status, ['selesai', 'dikembalikan']))
                                                    <div class="date-primary" style="color: var(--gray);">-</div>
                                                    <div class="date-secondary">Selesai</div>
                                                @elseif($selisihHari > 0)
                                                    <div class="date-primary" style="color: var(--success);">{{ $selisihHari }} hari</div>
                                                    <div class="date-secondary">Tersisa</div>
                                                @elseif($selisihHari == 0)
                                                    <div class="date-primary" style="color: var(--warning);">Hari ini</div>
                                                    <div class="date-secondary">Batas akhir</div>
                                                @else
                                                    <div class="date-primary" style="color: var(--danger);">{{ abs($selisihHari) }} hari</div>
                                                    <div class="date-secondary">Terlambat</div>
                                                @endif
                                            </div>
                                        </td>
                                        
                                        <td>
                                            <span class="status-badge {{ $statusClass }}">
                                                <i class="fas {{ $statusIcon }}" aria-hidden="true"></i>
                                                {{ $statusText }}
                                            </span>
                                        </td>
                                        
                                        <td>
                                            <button class="btn-detail-view" onclick='showDetailModal({{ json_encode($row) }}, {{ json_encode(["selisihHari" => $selisihHari, "status" => $statusText]) }})' aria-label="Lihat detail peminjaman">
                                                <i class="fas fa-info-circle" aria-hidden="true"></i>
                                                Detail
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="empty-state">
                                <div class="empty-icon" aria-hidden="true">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <h3>Tidak ada data peminjaman</h3>
                                <p>Belum ada peminjaman yang tercatat.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Premium Pagination -->
                    @if(method_exists($data, 'links') && $data->hasPages())
                        <div class="pagination-wrapper animate__animated animate__fadeInUp">
                            <!-- Info Pagination -->
                            <div class="pagination-info">
                                <i class="fas fa-chart-bar"></i>
                                <span>Menampilkan {{ $data->firstItem() }} - {{ $data->lastItem() }} dari {{ $data->total() }} data</span>
                            </div>

                            <!-- Custom Pagination dengan Style Premium -->
                            <div class="pagination">
                                {{-- Tombol Previous --}}
                                @if($data->onFirstPage())
                                    <span class="pagination-link" style="opacity: 0.5; cursor: not-allowed; background: #f8f9fa;">
                                        <i class="fas fa-chevron-left"></i>
                                    </span>
                                @else
                                    <a href="{{ $data->previousPageUrl() }}" class="pagination-link" aria-label="Halaman sebelumnya">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                @endif

                                {{-- Nomor Halaman dengan efek premium --}}
                                @foreach($data->getUrlRange(1, $data->lastPage()) as $page => $url)
                                    @if($page == $data->currentPage())
                                        <span class="pagination-current" aria-current="page">{{ $page }}</span>
                                    @elseif($page == 1 || $page == $data->lastPage() || ($page >= $data->currentPage() - 2 && $page <= $data->currentPage() + 2))
                                        <a href="{{ $url }}" class="pagination-link">{{ $page }}</a>
                                    @elseif($page == $data->currentPage() - 3 || $page == $data->currentPage() + 3)
                                        <span class="pagination-dots">...</span>
                                    @endif
                                @endforeach

                                {{-- Tombol Next --}}
                                @if($data->hasMorePages())
                                    <a href="{{ $data->nextPageUrl() }}" class="pagination-link" aria-label="Halaman selanjutnya">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                @else
                                    <span class="pagination-link" style="opacity: 0.5; cursor: not-allowed; background: #f8f9fa;">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                @endif
                            </div>

                            <!-- Per Page Selector -->
                            <div class="per-page-selector">
                                <label for="perPage">Tampilkan:</label>
                                <select id="perPage" onchange="changePerPage(this.value)">
                                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                                </select>
                                <span>data per halaman</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>

    <!-- Detail Modal -->
    <div class="modal" id="detailModal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalTitle">
                    <i class="fas fa-info-circle" aria-hidden="true"></i>
                    Detail Peminjaman
                </h3>
                <button class="modal-close" onclick="closeDetailModal()" aria-label="Tutup modal">
                    <i class="fas fa-times" aria-hidden="true"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="detail-grid">
                    <div class="detail-item">
                        <div class="detail-label">ID Peminjaman</div>
                        <div class="detail-value" id="detailId">-</div>
                        <div class="detail-sub" id="detailStatus">-</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Status</div>
                        <div class="detail-value" id="detailStatusBadge">-</div>
                        <div class="detail-sub" id="detailKondisi">-</div>
                    </div>
                </div>

                <div class="detail-row">
                    <span class="label">Peminjam</span>
                    <span class="value" id="detailUser">-</span>
                </div>
                <div class="detail-row">
                    <span class="label">Email</span>
                    <span class="value" id="detailEmail">-</span>
                </div>
                <div class="detail-row">
                    <span class="label">Alat</span>
                    <span class="value" id="detailAlat">-</span>
                </div>
                <div class="detail-row">
                    <span class="label">ID Alat</span>
                    <span class="value" id="detailAlatId">-</span>
                </div>
                <div class="detail-row">
                    <span class="label">Tanggal Pinjam</span>
                    <span class="value" id="detailTglPinjam">-</span>
                </div>
                <div class="detail-row">
                    <span class="label">Rencana Kembali</span>
                    <span class="value" id="detailRencanaKembali">-</span>
                </div>
                <div class="detail-row">
                    <span class="label">Tanggal Kembali</span>
                    <span class="value" id="detailTglKembali">-</span>
                </div>
                <div class="detail-row">
                    <span class="label">Sisa Waktu</span>
                    <span class="value" id="detailSisaWaktu">-</span>
                </div>
                <div class="detail-row">
                    <span class="label">Keterangan</span>
                    <span class="value" id="detailKeterangan">-</span>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-close-modal" onclick="closeDetailModal()">
                    <i class="fas fa-times" aria-hidden="true"></i>
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <script>
        (function() {
            'use strict';
            
            // ===== SIDEBAR TOGGLE =====
            const sidebarToggle = document.getElementById('sidebarToggle');
            const appContainer = document.getElementById('appContainer');

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    appContainer.classList.toggle('sidebar-collapsed');
                    
                    const icon = this.querySelector('i');
                    if (appContainer.classList.contains('sidebar-collapsed')) {
                        icon.className = 'fas fa-bars';
                    } else {
                        icon.className = 'fas fa-times';
                    }
                });
            }

            // ===== DOM ELEMENTS =====
            const searchInput = document.getElementById('searchInput');
            const notificationBtn = document.getElementById('notificationBtn');
            const userMenu = document.getElementById('userMenu');
            
            // ===== SEARCH FUNCTIONALITY =====
            function performSearch(searchTerm) {
                if (!searchTerm || searchTerm.length < 2) {
                    document.querySelectorAll('.peminjaman-table tbody tr').forEach(row => {
                        row.style.display = '';
                    });
                    return;
                }
                
                const rows = document.querySelectorAll('.peminjaman-table tbody tr');
                let foundCount = 0;
                
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    const isMatch = text.includes(searchTerm.toLowerCase());
                    row.style.display = isMatch ? '' : 'none';
                    if (isMatch) foundCount++;
                });
                
                showNotification(
                    foundCount > 0 
                        ? `✅ Ditemukan ${foundCount} hasil pencarian` 
                        : `❌ Tidak ditemukan data dengan kata kunci "${searchTerm}"`,
                    foundCount > 0 ? 'success' : 'warning'
                );
            }
            
            // Search with debounce
            let searchTimeout;
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        performSearch(this.value.trim());
                    }, 300);
                });
                
                // Search on enter key
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        performSearch(this.value.trim());
                    }
                });
            }
            
            // ===== PER PAGE SELECTOR =====
            window.changePerPage = function(value) {
                const url = new URL(window.location.href);
                url.searchParams.set('per_page', value);
                url.searchParams.set('page', 1); // Reset ke halaman pertama
                window.location.href = url.toString();
            };
            
            // ===== DETAIL MODAL =====
            window.showDetailModal = function(row, extra) {
                const modal = document.getElementById('detailModal');
                
                // ID
                document.getElementById('detailId').innerHTML = `#${row.id_peminjaman}`;
                
                // Status
                let statusClass = '';
                let statusIcon = '';
                let statusText = row.status || '-';
                
                if (row.status == 'selesai') {
                    statusClass = 'status-selesai';
                    statusIcon = 'fa-check-double';
                } else if (row.status == 'dikembalikan') {
                    statusClass = 'status-dikembalikan';
                    statusIcon = 'fa-check-circle';
                } else if (row.status == 'terlambat' || extra.selisihHari < 0) {
                    statusClass = 'status-terlambat';
                    statusIcon = 'fa-exclamation-triangle';
                } else {
                    statusClass = 'status-dipinjam';
                    statusIcon = 'fa-clock';
                }
                
                document.getElementById('detailStatus').innerHTML = extra.status || statusText;
                document.getElementById('detailStatusBadge').innerHTML = `
                    <span class="status-badge ${statusClass}" style="display: inline-flex;">
                        <i class="fas ${statusIcon}"></i>
                        ${extra.status || statusText}
                    </span>
                `;
                
                // Kondisi
                let kondisi = '';
                if (in_array(row.status, ['selesai', 'dikembalikan'])) {
                    kondisi = 'Selesai';
                } else if (extra.selisihHari < 0) {
                    kondisi = 'Terlambat';
                } else if (extra.selisihHari == 0) {
                    kondisi = 'Batas akhir';
                } else {
                    kondisi = 'Tepat waktu';
                }
                document.getElementById('detailKondisi').innerHTML = kondisi;
                
                // User
                document.getElementById('detailUser').innerHTML = row.user?.name || '-';
                document.getElementById('detailEmail').innerHTML = row.user?.email || '-';
                
                // Alat
                document.getElementById('detailAlat').innerHTML = row.alat?.nama_alat || '-';
                document.getElementById('detailAlatId').innerHTML = row.alat?.id_alat || '-';
                
                // Tanggal
                const tglPinjam = row.tanggal_pinjam ? new Date(row.tanggal_pinjam) : null;
                const tglRencana = row.tanggal_kembali ? new Date(row.tanggal_kembali) : null;
                const tglKembali = row.tanggal_kembali ? new Date(row.tanggal_kembali) : null;
                
                document.getElementById('detailTglPinjam').innerHTML = tglPinjam ? tglPinjam.toLocaleDateString('id-ID', { day: '2-digit', month: '2-digit', year: 'numeric' }) + ' ' + tglPinjam.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }) + ' WIB' : '-';
                
                document.getElementById('detailRencanaKembali').innerHTML = tglRencana ? tglRencana.toLocaleDateString('id-ID', { day: '2-digit', month: '2-digit', year: 'numeric' }) : '-';
                
                document.getElementById('detailTglKembali').innerHTML = tglKembali ? tglKembali.toLocaleDateString('id-ID', { day: '2-digit', month: '2-digit', year: 'numeric' }) + ' ' + tglKembali.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }) + ' WIB' : '-';
                
                // Sisa Waktu
                let sisaWaktu = '';
                if (in_array(row.status, ['selesai', 'dikembalikan'])) {
                    sisaWaktu = `<span style="color: var(--gray);">-</span>`;
                } else if (extra.selisihHari > 0) {
                    sisaWaktu = `<span style="color: var(--success);">${extra.selisihHari} hari tersisa</span>`;
                } else if (extra.selisihHari == 0) {
                    sisaWaktu = `<span style="color: var(--warning);">Batas akhir hari ini</span>`;
                } else {
                    sisaWaktu = `<span style="color: var(--danger);">${Math.abs(extra.selisihHari)} hari terlambat</span>`;
                }
                document.getElementById('detailSisaWaktu').innerHTML = sisaWaktu;
                
                // Keterangan
                document.getElementById('detailKeterangan').innerHTML = row.keterangan || '-';
                
                // Show modal
                modal.classList.add('show');
                document.body.style.overflow = 'hidden';
            };
            
            function in_array(value, array) {
                return array.indexOf(value) > -1;
            }
            
            window.closeDetailModal = function() {
                const modal = document.getElementById('detailModal');
                modal.classList.remove('show');
                document.body.style.overflow = '';
            };
            
            // ===== NOTIFICATION BUTTON =====
            if (notificationBtn) {
                notificationBtn.addEventListener('click', function() {
                    showNotification('📬 Tidak ada notifikasi baru', 'info');
                    
                    const badge = this.querySelector('.notification-badge');
                    if (badge) {
                        badge.style.transform = 'scale(0)';
                        setTimeout(() => {
                            badge.style.transform = 'scale(1)';
                            badge.textContent = '0';
                        }, 300);
                    }
                });
            }
            
            // ===== USER MENU =====
            if (userMenu) {
                userMenu.addEventListener('click', function() {
                    showNotification('👤 Menu pengguna', 'info');
                });

                // Keyboard accessibility
                userMenu.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        this.click();
                    }
                });
            }
            
            // ===== TOAST NOTIFICATION =====
            function showNotification(message, type = 'info') {
                const existingToast = document.querySelector('.custom-toast');
                if (existingToast) existingToast.remove();
                
                const toast = document.createElement('div');
                toast.className = 'custom-toast';
                toast.setAttribute('role', 'alert');
                
                const bgColor = type === 'success' ? 'var(--success)' : 
                               type === 'warning' ? 'var(--warning)' : 
                               type === 'error' ? 'var(--danger)' : 'var(--primary)';
                
                toast.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background: ${bgColor};
                    color: white;
                    padding: 16px 24px;
                    border-radius: var(--radius-md);
                    font-weight: 600;
                    box-shadow: var(--shadow-lg);
                    z-index: 9999;
                    display: flex;
                    align-items: center;
                    gap: 12px;
                    animation: slideInRight 0.3s ease;
                    max-width: 400px;
                `;
                
                const icon = type === 'success' ? 'fa-check-circle' : 
                           type === 'warning' ? 'fa-exclamation-triangle' : 
                           type === 'error' ? 'fa-times-circle' : 'fa-info-circle';
                
                toast.innerHTML = `
                    <i class="fas ${icon}" style="font-size: 18px;" aria-hidden="true"></i>
                    <span style="flex: 1;">${message}</span>
                    <button onclick="this.parentElement.remove()" style="background: none; border: none; color: white; cursor: pointer; font-size: 16px; opacity: 0.8;" aria-label="Tutup notifikasi">
                        <i class="fas fa-times" aria-hidden="true"></i>
                    </button>
                `;
                
                document.body.appendChild(toast);
                
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.style.animation = 'slideOutRight 0.3s ease';
                        setTimeout(() => toast.remove(), 300);
                    }
                }, 3000);
            }
            
            // ===== KEYBOARD SHORTCUTS =====
            document.addEventListener('keydown', function(e) {
                // Ctrl/Cmd + K to focus search
                if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                    e.preventDefault();
                    if (searchInput) {
                        searchInput.focus();
                        showNotification('🔍 Pencarian siap', 'info');
                    }
                }
                
                // ESC to clear search
                if (e.key === 'Escape' && document.activeElement === searchInput) {
                    searchInput.value = '';
                    document.querySelectorAll('.peminjaman-table tbody tr').forEach(row => {
                        row.style.display = '';
                    });
                    searchInput.blur();
                    showNotification('🧹 Pencarian dibersihkan', 'info');
                }
                
                // ESC to close modal
                if (e.key === 'Escape') {
                    closeDetailModal();
                }
            });
            
            // ===== ANIMATION STYLES =====
            const style = document.createElement('style');
            style.textContent = `
                @keyframes slideInRight {
                    from { opacity: 0; transform: translateX(100%); }
                    to { opacity: 1; transform: translateX(0); }
                }
                
                @keyframes slideOutRight {
                    from { opacity: 1; transform: translateX(0); }
                    to { opacity: 0; transform: translateX(100%); }
                }
                
                .custom-toast {
                    will-change: transform;
                }

                .sr-only {
                    position: absolute;
                    width: 1px;
                    height: 1px;
                    padding: 0;
                    margin: -1px;
                    overflow: hidden;
                    clip: rect(0, 0, 0, 0);
                    white-space: nowrap;
                    border: 0;
                }
            `;
            document.head.appendChild(style);
            
            // ===== RESIZE HANDLER =====
            window.addEventListener('resize', function() {
                if (window.innerWidth > 1200) {
                    appContainer.classList.remove('sidebar-collapsed');
                    if (sidebarToggle) {
                        sidebarToggle.querySelector('i').className = 'fas fa-bars';
                    }
                }
            });
            
            // ===== CLOSE MODAL ON CLICK OUTSIDE =====
            document.getElementById('detailModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeDetailModal();
                }
            });
            
            console.log('🚀 Forent Data Peminjaman - View Only Mode dengan Premium Pagination');
        })();
    </script>
</body>
</html>