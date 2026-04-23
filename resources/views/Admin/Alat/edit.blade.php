<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <title>LibTrack - Edit Buku</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700|playfair:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
        :root {
            --primary: #2c3e50;
            --primary-dark: #1a252f;
            --primary-light: #34495e;
            --secondary: #8e44ad;
            --accent: #e67e22;
            --success: #27ae60;
            --warning: #f39c12;
            --danger: #e74c3c;
            --dark: #2c3e50;
            --darker: #1a252f;
            --light: #fdf6e3;
            --gray: #7f8c8d;
            --gray-light: #ecf0f1;
            --card-bg: rgba(253, 246, 227, 0.95);
            --sidebar-bg: linear-gradient(180deg, #2c3e50 0%, #1a252f 100%);
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
        }

        body {
            background: linear-gradient(135deg, #f5e6ca 0%, #e8d5b7 100%);
            color: var(--dark);
            min-height: 100vh;
            overflow-x: hidden;
            font-family: 'Inter', sans-serif;
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

        /* Glass Header */
        .header {
            background: rgba(253, 246, 227, 0.95);
            backdrop-filter: blur(20px);
            padding: 0 40px;
            height: 80px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #d4a373;
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .header-title {
            font-size: 28px;
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
            content: '📚';
            position: absolute;
            left: -10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 28px;
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
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid #d4a373;
            border-radius: var(--radius-lg);
            font-size: 15px;
            color: var(--dark);
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--secondary);
            background: white;
            box-shadow: 0 0 0 4px rgba(142, 68, 173, 0.1);
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
            color: var(--secondary);
        }

        .notification-btn {
            position: relative;
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid #d4a373;
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
            color: var(--secondary);
            border-color: var(--secondary);
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
            box-shadow: 0 2px 8px rgba(230, 126, 34, 0.4);
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            padding: 8px 16px;
            border-radius: var(--radius-lg);
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid #d4a373;
            transition: var(--transition);
        }

        .user-menu:hover {
            background: white;
            border-color: var(--secondary);
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
            box-shadow: 0 4px 8px rgba(44, 62, 80, 0.3);
        }

        /* Content */
        .content-wrapper {
            flex: 1;
            padding: 40px;
        }

        /* Breadcrumb */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 32px;
            padding: 16px 24px;
            background: rgba(253, 246, 227, 0.95);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-sm);
            border-left: 4px solid var(--secondary);
        }

        .breadcrumb-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--gray);
            text-decoration: none;
            font-size: 14px;
            transition: var(--transition);
        }

        .breadcrumb-item:hover {
            color: var(--secondary);
        }

        .breadcrumb-separator {
            color: var(--gray-light);
        }

        .breadcrumb-item.active {
            color: var(--secondary);
            font-weight: 600;
        }

        /* Dashboard Card */
        .dashboard-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            padding: 32px;
            box-shadow: var(--shadow-md);
            border: 1px solid #d4a373;
            transition: var(--transition);
            animation: cardEntrance 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
            opacity: 0;
            transform: translateY(20px);
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
        }

        .dashboard-card::before {
            content: '📖';
            position: absolute;
            bottom: -20px;
            right: -20px;
            font-size: 120px;
            opacity: 0.05;
            pointer-events: none;
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
            border-color: var(--secondary);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            padding-bottom: 20px;
            border-bottom: 2px solid rgba(142, 68, 173, 0.2);
        }

        .card-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: 'Playfair', serif;
        }

        .card-title::before {
            content: '📚';
            font-size: 28px;
        }

        /* Current Image Display */
        .current-image-container {
            display: flex;
            align-items: center;
            gap: 24px;
            padding: 20px;
            background: rgba(248, 249, 250, 0.8);
            border-radius: var(--radius-md);
            margin-bottom: 20px;
            border: 2px dashed #d4a373;
        }

        .current-image-label {
            font-weight: 600;
            color: var(--dark);
            min-width: 120px;
        }

        .current-image {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: var(--radius-sm);
            border: 3px solid white;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
        }

        .current-image:hover {
            transform: scale(1.05);
            box-shadow: var(--shadow-lg);
        }

        .no-image {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--gray);
            font-style: italic;
        }

        .remove-image-btn {
            background: linear-gradient(135deg, var(--danger), #c0392b);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: var(--radius-sm);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .remove-image-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(231, 76, 60, 0.3);
        }

        /* Form Styling */
        .form-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 28px;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: var(--dark);
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-label i {
            color: var(--secondary);
            font-size: 16px;
        }

        .form-control {
            width: 100%;
            padding: 16px 20px;
            border: 2px solid #d4a373;
            border-radius: var(--radius-md);
            font-size: 15px;
            color: var(--dark);
            transition: var(--transition);
            background: white;
            box-shadow: var(--shadow-sm);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--secondary);
            box-shadow: 0 0 0 4px rgba(142, 68, 173, 0.1);
            transform: translateY(-2px);
        }

        .form-control::placeholder {
            color: var(--gray);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%238e44ad' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 20px center;
            background-size: 16px;
            padding-right: 48px;
            cursor: pointer;
        }

        .form-text {
            font-size: 13px;
            color: var(--gray);
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .form-text i {
            font-size: 12px;
        }

        /* File Upload */
        .file-upload-container {
            position: relative;
            overflow: hidden;
            border: 2px dashed #d4a373;
            border-radius: var(--radius-md);
            padding: 40px;
            text-align: center;
            transition: var(--transition);
            background: white;
            cursor: pointer;
        }

        .file-upload-container:hover {
            border-color: var(--secondary);
            background: rgba(142, 68, 173, 0.02);
            transform: translateY(-4px);
        }

        .file-upload-container.dragover {
            border-color: var(--secondary);
            background: rgba(142, 68, 173, 0.05);
        }

        .file-upload-icon {
            font-size: 48px;
            color: var(--secondary);
            margin-bottom: 16px;
        }

        .file-upload-text {
            font-size: 16px;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .file-upload-subtext {
            font-size: 14px;
            color: var(--gray);
            margin-bottom: 20px;
        }

        .file-upload-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 12px 24px;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 14px;
            transition: var(--transition);
            border: none;
            cursor: pointer;
            pointer-events: auto;
        }

        .file-upload-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(142, 68, 173, 0.3);
        }

        .file-upload-input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            z-index: 2;
        }

        .file-preview {
            margin-top: 20px;
            display: none;
            text-align: center;
        }

        .file-preview img {
            max-width: 200px;
            max-height: 200px;
            border-radius: var(--radius-sm);
            box-shadow: var(--shadow-sm);
            border: 2px solid #d4a373;
        }

        /* Form Actions */
        .form-actions {
            display: flex;
            gap: 16px;
            margin-top: 40px;
            padding-top: 24px;
            border-top: 2px solid rgba(142, 68, 173, 0.2);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 16px 32px;
            border-radius: var(--radius-md);
            font-weight: 600;
            font-size: 15px;
            text-decoration: none;
            transition: var(--transition);
            border: none;
            cursor: pointer;
            min-width: 140px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: 0 4px 12px rgba(44, 62, 80, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(142, 68, 173, 0.4);
            gap: 15px;
        }

        .btn-secondary {
            background: white;
            color: var(--dark);
            border: 2px solid #d4a373;
            box-shadow: var(--shadow-sm);
        }

        .btn-secondary:hover {
            background: var(--gray-light);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            border-color: var(--secondary);
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--warning), #e67e22);
            color: white;
            box-shadow: 0 4px 12px rgba(243, 156, 18, 0.3);
        }

        .btn-warning:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(243, 156, 18, 0.4);
        }

        /* Alert */
        .alert {
            padding: 16px 24px;
            border-radius: var(--radius-md);
            margin-bottom: 32px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideIn 0.5s ease;
            background: rgba(231, 76, 60, 0.1);
            border-left: 4px solid var(--danger);
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

        .alert-danger {
            background: linear-gradient(135deg, rgba(231, 76, 60, 0.15), rgba(231, 76, 60, 0.05));
            color: var(--danger);
            border: 2px solid rgba(231, 76, 60, 0.2);
        }

        .alert-danger i {
            color: var(--danger);
        }

        .error-message {
            color: var(--danger);
            font-size: 13px;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .error-message i {
            font-size: 12px;
        }

        .form-control.error {
            border-color: var(--danger);
            background: rgba(231, 76, 60, 0.05);
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

        /* Book Decoration */
        .book-decoration {
            position: fixed;
            bottom: 20px;
            right: 20px;
            font-size: 60px;
            opacity: 0.1;
            pointer-events: none;
            z-index: 1;
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
            .form-actions {
                flex-direction: column;
            }
            .btn {
                width: 100%;
                justify-content: center;
            }
            .breadcrumb {
                flex-wrap: wrap;
            }
            .current-image-container {
                flex-direction: column;
                text-align: center;
                gap: 16px;
            }
            .current-image-label {
                min-width: auto;
            }
        }

        @media (max-width: 480px) {
            .card-header {
                flex-direction: column;
                gap: 16px;
                align-items: flex-start;
            }
            .file-upload-container {
                padding: 24px;
            }
            .form-control {
                padding: 14px 16px;
            }
        }
    </style>
</head>
<body class="font-sans antialiased">
    <!-- Decorative Book Element -->
    <div class="book-decoration">
        <i class="fas fa-book-open"></i>
    </div>

    <!-- Sidebar Toggle Button -->
    <button class="sidebar-toggle" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- App Container -->
    <div class="app-container" id="appContainer">
        @include('layouts.sidebar')

        <!-- Main Content -->
        <main class="main-content" id="mainContent">
            <!-- Glass Header -->
            <header class="header">
                <h1 class="header-title animate__animated animate__fadeIn">Edit Buku</h1>
                <div class="header-actions">
                    <div class="search-bar">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" placeholder="Cari buku...">
                    </div>
                    <button class="notification-btn">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">2</span>
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
                <!-- Breadcrumb -->
                <nav class="breadcrumb animate__animated animate__fadeIn">
                    <a href="{{ url('/dashboard') }}" class="breadcrumb-item">
                        <i class="fas fa-home"></i>
                        Dashboard
                    </a>
                    <span class="breadcrumb-separator">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                    <a href="{{ route('admin.alat.index') }}" class="breadcrumb-item">
                        <i class="fas fa-book"></i>
                        Koleksi Buku
                    </a>
                    <span class="breadcrumb-separator">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                    <span class="breadcrumb-item active">
                        <i class="fas fa-edit"></i>
                        Edit Buku: {{ $alat->nama_alat }}
                    </span>
                </nav>

                <!-- Error Messages -->
                @if($errors->any())
                    <div class="alert alert-danger animate__animated animate__fadeIn">
                        <i class="fas fa-exclamation-circle"></i>
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

                <!-- Dashboard Card -->
                <div class="dashboard-card animate__animated animate__fadeInUp">
                    <div class="card-header">
                        <h3 class="card-title">
                            Edit Data Buku
                        </h3>
                        <div class="card-info">
                            <span style="color: var(--gray); font-size: 14px;">
                                <i class="fas fa-hashtag"></i>
                                ID Buku: {{ $alat->id_alat }}
                            </span>
                        </div>
                    </div>

                    <!-- Current Cover Display -->
                    <div class="current-image-container">
                        <div class="current-image-label">
                            <i class="fas fa-image"></i>
                            Cover Saat Ini:
                        </div>
                        @if($alat->gambar)
                            <img src="{{ asset('storage/'.$alat->gambar) }}" 
                                 class="current-image" 
                                 alt="{{ $alat->nama_alat }}"
                                 onerror="this.onerror=null; this.src='https://via.placeholder.com/120?text=No+Cover';">
                            <button type="button" 
                                    class="remove-image-btn"
                                    onclick="confirmRemoveImage()">
                                <i class="fas fa-trash"></i>
                                Hapus Cover
                            </button>
                        @else
                            <div class="no-image">
                                <i class="fas fa-book"></i>
                                Belum ada cover buku
                            </div>
                        @endif
                    </div>

                    <!-- Form Container -->
                    <div class="form-container">
                        <form action="{{ route('admin.alat.update', $alat->id_alat) }}"
                              method="POST"
                              enctype="multipart/form-data"
                              id="alatForm">

                            @csrf
                            @method('PUT')

                            <!-- Judul Buku -->
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-book"></i>
                                    Judul Buku
                                </label>
                                <input type="text" 
                                       name="nama_alat" 
                                       class="form-control @error('nama_alat') error @enderror"
                                       placeholder="Masukkan judul buku"
                                       value="{{ old('nama_alat', $alat->nama_alat) }}"
                                       required>
                                @error('nama_alat')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-lightbulb"></i>
                                    Masukkan judul buku yang lengkap dan jelas
                                </div>
                            </div>

                            <!-- Penulis -->
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-user-edit"></i>
                                    Nama Penulis
                                </label>
                                <input type="text" 
                                    name="penulis" 
                                    class="form-control @error('penulis') error @enderror"
                                    placeholder="Masukkan nama penulis"
                                    value="{{ old('penulis', $alat->penulis) }}"
                                    required>
                                @error('penulis')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-lightbulb"></i>
                                    Nama lengkap penulis atau editor buku
                                </div>
                            </div>                    
                                    
                            <!-- Tanggal Terbit -->
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-calendar-alt"></i>
                                    Tanggal Terbit
                                </label>
                                <input type="date" 
                                    name="tanggal_terbit" 
                                    class="form-control @error('tanggal_terbit') error @enderror"
                                    value="{{ old('tanggal_terbit', $alat->tanggal_terbit) }}"
                                    required>
                                @error('tanggal_terbit')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-lightbulb"></i>
                                    Tanggal pertama kali buku diterbitkan
                                </div>
                            </div>

                            <!-- Tempat Terbit -->
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-map-marker-alt"></i>
                                    Tempat Terbit
                                </label>
                                <input type="text" 
                                    name="tempat_terbit" 
                                    class="form-control @error('tempat_terbit') error @enderror"
                                    placeholder="Masukkan tempat terbit"
                                    value="{{ old('tempat_terbit', $alat->tempat_terbit ?? '') }}"
                                    required>
                                @error('tempat_terbit')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-lightbulb"></i>
                                    Contoh: Jakarta, Bandung, Yogyakarta
                                </div>
                            </div>

                            <!-- Kategori -->
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-tags"></i>
                                    Genre / Kategori
                                </label>
                                <select name="id_kategori" 
                                        class="form-control @error('id_kategori') error @enderror"
                                        required>
                                    <option value="">Pilih Genre Buku</option>
                                    @foreach($kategori as $k)
                                        <option value="{{ $k->id_kategori }}" 
                                                {{ old('id_kategori', $alat->id_kategori) == $k->id_kategori ? 'selected' : '' }}>
                                            {{ $k->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_kategori')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-lightbulb"></i>
                                    Pilih genre atau kategori buku
                                </div>
                            </div>

                            <!-- Stok -->
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-copy"></i>
                                    Jumlah Eksemplar
                                </label>
                                <input type="number" 
                                       name="stok" 
                                       class="form-control @error('stok') error @enderror"
                                       placeholder="Masukkan jumlah buku tersedia"
                                       value="{{ old('stok', $alat->stok) }}"
                                       min="0"
                                       required>
                                @error('stok')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-lightbulb"></i>
                                    Jumlah eksemplar buku yang tersedia
                                </div>
                            </div>

                            <!-- Sinopsis -->
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-align-left"></i>
                                    Sinopsis Buku
                                </label>
                                <textarea name="deskripsi" 
                                          class="form-control @error('deskripsi') error @enderror"
                                          placeholder="Tulis sinopsis atau ringkasan buku"
                                          rows="4">{{ old('deskripsi', $alat->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-lightbulb"></i>
                                    Ringkasan singkat tentang isi buku
                                </div>
                            </div>

                            <!-- Kondisi Buku -->
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-check-circle"></i>
                                    Kondisi Buku
                                </label>
                                <select name="kondisi" 
                                        class="form-control @error('kondisi') error @enderror"
                                        required>
                                    <option value="">Pilih Kondisi Buku</option>
                                    <option value="Baik" {{ old('kondisi', $alat->kondisi) == 'Baik' ? 'selected' : '' }}>Baik (Seperti Baru)</option>
                                    <option value="Rusak Ringan" {{ old('kondisi', $alat->kondisi) == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan (Lecet kecil)</option>
                                    <option value="Rusak Berat" {{ old('kondisi', $alat->kondisi) == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat (Halaman rusak)</option>
                                    <option value="Perlu Perbaikan" {{ old('kondisi', $alat->kondisi) == 'Perlu Perbaikan' ? 'selected' : '' }}>Perlu Perbaikan (Jilid lepas)</option>
                                </select>
                                @error('kondisi')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-lightbulb"></i>
                                    Kondisi fisik buku saat ini
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-toggle-on"></i>
                                    Status Ketersediaan
                                </label>
                                <select name="status" 
                                        class="form-control @error('status') error @enderror"
                                        required>
                                    <option value="">Pilih Status</option>
                                    <option value="tersedia" {{ old('status', $alat->status) == 'tersedia' ? 'selected' : '' }}>Tersedia untuk Dipinjam</option>
                                    <option value="dipinjam" {{ old('status', $alat->status) == 'dipinjam' ? 'selected' : '' }}>Sedang Dipinjam</option>
                                    <option value="perbaikan" {{ old('status', $alat->status) == 'perbaikan' ? 'selected' : '' }}>Dalam Perbaikan</option>
                                </select>
                                @error('status')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-lightbulb"></i>
                                    Status ketersediaan buku untuk dipinjam
                                </div>
                            </div>

                            <!-- Cover Baru -->
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-image"></i>
                                    Ganti Cover (Opsional)
                                </label>
                                
                                <div class="file-upload-container" id="fileUploadContainer">
                                    <div class="file-upload-icon">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                    </div>
                                    <div class="file-upload-text">
                                        Upload Cover Baru
                                    </div>
                                    <div class="file-upload-subtext">
                                        PNG, JPG, JPEG maks. 2MB
                                    </div>
                                    <button type="button" class="file-upload-btn" id="fileUploadBtn">
                                        <i class="fas fa-folder-open"></i>
                                        Pilih File
                                    </button>
                                    <input type="file" 
                                           name="gambar" 
                                           id="gambar"
                                           class="file-upload-input"
                                           accept="image/*">
                                </div>
                                
                                <div class="file-preview" id="filePreview">
                                    <img id="previewImage" src="" alt="Preview Cover Baru">
                                    <button type="button" 
                                            class="remove-image-btn"
                                            id="removeImageBtn">
                                        <i class="fas fa-times"></i>
                                        Batalkan
                                    </button>
                                </div>
                                
                                @error('gambar')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-lightbulb"></i>
                                    Upload cover baru untuk mengganti cover saat ini (kosongkan jika tidak ingin mengganti)
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i>
                                    Update Buku
                                </button>
                                <a href="{{ route('admin.alat.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i>
                                    Batal
                                </a>
                                <button type="button" 
                                        class="btn btn-warning"
                                        onclick="confirmDelete()">
                                    <i class="fas fa-trash"></i>
                                    Hapus Buku
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Delete Confirmation Form -->
    <form action="{{ route('admin.alat.destroy', $alat->id_alat) }}" 
          method="POST" 
          id="deleteForm"
          style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        // Toggle sidebar untuk mobile
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

        // File upload dengan perbaikan
        const fileUploadContainer = document.getElementById('fileUploadContainer');
        const fileInput = document.getElementById('gambar');
        const filePreview = document.getElementById('filePreview');
        const previewImage = document.getElementById('previewImage');
        const fileUploadBtn = document.getElementById('fileUploadBtn');
        const removeImageBtn = document.getElementById('removeImageBtn');

        function previewFile(file) {
            if (!file.type.match('image.*')) {
                alert('Hanya file gambar yang diperbolehkan!');
                fileInput.value = '';
                return false;
            }

            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file maksimal 2MB!');
                fileInput.value = '';
                return false;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                filePreview.style.display = 'block';
                fileUploadContainer.style.display = 'none';
            };
            reader.readAsDataURL(file);
            return true;
        }

        function resetUpload() {
            fileInput.value = '';
            filePreview.style.display = 'none';
            fileUploadContainer.style.display = 'block';
            previewImage.src = '';
        }

        if (fileUploadBtn) {
            fileUploadBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                fileInput.click();
            });
        }

        if (fileUploadContainer) {
            fileUploadContainer.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.classList.add('dragover');
            });

            fileUploadContainer.addEventListener('dragleave', function(e) {
                e.preventDefault();
                this.classList.remove('dragover');
            });

            fileUploadContainer.addEventListener('drop', function(e) {
                e.preventDefault();
                e.stopPropagation();
                this.classList.remove('dragover');
                
                if (e.dataTransfer.files && e.dataTransfer.files.length) {
                    const file = e.dataTransfer.files[0];
                    if (previewFile(file)) {
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);
                        fileInput.files = dataTransfer.files;
                    }
                }
            });
        }

        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                e.stopPropagation();
                if (this.files && this.files[0]) {
                    previewFile(this.files[0]);
                }
            });
        }

        if (removeImageBtn) {
            removeImageBtn.addEventListener('click', function(e) {
                e.preventDefault();
                resetUpload();
            });
        }

        // Confirm remove current cover
        function confirmRemoveImage() {
            if (confirm('Apakah Anda yakin ingin menghapus cover buku ini?\nCover akan dihapus permanen.')) {
                const form = document.getElementById('alatForm');
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'remove_image';
                hiddenInput.value = '1';
                form.appendChild(hiddenInput);
                
                document.querySelector('.current-image-container').style.display = 'none';
                alert('Cover akan dihapus saat Anda menyimpan perubahan.');
            }
        }

        // Confirm delete buku
        function confirmDelete() {
            if (confirm('Apakah Anda yakin ingin menghapus buku ini?\nTindakan ini tidak dapat dibatalkan.')) {
                document.getElementById('deleteForm').submit();
            }
        }

        // Form validation
        const form = document.getElementById('alatForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;
                
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add('error');
                        
                        let errorDiv = field.parentNode.querySelector('.error-message:not(.server-error)');
                        if (!errorDiv) {
                            errorDiv = document.createElement('div');
                            errorDiv.className = 'error-message';
                            errorDiv.innerHTML = `<i class="fas fa-exclamation-circle"></i> Field ini wajib diisi`;
                            field.parentNode.insertBefore(errorDiv, field.nextElementSibling);
                        }
                    } else {
                        field.classList.remove('error');
                        
                        const errorDiv = field.parentNode.querySelector('.error-message:not(.server-error)');
                        if (errorDiv && !errorDiv.classList.contains('server-error')) {
                            errorDiv.remove();
                        }
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                    alert('Harap lengkapi semua field yang wajib diisi!');
                }
            });
        }

        window.addEventListener('resize', function() {
            if (window.innerWidth > 1200) {
                appContainer.classList.remove('sidebar-collapsed');
                if (sidebarToggle) {
                    sidebarToggle.querySelector('i').className = 'fas fa-bars';
                }
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const firstField = document.querySelector('input:not([type="file"]), select, textarea');
            if (firstField) {
                firstField.focus();
            }
        });
    </script>
</body>
</html>