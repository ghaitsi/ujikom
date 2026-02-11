<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Forent - Edit Peminjaman</title>

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

        /* Form Container */
        .form-container {
            max-width: 800px;
            margin: 0 auto;
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

        /* Form Styling */
        .form-group {
            margin-bottom: 24px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 24px;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark);
            font-size: 14px;
        }

        .form-label .required {
            color: var(--danger);
            margin-left: 2px;
        }

        .form-input,
        .form-select {
            width: 100%;
            padding: 14px 16px;
            background: white;
            border: 2px solid var(--gray-light);
            border-radius: var(--radius-md);
            font-size: 15px;
            color: var(--dark);
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
        }

        .form-input:focus,
        .form-select:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.1);
        }

        .form-input::placeholder {
            color: var(--gray);
        }

        /* Form Select dengan custom arrow */
        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%236c757d' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            background-size: 16px;
            padding-right: 44px;
        }

        /* Form Actions */
        .form-actions {
            display: flex;
            gap: 16px;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid var(--gray-light);
        }

        /* Buttons */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 12px 28px;
            border-radius: var(--radius-md);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
            border: 2px solid transparent;
            cursor: pointer;
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            gap: 12px;
        }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: white;
            color: var(--dark);
            padding: 12px 28px;
            border-radius: var(--radius-md);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
            border: 2px solid var(--gray-light);
            cursor: pointer;
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            border-color: var(--gray);
        }

        .btn-danger {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, var(--danger), #dc2626);
            color: white;
            padding: 12px 28px;
            border-radius: var(--radius-md);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
            border: 2px solid transparent;
            cursor: pointer;
            border: none;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            gap: 12px;
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

        .alert-success i {
            color: var(--success);
        }

        .alert-danger {
            background: linear-gradient(135deg, rgba(249, 65, 68, 0.15), rgba(249, 65, 68, 0.05));
            color: var(--danger);
            border: 2px solid rgba(249, 65, 68, 0.2);
        }

        .alert-danger i {
            color: var(--danger);
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
            
            .card-header {
                flex-direction: column;
                gap: 16px;
                align-items: flex-start;
            }
            
            .form-actions {
                flex-direction: column;
                gap: 12px;
            }
            
            .btn-primary,
            .btn-secondary,
            .btn-danger {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .header-title {
                font-size: 22px;
            }
            
            .card-title {
                font-size: 18px;
            }
        }

        /* Current Value Display */
        .current-value {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(67, 97, 238, 0.1);
            color: var(--primary);
            padding: 8px 16px;
            border-radius: var(--radius-sm);
            font-size: 13px;
            margin-bottom: 8px;
            border: 1px solid rgba(67, 97, 238, 0.2);
        }

        .current-value i {
            font-size: 12px;
        }

        /* Status Color Indicators */
        .status-option {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .status-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
        }

        .menungju { background-color: var(--warning); }
        .disetujui { background-color: var(--success); }
        .ditolak { background-color: var(--danger); }
        .dipinjam { background-color: var(--primary); }
        .selesai { background-color: var(--secondary); }
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
                <h1 class="header-title animate__animated animate__fadeIn">Edit Peminjaman</h1>
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
                <div class="form-container">
                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="alert alert-success animate__animated animate__fadeIn">
                            <i class="fas fa-check-circle"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Error Messages -->
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

                    <!-- Premium Card Container -->
                    <div class="dashboard-card animate__animated animate__fadeInUp">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-edit"></i>
                                Edit Data Peminjaman #{{ $data->id_peminjaman }}
                            </h3>
                            <div class="action-buttons">
                                <a href="{{ route('admin.peminjaman.index') }}" class="btn-secondary">
                                    <i class="fas fa-arrow-left"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>

                        <form action="{{ route('admin.peminjaman.update', $data->id_peminjaman) }}" method="POST" id="editForm">
                            @csrf
                            @method('PUT')

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">
                                        User <span class="required">*</span>
                                        <span class="current-value">
                                            <i class="fas fa-user"></i>
                                            Current: {{ $data->user->name ?? 'User tidak ditemukan' }}
                                        </span>
                                    </label>
                                    <select name="id_user" class="form-select" required>
                                        <option value="">Pilih User</option>
                                        @foreach($users as $u)
                                            <option value="{{ $u->id }}"
                                                {{ $data->id_user == $u->id ? 'selected' : '' }}
                                                data-email="{{ $u->email }}">
                                                {{ $u->name }} ({{ $u->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="user-email-display" style="display: block; margin-top: 8px; color: var(--gray); font-size: 12px;">
                                        Email: {{ $data->user->email ?? '-' }}
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        Alat <span class="required">*</span>
                                        <span class="current-value">
                                            <i class="fas fa-toolbox"></i>
                                            Current: {{ $data->alat->nama_alat ?? 'Alat tidak ditemukan' }}
                                        </span>
                                    </label>
                                    <select name="id_alat" class="form-select" required>
                                        <option value="">Pilih Alat</option>
                                        @foreach($alat as $a)
                                            <option value="{{ $a->id_alat }}"
                                                {{ $data->id_alat == $a->id_alat ? 'selected' : '' }}
                                                data-kategori="{{ $a->kategori ?? '-' }}">
                                                {{ $a->nama_alat }} 
                                                @if($a->kategori)
                                                    ({{ $a->kategori }})
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="alat-info-display" style="display: block; margin-top: 8px; color: var(--gray); font-size: 12px;">
                                        Kategori: {{ $data->alat->kategori ?? '-' }}
                                    </small>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">
                                        Tanggal Pinjam <span class="required">*</span>
                                        <span class="current-value">
                                            <i class="fas fa-calendar-alt"></i>
                                            Current: {{ $data->tanggal_pinjam }}
                                        </span>
                                    </label>
                                    <input type="date" 
                                           name="tanggal_pinjam" 
                                           class="form-input" 
                                           value="{{ $data->tanggal_pinjam }}"
                                           required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        Rencana Kembali <span class="required">*</span>
                                        <span class="current-value">
                                            <i class="fas fa-calendar-check"></i>
                                            Current: {{ $data->tanggal_rencana_kembali }}
                                        </span>
                                    </label>
                                    <input type="date" 
                                           name="tanggal_rencana_kembali" 
                                           class="form-input" 
                                           value="{{ $data->tanggal_rencana_kembali }}"
                                           required>
                                    <small style="display: block; margin-top: 8px; color: var(--gray); font-size: 12px;">
                                        <i class="fas fa-info-circle"></i> Pastikan tanggal kembali setelah tanggal pinjam
                                    </small>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    Status <span class="required">*</span>
                                    <span class="current-value">
                                        <i class="fas fa-info-circle"></i>
                                        Current: 
                                        <span style="text-transform: capitalize;">{{ $data->status }}</span>
                                        <span class="status-indicator {{ $data->status }}"></span>
                                    </span>
                                </label>
                                <select name="status" class="form-select" required>
                                    @foreach(['menunggu','disetujui','ditolak','dipinjam','selesai'] as $s)
                                        <option value="{{ $s }}"
                                            {{ $data->status == $s ? 'selected' : '' }}>
                                            <span class="status-option">
                                                <span class="status-indicator {{ $s }}"></span>
                                                {{ ucfirst($s) }}
                                            </span>
                                        </option>
                                    @endforeach
                                </select>
                                <small style="display: block; margin-top: 8px; color: var(--gray); font-size: 12px;">
                                    <i class="fas fa-info-circle"></i> 
                                    Status membantu melacak progres peminjaman dari awal hingga selesai
                                </small>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn-primary">
                                    <i class="fas fa-save"></i>
                                    Update Peminjaman
                                </button>
                                
                                <a href="{{ route('admin.peminjaman.index') }}" class="btn-secondary">
                                    <i class="fas fa-times"></i>
                                    Batal
                                </a>
                                
                                <button type="button" class="btn-danger" onclick="confirmDelete()">
                                    <i class="fas fa-trash"></i>
                                    Hapus Peminjaman
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Delete Form (Hidden) -->
    <form id="deleteForm" action="{{ route('admin.peminjaman.destroy', $data->id_peminjaman) }}" method="POST" style="display: none;">
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
                
                // Update icon toggle
                const icon = this.querySelector('i');
                if (appContainer.classList.contains('sidebar-collapsed')) {
                    icon.className = 'fas fa-bars';
                } else {
                    icon.className = 'fas fa-times';
                }
            });
        }

        // Update email display when user changes
        const userSelect = document.querySelector('select[name="id_user"]');
        const userEmailDisplay = document.querySelector('.user-email-display');
        
        if (userSelect) {
            userSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const email = selectedOption.getAttribute('data-email');
                if (email) {
                    userEmailDisplay.textContent = `Email: ${email}`;
                }
            });
        }

        // Update alat info display when alat changes
        const alatSelect = document.querySelector('select[name="id_alat"]');
        const alatInfoDisplay = document.querySelector('.alat-info-display');
        
        if (alatSelect) {
            alatSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const kategori = selectedOption.getAttribute('data-kategori');
                if (kategori) {
                    alatInfoDisplay.textContent = `Kategori: ${kategori}`;
                }
            });
        }

        // Date validation
        const tanggalPinjamInput = document.querySelector('input[name="tanggal_pinjam"]');
        const tanggalKembaliInput = document.querySelector('input[name="tanggal_rencana_kembali"]');
        const editForm = document.getElementById('editForm');

        if (editForm) {
            editForm.addEventListener('submit', function(e) {
                const tanggalPinjam = new Date(tanggalPinjamInput.value);
                const tanggalKembali = new Date(tanggalKembaliInput.value);
                
                if (tanggalKembali <= tanggalPinjam) {
                    e.preventDefault();
                    showToast('Tanggal rencana kembali harus setelah tanggal pinjam', 'error');
                    tanggalKembaliInput.focus();
                    return false;
                }
                
                // Show loading
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
                    submitBtn.disabled = true;
                }
                
                return true;
            });
        }

        // Confirm delete function
        function confirmDelete() {
            if (confirm('Apakah Anda yakin ingin menghapus peminjaman ini? Tindakan ini tidak dapat dibatalkan.')) {
                const deleteForm = document.getElementById('deleteForm');
                if (deleteForm) {
                    // Show loading
                    const deleteBtn = document.querySelector('.btn-danger');
                    if (deleteBtn) {
                        deleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';
                        deleteBtn.disabled = true;
                    }
                    
                    // Submit form
                    setTimeout(() => {
                        deleteForm.submit();
                    }, 500);
                }
            }
        }

        // Toast notification function
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? 'var(--success)' : type === 'error' ? 'var(--danger)' : type === 'warning' ? 'var(--warning)' : 'var(--primary)'};
                color: white;
                padding: 16px 24px;
                border-radius: var(--radius-md);
                font-weight: 600;
                box-shadow: var(--shadow-lg);
                z-index: 9999;
                animation: slideInRight 0.3s ease;
                display: flex;
                align-items: center;
                gap: 12px;
                max-width: 400px;
            `;
            
            const icon = type === 'success' ? 'fas fa-check-circle' : type === 'error' ? 'fas fa-times-circle' : type === 'warning' ? 'fas fa-exclamation-triangle' : 'fas fa-info-circle';
            toast.innerHTML = `
                <i class="${icon}"></i>
                <span>${message}</span>
            `;
            
            document.body.appendChild(toast);
            
            // Auto remove after 3 seconds
            setTimeout(() => {
                toast.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => {
                    toast.remove();
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

        // Add custom animations
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
        `;
        document.head.appendChild(style);

        // Set minimum date for tanggal kembali
        if (tanggalPinjamInput) {
            tanggalPinjamInput.addEventListener('change', function() {
                const minDate = new Date(this.value);
                minDate.setDate(minDate.getDate() + 1);
                const nextDay = minDate.toISOString().split('T')[0];
                
                if (tanggalKembaliInput) {
                    tanggalKembaliInput.min = nextDay;
                    
                    // If current value is invalid, clear it
                    if (tanggalKembaliInput.value && tanggalKembaliInput.value <= this.value) {
                        tanggalKembaliInput.value = '';
                    }
                }
            });
        }

        // Initialize date validation on page load
        document.addEventListener('DOMContentLoaded', function() {
            if (tanggalPinjamInput && tanggalPinjamInput.value) {
                const minDate = new Date(tanggalPinjamInput.value);
                minDate.setDate(minDate.getDate() + 1);
                const nextDay = minDate.toISOString().split('T')[0];
                
                if (tanggalKembaliInput) {
                    tanggalKembaliInput.min = nextDay;
                }
            }
        });
    </script>
</body>
</html>