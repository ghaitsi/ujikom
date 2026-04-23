<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LibTrack - Dashboard Peminjam</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800|playfair:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --primary: #3b6e8c;
            --primary-dark: #2c556d;
            --primary-light: #5c8da8;
            --secondary: #8b5e7e;
            --secondary-light: #a87c9a;
            --accent: #d4a373;
            --success: #4a7c6f;
            --warning: #c9a03d;
            --danger: #c97b5e;
            --dark: #3a4a5a;
            --darker: #2a3a48;
            --light: #fefaf0;
            --gray: #8a9aa8;
            --gray-light: #e8e2d5;
            --card-bg: rgba(254, 250, 240, 0.96);
            --shadow-sm: 0 4px 12px rgba(0, 0, 0, 0.04);
            --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 16px 40px rgba(0, 0, 0, 0.12);
            --shadow-xl: 0 24px 56px rgba(0, 0, 0, 0.15);
            --radius-sm: 12px;
            --radius-md: 18px;
            --radius-lg: 24px;
            --radius-xl: 32px;
            --transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(145deg, #f5ede0 0%, #ebe1cf 100%);
            color: var(--dark);
            min-height: 100vh;
            overflow-x: hidden;
            font-family: 'Inter', sans-serif;
        }

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

        /* Header */
        .header {
            background: rgba(254, 250, 240, 0.92);
            backdrop-filter: blur(12px);
            padding: 0 32px;
            height: 72px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(212, 163, 115, 0.2);
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .header-title {
            font-size: 24px;
            font-weight: 700;
            font-family: 'Playfair', serif;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            position: relative;
            padding-left: 20px;
        }

        .header-title::before {
            content: '📖';
            position: absolute;
            left: -8px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 24px;
            opacity: 0.7;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .search-wrapper {
            position: relative;
            width: 300px;
        }

        .search-input {
            width: 100%;
            padding: 10px 16px 10px 42px;
            background: rgba(255, 255, 255, 0.85);
            border: 1px solid rgba(212, 163, 115, 0.3);
            border-radius: var(--radius-lg);
            font-size: 14px;
            color: var(--dark);
            transition: var(--transition);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary-light);
            background: white;
            box-shadow: 0 0 0 3px rgba(59, 110, 140, 0.1);
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
            background: rgba(0, 0, 0, 0.04);
            padding: 2px 6px;
            border-radius: 6px;
            font-size: 9px;
            color: var(--gray);
            font-weight: 600;
        }

        .notification-btn {
            position: relative;
            background: rgba(255, 255, 255, 0.85);
            border: 1px solid rgba(212, 163, 115, 0.3);
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
            border-color: var(--primary-light);
            transform: translateY(-2px);
        }

        .notification-badge {
            position: absolute;
            top: -3px;
            right: -3px;
            background: linear-gradient(135deg, var(--accent), var(--danger));
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 6px 12px;
            border-radius: var(--radius-lg);
            background: rgba(255, 255, 255, 0.85);
            border: 1px solid rgba(212, 163, 115, 0.3);
            transition: var(--transition);
        }

        .user-menu:hover {
            background: white;
            transform: translateY(-2px);
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
            font-weight: 600;
            font-size: 12px;
        }

        .content-wrapper {
            flex: 1;
            padding: 32px;
        }

        /* Welcome Section */
        .welcome-section {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: var(--radius-xl);
            padding: 32px;
            margin-bottom: 32px;
            color: white;
            box-shadow: var(--shadow-md);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .welcome-text h2 {
            font-size: 28px;
            font-weight: 700;
            font-family: 'Playfair', serif;
            margin-bottom: 8px;
        }

        .welcome-text p {
            font-size: 14px;
            opacity: 0.85;
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
            border: 1px solid rgba(212, 163, 115, 0.15);
            cursor: pointer;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
            border-color: rgba(212, 163, 115, 0.3);
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

        .icon-primary { background: linear-gradient(145deg, var(--primary), var(--primary-dark)); }
        .icon-success { background: linear-gradient(145deg, var(--success), #3a6b5e); }
        .icon-warning { background: linear-gradient(145deg, var(--warning), #b88a2d); }
        .icon-danger { background: linear-gradient(145deg, var(--danger), #b86a4a); }

        .stat-info h3 {
            font-size: 11px;
            color: var(--gray);
            margin-bottom: 4px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .stat-info .number {
            font-size: 28px;
            font-weight: 800;
            color: var(--dark);
            line-height: 1;
        }

        .stat-info .desc {
            font-size: 11px;
            color: var(--gray);
            margin-top: 4px;
        }

        /* Dashboard Card */
        .dashboard-card {
            background: var(--card-bg);
            border-radius: var(--radius-xl);
            padding: 28px;
            box-shadow: var(--shadow-md);
            border: 1px solid rgba(212, 163, 115, 0.2);
            transition: var(--transition);
            margin-bottom: 40px;
        }

        .dashboard-card:hover {
            box-shadow: var(--shadow-lg);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 2px solid rgba(212, 163, 115, 0.3);
            flex-wrap: wrap;
            gap: 12px;
        }

        .card-title {
            font-size: 20px;
            font-weight: 700;
            font-family: 'Playfair', serif;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-title i {
            color: var(--primary);
        }

        /* ============================================================ */
        /* MULTI SELECT TOOLBAR */
        /* ============================================================ */
        .multi-select-toolbar {
            background: white;
            border-radius: var(--radius-lg);
            padding: 16px 24px;
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            border: 1px solid rgba(212, 163, 115, 0.3);
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
        }

        .multi-select-toolbar.hidden {
            display: none;
        }

        .selected-count {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            color: var(--primary);
        }

        .selected-count i {
            font-size: 20px;
        }

        .toolbar-actions {
            display: flex;
            gap: 12px;
        }

        .btn-clear-selection {
            background: var(--gray-light);
            color: var(--gray);
            padding: 10px 20px;
            border-radius: var(--radius-md);
            font-weight: 600;
            font-size: 13px;
            border: none;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-clear-selection:hover {
            background: var(--gray);
            color: white;
        }

        .btn-borrow-selected {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 10px 24px;
            border-radius: var(--radius-md);
            font-weight: 600;
            font-size: 13px;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-borrow-selected:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            gap: 10px;
        }

        /* Books Grid */
        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 24px;
        }

        .book-card {
            background: white;
            border-radius: var(--radius-xl);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            border: 1px solid rgba(212, 163, 115, 0.2);
            position: relative;
        }

        .book-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-lg);
            border-color: rgba(212, 163, 115, 0.4);
        }

        .book-card.selected {
            border: 2px solid var(--primary);
            box-shadow: 0 0 0 3px rgba(59, 110, 140, 0.2);
        }

        .checkbox-wrapper {
            position: absolute;
            top: 12px;
            left: 12px;
            z-index: 10;
        }

        .book-checkbox {
            width: 22px;
            height: 22px;
            cursor: pointer;
            accent-color: var(--primary);
            transform: scale(1);
            background: white;
            border-radius: 6px;
        }

        .book-cover {
            position: relative;
            height: 200px;
            overflow: hidden;
            background: linear-gradient(145deg, var(--primary-light), var(--secondary-light));
            display: flex;
            align-items: center;
            justify-content: center;
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

        .no-image-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            background: linear-gradient(145deg, var(--primary-light), var(--secondary-light));
        }

        .no-image-placeholder i {
            font-size: 48px;
            margin-bottom: 8px;
            opacity: 0.7;
        }

        .book-info {
            padding: 20px;
        }

        .book-title {
            font-size: 17px;
            font-weight: 700;
            font-family: 'Playfair', serif;
            color: var(--dark);
            margin-bottom: 8px;
            line-height: 1.35;
        }

        .book-category {
            font-size: 11px;
            color: var(--secondary);
            font-weight: 600;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .book-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px dashed rgba(212, 163, 115, 0.3);
        }

        .book-stock {
            background: rgba(74, 124, 111, 0.12);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            color: var(--success);
        }

        .stock-low { color: var(--danger); background: rgba(201, 123, 94, 0.12); }
        .stock-medium { color: var(--warning); background: rgba(201, 160, 61, 0.12); }

        .condition-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 600;
        }

        .condition-baik {
            background: rgba(74, 124, 111, 0.12);
            color: var(--success);
        }

        /* Date Picker untuk Multi Pinjam */
        .date-picker-section {
            margin-bottom: 24px;
            padding: 20px;
            background: white;
            border-radius: var(--radius-lg);
            border: 1px solid rgba(212, 163, 115, 0.3);
        }

        .date-picker-section label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--dark);
        }

        .date-picker-section input {
            padding: 12px 16px;
            border: 1px solid rgba(212, 163, 115, 0.4);
            border-radius: var(--radius-md);
            font-size: 14px;
            width: 100%;
            max-width: 300px;
        }

        /* Loans Grid - Tetap Sama */
        .loans-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
            gap: 24px;
        }

        .loan-card {
            background: white;
            border-radius: var(--radius-xl);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            border: 1px solid rgba(212, 163, 115, 0.2);
        }

        .loan-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }

        .loan-header {
            background: linear-gradient(145deg, var(--primary-light), var(--secondary-light));
            padding: 16px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .loan-book-title {
            font-weight: 700;
            color: white;
            font-size: 16px;
            font-family: 'Playfair', serif;
        }

        .loan-status {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            color: white;
        }

        .status-menunggu { background: rgba(201, 160, 61, 0.9); color: var(--dark); }
        .status-dipinjam { background: rgba(233, 196, 106, 0.9); color: var(--dark); }
        .status-terlambat { background: rgba(201, 123, 94, 0.9); }
        .status-selesai { background: rgba(74, 124, 111, 0.9); }

        .loan-body {
            padding: 20px;
        }

        .loan-detail {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 1px dashed rgba(212, 163, 115, 0.2);
        }

        .loan-detail-label {
            font-size: 12px;
            color: var(--gray);
        }

        .loan-detail-value {
            font-weight: 600;
            color: var(--dark);
            font-size: 13px;
        }

        .denda-amount {
            color: var(--danger);
            font-weight: 800;
        }

        .loan-actions {
            margin-top: 16px;
            padding-top: 12px;
            border-top: 1px solid rgba(212, 163, 115, 0.2);
        }

        .btn-kembalikan, .btn-bayar-denda {
            width: 100%;
            padding: 10px;
            border-radius: var(--radius-md);
            font-weight: 600;
            font-size: 12px;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-kembalikan {
            background: linear-gradient(135deg, var(--success), #3a6b5e);
            color: white;
        }

        .btn-bayar-denda {
            background: linear-gradient(135deg, var(--danger), #b86a4a);
            color: white;
        }

        .btn-kembalikan:hover, .btn-bayar-denda:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
            gap: 10px;
        }

        .denda-status {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 600;
        }

        .denda-lunas {
            background: rgba(74, 124, 111, 0.12);
            color: var(--success);
        }

        .denda-belum {
            background: rgba(201, 123, 94, 0.12);
            color: var(--danger);
        }

        .denda-tidak {
            background: rgba(142, 142, 160, 0.12);
            color: #8E8EA0;
        }

        /* Alert */
        .alert {
            padding: 16px 20px;
            border-radius: var(--radius-md);
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-left: 4px solid;
            animation: slideIn 0.3s ease;
        }

        .alert-success {
            background: rgba(74, 124, 111, 0.1);
            border-left-color: var(--success);
            color: var(--success);
        }

        .alert-danger {
            background: rgba(201, 123, 94, 0.1);
            border-left-color: var(--danger);
            color: var(--danger);
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--gray);
        }

        .empty-icon {
            font-size: 64px;
            color: #d4a373;
            margin-bottom: 16px;
        }

        .empty-state h3 {
            font-size: 18px;
            margin-bottom: 8px;
            color: var(--dark);
        }

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

        /* Modal Pembayaran Denda */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            animation: fadeIn 0.3s ease;
        }

        .modal-content {
            background: white;
            border-radius: var(--radius-xl);
            padding: 28px;
            max-width: 450px;
            width: 90%;
            box-shadow: var(--shadow-lg);
            animation: slideUp 0.3s ease;
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

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 2px solid rgba(59, 110, 140, 0.1);
        }

        .modal-header h3 {
            font-size: 20px;
            font-weight: 700;
            color: var(--dark);
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--gray);
            transition: var(--transition);
        }

        .modal-close:hover {
            color: var(--danger);
        }

        .payment-details {
            background: #f8f5f0;
            padding: 20px;
            border-radius: var(--radius-md);
            margin-bottom: 20px;
        }

        .payment-details p {
            margin: 8px 0;
            font-size: 14px;
        }

        .payment-details .denda-value {
            font-size: 22px;
            color: var(--danger);
            font-weight: 800;
        }

        .payment-amount-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid rgba(212, 163, 115, 0.4);
            border-radius: var(--radius-md);
            font-size: 16px;
            margin-bottom: 8px;
        }

        .payment-info {
            font-size: 12px;
            color: var(--gray);
            margin-top: 5px;
        }

        .payment-info.warning { color: var(--danger); }
        .payment-info.success { color: var(--success); }

        .modal-actions {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        .btn-confirm {
            flex: 1;
            background: linear-gradient(135deg, var(--success), #3a6b5e);
            color: white;
            padding: 12px;
            border-radius: var(--radius-md);
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-confirm:hover {
            transform: translateY(-2px);
        }

        .btn-confirm:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .btn-cancel {
            flex: 1;
            background: #e8e2d5;
            color: var(--gray);
            padding: 12px;
            border-radius: var(--radius-md);
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-cancel:hover {
            background: #d6cebe;
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
            .dashboard-card {
                padding: 20px;
            }
            .search-wrapper {
                display: none;
            }
            .stats-container {
                grid-template-columns: 1fr;
            }
            .books-grid, .loans-grid {
                grid-template-columns: 1fr;
            }
            .welcome-section {
                flex-direction: column;
                text-align: center;
            }
            .multi-select-toolbar {
                flex-direction: column;
            }
            .toolbar-actions {
                width: 100%;
            }
            .btn-clear-selection, .btn-borrow-selected {
                flex: 1;
                justify-content: center;
            }
            .date-picker-section input {
                max-width: 100%;
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
    <button class="sidebar-toggle" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <div class="app-container" id="appContainer">
        @include('layouts.sidebarpeminjam')

        <main class="main-content" id="mainContent">
            <header class="header">
                <h1 class="header-title">Dashboard Peminjam</h1>
                <div class="header-actions">
                    <div class="search-wrapper">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" id="globalSearch" placeholder="Cari buku...">
                        <span class="search-shortcut">⌘K</span>
                    </div>
                    <button class="notification-btn" id="notificationBtn">
                        <i class="fas fa-bell"></i>
                        @php
                            $totalPeminjamanAktif = auth()->check() ? auth()->user()->peminjaman()->where('status', 'dipinjam')->count() : 0;
                        @endphp
                        <span class="notification-badge">{{ $totalPeminjamanAktif }}</span>
                    </button>
                    <div class="user-menu" id="userMenu">
                        <div class="user-menu-avatar">
                            @auth
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            @else
                                PE
                            @endauth
                        </div>
                        <span>{{ Auth::user()->name ?? 'Peminjam' }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </header>

            <div class="content-wrapper">
                <!-- Welcome Section -->
                <div class="welcome-section animate__animated animate__fadeIn">
                    <div class="welcome-text">
                        <h2>Selamat Membaca, {{ Auth::user()->name ?? 'Peminjam' }}! 📖</h2>
                        <p>Temukan buku favoritmu, pilih beberapa sekaligus, dan pinjam dengan mudah</p>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="stats-container">
                    @php
                        $totalBukuTersedia = App\Models\Alat::where('stok', '>', 0)->count();
                        $totalPeminjaman = auth()->check() ? auth()->user()->peminjaman()->count() : 0;
                        $totalDipinjam = auth()->check() ? auth()->user()->peminjaman()->where('status', 'dipinjam')->count() : 0;
                        $totalMenunggu = auth()->check() ? auth()->user()->peminjaman()->where('status', 'menunggu')->count() : 0;
                        $totalDendaBelum = auth()->check() ? auth()->user()->peminjaman()->where('denda', '>', 0)->where('status_denda', 'belum')->count() : 0;
                    @endphp
                    
                    <div class="stat-card" onclick="scrollToSection('booksSection')">
                        <div class="stat-icon icon-primary"><i class="fas fa-book"></i></div>
                        <div class="stat-info">
                            <h3>Buku Tersedia</h3>
                            <div class="number">{{ $totalBukuTersedia }}</div>
                            <div class="desc">Siap dipinjam</div>
                        </div>
                    </div>

                    <div class="stat-card" onclick="scrollToSection('loansSection')">
                        <div class="stat-icon icon-success"><i class="fas fa-history"></i></div>
                        <div class="stat-info">
                            <h3>Total Peminjaman</h3>
                            <div class="number">{{ $totalPeminjaman }}</div>
                            <div class="desc">Semua riwayat</div>
                        </div>
                    </div>

                    <div class="stat-card" onclick="scrollToSection('loansSection')">
                        <div class="stat-icon icon-warning"><i class="fas fa-book-open"></i></div>
                        <div class="stat-info">
                            <h3>Sedang Dipinjam</h3>
                            <div class="number">{{ $totalDipinjam }}</div>
                            <div class="desc">Belum dikembalikan</div>
                        </div>
                    </div>

                    <div class="stat-card" onclick="scrollToSection('loansSection')">
                        <div class="stat-icon icon-danger"><i class="fas fa-money-bill-wave"></i></div>
                        <div class="stat-info">
                            <h3>Denda Belum Bayar</h3>
                            <div class="number">{{ $totalDendaBelum }}</div>
                            <div class="desc">Perlu segera dibayar</div>
                        </div>
                    </div>
                </div>

                <!-- Alert Messages -->
                @if(session('success'))
                    <div class="alert alert-success animate__animated animate__fadeIn">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger animate__animated animate__fadeIn">
                        <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger animate__animated animate__fadeIn">
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

                <!-- Daftar Buku Tersedia - DENGAN MULTI SELECT -->
                <div class="dashboard-card" id="booksSection">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-book"></i>
                            Koleksi Buku Tersedia
                        </h3>
                        <div class="card-info">
                            <span style="font-size: 13px; color: var(--gray);">{{ $totalBukuTersedia }} buku siap dipinjam</span>
                        </div>
                    </div>

                    @php
                        $alatTersedia = App\Models\Alat::where('stok', '>', 0)->latest()->get();
                    @endphp
                    
                    @if($alatTersedia->count() > 0)
                        <!-- Multi Select Toolbar -->
                        <div class="multi-select-toolbar hidden" id="multiSelectToolbar">
                            <div class="selected-count">
                                <i class="fas fa-check-circle"></i>
                                <span id="selectedCount">0</span> buku dipilih
                            </div>
                            <div class="toolbar-actions">
                                <button type="button" class="btn-clear-selection" id="clearSelectionBtn">
                                    <i class="fas fa-times"></i> Batal Pilih
                                </button>
                                <button type="button" class="btn-borrow-selected" id="borrowSelectedBtn">
                                    <i class="fas fa-hand-peace"></i> Pinjam Sekarang
                                </button>
                            </div>
                        </div>

                        <!-- Date Picker untuk Multi Pinjam (hidden by default) -->
                        <div class="date-picker-section hidden" id="datePickerSection">
                            <label for="return_date"><i class="fas fa-calendar-alt"></i> Tanggal Rencana Kembali</label>
                            <input type="date" 
                                   id="return_date" 
                                   name="tanggal_rencana_kembali" 
                                   min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                   value="{{ date('Y-m-d', strtotime('+7 days')) }}">
                        </div>

                        <!-- Multi Select Form -->
                        <form id="multiBorrowForm" method="POST" action="{{ route('peminjam.pinjam') }}">
                            @csrf
                            <input type="hidden" name="tanggal_rencana_kembali" id="formReturnDate">
                            <div id="selectedBooksInputs"></div>
                        </form>

                        <!-- Books Grid -->
                        <div class="books-grid" id="booksGrid">
                            @foreach($alatTersedia as $book)
                                <div class="book-card" data-book-id="{{ $book->id_alat }}" data-book-title="{{ $book->nama_alat }}">
                                    <div class="checkbox-wrapper">
                                        <input type="checkbox" 
                                               class="book-checkbox" 
                                               data-id="{{ $book->id_alat }}"
                                               data-name="{{ $book->nama_alat }}">
                                    </div>
                                    <div class="book-cover">
                                        @if($book->gambar)
                                            <img src="{{ asset('storage/' . $book->gambar) }}" alt="{{ $book->nama_alat }}">
                                        @else
                                            <div class="no-image-placeholder">
                                                <i class="fas fa-book"></i>
                                                <span>{{ substr($book->nama_alat, 0, 2) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="book-info">
                                        <h3 class="book-title">{{ $book->nama_alat }}</h3>
                                        <div class="book-category">
                                            <i class="fas fa-tag"></i> {{ $book->kategori->nama_kategori ?? 'Umum' }}
                                        </div>
                                        <div class="book-meta">
                                            <span class="book-stock {{ $book->stok <= 2 ? 'stock-low' : ($book->stok <= 5 ? 'stock-medium' : '') }}">
                                                <i class="fas fa-copy"></i> Stok: {{ $book->stok }}
                                            </span>
                                            <span class="condition-badge condition-baik">
                                                <i class="fas fa-check-circle"></i> {{ $book->kondisi ?? 'Baik' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon"><i class="fas fa-book"></i></div>
                            <h3>Tidak ada buku tersedia</h3>
                            <p>Semua buku sedang dipinjam. Silakan coba lagi nanti.</p>
                        </div>
                    @endif
                </div>

                <!-- Riwayat Peminjaman (TETAP SAMA, TIDAK DIUBAH) -->
                <div class="dashboard-card" id="loansSection">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-history"></i>
                            Riwayat Peminjaman Saya
                        </h3>
                        <div class="card-info">
                            <span style="font-size: 13px; color: var(--gray);">{{ $totalDipinjam }} sedang dipinjam</span>
                        </div>
                    </div>

                    @php
                        $semuaPeminjaman = auth()->check() ? 
                            auth()->user()->peminjaman()
                                ->with('alat')
                                ->latest()
                                ->get() : 
                            collect();
                    @endphp
                    
                    @if($semuaPeminjaman->count() > 0)
                        <div class="loans-grid">
                            @foreach($semuaPeminjaman as $loan)
                                @php
                                    $today = now();
                                    $rencanaKembali = $loan->tanggal_rencana_kembali;
                                    $tanggalKembali = $loan->tanggal_kembali;
                                    $daysLeft = $today->diffInDays($rencanaKembali, false);
                                    $isTerlambat = $loan->status == 'dipinjam' && $today->greaterThan($rencanaKembali);
                                    
                                    if ($loan->status == 'menunggu') {
                                        $statusClass = 'status-menunggu';
                                        $statusText = 'Menunggu';
                                    } elseif ($isTerlambat) {
                                        $statusClass = 'status-terlambat';
                                        $statusText = 'Terlambat';
                                    } elseif ($loan->status == 'dipinjam') {
                                        $statusClass = 'status-dipinjam';
                                        $statusText = 'Dipinjam';
                                    } else {
                                        $statusClass = 'status-selesai';
                                        $statusText = 'Selesai';
                                    }
                                    
                                    // HITUNG DENDA
                                    if ($loan->status == 'dipinjam' && $today->greaterThan($rencanaKembali)) {
                                        $hariTerlambat = ceil(abs($daysLeft));
                                        $denda = $hariTerlambat * 1000;
                                    } else {
                                        $denda = $loan->denda ?? 0;
                                    }
                                    
                                    // STATUS DENDA
  if (strtolower($loan->status_denda) == 'lunas') {
        $dendaStatusClass = 'denda-lunas';
        $dendaStatusText = 'Lunas';
    } elseif ($loan->denda > 0) {
        $dendaStatusClass = 'denda-belum';
        $dendaStatusText = 'Belum Bayar';
    } else {
        $dendaStatusClass = 'denda-tidak';
        $dendaStatusText = 'Tidak Ada';
    }
                                @endphp
                                <div class="loan-card">
                                    <div class="loan-header">
                                        <span class="loan-book-title">{{ $loan->alat->nama_alat ?? 'Buku' }}</span>
                                        <span class="loan-status {{ $statusClass }}">{{ $statusText }}</span>
                                    </div>
                                    <div class="loan-body">
                                        <div class="loan-detail">
                                            <span class="loan-detail-label"><i class="fas fa-calendar"></i> Tanggal Pinjam</span>
                                            <span class="loan-detail-value">{{ \Carbon\Carbon::parse($loan->tanggal_pinjam)->format('d/m/Y') }}</span>
                                        </div>
                                        <div class="loan-detail">
                                            <span class="loan-detail-label"><i class="fas fa-calendar-check"></i> Rencana Kembali</span>
                                            <span class="loan-detail-value">{{ \Carbon\Carbon::parse($loan->tanggal_rencana_kembali)->format('d/m/Y') }}</span>
                                        </div>
                                        @if($tanggalKembali)
                                        <div class="loan-detail">
                                            <span class="loan-detail-label"><i class="fas fa-undo"></i> Tanggal Kembali</span>
                                            <span class="loan-detail-value">{{ \Carbon\Carbon::parse($tanggalKembali)->format('d/m/Y') }}</span>
                                        </div>
                                        @endif
                                        <div class="loan-detail">
                                            <span class="loan-detail-label"><i class="fas fa-money-bill"></i> Denda</span>
                                            <span class="loan-detail-value denda-amount">Rp {{ number_format($denda, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="loan-detail">
                                            <span class="loan-detail-label"><i class="fas fa-flag-checkered"></i> Status Denda</span>
                                            <span class="denda-status {{ $dendaStatusClass }}">
                                                <i class="fas {{ $dendaStatusClass == 'denda-lunas' ? 'fa-check-circle' : ($dendaStatusClass == 'denda-belum' ? 'fa-exclamation-circle' : 'fa-minus-circle') }}"></i>
                                                {{ $dendaStatusText }}
                                            </span>
                                        </div>
                                        @if($loan->status == 'dipinjam')
                                            <div class="loan-actions">
                                                @if($denda > 0)
                                                    <button type="button" class="btn-bayar-denda" onclick="openPaymentModal({{ $loan->id_peminjaman }}, '{{ addslashes($loan->alat->nama_alat ?? 'Buku') }}', {{ $denda }})">
                                                        <i class="fas fa-money-bill-wave"></i> Bayar Denda & Kembalikan
                                                    </button>
                                                @else
                                                    <form method="POST" action="{{ route('peminjam.pengembalian.kembalikan', $loan->id_peminjaman) }}">
                                                        @csrf
                                                        <button type="submit" class="btn-kembalikan">
                                                            <i class="fas fa-undo-alt"></i> Kembalikan Buku
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        @elseif($loan->status == 'menunggu')
                                            <div class="loan-actions">
                                                <div style="text-align: center; color: var(--warning); font-size: 12px;">
                                                    <i class="fas fa-hourglass-half"></i> Menunggu konfirmasi petugas
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon"><i class="fas fa-history"></i></div>
                            <h3>Belum ada peminjaman</h3>
                            <p>Mulai dengan meminjam buku dari koleksi di atas.</p>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Pembayaran Denda -->
    <div id="paymentModal" class="modal-overlay" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-money-bill-wave"></i> Bayar Denda & Kembalikan Buku</h3>
                <button class="modal-close" onclick="closePaymentModal()">&times;</button>
            </div>
            <form id="paymentForm" method="POST" action="">
                @csrf
                @method('PUT')
                <input type="hidden" name="id_peminjaman" id="paymentLoanId">
                
                <div class="payment-details">
                    <p><span class="label">Buku:</span> <span class="value" id="paymentBookName"></span></p>
                    <p><span class="label">Total Denda:</span> <span class="value denda-value" id="paymentDendaAmount"></span></p>
                    <p><span class="label">Info:</span> <span class="value">Bayar denda terlebih dahulu untuk mengembalikan buku</span></p>
                </div>
                
                <div class="manual-payment-input">
                    <label for="jumlah_bayar">Masukkan Jumlah Pembayaran</label>
                    <input type="number" 
                           id="jumlah_bayar" 
                           name="jumlah_bayar" 
                           class="payment-amount-input"
                           placeholder="Masukkan nominal pembayaran"
                           min="0"
                           step="1000"
                           oninput="validatePaymentAmount(this)">
                    <div id="paymentInfo" class="payment-info"></div>
                </div>
                
                <div class="modal-actions">
                    <button type="button" class="btn-cancel" onclick="closePaymentModal()">Batal</button>
                    <button type="submit" class="btn-confirm" id="confirmPaymentBtn" disabled>
                        <i class="fas fa-check-circle"></i> Bayar & Kembalikan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentDendaAmount = 0;
        let currentLoanId = null;

        // Toggle sidebar
        const sidebarToggle = document.getElementById('sidebarToggle');
        const appContainer = document.getElementById('appContainer');
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                appContainer.classList.toggle('sidebar-collapsed');
            });
        }

        // Scroll to section
        function scrollToSection(sectionId) {
            const section = document.getElementById(sectionId);
            if (section) {
                section.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }

        // Search functionality
        const globalSearch = document.getElementById('globalSearch');
        if (globalSearch) {
            let searchTimeout;
            globalSearch.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    const term = this.value.toLowerCase();
                    const bookCards = document.querySelectorAll('.book-card');
                    let visibleCount = 0;
                    
                    bookCards.forEach(card => {
                        const title = card.dataset.bookTitle?.toLowerCase() || '';
                        if (title.includes(term)) {
                            card.style.display = '';
                            visibleCount++;
                        } else {
                            card.style.display = 'none';
                        }
                    });
                }, 300);
            });
        }

        // ============================================================
        // MULTI SELECT LOGIC
        // ============================================================
        let selectedBooks = [];

        const checkboxes = document.querySelectorAll('.book-checkbox');
        const multiSelectToolbar = document.getElementById('multiSelectToolbar');
        const datePickerSection = document.getElementById('datePickerSection');
        const selectedCountSpan = document.getElementById('selectedCount');
        const clearSelectionBtn = document.getElementById('clearSelectionBtn');
        const borrowSelectedBtn = document.getElementById('borrowSelectedBtn');
        const returnDateInput = document.getElementById('return_date');
        const formReturnDate = document.getElementById('formReturnDate');
        const selectedBooksInputs = document.getElementById('selectedBooksInputs');
        const multiBorrowForm = document.getElementById('multiBorrowForm');

        function updateMultiSelectUI() {
            const count = selectedBooks.length;
            selectedCountSpan.textContent = count;
            
            if (count > 0) {
                multiSelectToolbar.classList.remove('hidden');
                datePickerSection.classList.remove('hidden');
            } else {
                multiSelectToolbar.classList.add('hidden');
                datePickerSection.classList.add('hidden');
            }
        }

        function updateSelectedBooksInputs() {
            selectedBooksInputs.innerHTML = '';
            selectedBooks.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'id_alat[]';
                input.value = id;
                selectedBooksInputs.appendChild(input);
            });
        }

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const bookId = parseInt(this.dataset.id);
                const bookCard = this.closest('.book-card');
                
                if (this.checked) {
                    if (!selectedBooks.includes(bookId)) {
                        selectedBooks.push(bookId);
                        bookCard.classList.add('selected');
                    }
                } else {
                    selectedBooks = selectedBooks.filter(id => id !== bookId);
                    bookCard.classList.remove('selected');
                }
                
                updateMultiSelectUI();
                updateSelectedBooksInputs();
            });
        });

        if (clearSelectionBtn) {
            clearSelectionBtn.addEventListener('click', function() {
                selectedBooks = [];
                checkboxes.forEach(cb => {
                    cb.checked = false;
                    cb.closest('.book-card').classList.remove('selected');
                });
                updateMultiSelectUI();
                updateSelectedBooksInputs();
            });
        }

        if (borrowSelectedBtn) {
            borrowSelectedBtn.addEventListener('click', function() {
                const returnDate = returnDateInput.value;
                const selectedCount = selectedBooks.length;
                
                if (selectedCount === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tidak ada buku dipilih',
                        text: 'Silakan pilih minimal satu buku untuk dipinjam',
                        confirmButtonColor: '#3b6e8c'
                    });
                    return;
                }
                
                if (!returnDate) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tanggal belum diisi',
                        text: 'Silakan pilih tanggal rencana pengembalian',
                        confirmButtonColor: '#3b6e8c'
                    });
                    return;
                }
                
                const formattedDate = new Date(returnDate).toLocaleDateString('id-ID');
                const bookNames = Array.from(checkboxes)
                    .filter(cb => cb.checked)
                    .map(cb => `• ${cb.dataset.name}`)
                    .join('<br>');
                
                Swal.fire({
                    title: '<i class="fas fa-hand-peace"></i> Konfirmasi Peminjaman',
                    html: `
                        <div style="text-align: center;">
                            <div style="background: linear-gradient(135deg, #3b6e8c, #8b5e7e); width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                                <i class="fas fa-books" style="font-size: 30px; color: white;"></i>
                            </div>
                            <p><strong>${selectedCount} buku akan dipinjam:</strong></p>
                            <div style="background: #f8f5f0; padding: 12px; border-radius: 12px; margin: 15px 0; text-align: left;">
                                ${bookNames}
                            </div>
                            <p>Rencana Tanggal Kembali: <strong>${formattedDate}</strong></p>
                            <p style="color: #8a9aa8; margin-top: 15px;">Peminjaman akan diproses setelah disetujui petugas.</p>
                        </div>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: '<i class="fas fa-check"></i> Ya, Pinjam!',
                    cancelButtonText: '<i class="fas fa-times"></i> Batal',
                    confirmButtonColor: '#3b6e8c',
                    cancelButtonColor: '#8a9aa8',
                    background: '#fefaf0'
                }).then((result) => {
                    if (result.isConfirmed) {
                        formReturnDate.value = returnDate;
                        multiBorrowForm.submit();
                    }
                });
            });
        }

        // Set default return date
        if (returnDateInput) {
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            const minDate = tomorrow.toISOString().split('T')[0];
            returnDateInput.min = minDate;
            
            const defaultDate = new Date();
            defaultDate.setDate(defaultDate.getDate() + 7);
            returnDateInput.value = defaultDate.toISOString().split('T')[0];
        }

        // ============================================================
        // PAYMENT MODAL FUNCTIONS (TETAP SAMA)
        // ============================================================
        function openPaymentModal(loanId, bookName, denda) {
            currentLoanId = loanId;
            currentDendaAmount = denda;
            
            const modal = document.getElementById('paymentModal');
            const form = document.getElementById('paymentForm');
            const loanIdInput = document.getElementById('paymentLoanId');
            const bookNameSpan = document.getElementById('paymentBookName');
            const dendaSpan = document.getElementById('paymentDendaAmount');
            const jumlahBayarInput = document.getElementById('jumlah_bayar');
            const infoDiv = document.getElementById('paymentInfo');
            const confirmBtn = document.getElementById('confirmPaymentBtn');
            
            form.action = `/peminjam/bayar-denda-kembalikan/${loanId}`;
            loanIdInput.value = loanId;
            bookNameSpan.textContent = bookName;
            dendaSpan.textContent = formatRupiah(denda);
            
            jumlahBayarInput.value = '';
            jumlahBayarInput.max = denda;
            infoDiv.innerHTML = 'Masukkan nominal pembayaran';
            infoDiv.className = 'payment-info';
            
            confirmBtn.disabled = true;
            confirmBtn.style.opacity = '0.6';
            
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
        
        function closePaymentModal() {
            document.getElementById('paymentModal').style.display = 'none';
            document.body.style.overflow = '';
        }
        
        document.getElementById('paymentModal').addEventListener('click', function(e) {
            if (e.target === this) closePaymentModal();
        });

        function validatePaymentAmount(input) {
            let value = parseInt(input.value) || 0;
            const infoDiv = document.getElementById('paymentInfo');
            const confirmBtn = document.getElementById('confirmPaymentBtn');
            
            if (value > currentDendaAmount) {
                infoDiv.innerHTML = `<i class="fas fa-exclamation-circle"></i> Pembayaran melebihi denda! Maksimal ${formatRupiah(currentDendaAmount)}`;
                infoDiv.className = 'payment-info warning';
                confirmBtn.disabled = true;
                confirmBtn.style.opacity = '0.6';
            } else if (value > 0 && value < currentDendaAmount) {
                const kurang = currentDendaAmount - value;
                infoDiv.innerHTML = `<i class="fas fa-info-circle"></i> Pembayaran kurang ${formatRupiah(kurang)}. Sisa denda akan tetap tercatat. Tetap bisa mengembalikan alat.`;
                infoDiv.className = 'payment-info';
                confirmBtn.disabled = false;
                confirmBtn.style.opacity = '1';
            } else if (value === currentDendaAmount) {
                infoDiv.innerHTML = `<i class="fas fa-check-circle"></i> Pembayaran lunas! Status denda akan berubah menjadi LUNAS.`;
                infoDiv.className = 'payment-info success';
                confirmBtn.disabled = false;
                confirmBtn.style.opacity = '1';
            } else if (value === 0) {
                infoDiv.innerHTML = 'Masukkan nominal pembayaran';
                infoDiv.className = 'payment-info';
                confirmBtn.disabled = true;
                confirmBtn.style.opacity = '0.6';
            } else {
                infoDiv.innerHTML = 'Pembayaran valid.';
                infoDiv.className = 'payment-info success';
                confirmBtn.disabled = false;
                confirmBtn.style.opacity = '1';
            }
        }

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(angka);
        }

        // Payment form submit with AJAX
        const paymentForm = document.getElementById('paymentForm');
        if (paymentForm) {
            paymentForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const jumlahBayar = parseInt(document.getElementById('jumlah_bayar').value) || 0;
                
                if (jumlahBayar > currentDendaAmount) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: `Jumlah pembayaran tidak boleh melebihi denda! Maksimal ${formatRupiah(currentDendaAmount)}`,
                        confirmButtonColor: '#3b6e8c'
                    });
                    return;
                }
                
                if (jumlahBayar <= 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Masukkan jumlah pembayaran yang valid!',
                        confirmButtonColor: '#3b6e8c'
                    });
                    return;
                }
                
                const submitBtn = this.querySelector('.btn-confirm');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
                submitBtn.disabled = true;
                
                const loanId = document.getElementById('paymentLoanId').value;
                
                fetch(`/peminjam/bayar-denda-kembalikan/${loanId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ 
                        jumlah_bayar: jumlahBayar,
                        _method: 'PUT'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message,
                            confirmButtonColor: '#3b6e8c'
                        }).then(() => window.location.reload());
                        closePaymentModal();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: data.message || 'Terjadi kesalahan',
                            confirmButtonColor: '#3b6e8c'
                        });
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan jaringan. Silakan coba lagi.',
                        confirmButtonColor: '#3b6e8c'
                    });
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                });
            });
        }

        // Notification button
        const notificationBtn = document.getElementById('notificationBtn');
        if (notificationBtn) {
            notificationBtn.addEventListener('click', function() {
                scrollToSection('loansSection');
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
                            <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #3b6e8c, #8b5e7e); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                                <i class="fas fa-user" style="font-size: 40px; color: white;"></i>
                            </div>
                            <h3 style="font-weight: 800;">{{ Auth::user()->name ?? 'Peminjam' }}</h3>
                            <p style="color: #8a9aa8;">{{ Auth::user()->email ?? 'peminjam@libtrack.com' }}</p>
                        </div>
                    `,
                    showCancelButton: true,
                    confirmButtonText: '<i class="fas fa-sign-out-alt"></i> Logout',
                    cancelButtonText: '<i class="fas fa-times"></i> Tutup',
                    confirmButtonColor: '#c97b5e',
                    cancelButtonColor: '#8a9aa8',
                    background: '#fefaf0'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '{{ route("logout") }}';
                    }
                });
            });
        }

        // Keyboard shortcut Ctrl+K
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                if (globalSearch) globalSearch.focus();
            }
        });

        // Success message with SweetAlert
        @if(session('success'))
        Swal.fire({
            title: '<i class="fas fa-check-circle"></i> Berhasil!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonColor: '#3b6e8c',
            timer: 4000,
            timerProgressBar: true,
            toast: false,
            background: '#fefaf0'
        });
        @endif

        @if(session('error'))
        Swal.fire({
            title: '<i class="fas fa-exclamation-circle"></i> Gagal!',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonColor: '#c97b5e',
            background: '#fefaf0'
        });
        @endif
    </script>
</body>
</html>