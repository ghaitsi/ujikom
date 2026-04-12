<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Forent - Daftar Alat</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- AOS Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

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
            --gray-dark: #343a40;
            --card-bg: rgba(255, 255, 255, 0.98);
            --sidebar-bg: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.12);
            --shadow-lg: 0 10px 40px rgba(0, 0, 0, 0.15);
            --shadow-xl: 0 20px 60px rgba(0, 0, 0, 0.2);
            --radius-sm: 10px;
            --radius-md: 16px;
            --radius-lg: 24px;
            --radius-xl: 32px;
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
            opacity: 0.06;
            animation: float 20s infinite linear;
            pointer-events: none;
        }

        .bg-circle:nth-child(even) {
            background: linear-gradient(135deg, var(--secondary), transparent);
        }

        @keyframes float {
            0%, 100% { 
                transform: translate(0, 0) rotate(0deg) scale(1); 
            }
            33% { 
                transform: translate(50px, -50px) rotate(120deg) scale(1.1); 
            }
            66% { 
                transform: translate(-30px, 30px) rotate(240deg) scale(0.9); 
            }
        }

        @keyframes pulseGlow {
            0%, 100% {
                opacity: 0.3;
                transform: scale(1);
            }
            50% {
                opacity: 0.6;
                transform: scale(1.05);
            }
        }

        /* Layout Container */
        .app-container {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        /* Main Content */
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

        /* Glass Header Enhanced */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 0 40px;
            height: 80px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(67, 97, 238, 0.1);
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 90;
            transition: var(--transition);
        }

        .header:hover {
            box-shadow: var(--shadow-md);
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
            letter-spacing: -0.5px;
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
            animation: pulseHeight 2s infinite;
        }

        @keyframes pulseHeight {
            0%, 100% { height: 30px; opacity: 1; }
            50% { height: 40px; opacity: 0.7; }
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        /* Enhanced Search Bar */
        .search-bar {
            position: relative;
            width: 320px;
        }

        .search-input {
            width: 100%;
            padding: 14px 20px 14px 48px;
            background: white;
            border: 2px solid var(--gray-light);
            border-radius: var(--radius-lg);
            font-size: 15px;
            color: var(--dark);
            font-weight: 500;
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
        }

        .search-input::placeholder {
            color: var(--gray);
            font-weight: 400;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.1);
            transform: translateY(-2px);
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

        .search-shortcut {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.08);
            padding: 4px 8px;
            border-radius: 8px;
            font-size: 11px;
            color: var(--gray);
            font-weight: 600;
            pointer-events: none;
        }

        /* Enhanced Notification Button */
        .notification-btn {
            position: relative;
            background: white;
            border: 2px solid var(--gray-light);
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
            font-size: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(247, 37, 133, 0.4);
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }

        /* Enhanced User Menu */
        .user-menu {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            padding: 8px 20px 8px 12px;
            border-radius: var(--radius-lg);
            background: white;
            border: 2px solid var(--gray-light);
            transition: var(--transition);
            position: relative;
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
            transition: var(--transition);
        }

        .user-menu:hover .user-menu-avatar {
            transform: scale(1.05);
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 700;
            font-size: 14px;
            color: var(--dark);
        }

        .user-role {
            font-size: 11px;
            color: var(--gray);
            font-weight: 500;
        }

        /* Content */
        .content-wrapper {
            flex: 1;
            padding: 40px;
        }

        /* Enhanced Dashboard Card */
        .dashboard-card {
            background: var(--card-bg);
            border-radius: var(--radius-xl);
            padding: 32px;
            box-shadow: var(--shadow-md);
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: var(--transition);
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
        }

        .dashboard-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary), var(--accent));
        }

        .dashboard-card:hover {
            box-shadow: var(--shadow-xl);
            transform: translateY(-8px);
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
            font-weight: 800;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-title::before {
            content: '';
            width: 8px;
            height: 28px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 4px;
        }

        .card-info {
            background: rgba(67, 97, 238, 0.1);
            padding: 8px 16px;
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-info i {
            color: var(--primary);
            animation: pulseGlow 2s infinite;
        }

        .card-info span {
            color: var(--dark);
            font-weight: 600;
        }

        /* Enhanced Premium Table */
        .table-responsive {
            overflow-x: auto;
            border-radius: var(--radius-md);
        }

        .premium-table {
            width: 100%;
            background: white;
            border-radius: var(--radius-md);
            overflow: hidden;
            border-collapse: separate;
            border-spacing: 0;
        }

        .premium-table thead {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }

        .premium-table th {
            color: white;
            font-weight: 700;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 18px 16px;
            text-align: left;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
            position: relative;
        }

        .premium-table th:first-child {
            border-top-left-radius: var(--radius-md);
        }

        .premium-table th:last-child {
            border-top-right-radius: var(--radius-md);
        }

        .premium-table tbody tr {
            transition: var(--transition);
            border-bottom: 1px solid var(--gray-light);
            animation: rowFadeIn 0.5s ease forwards;
            opacity: 0;
        }

        @keyframes rowFadeIn {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .premium-table tbody tr:hover {
            background: linear-gradient(90deg, rgba(67, 97, 238, 0.05), rgba(114, 9, 183, 0.05));
            transform: translateX(4px);
        }

        .premium-table td {
            padding: 20px 16px;
            font-size: 14px;
            color: var(--dark);
            font-weight: 500;
            border-bottom: 1px solid var(--gray-light);
            vertical-align: middle;
        }

        .premium-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Enhanced ID Styling */
        .id-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            background: rgba(67, 97, 238, 0.1);
            color: var(--primary);
            border-radius: var(--radius-sm);
            font-weight: 700;
            font-size: 12px;
            border: 1px solid rgba(67, 97, 238, 0.2);
            transition: var(--transition);
        }

        .id-badge:hover {
            background: rgba(67, 97, 238, 0.2);
            transform: scale(1.02);
        }

        .id-badge i {
            font-size: 11px;
        }

        /* Enhanced Status Badges */
        .status-badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: var(--transition);
        }

        .status-badge:hover {
            transform: scale(1.02);
        }

        .status-available {
            background: linear-gradient(135deg, rgba(76, 201, 240, 0.15), rgba(76, 201, 240, 0.05));
            color: #0a7e9e;
            border: 2px solid rgba(76, 201, 240, 0.3);
        }

        .status-rented {
            background: linear-gradient(135deg, rgba(249, 65, 68, 0.15), rgba(249, 65, 68, 0.05));
            color: #c92a2a;
            border: 2px solid rgba(249, 65, 68, 0.3);
        }

        .status-maintenance {
            background: linear-gradient(135deg, rgba(248, 150, 30, 0.15), rgba(248, 150, 30, 0.05));
            color: #c96f0e;
            border: 2px solid rgba(248, 150, 30, 0.3);
        }

        /* Enhanced Action Buttons */
        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn-action {
            padding: 8px 18px;
            border-radius: var(--radius-sm);
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .btn-action::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .btn-action:hover::before {
            left: 100%;
        }

        .btn-edit {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            box-shadow: 0 2px 8px rgba(67, 97, 238, 0.3);
        }

        .btn-edit:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(67, 97, 238, 0.4);
        }

        .btn-delete {
            background: linear-gradient(135deg, var(--danger), #e53e3e);
            color: white;
            box-shadow: 0 2px 8px rgba(249, 65, 68, 0.3);
        }

        .btn-delete:hover {
            background: linear-gradient(135deg, #e53e3e, var(--danger));
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(249, 65, 68, 0.4);
        }

        /* Enhanced Image Thumbnail */
        .img-thumbnail {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: var(--radius-md);
            border: 2px solid var(--gray-light);
            transition: var(--transition);
            cursor: pointer;
        }

        .img-thumbnail:hover {
            transform: scale(1.15) rotate(2deg);
            border-color: var(--primary);
            box-shadow: var(--shadow-md);
        }

        /* Enhanced Pagination */
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid var(--gray-light);
            flex-wrap: wrap;
            gap: 16px;
        }

        .pagination-info {
            color: var(--gray-dark);
            font-size: 14px;
            font-weight: 500;
        }

        .pagination-info i {
            color: var(--primary);
            margin-right: 6px;
        }

        .pagination {
            display: flex;
            gap: 8px;
            list-style: none;
        }

        .pagination li {
            display: inline-block;
        }

        .pagination a, .pagination span {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 0 12px;
            border-radius: var(--radius-sm);
            background: white;
            color: var(--dark);
            text-decoration: none;
            font-weight: 700;
            font-size: 14px;
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
            border: 2px solid var(--gray-light);
        }

        .pagination a:hover {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            border-color: transparent;
        }

        .pagination .active span {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: var(--shadow-md);
            border-color: transparent;
        }

        /* Enhanced Add Button */
        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 14px 32px;
            border-radius: var(--radius-md);
            text-decoration: none;
            font-weight: 700;
            font-size: 15px;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
            border: none;
            cursor: pointer;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
        }

        .btn-add::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .btn-add:hover::before {
            left: 100%;
        }

        .btn-add:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(67, 97, 238, 0.5);
            gap: 16px;
        }

        /* Enhanced No Data Message */
        .no-data {
            text-align: center;
            padding: 60px 48px;
            color: var(--gray);
        }

        .no-data i {
            font-size: 64px;
            margin-bottom: 20px;
            color: var(--gray-light);
            animation: floatIcon 3s infinite;
        }

        @keyframes floatIcon {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .no-data h3 {
            font-size: 20px;
            margin-bottom: 8px;
            color: var(--dark);
            font-weight: 700;
        }

        .no-data p {
            color: var(--gray);
            font-weight: 500;
        }

        /* Sidebar Toggle Button */
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

        /* ======================================== */
        /* ENHANCED LOADING OVERLAY */
        /* ======================================== */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(8px);
            z-index: 9999;
            display: none;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .loading-overlay.active {
            display: flex;
            opacity: 1;
        }

        .loading-container {
            text-align: center;
            animation: fadeInUp 0.5s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Loading Spinner */
        .loading-spinner-wrapper {
            position: relative;
            width: 100px;
            height: 100px;
            margin: 0 auto 30px;
        }

        .loading-spinner-ring {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 3px solid transparent;
            border-top-color: var(--primary);
            border-right-color: var(--secondary);
            animation: spin 1s linear infinite;
        }

        .loading-spinner-ring:nth-child(2) {
            width: 80%;
            height: 80%;
            top: 10%;
            left: 10%;
            border-top-color: var(--secondary);
            border-right-color: var(--accent);
            animation-duration: 1.5s;
            animation-direction: reverse;
        }

        .loading-spinner-ring:nth-child(3) {
            width: 60%;
            height: 60%;
            top: 20%;
            left: 20%;
            border-top-color: var(--accent);
            border-right-color: var(--primary);
            animation-duration: 2s;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        /* Loading Icon */
        .loading-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 32px;
            color: white;
            animation: pulseIcon 1s ease infinite;
        }

        @keyframes pulseIcon {
            0%, 100% {
                transform: translate(-50%, -50%) scale(1);
                opacity: 1;
            }
            50% {
                transform: translate(-50%, -50%) scale(1.1);
                opacity: 0.8;
            }
        }

        /* Loading Text */
        .loading-text {
            color: white;
            font-size: 18px;
            font-weight: 600;
            margin-top: 20px;
            letter-spacing: 1px;
        }

        .loading-dots {
            display: inline-flex;
            gap: 4px;
            margin-left: 4px;
        }

        .loading-dots span {
            animation: dotPulse 1.4s ease infinite;
            opacity: 0;
        }

        .loading-dots span:nth-child(1) {
            animation-delay: 0s;
        }

        .loading-dots span:nth-child(2) {
            animation-delay: 0.2s;
        }

        .loading-dots span:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes dotPulse {
            0%, 60%, 100% {
                opacity: 0;
            }
            30% {
                opacity: 1;
            }
        }

        /* Loading Progress Bar */
        .loading-progress {
            width: 250px;
            margin: 20px auto 0;
        }

        .progress-bar-bg {
            width: 100%;
            height: 3px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
            overflow: hidden;
        }

        .progress-bar-fill {
            width: 0%;
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--secondary), var(--accent));
            border-radius: 3px;
            transition: width 0.1s ease;
            animation: loadingProgress 2s ease infinite;
        }

        @keyframes loadingProgress {
            0% {
                width: 0%;
            }
            50% {
                width: 70%;
            }
            100% {
                width: 100%;
            }
        }

        /* Loading Tips */
        .loading-tips {
            margin-top: 30px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 13px;
            max-width: 300px;
            text-align: center;
        }

        .loading-tips i {
            color: var(--primary-light);
            margin-right: 6px;
        }

        /* Toast Notification */
        .toast-notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: white;
            border-radius: var(--radius-md);
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: var(--shadow-lg);
            z-index: 1000;
            animation: slideInRight 0.3s ease;
            border-left: 4px solid var(--primary);
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
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
            .table-responsive {
                overflow-x: auto;
            }
            
            .premium-table th,
            .premium-table td {
                white-space: nowrap;
                min-width: 120px;
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
            
            .user-info {
                display: none;
            }
            
            .user-menu {
                padding: 8px 12px;
            }
            
            .action-buttons {
                flex-direction: column;
                gap: 6px;
            }
            
            .btn-action {
                width: 100%;
                justify-content: center;
            }
            
            .pagination-container {
                flex-direction: column;
                align-items: center;
            }
        }

        @media (max-width: 480px) {
            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .btn-add {
                width: 100%;
                justify-content: center;
            }
            
            .pagination {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .loading-progress {
                width: 200px;
            }
            
            .loading-tips {
                font-size: 11px;
                max-width: 250px;
            }
        }
    </style>
</head>
<body>
    <!-- Enhanced Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-container">
            <div class="loading-spinner-wrapper">
                <div class="loading-spinner-ring"></div>
                <div class="loading-spinner-ring"></div>
                <div class="loading-spinner-ring"></div>
                <div class="loading-icon">
                    <i class="fas fa-moon"></i>
                </div>
            </div>
            <div class="loading-text">
                Memuat data<span class="loading-dots"><span>.</span><span>.</span><span>.</span></span>
            </div>
            <div class="loading-progress">
                <div class="progress-bar-bg">
                    <div class="progress-bar-fill" id="loadingProgressFill"></div>
                </div>
            </div>
            <div class="loading-tips" id="loadingTip">
                <i class="fas fa-lightbulb"></i>
                <span>Tips: Gunakan Ctrl+K untuk mencari alat</span>
            </div>
        </div>
    </div>

    <!-- Animated Background -->
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
                <h1 class="header-title animate__animated animate__fadeIn">Daftar Alat</h1>
                <div class="header-actions">
                    <div class="search-bar">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" id="searchInput" placeholder="Cari nama alat...">
                        <span class="search-shortcut">⌘K</span>
                    </div>
                    <button class="notification-btn" id="notificationBtn">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </button>
                    <div class="user-menu" id="userMenu">
                        <div class="user-menu-avatar">
                            @auth
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            @else
                                AD
                            @endauth
                        </div>
                        <div class="user-info">
                            <span class="user-name">
                                @auth
                                    {{ Auth::user()->name }}
                                @else
                                    Admin
                                @endauth
                            </span>
                            <span class="user-role">Administrator</span>
                        </div>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="content-wrapper">
                <!-- Add Button -->
                <a href="{{ route('admin.alat.create') }}" class="btn-add animate__animated animate__fadeIn" id="addToolBtn">
                    <i class="fas fa-plus"></i>
                    Tambah Alat Baru
                </a>

                <!-- Premium Card Container -->
                <div class="dashboard-card animate__animated animate__fadeInUp" data-aos="fade-up">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-tools"></i>
                            Daftar Semua Alat
                        </h3>
                        <div class="card-info">
                            <i class="fas fa-database"></i>
                            <span>Total: {{ $alat->total() }} alat</span>
                        </div>
                    </div>

                    <!-- Premium Table -->
                    @if($alat->count() > 0)
                        <div class="table-responsive">
                            <table class="premium-table">
                                <thead>
                                    <tr>
                                        <th>ID Alat</th>
                                        <th>Nama Alat</th>
                                        <th>ID Kategori</th>
                                        <th>Kategori</th>
                                        <th>Stok</th>
                                        <th>Status</th>
                                        <th>Kondisi</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach($alat as $index => $a)
                                        <tr>
                                            <td>
                                                <span class="id-badge">
                                                    <i class="fas fa-hashtag"></i>
                                                    {{ $a->id_alat }}
                                                </span>
                                            </td>
                                            <td>
                                                <strong style="color: var(--dark); font-weight: 700;">{{ $a->nama_alat }}</strong>
                                            </td>
                                            <td>
                                                @if($a->kategori)
                                                    <span class="id-badge" style="background: rgba(114, 9, 183, 0.1); color: var(--secondary); border-color: rgba(114, 9, 183, 0.2);">
                                                        <i class="fas fa-tag"></i>
                                                        #{{ $a->kategori->id_kategori }}
                                                    </span>
                                                @else
                                                    <span style="color: var(--gray); font-weight: 500;">-</span>
                                                @endif
                                              </td>
                                            <td>
                                                @if($a->kategori)
                                                    <span style="font-weight: 600; color: var(--dark);">{{ $a->kategori->nama_kategori }}</span>
                                                @else
                                                    <span style="color: var(--gray); font-weight: 500;">Tidak ada kategori</span>
                                                @endif
                                              </td>
                                            <td>
                                                <span style="font-weight: 800; color: var(--primary); font-size: 16px;">
                                                    {{ $a->stok }}
                                                </span>
                                              </td>
                                            <td>
                                                @php
                                                    $statusClass = 'status-available';
                                                    $statusIcon = 'fa-check-circle';
                                                    $statusText = $a->status;
                                                    if($a->status == 'dipinjam') {
                                                        $statusClass = 'status-rented';
                                                        $statusIcon = 'fa-clock';
                                                    } elseif($a->status == 'perbaikan') {
                                                        $statusClass = 'status-maintenance';
                                                        $statusIcon = 'fa-wrench';
                                                    } else {
                                                        $statusIcon = 'fa-check-circle';
                                                    }
                                                @endphp
                                                <span class="status-badge {{ $statusClass }}">
                                                    <i class="fas {{ $statusIcon }}"></i>
                                                    {{ ucfirst($a->status) }}
                                                </span>
                                              </td>
                                            <td>
                                                <span class="tooltip-custom" data-tooltip="Kondisi alat" style="font-weight: 600; color: var(--dark);">
                                                    <i class="fas fa-microchip"></i> {{ $a->kondisi }}
                                                </span>
                                              </td>
                                            <td>
                                                @if($a->gambar)
                                                    <img src="{{ asset('storage/'.$a->gambar) }}" 
                                                         class="img-thumbnail tool-image" 
                                                         alt="{{ $a->nama_alat }}"
                                                         data-tool-name="{{ $a->nama_alat }}"
                                                         data-image-url="{{ asset('storage/'.$a->gambar) }}"
                                                         onerror="this.onerror=null; this.src='https://via.placeholder.com/60?text=No+Image';">
                                                @else
                                                    <img src="https://via.placeholder.com/60?text=No+Image" 
                                                         class="img-thumbnail" 
                                                         alt="No Image">
                                                @endif
                                              </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="{{ route('admin.alat.edit', $a->id_alat) }}" 
                                                       class="btn-action btn-edit edit-tool"
                                                       data-tool-name="{{ $a->nama_alat }}">
                                                        <i class="fas fa-edit"></i>
                                                        Edit
                                                    </a>
                                                    <button type="button" 
                                                            class="btn-action btn-delete delete-tool"
                                                            data-tool-id="{{ $a->id_alat }}"
                                                            data-tool-name="{{ $a->nama_alat }}">
                                                        <i class="fas fa-trash"></i>
                                                        Hapus
                                                    </button>
                                                </div>
                                             </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="no-data">
                            <i class="fas fa-tools"></i>
                            <h3>Tidak ada data alat</h3>
                            <p>Mulai dengan menambahkan alat baru</p>
                        </div>
                    @endif

                    <!-- Enhanced Pagination -->
                    @if($alat->hasPages())
                        <div class="pagination-container">
                            <div class="pagination-info">
                                <i class="fas fa-info-circle"></i>
                                Menampilkan {{ $alat->firstItem() }} - {{ $alat->lastItem() }} dari {{ $alat->total() }} alat
                            </div>
                            {{ $alat->links('vendor.pagination.custom') }}
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 50
        });

        // Enhanced Loading functions
        let loadingStartTime = null;
        let loadingTimeout = null;

        function showLoading(message = 'Memuat data') {
            const overlay = document.getElementById('loadingOverlay');
            const loadingText = document.querySelector('.loading-text');
            const progressFill = document.getElementById('loadingProgressFill');
            
            if (overlay) {
                // Reset progress
                if (progressFill) {
                    progressFill.style.width = '0%';
                }
                
                // Update text
                if (loadingText) {
                    loadingText.innerHTML = `${message}<span class="loading-dots"><span>.</span><span>.</span><span>.</span></span>`;
                }
                
                // Animate progress
                let progress = 0;
                const interval = setInterval(() => {
                    progress += Math.random() * 30;
                    if (progress >= 90) {
                        clearInterval(interval);
                    }
                    if (progressFill) {
                        progressFill.style.width = Math.min(progress, 90) + '%';
                    }
                }, 200);
                
                // Show overlay
                overlay.classList.add('active');
                loadingStartTime = Date.now();
                
                // Store interval to clear later
                overlay._progressInterval = interval;
            }
        }

        function hideLoading() {
            const overlay = document.getElementById('loadingOverlay');
            const progressFill = document.getElementById('loadingProgressFill');
            
            if (overlay) {
                // Complete progress
                if (progressFill) {
                    progressFill.style.width = '100%';
                }
                
                // Clear interval
                if (overlay._progressInterval) {
                    clearInterval(overlay._progressInterval);
                    overlay._progressInterval = null;
                }
                
                // Ensure minimum display time of 300ms for smooth transition
                const elapsed = Date.now() - (loadingStartTime || 0);
                const delay = Math.max(0, 300 - elapsed);
                
                setTimeout(() => {
                    overlay.classList.remove('active');
                    loadingStartTime = null;
                }, delay);
            }
        }

        // Tips rotation
        const tips = [
            'Tips: Gunakan Ctrl+K untuk mencari alat dengan cepat',
            'Tips: Klik gambar alat untuk melihat preview lebih besar',
            'Tips: Gunakan filter pencarian untuk menemukan alat spesifik',
            'Tips: Status alat akan berubah warna sesuai kondisi',
            'Tips: Data selalu up-to-date setiap kali halaman dimuat',
            'Pro Tips: Gunakan shortcut keyboard untuk navigasi lebih cepat'
        ];
        
        let tipIndex = 0;
        function rotateTips() {
            const tipElement = document.getElementById('loadingTip');
            if (tipElement) {
                const span = tipElement.querySelector('span');
                if (span) {
                    tipIndex = (tipIndex + 1) % tips.length;
                    span.innerHTML = tips[tipIndex];
                }
            }
        }
        
        // Rotate tips every 3 seconds when loading
        let tipInterval = null;
        
        function startTipRotation() {
            if (tipInterval) clearInterval(tipInterval);
            tipInterval = setInterval(rotateTips, 3000);
        }
        
        function stopTipRotation() {
            if (tipInterval) {
                clearInterval(tipInterval);
                tipInterval = null;
            }
        }
        
        // Override showLoading to start tip rotation
        const originalShowLoading = showLoading;
        window.showLoading = function(message) {
            startTipRotation();
            originalShowLoading(message);
        };
        
        // Override hideLoading to stop tip rotation
        const originalHideLoading = hideLoading;
        window.hideLoading = function() {
            stopTipRotation();
            originalHideLoading();
        };

        // Create enhanced animated background elements
        function createBackgroundElements() {
            const container = document.getElementById('bgElements');
            if (!container) return;
            
            const colors = ['#4361ee', '#7209b7', '#f72585', '#4cc9f0'];
            const elements = 20;
            
            for (let i = 0; i < elements; i++) {
                const circle = document.createElement('div');
                circle.className = 'bg-circle';
                
                const size = Math.random() * 400 + 100;
                const posX = Math.random() * 100;
                const posY = Math.random() * 100;
                const duration = Math.random() * 30 + 20;
                const delay = Math.random() * 10;
                const color = colors[Math.floor(Math.random() * colors.length)];
                
                circle.style.width = `${size}px`;
                circle.style.height = `${size}px`;
                circle.style.left = `${posX}%`;
                circle.style.top = `${posY}%`;
                circle.style.animationDuration = `${duration}s`;
                circle.style.animationDelay = `${delay}s`;
                circle.style.background = `linear-gradient(135deg, ${color}, transparent)`;
                
                container.appendChild(circle);
            }
        }
        
        createBackgroundElements();

        // Toggle sidebar untuk mobile
        const sidebarToggle = document.getElementById('sidebarToggle');
        const appContainer = document.getElementById('appContainer');

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                appContainer.classList.toggle('sidebar-collapsed');
                const icon = this.querySelector('i');
                if (appContainer.classList.contains('sidebar-collapsed')) {
                    icon.className = 'fas fa-bars';
                    showToast('Sidebar ditutup', 'info');
                } else {
                    icon.className = 'fas fa-times';
                    showToast('Sidebar dibuka', 'info');
                }
            });
        }

        // Enhanced Search functionality
        const searchInput = document.getElementById('searchInput');
        
        if (searchInput) {
            let searchTimeout;
            
            searchInput.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            searchInput.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
            
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    const searchTerm = this.value.toLowerCase();
                    const rows = document.querySelectorAll('#tableBody tr');
                    let visibleCount = 0;
                    
                    rows.forEach(row => {
                        const toolName = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase() || '';
                        if (toolName.includes(searchTerm)) {
                            row.style.display = '';
                            visibleCount++;
                        } else {
                            row.style.display = 'none';
                        }
                    });
                    
                    // Visual feedback on input
                    if (searchTerm.length > 0 && visibleCount === 0) {
                        this.style.borderColor = '#f94144';
                        if (visibleCount === 0) {
                            showToast('Tidak ada alat ditemukan', 'warning');
                        }
                    } else if (searchTerm.length > 0) {
                        this.style.borderColor = '#4cc9f0';
                        showToast(`${visibleCount} alat ditemukan`, 'success');
                    } else {
                        this.style.borderColor = '';
                    }
                }, 500);
            });
        }

        // SweetAlert for Add Tool button
        const addToolBtn = document.getElementById('addToolBtn');
        if (addToolBtn) {
            addToolBtn.addEventListener('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '<i class="fas fa-plus-circle"></i> Tambah Alat Baru',
                    html: `
                        <div style="text-align: center; padding: 10px;">
                            <div style="background: linear-gradient(135deg, #4361ee, #7209b7); width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; animation: pulseGlow 2s infinite;">
                                <i class="fas fa-tools" style="font-size: 40px; color: white;"></i>
                            </div>
                            <p style="color: #6c757d; margin-bottom: 10px; font-weight: 500;">Anda akan menambahkan alat baru ke dalam sistem.</p>
                            <p style="color: #4361ee; font-weight: 600; background: rgba(67,97,238,0.1); padding: 10px; border-radius: 12px;">
                                <i class="fas fa-info-circle"></i> Lengkapi informasi alat pada halaman berikutnya
                            </p>
                        </div>
                    `,
                    icon: 'info',
                    confirmButtonText: '<i class="fas fa-arrow-right"></i> Lanjutkan',
                    confirmButtonColor: '#4361ee',
                    showCancelButton: true,
                    cancelButtonText: '<i class="fas fa-times"></i> Batal',
                    cancelButtonColor: '#6c757d',
                    showClass: {
                        popup: 'animate__animated animate__zoomIn'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        showLoading('Mengarahkan ke halaman tambah alat');
                        window.location.href = addToolBtn.getAttribute('href');
                    }
                });
            });
        }

        // Enhanced SweetAlert for Delete Tool
        const deleteButtons = document.querySelectorAll('.delete-tool');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const toolId = this.dataset.toolId;
                const toolName = this.dataset.toolName;
                
                Swal.fire({
                    title: '<i class="fas fa-exclamation-triangle" style="color: #f94144;"></i> Hapus Alat',
                    html: `
                        <div style="text-align: center;">
                            <div style="background: rgba(249, 65, 68, 0.1); width: 90px; height: 90px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; animation: pulseGlow 1s infinite;">
                                <i class="fas fa-trash-alt" style="font-size: 45px; color: #f94144;"></i>
                            </div>
                            <p style="font-size: 16px; margin-bottom: 10px; color: var(--dark);">Apakah Anda yakin ingin menghapus alat</p>
                            <p style="font-weight: 800; font-size: 22px; color: #f94144;">"${toolName}"?</p>
                            <p style="color: #6c757d; margin-top: 15px; font-size: 13px; padding: 12px; background: rgba(0,0,0,0.05); border-radius: 12px;">
                                <i class="fas fa-exclamation-circle"></i> Tindakan ini tidak dapat dibatalkan! Data akan hilang permanen.
                            </p>
                        </div>
                    `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '<i class="fas fa-trash"></i> Ya, Hapus!',
                    cancelButtonText: '<i class="fas fa-times"></i> Batal',
                    confirmButtonColor: '#f94144',
                    cancelButtonColor: '#6c757d',
                    reverseButtons: true,
                    showClass: {
                        popup: 'animate__animated animate__shakeX'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        showLoading('Menghapus data alat');
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = `{{ url('admin/alat') }}/${toolId}`;
                        form.innerHTML = `
                            @csrf
                            @method('DELETE')
                        `;
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });

        // Enhanced SweetAlert for Edit Tool
        const editButtons = document.querySelectorAll('.edit-tool');
        editButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const toolName = this.dataset.toolName;
                const editUrl = this.getAttribute('href');
                
                Swal.fire({
                    title: '<i class="fas fa-edit"></i> Edit Alat',
                    html: `
                        <div style="text-align: center;">
                            <div style="background: linear-gradient(135deg, #4361ee, #7209b7); width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; animation: pulseGlow 2s infinite;">
                                <i class="fas fa-pen" style="font-size: 35px; color: white;"></i>
                            </div>
                            <p style="font-size: 16px; color: var(--dark);">Anda akan mengedit alat</p>
                            <p style="font-weight: 800; font-size: 20px; margin-top: 10px; color: #4361ee;">"${toolName}"</p>
                            <p style="color: #6c757d; margin-top: 15px; font-size: 13px;">Anda dapat mengubah informasi alat seperti nama, stok, status, dan lainnya.</p>
                        </div>
                    `,
                    icon: 'info',
                    confirmButtonText: '<i class="fas fa-arrow-right"></i> Lanjutkan Edit',
                    confirmButtonColor: '#4361ee',
                    showCancelButton: true,
                    cancelButtonText: '<i class="fas fa-times"></i> Batal',
                    cancelButtonColor: '#6c757d',
                    showClass: {
                        popup: 'animate__animated animate__fadeInUp'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        showLoading('Mengarahkan ke halaman edit');
                        window.location.href = editUrl;
                    }
                });
            });
        });

        // Enhanced SweetAlert for Image Preview
        const toolImages = document.querySelectorAll('.tool-image');
        toolImages.forEach(img => {
            img.addEventListener('click', function(e) {
                e.stopPropagation();
                const imgSrc = this.dataset.imageUrl || this.src;
                const toolName = this.dataset.toolName || 'Alat';
                
                Swal.fire({
                    title: `<i class="fas fa-image"></i> ${toolName}`,
                    html: `
                        <div style="text-align: center;">
                            <img src="${imgSrc}" style="max-width: 100%; max-height: 450px; border-radius: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.2);">
                            <p style="margin-top: 15px; color: #6c757d;">Klik diluar untuk menutup</p>
                        </div>
                    `,
                    showConfirmButton: true,
                    confirmButtonText: '<i class="fas fa-check"></i> Tutup',
                    confirmButtonColor: '#4361ee',
                    showClass: {
                        popup: 'animate__animated animate__zoomIn'
                    }
                });
            });
        });

        // Enhanced Notification button
        const notificationBtn = document.getElementById('notificationBtn');
        if (notificationBtn) {
            notificationBtn.addEventListener('click', function() {
                Swal.fire({
                    title: '<i class="fas fa-bell"></i> Notifikasi',
                    html: `
                        <div style="text-align: left; max-height: 450px; overflow-y: auto;">
                            <div style="padding: 15px; border-bottom: 1px solid #e9ecef; transition: all 0.3s; cursor: pointer;" class="notification-item" onclick="this.style.background='rgba(67,97,238,0.05)'">
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div style="width: 45px; height: 45px; background: rgba(76, 201, 240, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-plus-circle" style="color: #4cc9f0; font-size: 22px;"></i>
                                    </div>
                                    <div style="flex: 1;">
                                        <strong style="font-size: 14px; color: var(--dark);">Alat Baru Ditambahkan</strong>
                                        <p style="font-size: 12px; color: #6c757d; margin-top: 3px;">Bor Listrik - 2 jam yang lalu</p>
                                    </div>
                                </div>
                            </div>
                            <div style="padding: 15px; border-bottom: 1px solid #e9ecef; transition: all 0.3s; cursor: pointer;" class="notification-item" onclick="this.style.background='rgba(67,97,238,0.05)'">
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div style="width: 45px; height: 45px; background: rgba(67, 97, 238, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-edit" style="color: #4361ee; font-size: 22px;"></i>
                                    </div>
                                    <div style="flex: 1;">
                                        <strong style="font-size: 14px; color: var(--dark);">Alat Diperbarui</strong>
                                        <p style="font-size: 12px; color: #6c757d; margin-top: 3px;">Gerinda Tangan - stok diperbarui</p>
                                    </div>
                                </div>
                            </div>
                            <div style="padding: 15px; transition: all 0.3s; cursor: pointer;" class="notification-item" onclick="this.style.background='rgba(67,97,238,0.05)'">
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div style="width: 45px; height: 45px; background: rgba(248, 150, 30, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-exclamation-triangle" style="color: #f8961e; font-size: 22px;"></i>
                                    </div>
                                    <div style="flex: 1;">
                                        <strong style="font-size: 14px; color: var(--dark);">Stok Menipis</strong>
                                        <p style="font-size: 12px; color: #6c757d; margin-top: 3px;">Mesin Bor tersisa 2 unit</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `,
                    icon: 'info',
                    confirmButtonText: '<i class="fas fa-check"></i> Tutup',
                    confirmButtonColor: '#4361ee',
                    showCancelButton: true,
                    cancelButtonText: '<i class="fas fa-check-double"></i> Tandai Dibaca',
                    cancelButtonColor: '#6c757d',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    }
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.cancel) {
                        const badge = document.querySelector('.notification-badge');
                        if (badge) {
                            badge.style.display = 'none';
                        }
                        showToast('Semua notifikasi telah ditandai dibaca', 'success');
                    }
                });
            });
        }

        // Enhanced User menu
        const userMenu = document.getElementById('userMenu');
        if (userMenu) {
            userMenu.addEventListener('click', function() {
                @auth
                const userName = "{{ Auth::user()->name }}";
                const userEmail = "{{ Auth::user()->email }}";
                @else
                const userName = "Administrator";
                const userEmail = "admin@forent.com";
                @endauth
                
                Swal.fire({
                    title: '<i class="fas fa-user-circle"></i> Akun Saya',
                    html: `
                        <div style="text-align: center;">
                            <div style="width: 90px; height: 90px; background: linear-gradient(135deg, #4361ee, #7209b7); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; animation: pulseGlow 2s infinite;">
                                <i class="fas fa-user" style="font-size: 45px; color: white;"></i>
                            </div>
                            <h3 style="font-weight: 800; margin-bottom: 5px; font-size: 20px; color: var(--dark);">${userName}</h3>
                            <p style="color: #6c757d; margin-bottom: 5px;">${userEmail}</p>
                            <p style="color: #4361ee; font-weight: 600; margin-bottom: 15px;">Administrator</p>
                            <div style="background: rgba(67, 97, 238, 0.1); padding: 12px; border-radius: 12px;">
                                <i class="fas fa-shield-alt" style="color: #4361ee;"></i>
                                <span style="font-size: 13px; color: var(--dark); font-weight: 500;">Akses Penuh ke Semua Fitur</span>
                            </div>
                        </div>
                    `,
                    showCancelButton: true,
                    confirmButtonText: '<i class="fas fa-cog"></i> Pengaturan',
                    cancelButtonText: '<i class="fas fa-sign-out-alt"></i> Logout',
                    confirmButtonColor: '#4361ee',
                    cancelButtonColor: '#f94144',
                    showClass: {
                        popup: 'animate__animated animate__fadeInUp'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: '<i class="fas fa-cog"></i> Pengaturan Profil',
                            text: 'Fitur ini sedang dalam pengembangan',
                            icon: 'info',
                            confirmButtonColor: '#4361ee',
                            timer: 2000,
                            showConfirmButton: false,
                            toast: true,
                            position: 'top-end'
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire({
                            title: '<i class="fas fa-sign-out-alt"></i> Konfirmasi Logout',
                            text: 'Apakah Anda yakin ingin keluar?',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: '<i class="fas fa-check"></i> Ya, Keluar',
                            cancelButtonText: '<i class="fas fa-times"></i> Batal',
                            confirmButtonColor: '#f94144',
                            cancelButtonColor: '#4361ee',
                            showClass: {
                                popup: 'animate__animated animate__shakeX'
                            }
                        }).then((logoutResult) => {
                            if (logoutResult.isConfirmed) {
                                showLoading('Keluar dari sistem');
                                window.location.href = '{{ route("logout") }}';
                            }
                        });
                    }
                });
            });
        }

        // Show Toast Notification
        function showToast(message, type = 'success') {
            const colors = {
                success: '#4cc9f0',
                error: '#f94144',
                warning: '#f8961e',
                info: '#4361ee'
            };
            
            const icons = {
                success: 'fa-check-circle',
                error: 'fa-exclamation-circle',
                warning: 'fa-exclamation-triangle',
                info: 'fa-info-circle'
            };
            
            const toast = document.createElement('div');
            toast.className = 'toast-notification';
            toast.style.borderLeftColor = colors[type];
            toast.innerHTML = `
                <i class="fas ${icons[type]}" style="color: ${colors[type]}; font-size: 20px;"></i>
                <span style="color: var(--dark); font-weight: 500;">${message}</span>
            `;
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => toast.remove(), 300);
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

        // Show success message from session with SweetAlert
        @if(session('success'))
        Swal.fire({
            title: '<i class="fas fa-check-circle"></i> Berhasil!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonColor: '#4361ee',
            timer: 3000,
            timerProgressBar: true,
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            toast: true,
            position: 'top-end',
            showConfirmButton: false
        });
        @endif

        // Show error message if any
        @if(session('error'))
        Swal.fire({
            title: '<i class="fas fa-exclamation-circle"></i> Gagal!',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonColor: '#f94144',
            showClass: {
                popup: 'animate__animated animate__shakeX'
            }
        });
        @endif

        // Keyboard shortcut: Ctrl/Cmd + K to focus search
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                if (searchInput) {
                    searchInput.focus();
                    showToast('Ketik nama alat yang ingin dicari', 'info');
                }
            }
        });

        // Row animation delay
        const rows = document.querySelectorAll('#tableBody tr');
        rows.forEach((row, index) => {
            row.style.animationDelay = `${index * 0.05}s`;
        });

        // Add hover effect for table rows
        rows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.cursor = 'pointer';
            });
        });

        // Smooth scroll to top when pagination clicked
        document.querySelectorAll('.pagination a').forEach(link => {
            link.addEventListener('click', function(e) {
                setTimeout(() => {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }, 100);
            });
        });
    </script>
</body>
</html>