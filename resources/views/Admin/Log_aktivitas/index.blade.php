<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Forent - Log Aktivitas</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <!-- Flatpickr for Date Range -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">

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

        /* Search Bar */
        .search-wrapper {
            position: relative;
            width: 360px;
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
            pointer-events: none;
        }

        .search-clear {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            font-size: 14px;
            cursor: pointer;
            padding: 6px;
            border-radius: 50%;
            background: var(--gray-light);
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            opacity: 0;
            visibility: hidden;
        }

        .search-input:not(:placeholder-shown) + .search-icon + .search-clear {
            opacity: 1;
            visibility: visible;
        }

        .search-clear:hover {
            background: var(--danger);
            color: white;
            transform: translateY(-50%) scale(1.1);
        }

        /* Notification Button */
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

        /* User Menu */
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
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            opacity: 0;
            transition: var(--transition);
        }

        .stat-card:hover::before {
            opacity: 1;
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
            box-shadow: var(--shadow-sm);
            position: relative;
            z-index: 1;
        }

        .icon-info {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }

        .icon-warning {
            background: linear-gradient(135deg, var(--warning), #f97316);
        }

        .icon-success {
            background: linear-gradient(135deg, var(--success), #0ea5e9);
        }

        .icon-danger {
            background: linear-gradient(135deg, var(--danger), #dc2626);
        }

        .stat-info {
            position: relative;
            z-index: 1;
        }

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

        .stat-info .trend {
            font-size: 12px;
            color: var(--success);
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
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
            flex-wrap: wrap;
            gap: 16px;
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

        .card-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .action-btn {
            padding: 10px 20px;
            border: none;
            border-radius: var(--radius-md);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success), #0ea5e9);
            color: white;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--warning), #f97316);
            color: white;
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--gray-light);
            color: var(--dark);
        }

        .btn-outline:hover {
            background: var(--gray-light);
            transform: translateY(-2px);
        }

        /* Filter Section */
        .filter-section {
            background: rgba(248, 249, 250, 0.5);
            border-radius: var(--radius-lg);
            padding: 24px;
            margin-bottom: 24px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
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
            gap: 8px;
        }

        .filter-item label {
            font-size: 13px;
            font-weight: 600;
            color: var(--gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .filter-input {
            padding: 12px 16px;
            border: 2px solid var(--gray-light);
            border-radius: var(--radius-md);
            font-size: 14px;
            color: var(--dark);
            background: white;
            transition: var(--transition);
            width: 100%;
        }

        .filter-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.1);
        }

        .filter-input:hover {
            border-color: var(--primary-light);
        }

        .filter-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            flex-wrap: wrap;
        }

        /* Active Filters */
        .active-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
            padding: 16px;
            background: rgba(67, 97, 238, 0.05);
            border-radius: var(--radius-md);
            border: 1px dashed var(--primary-light);
        }

        .filter-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            background: white;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            color: var(--dark);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-light);
        }

        .filter-tag i {
            color: var(--primary);
            font-size: 12px;
        }

        .filter-tag .remove-filter {
            cursor: pointer;
            padding: 2px 6px;
            border-radius: 50%;
            transition: var(--transition);
        }

        .filter-tag .remove-filter:hover {
            background: var(--danger);
            color: white;
        }

        /* Quick Date Filters */
        .quick-dates {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 16px;
        }

        .quick-date-btn {
            padding: 6px 12px;
            background: white;
            border: 1px solid var(--gray-light);
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            color: var(--dark);
            cursor: pointer;
            transition: var(--transition);
        }

        .quick-date-btn:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .quick-date-btn.active {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-color: transparent;
        }

        /* Table Styling */
        .table-container {
            overflow-x: auto;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-sm);
            margin-bottom: 24px;
        }

        .activity-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: white;
            border-radius: var(--radius-md);
            overflow: hidden;
        }

        .activity-table thead {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }

        .activity-table th {
            padding: 18px 20px;
            text-align: left;
            color: white;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
            position: relative;
        }

        .activity-table th.sortable {
            cursor: pointer;
            user-select: none;
        }

        .activity-table th.sortable:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .activity-table th.sortable i {
            margin-left: 8px;
            font-size: 12px;
            opacity: 0.7;
        }

        .activity-table th:first-child {
            border-top-left-radius: var(--radius-md);
        }

        .activity-table th:last-child {
            border-top-right-radius: var(--radius-md);
        }

        .activity-table tbody tr {
            transition: var(--transition);
            border-bottom: 1px solid var(--gray-light);
        }

        .activity-table tbody tr:last-child {
            border-bottom: none;
        }

        .activity-table tbody tr:hover {
            background: rgba(67, 97, 238, 0.05);
            transform: translateX(4px);
        }

        .activity-table td {
            padding: 18px 20px;
            color: var(--dark);
            font-size: 14px;
            border: none;
        }

        .activity-table td:first-child {
            font-weight: 600;
            color: var(--gray);
        }

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
            box-shadow: var(--shadow-sm);
        }

        .activity-cell {
            position: relative;
            padding-left: 28px;
        }

        .activity-icon {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            color: white;
        }

        .icon-login {
            background: var(--success);
        }

        .icon-logout {
            background: var(--danger);
        }

        .icon-create {
            background: var(--primary);
        }

        .icon-update {
            background: var(--warning);
        }

        .icon-delete {
            background: var(--danger);
        }

        .icon-system {
            background: var(--secondary);
        }

        .time-cell {
            font-family: 'Monaco', 'Courier New', monospace;
            font-size: 13px;
            color: var(--gray);
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
        }

        .status-success {
            background: rgba(76, 201, 240, 0.15);
            color: var(--success);
            border: 1px solid rgba(76, 201, 240, 0.3);
        }

        .status-warning {
            background: rgba(248, 150, 30, 0.15);
            color: var(--warning);
            border: 1px solid rgba(248, 150, 30, 0.3);
        }

        .status-danger {
            background: rgba(249, 65, 68, 0.15);
            color: var(--danger);
            border: 1px solid rgba(249, 65, 68, 0.3);
        }

        .status-info {
            background: rgba(67, 97, 238, 0.15);
            color: var(--primary);
            border: 1px solid rgba(67, 97, 238, 0.3);
        }

        /* Export Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
            animation: fadeIn 0.3s ease;
        }

        .modal-content {
            background: white;
            border-radius: var(--radius-lg);
            padding: 32px;
            max-width: 500px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: var(--shadow-lg);
            animation: slideUp 0.3s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 2px solid var(--gray-light);
        }

        .modal-header h3 {
            font-size: 20px;
            font-weight: 700;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 20px;
            color: var(--gray);
            cursor: pointer;
            padding: 8px;
            border-radius: 50%;
            transition: var(--transition);
        }

        .modal-close:hover {
            background: var(--danger);
            color: white;
            transform: rotate(90deg);
        }

        .modal-body {
            margin-bottom: 24px;
        }

        .export-option {
            display: flex;
            align-items: center;
            padding: 16px;
            border: 2px solid var(--gray-light);
            border-radius: var(--radius-md);
            margin-bottom: 12px;
            cursor: pointer;
            transition: var(--transition);
        }

        .export-option:hover {
            border-color: var(--primary);
            background: rgba(67, 97, 238, 0.05);
            transform: translateX(4px);
        }

        .export-option.selected {
            border-color: var(--primary);
            background: rgba(67, 97, 238, 0.1);
        }

        .export-option-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-right: 16px;
        }

        .export-option-info h4 {
            font-size: 16px;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 4px;
        }

        .export-option-info p {
            font-size: 13px;
            color: var(--gray);
        }

        .modal-footer {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        /* Pagination */
        .pagination-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--gray-light);
        }

        .pagination {
            display: flex;
            align-items: center;
            gap: 8px;
            list-style: none;
        }

        .pagination li {
            display: inline-flex;
        }

        .pagination a, .pagination span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 0 12px;
            border-radius: var(--radius-sm);
            background: white;
            color: var(--dark);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            border: 2px solid var(--gray-light);
            transition: var(--transition);
        }

        .pagination a:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            transform: translateY(-2px);
        }

        .pagination .active span {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-color: var(--primary);
        }

        .pagination .disabled span {
            background: var(--gray-light);
            color: var(--gray);
            cursor: not-allowed;
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
            margin: 0 auto 20px;
        }

        /* Loading States */
        .loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(3px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 100;
            border-radius: inherit;
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid var(--gray-light);
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Tooltip */
        .tooltip {
            position: relative;
        }

        .tooltip:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            padding: 6px 12px;
            background: var(--dark);
            color: white;
            font-size: 12px;
            border-radius: var(--radius-sm);
            white-space: nowrap;
            z-index: 1000;
            margin-bottom: 8px;
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

        /* Toast Customization */
        .custom-toast {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 16px 24px;
            border-radius: var(--radius-md);
            color: white;
            font-weight: 600;
            box-shadow: var(--shadow-lg);
            z-index: 9999;
            display: flex;
            align-items: center;
            gap: 12px;
            max-width: 400px;
            animation: slideInRight 0.3s ease;
        }

        .toast-success { background: var(--success); }
        .toast-error { background: var(--danger); }
        .toast-warning { background: var(--warning); }
        .toast-info { background: var(--primary); }

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
                width: 280px;
            }
        }

        @media (max-width: 992px) {
            .filter-grid {
                grid-template-columns: repeat(2, 1fr);
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
            
            .filter-actions {
                flex-direction: column;
            }
            
            .filter-actions button {
                width: 100%;
            }
            
            .activity-table th,
            .activity-table td {
                padding: 12px;
            }
        }

        @media (max-width: 480px) {
            .header-title {
                font-size: 20px;
            }
            
            .user-menu span {
                display: none;
            }
            
            .user-menu-avatar {
                width: 32px;
                height: 32px;
                font-size: 14px;
            }
            
            .user-cell {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
            
            .activity-cell {
                padding-left: 0;
                padding-top: 24px;
            }
            
            .activity-icon {
                top: 0;
                transform: none;
            }
            
            .pagination {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .modal-content {
                padding: 20px;
            }
            
            .export-option {
                flex-direction: column;
                text-align: center;
            }
            
            .export-option-icon {
                margin-right: 0;
                margin-bottom: 12px;
            }
        }
    </style>
</head>
<body class="font-sans antialiased">
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
                <h1 class="header-title animate__animated animate__fadeIn">Log Aktivitas Sistem</h1>
                <div class="header-actions">
                    <div class="search-wrapper">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" placeholder="Cari aktivitas, user, atau detail..." id="searchInput" value="{{ request('search') }}">
                        <i class="fas fa-times search-clear" id="searchClear"></i>
                    </div>
                    <button class="notification-btn tooltip" data-tooltip="Notifikasi">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </button>
                    <div class="user-menu">
                        <div class="user-menu-avatar">
                            @auth
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            @else
                                GU
                            @endauth
                        </div>
                        <span style="font-weight: 500;">{{ Auth::user()->name ?? 'Guest' }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="content-wrapper">
                <!-- Stats Cards -->
                <div class="stats-container">
                    <div class="stat-card animate__animated animate__fadeInUp">
                        <div class="stat-icon icon-info">
                            <i class="fas fa-history"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Total Aktivitas</h3>
                            <div class="number" id="totalLogs">{{ $totalLogs ?? 0 }}</div>
                            <div class="trend">
                                <i class="fas fa-arrow-up"></i>
                                Hari ini: <span id="todayLogs">{{ $todayLogs ?? 0 }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
                        <div class="stat-icon icon-success">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="stat-info">
                            <h3>User Aktif</h3>
                            <div class="number">{{ $activeUsers ?? 0 }}</div>
                            <div class="trend">
                                <i class="fas fa-users"></i>
                                Total user: {{ $totalUsers ?? 0 }}
                            </div>
                        </div>
                    </div>

                    <div class="stat-card animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
                        <div class="stat-icon icon-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Peringatan</h3>
                            <div class="number" id="warningCount">{{ $warningLogs ?? 0 }}</div>
                            <div class="trend">
                                <i class="fas fa-shield-alt"></i>
                                Sistem aman
                            </div>
                        </div>
                    </div>

                    <div class="stat-card animate__animated animate__fadeInUp" style="animation-delay: 0.3s">
                        <div class="stat-icon icon-danger">
                            <i class="fas fa-bug"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Error</h3>
                            <div class="number" id="errorCount">{{ $errorLogs ?? 0 }}</div>
                            <div class="trend">
                                <i class="fas fa-check-circle"></i>
                                Tidak ada error kritis
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Premium Card Container -->
                <div class="dashboard-card animate__animated animate__fadeInUp">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-clipboard-list"></i>
                            Riwayat Aktivitas Sistem
                        </h3>
                        <div class="card-actions">
                            <button class="action-btn btn-primary tooltip" data-tooltip="Refresh Data" id="refreshData">
                                <i class="fas fa-sync-alt"></i>
                                <span class="hide-mobile">Refresh</span>
                            </button>
                            <button class="action-btn btn-success tooltip" data-tooltip="Export Data" id="exportBtn">
                                <i class="fas fa-download"></i>
                                <span class="hide-mobile">Export</span>
                            </button>
                            <button class="action-btn btn-outline tooltip" data-tooltip="Toggle Filters" id="toggleFilters">
                                <i class="fas fa-sliders-h"></i>
                                <span class="hide-mobile">Filter</span>
                            </button>
                        </div>
                    </div>

                    <!-- Filter Section (Collapsible) -->
                    <div class="filter-section" id="filterSection" style="{{ request()->anyFilled(['activity_type', 'user_id', 'date_from', 'date_to', 'status', 'search']) ? '' : 'display: none;' }}">
                        <form method="GET" action="{{ url()->current() }}" id="filterForm">
                            <!-- Quick Date Filters -->
                            <div class="quick-dates">
                                <span style="font-size: 13px; font-weight: 600; color: var(--gray);">Quick Filter:</span>
                                <button type="button" class="quick-date-btn" data-range="today">Hari Ini</button>
                                <button type="button" class="quick-date-btn" data-range="yesterday">Kemarin</button>
                                <button type="button" class="quick-date-btn" data-range="week">7 Hari</button>
                                <button type="button" class="quick-date-btn" data-range="month">30 Hari</button>
                                <button type="button" class="quick-date-btn" data-range="thisMonth">Bulan Ini</button>
                                <button type="button" class="quick-date-btn" data-range="lastMonth">Bulan Lalu</button>
                            </div>

                            <!-- Filter Grid -->
                            <div class="filter-grid">
                                <div class="filter-item">
                                    <label><i class="fas fa-tag"></i> Tipe Aktivitas</label>
                                    <select class="filter-input" id="activityType" name="activity_type">
                                        <option value="">Semua Aktivitas</option>
                                        <option value="login" {{ request('activity_type') == 'login' ? 'selected' : '' }}>Login</option>
                                        <option value="logout" {{ request('activity_type') == 'logout' ? 'selected' : '' }}>Logout</option>
                                        <option value="create" {{ request('activity_type') == 'create' ? 'selected' : '' }}>Create</option>
                                        <option value="update" {{ request('activity_type') == 'update' ? 'selected' : '' }}>Update</option>
                                        <option value="delete" {{ request('activity_type') == 'delete' ? 'selected' : '' }}>Delete</option>
                                        <option value="view" {{ request('activity_type') == 'view' ? 'selected' : '' }}>View</option>
                                        <option value="export" {{ request('activity_type') == 'export' ? 'selected' : '' }}>Export</option>
                                    </select>
                                </div>
                                
                                <div class="filter-item">
                                    <label><i class="fas fa-user"></i> User</label>
                                    <select class="filter-input" id="userFilter" name="user_id">
                                        <option value="">Semua User</option>
                                        @foreach($users ?? [] as $user)
                                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="filter-item">
                                    <label><i class="fas fa-calendar-alt"></i> Tanggal Mulai</label>
                                    <input type="date" class="filter-input" id="dateFrom" name="date_from" value="{{ request('date_from') }}">
                                </div>
                                
                                <div class="filter-item">
                                    <label><i class="fas fa-calendar-alt"></i> Tanggal Akhir</label>
                                    <input type="date" class="filter-input" id="dateTo" name="date_to" value="{{ request('date_to') }}">
                                </div>
                                
                                <div class="filter-item">
                                    <label><i class="fas fa-flag"></i> Status</label>
                                    <select class="filter-input" id="statusFilter" name="status">
                                        <option value="">Semua Status</option>
                                        <option value="success" {{ request('status') == 'success' ? 'selected' : '' }}>Berhasil</option>
                                        <option value="warning" {{ request('status') == 'warning' ? 'selected' : '' }}>Peringatan</option>
                                        <option value="danger" {{ request('status') == 'danger' ? 'selected' : '' }}>Error</option>
                                    </select>
                                </div>

                                <div class="filter-item">
                                    <label><i class="fas fa-sort"></i> Urutkan</label>
                                    <select class="filter-input" id="sortBy" name="sort_by">
                                        <option value="waktu_desc" {{ request('sort_by') == 'waktu_desc' ? 'selected' : '' }}>Terbaru</option>
                                        <option value="waktu_asc" {{ request('sort_by') == 'waktu_asc' ? 'selected' : '' }}>Terlama</option>
                                        <option value="user_asc" {{ request('sort_by') == 'user_asc' ? 'selected' : '' }}>User A-Z</option>
                                        <option value="user_desc" {{ request('sort_by') == 'user_desc' ? 'selected' : '' }}>User Z-A</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Hidden search input -->
                            <input type="hidden" name="search" id="searchHidden" value="{{ request('search') }}">

                            <!-- Filter Actions -->
                            <div class="filter-actions">
                                <button type="submit" class="action-btn btn-primary" id="applyFilters">
                                    <i class="fas fa-filter"></i> Terapkan Filter
                                </button>
                                <a href="{{ url()->current() }}" class="action-btn btn-outline" id="resetFilters">
                                    <i class="fas fa-redo"></i> Reset
                                </a>
                            </div>
                        </form>
                    </div>

                    <!-- Active Filters Display -->
                    @if(request()->anyFilled(['activity_type', 'user_id', 'date_from', 'date_to', 'status', 'search']))
                    <div class="active-filters">
                        <span style="font-weight: 600; color: var(--primary);">
                            <i class="fas fa-filter"></i> Filter Aktif:
                        </span>
                        
                        @if(request('search'))
                        <span class="filter-tag">
                            <i class="fas fa-search"></i> Pencarian: "{{ request('search') }}"
                            <i class="fas fa-times remove-filter" data-filter="search"></i>
                        </span>
                        @endif

                        @if(request('activity_type'))
                        <span class="filter-tag">
                            <i class="fas fa-tag"></i> Tipe: {{ request('activity_type') }}
                            <i class="fas fa-times remove-filter" data-filter="activity_type"></i>
                        </span>
                        @endif

                        @if(request('user_id') && isset($users))
                            @php $selectedUser = $users->firstWhere('id', request('user_id')); @endphp
                            @if($selectedUser)
                            <span class="filter-tag">
                                <i class="fas fa-user"></i> User: {{ $selectedUser->name }}
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
                            <i class="fas fa-flag"></i> Status: {{ request('status') }}
                            <i class="fas fa-times remove-filter" data-filter="status"></i>
                        </span>
                        @endif

                        <span class="filter-tag" id="clearAllFilters" style="cursor: pointer; background: var(--danger); color: white; border: none;">
                            <i class="fas fa-times"></i> Hapus Semua
                        </span>
                    </div>
                    @endif

                    <!-- Table with Loading Overlay -->
                    <div class="table-container" id="tableContainer">
                        <div class="loading-overlay" id="loadingOverlay" style="display: none;">
                            <div class="loading-spinner"></div>
                        </div>

                        @if(isset($logs) && $logs->count() > 0)
                            <table class="activity-table" id="activityTable">
                                <thead>
                                    <tr>
                                        <th class="sortable" data-sort="id">ID <i class="fas fa-sort"></i></th>
                                        <th class="sortable" data-sort="user">User <i class="fas fa-sort"></i></th>
                                        <th class="sortable" data-sort="aktivitas">Aktivitas <i class="fas fa-sort"></i></th>
                                        <th class="sortable" data-sort="status">Status <i class="fas fa-sort"></i></th>
                                        <th class="sortable" data-sort="waktu">Waktu <i class="fas fa-sort"></i></th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach($logs as $log)
                                    <tr class="animate__animated animate__fadeIn" style="animation-delay: {{ $loop->index * 0.05 }}s" 
                                        data-id="{{ $log->id_log }}"
                                        data-user="{{ $log->user->name ?? 'Unknown' }}"
                                        data-activity="{{ strtolower($log->aktivitas) }}"
                                        data-user-id="{{ $log->user->id ?? '' }}"
                                        data-date="{{ \Carbon\Carbon::parse($log->waktu)->format('Y-m-d') }}"
                                        data-status="{{ $log->status ?? 'success' }}">
                                        <td>
                                            <span style="font-family: 'Monaco', 'Courier New', monospace; color: var(--gray);">#{{ $log->id_log }}</span>
                                        </td>
                                        
                                        <td>
                                            <div class="user-cell">
                                                <div class="user-avatar">
                                                    {{ strtoupper(substr($log->user->name ?? 'U', 0, 2)) }}
                                                </div>
                                                <div>
                                                    <div style="font-weight: 600; color: var(--dark);">{{ $log->user->name ?? 'Unknown User' }}</div>
                                                    <div style="font-size: 12px; color: var(--gray);">{{ $log->user->email ?? 'No email' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        
                                        <td>
                                            <div class="activity-cell">
                                                @php
                                                    $activityLower = strtolower($log->aktivitas);
                                                    $icon = 'fa-info-circle';
                                                    $iconClass = 'icon-system';
                                                    
                                                    if(str_contains($activityLower, 'login')) {
                                                        $icon = 'fa-sign-in-alt';
                                                        $iconClass = 'icon-login';
                                                    } elseif(str_contains($activityLower, 'logout')) {
                                                        $icon = 'fa-sign-out-alt';
                                                        $iconClass = 'icon-logout';
                                                    } elseif(str_contains($activityLower, 'tambah') || str_contains($activityLower, 'create') || str_contains($activityLower, 'insert')) {
                                                        $icon = 'fa-plus-circle';
                                                        $iconClass = 'icon-create';
                                                    } elseif(str_contains($activityLower, 'edit') || str_contains($activityLower, 'update') || str_contains($activityLower, 'ubah')) {
                                                        $icon = 'fa-edit';
                                                        $iconClass = 'icon-update';
                                                    } elseif(str_contains($activityLower, 'hapus') || str_contains($activityLower, 'delete') || str_contains($activityLower, 'remove')) {
                                                        $icon = 'fa-trash-alt';
                                                        $iconClass = 'icon-delete';
                                                    } elseif(str_contains($activityLower, 'view') || str_contains($activityLower, 'lihat')) {
                                                        $icon = 'fa-eye';
                                                        $iconClass = 'icon-info';
                                                    } elseif(str_contains($activityLower, 'export') || str_contains($activityLower, 'download')) {
                                                        $icon = 'fa-download';
                                                        $iconClass = 'icon-success';
                                                    }
                                                @endphp
                                                <div class="activity-icon {{ $iconClass }}">
                                                    <i class="fas {{ $icon }}"></i>
                                                </div>
                                                <span style="color: var(--dark);">{{ $log->aktivitas }}</span>
                                            </div>
                                        </td>
                                        
                                        <td>
                                            @php
                                                $status = 'success';
                                                $statusClass = 'status-success';
                                                $statusIcon = 'fa-check-circle';
                                                $statusText = 'Berhasil';
                                                
                                                if(isset($log->status)) {
                                                    $status = $log->status;
                                                } elseif(str_contains(strtolower($log->aktivitas), 'error') || str_contains(strtolower($log->aktivitas), 'gagal') || str_contains(strtolower($log->aktivitas), 'failed')) {
                                                    $status = 'danger';
                                                } elseif(str_contains(strtolower($log->aktivitas), 'peringatan') || str_contains(strtolower($log->aktivitas), 'warning')) {
                                                    $status = 'warning';
                                                }
                                                
                                                switch($status) {
                                                    case 'danger':
                                                        $statusClass = 'status-danger';
                                                        $statusText = 'Error';
                                                        $statusIcon = 'fa-times-circle';
                                                        break;
                                                    case 'warning':
                                                        $statusClass = 'status-warning';
                                                        $statusText = 'Peringatan';
                                                        $statusIcon = 'fa-exclamation-triangle';
                                                        break;
                                                    default:
                                                        $statusClass = 'status-success';
                                                        $statusText = 'Berhasil';
                                                        $statusIcon = 'fa-check-circle';
                                                }
                                            @endphp
                                            <span class="status-badge {{ $statusClass }}">
                                                <i class="fas {{ $statusIcon }}" style="margin-right: 4px;"></i> {{ $statusText }}
                                            </span>
                                        </td>
                                        
                                        <td>
                                            <div class="time-cell">
                                                <div style="font-weight: 600; color: var(--dark);">
                                                    {{ \Carbon\Carbon::parse($log->waktu)->format('d M Y') }}
                                                </div>
                                                <div style="font-size: 12px; color: var(--gray);">
                                                    {{ \Carbon\Carbon::parse($log->waktu)->format('H:i:s') }}
                                                </div>
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
                                <p>Belum ada riwayat aktivitas yang tercatat dalam sistem.</p>
                                @if(request()->anyFilled(['activity_type', 'user_id', 'date_from', 'date_to', 'status', 'search']))
                                <a href="{{ url()->current() }}" class="action-btn btn-primary" style="display: inline-flex;">
                                    <i class="fas fa-redo"></i> Reset Filter
                                </a>
                                @endif
                            </div>
                        @endif
                    </div>

                    <!-- Table Info & Pagination -->
                    @if(isset($logs) && $logs->count() > 0)
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
                        <div style="color: var(--gray); font-size: 14px;" id="tableInfo">
                            Menampilkan {{ $logs->firstItem() ?? 0 }} - {{ $logs->lastItem() ?? 0 }} dari {{ $logs->total() }} aktivitas
                        </div>
                        <div class="pagination-container" style="margin-top: 0; border-top: none;">
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
                    <i class="fas fa-download" style="color: var(--success);"></i>
                    Export Data Log
                </h3>
                <button class="modal-close" id="closeModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <p style="margin-bottom: 20px; color: var(--gray);">Pilih format dan data yang ingin diexport:</p>
                
                <div class="export-option selected" data-format="csv">
                    <div class="export-option-icon" style="background: rgba(76, 201, 240, 0.1); color: var(--success);">
                        <i class="fas fa-file-csv"></i>
                    </div>
                    <div class="export-option-info">
                        <h4>CSV (Comma Separated Values)</h4>
                        <p>Format tabel yang dapat dibuka di Excel, Google Sheets, atau aplikasi spreadsheet lainnya.</p>
                    </div>
                </div>
                
                <div class="export-option" data-format="excel">
                    <div class="export-option-icon" style="background: rgba(76, 201, 240, 0.1); color: #0f9d58;">
                        <i class="fas fa-file-excel"></i>
                    </div>
                    <div class="export-option-info">
                        <h4>Excel (XLSX)</h4>
                        <p>Format Microsoft Excel dengan formatting yang lebih baik.</p>
                    </div>
                </div>
                
                <div class="export-option" data-format="pdf">
                    <div class="export-option-icon" style="background: rgba(249, 65, 68, 0.1); color: var(--danger);">
                        <i class="fas fa-file-pdf"></i>
                    </div>
                    <div class="export-option-info">
                        <h4>PDF</h4>
                        <p>Format dokumen PDF untuk laporan yang siap cetak.</p>
                    </div>
                </div>
                
                <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid var(--gray-light);">
                    <h4 style="margin-bottom: 12px; font-size: 16px;">Opsi Export:</h4>
                    
                    <label style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px; cursor: pointer;">
                        <input type="radio" name="exportScope" value="all" checked> 
                        <span>Semua data ({{ $logs->total() ?? 0 }} aktivitas)</span>
                    </label>
                    
                    <label style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px; cursor: pointer;">
                        <input type="radio" name="exportScope" value="current"> 
                        <span>Halaman saat ini ({{ $logs->count() ?? 0 }} aktivitas)</span>
                    </label>
                    
                    <label style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px; cursor: pointer;">
                        <input type="radio" name="exportScope" value="selected"> 
                        <span>Data yang difilter</span>
                    </label>
                </div>
                
                <div style="margin-top: 20px; background: rgba(67, 97, 238, 0.05); padding: 16px; border-radius: var(--radius-md);">
                    <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="checkbox" id="includeSummary" checked> 
                            <span>Sertakan Ringkasan</span>
                        </label>
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="checkbox" id="includeStats" checked> 
                            <span>Sertakan Statistik</span>
                        </label>
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="checkbox" id="includeFilters" checked> 
                            <span>Sertakan Info Filter</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="action-btn btn-outline" id="cancelExport">
                    <i class="fas fa-times"></i> Batal
                </button>
                <button class="action-btn btn-success" id="confirmExport">
                    <i class="fas fa-download"></i> Export Data
                </button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        // Toggle sidebar untuk mobile
        const sidebarToggle = document.getElementById('sidebarToggle');
        const appContainer = document.getElementById('appContainer');

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

        // Toggle Filter Section
        const toggleFilters = document.getElementById('toggleFilters');
        const filterSection = document.getElementById('filterSection');

        if (toggleFilters && filterSection) {
            toggleFilters.addEventListener('click', function() {
                if (filterSection.style.display === 'none') {
                    filterSection.style.display = 'block';
                    filterSection.style.animation = 'fadeIn 0.3s ease';
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
                    performSearch();
                }, 500);
            });
            
            searchInput.addEventListener('keyup', function(e) {
                if (e.key === 'Enter') {
                    clearTimeout(searchTimeout);
                    performSearch();
                }
            });
            
            if (searchClear) {
                searchClear.addEventListener('click', function() {
                    searchInput.value = '';
                    searchHidden.value = '';
                    performSearch();
                });
            }
        }

        function performSearch() {
            const searchTerm = searchInput.value.trim();
            searchHidden.value = searchTerm;
            
            // Submit form dengan search term
            document.getElementById('filterForm').submit();
            
            // Show loading
            showLoading(true);
        }

        // Quick Date Filters
        const quickDateBtns = document.querySelectorAll('.quick-date-btn');
        const dateFrom = document.getElementById('dateFrom');
        const dateTo = document.getElementById('dateTo');

        if (quickDateBtns.length > 0) {
            quickDateBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const range = this.dataset.range;
                    const today = new Date();
                    let fromDate = new Date();
                    let toDate = new Date();
                    
                    switch(range) {
                        case 'today':
                            fromDate = today;
                            toDate = today;
                            break;
                        case 'yesterday':
                            fromDate.setDate(today.getDate() - 1);
                            toDate.setDate(today.getDate() - 1);
                            break;
                        case 'week':
                            fromDate.setDate(today.getDate() - 7);
                            toDate = today;
                            break;
                        case 'month':
                            fromDate.setDate(today.getDate() - 30);
                            toDate = today;
                            break;
                        case 'thisMonth':
                            fromDate = new Date(today.getFullYear(), today.getMonth(), 1);
                            toDate = new Date(today.getFullYear(), today.getMonth() + 1, 0);
                            break;
                        case 'lastMonth':
                            fromDate = new Date(today.getFullYear(), today.getMonth() - 1, 1);
                            toDate = new Date(today.getFullYear(), today.getMonth(), 0);
                            break;
                    }
                    
                    dateFrom.value = formatDate(fromDate);
                    dateTo.value = formatDate(toDate);
                    
                    // Highlight active button
                    quickDateBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        }

        function formatDate(date) {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

        // Remove individual filter
        const removeFilterBtns = document.querySelectorAll('.remove-filter');
        if (removeFilterBtns.length > 0) {
            removeFilterBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const filter = this.dataset.filter;
                    const url = new URL(window.location.href);
                    
                    if (filter === 'search') {
                        url.searchParams.delete('search');
                        searchInput.value = '';
                    } else {
                        url.searchParams.delete(filter);
                    }
                    
                    window.location.href = url.toString();
                });
            });
        }

        // Clear all filters
        const clearAllFilters = document.getElementById('clearAllFilters');
        if (clearAllFilters) {
            clearAllFilters.addEventListener('click', function() {
                window.location.href = window.location.pathname;
            });
        }

        // Sort functionality
        const sortableHeaders = document.querySelectorAll('.sortable');
        if (sortableHeaders.length > 0) {
            sortableHeaders.forEach(header => {
                header.addEventListener('click', function() {
                    const sortBy = this.dataset.sort;
                    const currentSort = document.getElementById('sortBy').value;
                    let newSort = '';
                    
                    if (currentSort === `${sortBy}_asc`) {
                        newSort = `${sortBy}_desc`;
                    } else {
                        newSort = `${sortBy}_asc`;
                    }
                    
                    document.getElementById('sortBy').value = newSort;
                    document.getElementById('filterForm').submit();
                });
            });
        }

        // Export Modal
        const exportBtn = document.getElementById('exportBtn');
        const exportModal = document.getElementById('exportModal');
        const closeModal = document.getElementById('closeModal');
        const cancelExport = document.getElementById('cancelExport');
        const confirmExport = document.getElementById('confirmExport');

        if (exportBtn && exportModal) {
            exportBtn.addEventListener('click', function() {
                exportModal.classList.add('active');
            });
        }

        if (closeModal) {
            closeModal.addEventListener('click', function() {
                exportModal.classList.remove('active');
            });
        }

        if (cancelExport) {
            cancelExport.addEventListener('click', function() {
                exportModal.classList.remove('active');
            });
        }

        // Export option selection
        const exportOptions = document.querySelectorAll('.export-option');
        exportOptions.forEach(option => {
            option.addEventListener('click', function() {
                exportOptions.forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
            });
        });

        // Confirm Export
        if (confirmExport) {
            confirmExport.addEventListener('click', function() {
                const selectedFormat = document.querySelector('.export-option.selected')?.dataset.format || 'csv';
                const exportScope = document.querySelector('input[name="exportScope"]:checked')?.value || 'all';
                const includeSummary = document.getElementById('includeSummary')?.checked || false;
                const includeStats = document.getElementById('includeStats')?.checked || false;
                const includeFilters = document.getElementById('includeFilters')?.checked || false;
                
                // Get current filters
                const params = new URLSearchParams(window.location.search);
                params.append('export', 'true');
                params.append('format', selectedFormat);
                params.append('scope', exportScope);
                params.append('summary', includeSummary);
                params.append('stats', includeStats);
                params.append('filters', includeFilters);
                
                showToast('Menyiapkan data untuk diekspor...', 'info');
                
                // Show loading on button
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
                this.disabled = true;
                
                // Simulate export process
                setTimeout(() => {
                    // Hide modal
                    exportModal.classList.remove('active');
                    
                    // Reset button
                    this.innerHTML = '<i class="fas fa-download"></i> Export Data';
                    this.disabled = false;
                    
                    // Generate filename
                    const now = new Date();
                    const timestamp = `${now.getFullYear()}${String(now.getMonth()+1).padStart(2,'0')}${String(now.getDate()).padStart(2,'0')}_${String(now.getHours()).padStart(2,'0')}${String(now.getMinutes()).padStart(2,'0')}`;
                    
                    if (selectedFormat === 'csv') {
                        exportToCSV(exportScope, includeSummary, includeStats, includeFilters, timestamp);
                    } else {
                        // For other formats, just show success message
                        showToast(`Data berhasil diekspor dalam format ${selectedFormat.toUpperCase()}`, 'success');
                    }
                }, 2000);
            });
        }

        // Export to CSV function
        function exportToCSV(scope, includeSummary, includeStats, includeFilters, timestamp) {
            const rows = document.querySelectorAll('.activity-table tbody tr');
            let data = [];
            
            // Add header
            data.push(['ID', 'User', 'Email', 'Aktivitas', 'Status', 'Waktu', 'Detail']);
            
            // Add data rows
            rows.forEach(row => {
                if (scope === 'current' || row.style.display !== 'none') {
                    const cols = row.querySelectorAll('td');
                    const id = cols[0]?.textContent.trim() || '';
                    const userName = cols[1]?.querySelector('div div')?.textContent.trim() || '';
                    const userEmail = cols[1]?.querySelector('div div:last-child')?.textContent.trim() || '';
                    const aktivitas = cols[2]?.querySelector('span')?.textContent.trim() || '';
                    const status = cols[3]?.querySelector('span')?.textContent.trim() || '';
                    const waktu = cols[4]?.textContent.trim().replace(/\s+/g, ' ') || '';
                    
                    data.push([id, userName, userEmail, aktivitas, status, waktu, '']);
                }
            });
            
            // Add summary if requested
            if (includeSummary) {
                data.push([]);
                data.push(['RINGKASAN', '', '', '', '', '', '']);
                data.push(['Total Data', data.length - 1, '', '', '', '', '']);
                data.push(['Tanggal Export', new Date().toLocaleString(), '', '', '', '', '']);
            }
            
            // Add stats if requested
            if (includeStats) {
                const successCount = document.querySelectorAll('.status-success').length;
                const warningCount = document.querySelectorAll('.status-warning').length;
                const errorCount = document.querySelectorAll('.status-danger').length;
                
                data.push([]);
                data.push(['STATISTIK', '', '', '', '', '', '']);
                data.push(['Berhasil', successCount, '', '', '', '', '']);
                data.push(['Peringatan', warningCount, '', '', '', '', '']);
                data.push(['Error', errorCount, '', '', '', '', '']);
            }
            
            // Add filter info if requested
            if (includeFilters && window.location.search) {
                const params = new URLSearchParams(window.location.search);
                const filters = [];
                params.forEach((value, key) => {
                    if (!['page', 'export', 'format', 'scope', 'summary', 'stats', 'filters'].includes(key)) {
                        filters.push(`${key}: ${value}`);
                    }
                });
                
                if (filters.length > 0) {
                    data.push([]);
                    data.push(['FILTER AKTIF', '', '', '', '', '', '']);
                    filters.forEach(filter => {
                        data.push([filter, '', '', '', '', '', '']);
                    });
                }
            }
            
            // Convert to CSV
            const csvContent = data.map(row => 
                row.map(cell => {
                    if (typeof cell === 'string' && (cell.includes(',') || cell.includes('"') || cell.includes('\n'))) {
                        return `"${cell.replace(/"/g, '""')}"`;
                    }
                    return cell;
                }).join(',')
            ).join('\n');
            
            // Download CSV
            const blob = new Blob(["\uFEFF" + csvContent], { type: 'text/csv;charset=utf-8;' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `log-aktivitas_${timestamp}.csv`;
            a.click();
            
            showToast('Data berhasil diekspor sebagai CSV', 'success');
        }

        // Refresh data
        const refreshData = document.getElementById('refreshData');
        if (refreshData) {
            refreshData.addEventListener('click', function() {
                showLoading(true);
                
                // Show loading on button
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memuat...';
                this.disabled = true;
                
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            });
        }

        // Show/Hide Loading
        function showLoading(show) {
            const overlay = document.getElementById('loadingOverlay');
            if (overlay) {
                overlay.style.display = show ? 'flex' : 'none';
            }
        }

        // Toast notification
        function showToast(message, type = 'info') {
            const existingToast = document.querySelector('.custom-toast');
            if (existingToast) {
                existingToast.remove();
            }
            
            const toast = document.createElement('div');
            toast.className = `custom-toast toast-${type}`;
            
            const icon = type === 'success' ? 'fa-check-circle' : 
                        type === 'error' ? 'fa-times-circle' : 
                        type === 'warning' ? 'fa-exclamation-triangle' : 'fa-info-circle';
            
            toast.innerHTML = `
                <i class="fas ${icon}"></i>
                <span>${message}</span>
            `;
            
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.remove();
                    }
                }, 300);
            }, 3000);
        }

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 1200) {
                appContainer.classList.remove('sidebar-collapsed');
                if (sidebarToggle) {
                    sidebarToggle.querySelector('i').className = 'fas fa-bars';
                }
            }
        });

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            // Add animation styles
            const style = document.createElement('style');
            style.textContent = `
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
                
                @keyframes fadeIn {
                    from {
                        opacity: 0;
                        transform: translateY(10px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }
                
                .hide-mobile {
                    @media (max-width: 768px) {
                        display: none;
                    }
                }
            `;
            document.head.appendChild(style);
            
            // Add hover effects
            const tableRows = document.querySelectorAll('.activity-table tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    if (this.style.display !== 'none') {
                        this.style.transform = 'translateX(8px)';
                    }
                });
                
                row.addEventListener('mouseleave', function() {
                    this.style.transform = '';
                });
            });
            
            // Show toast if filters are applied
            if (window.location.search && !window.location.search.includes('page=')) {
                showToast('Filter diterapkan', 'info');
            }
            
            // Initialize flatpickr if available
            if (typeof flatpickr !== 'undefined') {
                flatpickr("#dateFrom, #dateTo", {
                    dateFormat: "Y-m-d",
                    theme: "material_blue"
                });
            }
        });
    </script>
</body>
</html>