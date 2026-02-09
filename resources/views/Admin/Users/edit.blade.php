<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Forent - Edit User</title>

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
            margin-left: 280px; /* Sama dengan lebar sidebar */
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

        /* Back Button */
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, var(--gray-light), white);
            color: var(--dark);
            padding: 14px 28px;
            border-radius: var(--radius-md);
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
            border: 2px solid transparent;
            margin-bottom: 24px;
            cursor: pointer;
        }

        .btn-back:hover {
            background: white;
            border-color: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            gap: 15px;
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

        /* User Info Section */
        .user-info-section {
            display: flex;
            align-items: center;
            gap: 24px;
            margin-bottom: 32px;
            padding: 24px;
            background: linear-gradient(135deg, rgba(248, 249, 250, 0.8), white);
            border-radius: var(--radius-md);
            border: 2px solid var(--gray-light);
        }

        .user-avatar-large {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 32px;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
        }

        .user-avatar-large:hover {
            transform: scale(1.05) rotate(5deg);
            box-shadow: var(--shadow-lg);
        }

        .user-details h3 {
            font-size: 24px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .user-details p {
            color: var(--gray);
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .user-details i {
            color: var(--primary);
            width: 20px;
        }

        /* Form Styling */
        .premium-form {
            display: grid;
            grid-template-columns: 1fr;
            gap: 28px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .form-label {
            font-size: 15px;
            font-weight: 600;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-label i {
            color: var(--primary);
            width: 20px;
        }

        .form-input {
            padding: 16px 20px;
            border: 2px solid var(--gray-light);
            border-radius: var(--radius-md);
            font-size: 15px;
            color: var(--dark);
            transition: var(--transition);
            background: white;
            box-shadow: var(--shadow-sm);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.1);
        }

        .form-input:hover {
            border-color: var(--primary-light);
        }

        .form-input::placeholder {
            color: var(--gray);
        }

        .form-select {
            padding: 16px 20px;
            border: 2px solid var(--gray-light);
            border-radius: var(--radius-md);
            font-size: 15px;
            color: var(--dark);
            transition: var(--transition);
            background: white;
            box-shadow: var(--shadow-sm);
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%234361ee' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 20px center;
            background-size: 16px;
        }

        .form-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.1);
        }

        .form-select:hover {
            border-color: var(--primary-light);
        }

        /* Role Badges Preview */
        .role-preview {
            display: flex;
            gap: 12px;
            margin-top: 8px;
        }

        .role-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: var(--transition);
            cursor: pointer;
        }

        .role-badge:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        .role-admin {
            background: linear-gradient(135deg, rgba(67, 97, 238, 0.15), rgba(67, 97, 238, 0.05));
            color: var(--primary);
            border: 2px solid rgba(67, 97, 238, 0.2);
        }

        .role-petugas {
            background: linear-gradient(135deg, rgba(76, 201, 240, 0.15), rgba(76, 201, 240, 0.05));
            color: var(--success);
            border: 2px solid rgba(76, 201, 240, 0.2);
        }

        .role-peminjam {
            background: linear-gradient(135deg, rgba(114, 9, 183, 0.15), rgba(114, 9, 183, 0.05));
            color: var(--secondary);
            border: 2px solid rgba(114, 9, 183, 0.2);
        }

        .role-badge.active {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-color: var(--primary);
        }

        /* Form Actions */
        .form-actions {
            display: flex;
            gap: 16px;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 2px solid var(--gray-light);
        }

        .btn-submit {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 16px 32px;
            border-radius: var(--radius-md);
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
            border: none;
            cursor: pointer;
            flex: 1;
            justify-content: center;
        }

        .btn-submit:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.4);
            gap: 15px;
        }

        .btn-cancel {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, var(--gray-light), white);
            color: var(--dark);
            padding: 16px 32px;
            border-radius: var(--radius-md);
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
            border: 2px solid transparent;
            cursor: pointer;
            flex: 1;
            justify-content: center;
        }

        .btn-cancel:hover {
            background: white;
            border-color: var(--danger);
            color: var(--danger);
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }

        /* Error Messages */
        .error-messages {
            background: linear-gradient(135deg, rgba(249, 65, 68, 0.1), rgba(249, 65, 68, 0.05));
            border: 2px solid rgba(249, 65, 68, 0.2);
            border-radius: var(--radius-md);
            padding: 20px;
            margin-bottom: 28px;
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

        .error-title {
            color: var(--danger);
            font-weight: 600;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
        }

        .error-list {
            list-style: none;
        }

        .error-item {
            color: var(--danger);
            padding: 8px 0;
            border-bottom: 1px solid rgba(249, 65, 68, 0.1);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .error-item:last-child {
            border-bottom: none;
        }

        .error-item i {
            color: var(--danger);
            width: 16px;
        }

        /* Password Tips */
        .password-tips {
            background: linear-gradient(135deg, rgba(76, 201, 240, 0.1), rgba(76, 201, 240, 0.05));
            border: 2px solid rgba(76, 201, 240, 0.2);
            border-radius: var(--radius-md);
            padding: 20px;
            margin-top: 12px;
        }

        .password-tips h4 {
            color: var(--success);
            font-weight: 600;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .password-tips ul {
            list-style: none;
            color: var(--gray);
            font-size: 14px;
        }

        .password-tips li {
            padding: 6px 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .password-tips i {
            color: var(--success);
            width: 16px;
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
            
            .user-info-section {
                flex-direction: column;
                text-align: center;
                gap: 16px;
            }
            
            .user-details {
                text-align: center;
            }
            
            .form-actions {
                flex-direction: column;
            }
            
            .btn-submit, .btn-cancel {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .card-header {
                flex-direction: column;
                gap: 16px;
                align-items: flex-start;
            }
            
            .role-preview {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .btn-back {
                width: 100%;
                justify-content: center;
            }
        }

        /* Grid Layout for Larger Screens */
        @media (min-width: 768px) {
            .premium-form {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .form-group.full-width {
                grid-column: span 2;
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
                <h1 class="header-title animate__animated animate__fadeIn">Edit User</h1>
                <div class="header-actions">
                    <div class="search-bar">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" placeholder="Cari...">
                    </div>
                    <button class="notification-btn">
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
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="content-wrapper">
                <!-- Back Button -->
                <a href="{{ route('admin.users.index') }}" class="btn-back animate__animated animate__fadeIn">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Daftar User
                </a>

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="error-messages animate__animated animate__fadeIn">
                        <div class="error-title">
                            <i class="fas fa-exclamation-circle"></i>
                            Terdapat kesalahan dalam pengisian form:
                        </div>
                        <ul class="error-list">
                            @foreach ($errors->all() as $error)
                                <li class="error-item">
                                    <i class="fas fa-times-circle"></i>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Premium Card Container -->
                <div class="dashboard-card animate__animated animate__fadeInUp">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-user-edit"></i>
                            Edit Data User
                        </h3>
                        <div class="card-info">
                            <span style="color: var(--gray); font-size: 14px;">
                                User ID: #{{ $user->id }}
                            </span>
                        </div>
                    </div>

                    <!-- User Info Section -->
                    <div class="user-info-section">
                        <div class="user-avatar-large">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                        <div class="user-details">
                            <h3>{{ $user->name }}</h3>
                            <p>
                                <i class="fas fa-envelope"></i>
                                {{ $user->email }}
                            </p>
                            <p>
                                <i class="fas fa-user-tag"></i>
                                Role: <span style="font-weight: 600; color: var(--primary);">{{ $user->role }}</span>
                            </p>
                            <p>
                                <i class="fas fa-calendar-alt"></i>
                                Bergabung: {{ $user->created_at->format('d M Y') }}
                            </p>
                        </div>
                    </div>

                    <!-- Form -->
                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="premium-form">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-user"></i>
                                Nama Lengkap
                            </label>
                            <input type="text" 
                                   name="name" 
                                   value="{{ old('name', $user->name) }}" 
                                   class="form-input"
                                   placeholder="Masukkan nama lengkap"
                                   required>
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-envelope"></i>
                                Email
                            </label>
                            <input type="email" 
                                   name="email" 
                                   value="{{ old('email', $user->email) }}" 
                                   class="form-input"
                                   placeholder="Masukkan alamat email"
                                   required>
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-lock"></i>
                                Password Baru
                                <span style="font-size: 12px; color: var(--gray); font-weight: normal;">
                                    (Kosongkan jika tidak ingin mengubah)
                                </span>
                            </label>
                            <input type="password" 
                                   name="password" 
                                   class="form-input"
                                   placeholder="Masukkan password baru">
                            
                            <!-- Password Tips -->
                            <div class="password-tips">
                                <h4><i class="fas fa-lightbulb"></i> Tips Password Aman:</h4>
                                <ul>
                                    <li><i class="fas fa-check-circle"></i> Minimal 8 karakter</li>
                                    <li><i class="fas fa-check-circle"></i> Kombinasi huruf dan angka</li>
                                    <li><i class="fas fa-check-circle"></i> Gunakan karakter spesial jika perlu</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Role Selection -->
                        <div class="form-group full-width">
                            <label class="form-label">
                                <i class="fas fa-user-tag"></i>
                                Role
                            </label>
                            
                            <!-- Role Badges Preview -->
                            <div class="role-preview">
                                <span class="role-badge role-admin {{ $user->role == 'admin' ? 'active' : '' }}"
                                      onclick="selectRole('admin')">
                                    <i class="fas fa-user-shield"></i> Admin
                                </span>
                                <span class="role-badge role-petugas {{ $user->role == 'petugas' ? 'active' : '' }}"
                                      onclick="selectRole('petugas')">
                                    <i class="fas fa-user-tie"></i> Petugas
                                </span>
                                <span class="role-badge role-peminjam {{ $user->role == 'peminjam' ? 'active' : '' }}"
                                      onclick="selectRole('peminjam')">
                                    <i class="fas fa-user"></i> Peminjam
                                </span>
                            </div>

                            <!-- Hidden Select Field -->
                            <select name="role" id="roleSelect" class="form-select" required>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="petugas" {{ old('role', $user->role) == 'petugas' ? 'selected' : '' }}>Petugas</option>
                                <option value="peminjam" {{ old('role', $user->role) == 'peminjam' ? 'selected' : '' }}>Peminjam</option>
                            </select>
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions full-width">
                            <button type="submit" class="btn-submit">
                                <i class="fas fa-save"></i>
                                Update User
                            </button>
                            <a href="{{ route('admin.users.index') }}" class="btn-cancel">
                                <i class="fas fa-times"></i>
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

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

        // Role selection functionality
        function selectRole(role) {
            // Update select field
            const roleSelect = document.getElementById('roleSelect');
            roleSelect.value = role;
            
            // Update badges active state
            document.querySelectorAll('.role-badge').forEach(badge => {
                badge.classList.remove('active');
            });
            
            // Add active class to selected badge
            event.target.closest('.role-badge').classList.add('active');
            
            // Add animation effect
            event.target.closest('.role-badge').style.animation = 'pulse 0.3s ease';
            setTimeout(() => {
                event.target.closest('.role-badge').style.animation = '';
            }, 300);
        }

        // Password visibility toggle
        const passwordInput = document.querySelector('input[name="password"]');
        const passwordField = document.querySelector('.form-group:nth-child(3)');
        
        // Add password toggle button
        if (passwordInput) {
            const toggleBtn = document.createElement('button');
            toggleBtn.type = 'button';
            toggleBtn.innerHTML = '<i class="fas fa-eye"></i>';
            toggleBtn.style.cssText = `
                position: absolute;
                right: 20px;
                top: 50%;
                transform: translateY(-50%);
                background: none;
                border: none;
                color: var(--gray);
                font-size: 16px;
                cursor: pointer;
                padding: 8px;
                transition: var(--transition);
            `;
            
            passwordField.style.position = 'relative';
            passwordInput.style.paddingRight = '50px';
            passwordField.appendChild(toggleBtn);
            
            toggleBtn.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                // Toggle icon
                const icon = this.querySelector('i');
                icon.className = type === 'password' ? 'fas fa-eye' : 'fas fa-eye-slash';
                
                // Add animation
                this.style.animation = 'pulse 0.3s ease';
                setTimeout(() => {
                    this.style.animation = '';
                }, 300);
            });
        }

        // Form validation and enhancement
        const form = document.querySelector('.premium-form');
        if (form) {
            form.addEventListener('submit', function(e) {
                const nameInput = this.querySelector('input[name="name"]');
                const emailInput = this.querySelector('input[name="email"]');
                
                // Validate name
                if (nameInput.value.trim().length < 2) {
                    e.preventDefault();
                    showInputError(nameInput, 'Nama harus minimal 2 karakter');
                    return;
                }
                
                // Validate email
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(emailInput.value)) {
                    e.preventDefault();
                    showInputError(emailInput, 'Format email tidak valid');
                    return;
                }
                
                // Validate password if provided
                const passwordInput = this.querySelector('input[name="password"]');
                if (passwordInput.value && passwordInput.value.length < 8) {
                    e.preventDefault();
                    showInputError(passwordInput, 'Password harus minimal 8 karakter');
                    return;
                }
                
                // Show loading state
                const submitBtn = this.querySelector('.btn-submit');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
                submitBtn.disabled = true;
            });
        }

        // Show input error function
        function showInputError(input, message) {
            // Remove any existing error
            const existingError = input.parentElement.querySelector('.input-error');
            if (existingError) {
                existingError.remove();
            }
            
            // Add error styling to input
            input.style.borderColor = 'var(--danger)';
            input.style.boxShadow = '0 0 0 4px rgba(249, 65, 68, 0.1)';
            
            // Create error message
            const errorDiv = document.createElement('div');
            errorDiv.className = 'input-error';
            errorDiv.style.cssText = `
                color: var(--danger);
                font-size: 13px;
                margin-top: 6px;
                display: flex;
                align-items: center;
                gap: 6px;
                animation: slideIn 0.3s ease;
            `;
            errorDiv.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
            
            input.parentElement.appendChild(errorDiv);
            
            // Focus on the input
            input.focus();
            
            // Remove error on input
            input.addEventListener('input', function() {
                this.style.borderColor = '';
                this.style.boxShadow = '';
                if (errorDiv) {
                    errorDiv.remove();
                }
            }, { once: true });
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

        // Initialize animations
        document.addEventListener('DOMContentLoaded', function() {
            // Add animation to form inputs
            const formInputs = document.querySelectorAll('.form-input, .form-select');
            formInputs.forEach((input, index) => {
                input.style.animationDelay = `${index * 0.1}s`;
                input.style.animation = 'fadeInUp 0.5s ease forwards';
            });
            
            // Add custom animations
            const style = document.createElement('style');
            style.textContent = `
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
                
                @keyframes pulse {
                    0%, 100% { transform: scale(1); }
                    50% { transform: scale(1.1); }
                }
                
                .form-input, .form-select {
                    opacity: 0;
                }
            `;
            document.head.appendChild(style);
        });

        // Auto-focus first input
        setTimeout(() => {
            const firstInput = document.querySelector('.form-input');
            if (firstInput) {
                firstInput.focus();
            }
        }, 500);
    </script>
</body>
</html>