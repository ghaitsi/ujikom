<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Forent - Riwayat Pengembalian</title>

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
        .icon-info { background: linear-gradient(135deg, #3b82f6, #1e40af); }

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

        /* Filter Section */
        .filter-section {
            display: flex;
            gap: 16px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(248, 249, 250, 0.8);
            padding: 4px;
            border-radius: 999px;
            border: 2px solid transparent;
            transition: var(--transition);
        }

        .filter-group:hover {
            background: white;
            border-color: var(--primary-light);
        }

        .filter-btn {
            padding: 8px 20px;
            border-radius: 999px;
            border: none;
            background: transparent;
            color: var(--gray);
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-btn:hover {
            color: var(--primary);
        }

        .filter-btn.active {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);
        }

        .filter-btn i {
            font-size: 14px;
        }

        .date-filter {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(248, 249, 250, 0.8);
            padding: 4px 4px 4px 16px;
            border-radius: 999px;
            border: 2px solid transparent;
            transition: var(--transition);
        }

        .date-filter:hover {
            background: white;
            border-color: var(--primary-light);
        }

        .date-input {
            background: white;
            border: 2px solid var(--gray-light);
            border-radius: 999px;
            padding: 8px 16px;
            color: var(--dark);
            font-size: 14px;
            transition: var(--transition);
        }

        .date-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }

        /* Premium Table Styling */
        .table-container {
            overflow-x: auto;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-sm);
            -webkit-overflow-scrolling: touch;
        }

        .pengembalian-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: white;
            border-radius: var(--radius-md);
            overflow: hidden;
            min-width: 1200px;
        }

        .pengembalian-table thead {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            position: sticky;
            top: 0;
        }

        .pengembalian-table th {
            padding: 18px 20px;
            text-align: left;
            color: white;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        .pengembalian-table tbody tr {
            transition: var(--transition);
            border-bottom: 1px solid var(--gray-light);
        }

        .pengembalian-table tbody tr:last-child {
            border-bottom: none;
        }

        .pengembalian-table tbody tr:hover {
            background: rgba(67, 97, 238, 0.05);
            transform: translateX(4px);
        }

        .pengembalian-table td {
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

        /* User & Alat Info */
        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar-sm {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 14px;
            flex-shrink: 0;
        }

        .user-details {
            display: flex;
            flex-direction: column;
            gap: 2px;
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

        /* Denda Styling */
        .denda-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 12px;
            background: linear-gradient(135deg, rgba(249, 65, 68, 0.15), rgba(249, 65, 68, 0.05));
            color: var(--danger);
            border-radius: 999px;
            font-weight: 700;
            font-size: 13px;
            border: 2px solid rgba(249, 65, 68, 0.2);
        }

        .denda-badge i {
            font-size: 12px;
        }

        .denda-normal {
            background: linear-gradient(135deg, rgba(76, 201, 240, 0.15), rgba(76, 201, 240, 0.05));
            color: var(--success);
            border-color: rgba(76, 201, 240, 0.2);
        }

        /* Action Buttons - ONLY DETAIL BUTTON */
        .action-cell {
            display: flex;
            gap: 8px;
            justify-content: flex-start;
        }

        .btn-detail {
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

        .btn-detail:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
        }

        .btn-detail i {
            font-size: 12px;
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

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 16px;
        }

        .info-card {
            background: rgba(67, 97, 238, 0.03);
            border-radius: var(--radius-md);
            padding: 16px;
            border: 1px solid rgba(67, 97, 238, 0.1);
        }

        .info-card-title {
            font-size: 11px;
            text-transform: uppercase;
            color: var(--gray);
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .info-card-value {
            font-size: 16px;
            font-weight: 700;
            color: var(--dark);
        }

        .detail-row {
            display: flex;
            padding: 12px 0;
            border-bottom: 1px solid var(--gray-light);
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            width: 120px;
            color: var(--gray);
            font-size: 14px;
        }

        .detail-value {
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
            display: flex;
            align-items: center;
            gap: 8px;
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
            border-radius: 999px;
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

        /* Per-page selector */
        .per-page-selector {
            display: flex;
            align-items: center;
            gap: 12px;
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
            margin: 0 auto;
            color: var(--gray);
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

        .alert-warning {
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

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--gray-light);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, var(--primary), var(--secondary));
            border-radius: 999px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, var(--primary-light), var(--secondary));
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
            .search-bar {
                width: 200px;
            }
            
            .filter-section {
                flex-direction: column;
            }
            
            .filter-group {
                width: 100%;
                justify-content: space-between;
            }

            .info-grid {
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
            
            .action-cell {
                justify-content: flex-start;
            }
            
            .btn-detail {
                width: 100%;
                justify-content: center;
            }
            
            .pengembalian-table th,
            .pengembalian-table td {
                padding: 12px;
            }
            
            .filter-group {
                flex-wrap: wrap;
            }
            
            .filter-btn {
                flex: 1;
                justify-content: center;
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
            
            .pengembalian-table {
                font-size: 12px;
            }
            
            .modal-content {
                padding: 20px;
            }
            
            .detail-row {
                flex-direction: column;
                gap: 4px;
            }
            
            .detail-label {
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
                    <i class="fas fa-history" style="margin-right: 10px;"></i>
                    Riwayat Pengembalian
                </h1>
                <div class="header-actions">
                    <div class="search-bar" role="search">
                        <i class="fas fa-search search-icon" aria-hidden="true"></i>
                        <input type="text" class="search-input" id="searchInput" placeholder="Cari riwayat pengembalian... (Ctrl+K)" aria-label="Pencarian riwayat">
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
                        <div class="stat-icon icon-primary">
                            <i class="fas fa-rotate-left"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Total Pengembalian</h3>
                            <div class="number">{{ $totalPengembalian ?? $data->total() }}</div>
                            <div class="desc">Semua riwayat</div>
                        </div>
                    </div>

                    <div class="stat-card animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
                        <div class="stat-icon icon-success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Tepat Waktu</h3>
                            <div class="number">{{ $tepatWaktu ?? 0 }}</div>
                            <div class="desc">Sesuai rencana</div>
                        </div>
                    </div>

                    <div class="stat-card animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
                        <div class="stat-icon icon-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Terlambat</h3>
                            <div class="number">{{ $terlambat ?? 0 }}</div>
                            <div class="desc">Melewati rencana</div>
                        </div>
                    </div>

                    <div class="stat-card animate__animated animate__fadeInUp" style="animation-delay: 0.3s">
                        <div class="stat-icon icon-info">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Total Denda</h3>
                            <div class="number">Rp {{ number_format($totalDenda ?? 0, 0, ',', '.') }}</div>
                            <div class="desc">Akumulasi denda</div>
                        </div>
                    </div>
                </div>

                <!-- Alert Messages -->
                @if(session('success'))
                    <div class="alert alert-success animate__animated animate__fadeIn" role="alert">
                        <i class="fas fa-check-circle" aria-hidden="true"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('warning'))
                    <div class="alert alert-warning animate__animated animate__fadeIn" role="alert">
                        <i class="fas fa-exclamation-triangle" aria-hidden="true"></i>
                        {{ session('warning') }}
                    </div>
                @endif

                <!-- Premium Card Container -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-history"></i>
                            Riwayat Pengembalian Alat
                        </h3>
                        <div class="info-badge">
                            <i class="fas fa-eye"></i>
                            Mode Lihat Saja
                        </div>
                    </div>

                    <!-- Filter Section -->
                    <div class="filter-section">
                        <div class="filter-group">
                            <button class="filter-btn active" data-filter="semua">
                                <i class="fas fa-list-ul"></i>
                                Semua
                            </button>
                            <button class="filter-btn" data-filter="tepat-waktu">
                                <i class="fas fa-check-circle"></i>
                                Tepat Waktu
                            </button>
                            <button class="filter-btn" data-filter="terlambat">
                                <i class="fas fa-exclamation-triangle"></i>
                                Terlambat
                            </button>
                        </div>
                        <div class="date-filter">
                            <i class="fas fa-calendar-alt" style="color: var(--gray);"></i>
                            <input type="date" class="date-input" id="filterDate" value="{{ now()->format('Y-m-d') }}">
                        </div>
                    </div>

                    <!-- Table - TANPA KOLOM TANGGAL KEMBALI -->
                    <div class="table-container">
                        @if($data->count() > 0)
                            <table class="pengembalian-table">
                                <caption class="sr-only">Riwayat pengembalian alat</caption>
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">User</th>
                                        <th scope="col">Alat</th>
                                        <th scope="col">Tanggal Pinjam</th>
                                        <th scope="col">Rencana Kembali</th>
                                        <th scope="col">Keterlambatan</th>
                                        <th scope="col">Denda</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $row)
                                        @php
                                            // RESET KE AWAL HARI (00:00:00) UNTUK MENGHINDARI DESIMAL
                                            $today = now()->startOfDay();
                                            $rencanaKembali = \Carbon\Carbon::parse($row->tanggal_rencana_kembali)->startOfDay();
                                            
                                            // HITUNG SELISIH HARI (INTEGER)
                                            $selisihHari = $today->diffInDays($rencanaKembali, false); // false = bisa negatif
                                            
                                            // TENTUKAN TERLAMBAT ATAU TIDAK
                                            $isTerlambat = $selisihHari < 0; // NEGATIF = SUDAH MELEWATI RENCANA
                                            
                                            if ($isTerlambat) {
                                                $hariTerlambat = abs($selisihHari); // Ubah ke positif
                                                $denda = $hariTerlambat * 5000; // Rp 5.000 per hari
                                            } else {
                                                $hariTerlambat = 0;
                                                $denda = 0;
                                            }
                                        @endphp
                                        <tr class="animate__animated animate__fadeIn" 
                                            data-status="{{ $row->status }}"
                                            data-terlambat="{{ $isTerlambat ? 'true' : 'false' }}"
                                            data-tanggal="{{ \Carbon\Carbon::parse($row->tanggal_pinjam)->format('Y-m-d') }}">
                                            
                                            <td>
                                                <span class="id-badge">#{{ $row->id_peminjaman }}</span>
                                            </td>
                                            
                                            <td>
                                                <div class="user-info">
                                                    <div class="user-avatar-sm">
                                                        {{ strtoupper(substr($row->user->name ?? 'U', 0, 1)) }}
                                                    </div>
                                                    <div class="user-details">
                                                        <div class="user-name">{{ $row->user->name ?? '-' }}</div>
                                                        <div class="user-email">{{ $row->user->email ?? '' }}</div>
                                                    </div>
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
                                                    <div class="date-secondary">{{ \Carbon\Carbon::parse($row->tanggal_pinjam)->format('H:i') }} WIB</div>
                                                </div>
                                            </td>
                                            
                                            <td>
                                                <div class="date-cell">
                                                    <div class="date-primary">{{ \Carbon\Carbon::parse($row->tanggal_rencana_kembali)->format('d/m/Y') }}</div>
                                                </div>
                                            </td>
                                            
                                            <td>
                                                <div class="date-cell">
                                                    @if($isTerlambat)
                                                        <div class="date-primary" style="color: var(--danger);">
                                                            <i class="fas fa-exclamation-circle"></i>
                                                            {{ $hariTerlambat }} hari
                                                        </div>
                                                        <div class="date-secondary">Terlambat</div>
                                                    @else
                                                        <div class="date-primary" style="color: var(--success);">
                                                            <i class="fas fa-check-circle"></i>
                                                            0 hari
                                                        </div>
                                                        <div class="date-secondary">Tepat waktu</div>
                                                    @endif
                                                </div>
                                            </td>
                                            
                                            <td>
                                                @if($denda > 0)
                                                    <span class="denda-badge">
                                                        <i class="fas fa-coins"></i>
                                                        Rp {{ number_format($denda, 0, ',', '.') }}
                                                    </span>
                                                @else
                                                    <span class="denda-badge denda-normal">
                                                        <i class="fas fa-check-circle"></i>
                                                        Rp 0
                                                    </span>
                                                @endif
                                            </td>
                                            
                                            <td>
                                                @if($row->status == 'selesai')
                                                    <span class="status-badge status-dikembalikan">
                                                        <i class="fas fa-check-circle"></i>
                                                        Selesai
                                                    </span>
                                                @elseif($row->status == 'dikembalikan')
                                                    <span class="status-badge status-dikembalikan">
                                                        <i class="fas fa-check-circle"></i>
                                                        Dikembalikan
                                                    </span>
                                                @elseif($isTerlambat)
                                                    <span class="status-badge status-terlambat">
                                                        <i class="fas fa-exclamation-triangle"></i>
                                                        Terlambat
                                                    </span>
                                                @else
                                                    <span class="status-badge status-dipinjam">
                                                        <i class="fas fa-clock"></i>
                                                        Dipinjam
                                                    </span>
                                                @endif
                                            </td>                                            
                                                                                        <td>
                                                <div class="action-cell">
                                                    <button class="btn-detail" onclick='showDetailModal({{ json_encode($row) }}, {{ json_encode(["denda" => $denda, "terlambat" => $isTerlambat, "hari" => $hariTerlambat]) }})' aria-label="Lihat detail pengembalian">
                                                        <i class="fas fa-info-circle"></i> 
                                                        Detail
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="fas fa-history"></i>
                                </div>
                                <h3>Belum Ada Riwayat Pengembalian</h3>
                                <p>Belum ada data pengembalian alat yang tercatat dalam sistem.</p>
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
                    <i class="fas fa-info-circle"></i>
                    Detail Pengembalian
                </h3>
                <button class="modal-close" onclick="closeDetailModal()" aria-label="Tutup modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <!-- Info Grid -->
                <div class="info-grid">
                    <div class="info-card">
                        <div class="info-card-title">ID Peminjaman</div>
                        <div class="info-card-value" id="detailId">#12345</div>
                    </div>
                    <div class="info-card">
                        <div class="info-card-title">Status</div>
                        <div class="info-card-value" id="detailStatus">-</div>
                    </div>
                </div>

                <!-- User Info -->
                <div class="detail-row">
                    <span class="detail-label">Peminjam</span>
                    <span class="detail-value" id="detailUser">-</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Email</span>
                    <span class="detail-value" id="detailEmail">-</span>
                </div>

                <!-- Alat Info -->
                <div class="detail-row">
                    <span class="detail-label">Alat</span>
                    <span class="detail-value" id="detailAlat">-</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">ID Alat</span>
                    <span class="detail-value" id="detailAlatId">-</span>
                </div>

                <!-- Tanggal -->
                <div class="detail-row">
                    <span class="detail-label">Tanggal Pinjam</span>
                    <span class="detail-value" id="detailTglPinjam">-</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Rencana Kembali</span>
                    <span class="detail-value" id="detailRencanaKembali">-</span>
                </div>

                <!-- Keterlambatan & Denda -->
                <div class="detail-row">
                    <span class="detail-label">Keterlambatan</span>
                    <span class="detail-value" id="detailTerlambat">-</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Denda</span>
                    <span class="detail-value" id="detailDenda">-</span>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-close-modal" onclick="closeDetailModal()">
                    <i class="fas fa-times"></i>
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
            icon.className = appContainer.classList.contains('sidebar-collapsed') 
                ? 'fas fa-bars' 
                : 'fas fa-times';
        });
    }

    // ===== DOM =====
    const searchInput = document.getElementById('searchInput');
    const filterBtns = document.querySelectorAll('.filter-btn');
    const filterDate = document.getElementById('filterDate');

    // ===== 🔥 CORE FIX: HITUNG DENDA =====
    function hitungDenda(row) {
        const now = new Date();
        const tglRencana = row.tanggal_rencana_kembali ? new Date(row.tanggal_rencana_kembali) : null;
        const tglKembali = row.tanggal_kembali ? new Date(row.tanggal_kembali) : null;

        let terlambat = false;
        let hari = 0;
        let denda = 0;
        const DENDA_PER_HARI = 5000;

        if (!tglRencana) return { terlambat, hari, denda };

        if (row.status === 'dikembalikan') {
            if (tglKembali && tglKembali > tglRencana) {
                terlambat = true;
                hari = Math.ceil((tglKembali - tglRencana) / (1000 * 60 * 60 * 24));
                denda = hari * DENDA_PER_HARI;
            }
        } else {
            if (now > tglRencana) {
                terlambat = true;
                hari = Math.ceil((now - tglRencana) / (1000 * 60 * 60 * 24));
                denda = hari * DENDA_PER_HARI;
            }
        }

        return { terlambat, hari, denda };
    }

    // ===== SEARCH =====
    function performSearch(searchTerm) {
        const rows = document.querySelectorAll('.pengembalian-table tbody tr');

        if (!searchTerm || searchTerm.length < 2) {
            rows.forEach(row => row.style.display = '');
            return;
        }

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm.toLowerCase()) ? '' : 'none';
        });
    }

    if (searchInput) {
        let timeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(timeout);
            timeout = setTimeout(() => performSearch(this.value.trim()), 300);
        });
    }

    // ===== FILTER =====
    function applyFilter(filter, date) {
        const rows = document.querySelectorAll('.pengembalian-table tbody tr');

        rows.forEach(row => {
            let show = true;

            // 🔥 hitung ulang denda (bukan dari dataset!)
            const rowData = JSON.parse(row.dataset.row);
            const extra = hitungDenda(rowData);

            if (filter !== 'semua') {
                if (filter === 'tepat-waktu' && extra.terlambat) show = false;
                if (filter === 'terlambat' && !extra.terlambat) show = false;
            }

            if (date) {
                if (row.dataset.tanggal !== date) show = false;
            }

            row.style.display = show ? '' : 'none';
        });
    }

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            applyFilter(
                this.dataset.filter,
                filterDate?.value || null
            );
        });
    });

    // ===== MODAL =====
    window.showDetailModal = function(row) {
        const modal = document.getElementById('detailModal');

        // 🔥 HITUNG REAL TIME
        const extra = hitungDenda(row);

        document.getElementById('detailId').innerHTML = `#${row.id_peminjaman}`;

        let statusColor = 'var(--gray)';
        if (row.status === 'dikembalikan') statusColor = 'var(--success)';
        else if (extra.terlambat) statusColor = 'var(--danger)';
        else statusColor = 'var(--warning)';

        document.getElementById('detailStatus').innerHTML =
            `<span style="color:${statusColor};font-weight:700;">${row.status}</span>`;

        document.getElementById('detailUser').innerHTML = row.user?.name || '-';
        document.getElementById('detailEmail').innerHTML = row.user?.email || '-';
        document.getElementById('detailAlat').innerHTML = row.alat?.nama_alat || '-';

        const tglPinjam = new Date(row.tanggal_pinjam);
        const tglRencana = new Date(row.tanggal_rencana_kembali);

        document.getElementById('detailTglPinjam').innerHTML =
            tglPinjam.toLocaleString('id-ID');

        document.getElementById('detailRencanaKembali').innerHTML =
            tglRencana.toLocaleDateString('id-ID');

        // 🔥 FIX OUTPUT
        document.getElementById('detailTerlambat').innerHTML = extra.terlambat
            ? `<span style="color:red">${extra.hari} hari</span>`
            : `<span style="color:green">Tepat waktu</span>`;

        document.getElementById('detailDenda').innerHTML = extra.denda > 0
            ? `<span style="color:red;font-weight:700">Rp ${extra.denda.toLocaleString('id-ID')}</span>`
            : `<span style="color:green">Rp 0</span>`;

        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
    };

    window.closeDetailModal = function() {
        document.getElementById('detailModal').classList.remove('show');
        document.body.style.overflow = '';
    };

})();
</script>
</body>
</html>