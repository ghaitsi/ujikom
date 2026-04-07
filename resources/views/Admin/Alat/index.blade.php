<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Forent - Daftar Alat</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
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
            opacity: 0.08;
            animation: float 20s infinite linear;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(100px, 50px) rotate(90deg); }
            50% { transform: translate(50px, 100px) rotate(180deg); }
            75% { transform: translate(-50px, 50px) rotate(270deg); }
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

        /* Premium Table Styling */
        .premium-table {
            width: 100%;
            background: white;
            border-radius: var(--radius-md);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            border-collapse: separate;
            border-spacing: 0;
        }

        .premium-table thead {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }

        .premium-table th {
            color: white;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 18px 16px;
            text-align: left;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
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
        }

        .premium-table tbody tr:hover {
            background: rgba(67, 97, 238, 0.05);
            transform: translateX(4px);
        }

        .premium-table td {
            padding: 20px 16px;
            font-size: 14px;
            color: var(--dark);
            border-bottom: 1px solid var(--gray-light);
        }

        .premium-table tbody tr:last-child td {
            border-bottom: none;
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
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-available {
            background: linear-gradient(135deg, rgba(76, 201, 240, 0.15), rgba(76, 201, 240, 0.05));
            color: var(--success);
            border: 2px solid rgba(76, 201, 240, 0.2);
        }

        .status-rented {
            background: linear-gradient(135deg, rgba(249, 65, 68, 0.15), rgba(249, 65, 68, 0.05));
            color: var(--danger);
            border: 2px solid rgba(249, 65, 68, 0.2);
        }

        .status-maintenance {
            background: linear-gradient(135deg, rgba(248, 150, 30, 0.15), rgba(248, 150, 30, 0.05));
            color: var(--warning);
            border: 2px solid rgba(248, 150, 30, 0.2);
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .btn-action {
            padding: 8px 16px;
            border-radius: var(--radius-sm);
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: none;
            cursor: pointer;
        }

        .btn-edit {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            box-shadow: 0 2px 8px rgba(67, 97, 238, 0.3);
        }

        .btn-edit:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.4);
        }

        .btn-delete {
            background: linear-gradient(135deg, var(--danger), #e53e3e);
            color: white;
            box-shadow: 0 2px 8px rgba(249, 65, 68, 0.3);
        }

        .btn-delete:hover {
            background: linear-gradient(135deg, #e53e3e, var(--danger));
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(249, 65, 68, 0.4);
        }

        /* Image Thumbnail */
        .img-thumbnail {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: var(--radius-sm);
            border: 2px solid var(--gray-light);
            transition: var(--transition);
            cursor: pointer;
        }

        .img-thumbnail:hover {
            transform: scale(1.1);
            border-color: var(--primary);
            box-shadow: var(--shadow-sm);
        }

        /* Pagination Styling */
        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 32px;
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
            font-weight: 600;
            font-size: 14px;
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
            border: 2px solid transparent;
        }

        .pagination a:hover {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary);
        }

        .pagination .active span {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: var(--shadow-md);
        }

        /* Add Button */
        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 14px 28px;
            border-radius: var(--radius-md);
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
            border: none;
            cursor: pointer;
            margin-bottom: 24px;
        }

        .btn-add:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.4);
            gap: 15px;
        }

        /* No Data Message */
        .no-data {
            text-align: center;
            padding: 48px;
            color: var(--gray);
        }

        .no-data i {
            font-size: 48px;
            margin-bottom: 16px;
            color: var(--gray-light);
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
            .premium-table {
                display: block;
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
            
            .action-buttons {
                flex-direction: column;
                gap: 4px;
            }
            
            .btn-action {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .card-header {
                flex-direction: column;
                gap: 16px;
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
        }
    </style>
</head>
<body>
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
                <div class="dashboard-card animate__animated animate__fadeInUp">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-tools"></i>
                            Daftar Semua Alat
                        </h3>
                        <div class="card-info">
                            <span style="color: var(--gray); font-size: 14px;">
                                <i class="fas fa-database"></i> Total: {{ $alat->total() }} alat
                            </span>
                        </div>
                    </div>

                    <!-- Premium Table -->
                    @if($alat->count() > 0)
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
                            <tbody>
                                @foreach($alat as $a)
                                    <tr>
                                        <td>
                                            <span class="id-badge">#{{ $a->id_alat }}</span>
                                        </td>
                                        <td>{{ $a->nama_alat }}</td>
                                        <td>
                                            @if($a->kategori)
                                                <span class="id-badge" style="background: rgba(114, 9, 183, 0.1); color: var(--secondary); border-color: rgba(114, 9, 183, 0.2);">
                                                    #{{ $a->kategori->id_kategori }}
                                                </span>
                                            @else
                                                <span style="color: var(--gray); font-size: 12px;">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($a->kategori)
                                                <span style="font-weight: 500;">{{ $a->kategori->nama_kategori }}</span>
                                            @else
                                                <span style="color: var(--gray); font-size: 12px;">Tidak ada kategori</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span style="font-weight: 700; color: var(--primary);">
                                                {{ $a->stok }}
                                            </span>
                                        </td>
                                        <td>
                                            @php
                                                $statusClass = 'status-available';
                                                $statusText = $a->status;
                                                if($a->status == 'dipinjam') {
                                                    $statusClass = 'status-rented';
                                                } elseif($a->status == 'perbaikan') {
                                                    $statusClass = 'status-maintenance';
                                                }
                                            @endphp
                                            <span class="status-badge {{ $statusClass }}">
                                                {{ ucfirst($a->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $a->kondisi }}</td>
                                        <td>
                                            @if($a->gambar)
                                                <img src="{{ asset('storage/'.$a->gambar) }}" 
                                                     class="img-thumbnail tool-image" 
                                                     alt="{{ $a->nama_alat }}"
                                                     data-tool-name="{{ $a->nama_alat }}"
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
                    @else
                        <div class="no-data">
                            <i class="fas fa-tools"></i>
                            <h3>Tidak ada data alat</h3>
                            <p>Mulai dengan menambahkan alat baru</p>
                        </div>
                    @endif

                    <!-- Pagination -->
                    @if($alat->hasPages())
                        <div class="pagination-container">
                            {{ $alat->links('vendor.pagination.custom') }}
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // Create animated background elements
        function createBackgroundElements() {
            const container = document.getElementById('bgElements');
            if (!container) return;
            
            for (let i = 0; i < 12; i++) {
                const circle = document.createElement('div');
                circle.className = 'bg-circle';
                
                const size = Math.random() * 250 + 80;
                const posX = Math.random() * 100;
                const posY = Math.random() * 100;
                const duration = Math.random() * 20 + 15;
                const delay = Math.random() * 5;
                
                circle.style.width = `${size}px`;
                circle.style.height = `${size}px`;
                circle.style.left = `${posX}%`;
                circle.style.top = `${posY}%`;
                circle.style.animationDuration = `${duration}s`;
                circle.style.animationDelay = `${delay}s`;
                
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
                } else {
                    icon.className = 'fas fa-times';
                }
            });
        }

        // Search functionality with SweetAlert
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            searchInput.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
            
            // Live search
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll('.premium-table tbody tr');
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
                
                // Show result count if needed
                if (searchTerm.length > 0 && visibleCount === 0) {
                    // Optional: show no results message
                    console.log('No tools found');
                }
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
                            <div style="background: linear-gradient(135deg, #4361ee, #7209b7); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                                <i class="fas fa-tools" style="font-size: 28px; color: white;"></i>
                            </div>
                            <p style="color: #6c757d;">Anda akan menambahkan alat baru ke dalam sistem.</p>
                            <p style="color: #6c757d; margin-top: 10px;">Lengkapi informasi alat pada halaman berikutnya.</p>
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
                        window.location.href = addToolBtn.getAttribute('href');
                    }
                });
            });
        }

        // SweetAlert for Delete Tool
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
                            <div style="background: rgba(249, 65, 68, 0.1); width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                                <i class="fas fa-trash-alt" style="font-size: 32px; color: #f94144;"></i>
                            </div>
                            <p style="font-size: 16px; margin-bottom: 10px;">Apakah Anda yakin ingin menghapus alat</p>
                            <p style="font-weight: 700; font-size: 18px; color: #f94144;">"${toolName}"?</p>
                            <p style="color: #6c757d; margin-top: 15px; font-size: 13px;">Tindakan ini tidak dapat dibatalkan!</p>
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
                        // Create form and submit
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = `{{ url('admin/alat') }}/${toolId}`;
                        form.innerHTML = `
                            @csrf
                            @method('DELETE')
                        `;
                        document.body.appendChild(form);
                        
                        // Show loading
                        Swal.fire({
                            title: 'Menghapus...',
                            text: 'Mohon tunggu sebentar',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                                form.submit();
                            }
                        });
                    }
                });
            });
        });

        // SweetAlert for Edit Tool
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
                            <div style="background: linear-gradient(135deg, #4361ee, #7209b7); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                                <i class="fas fa-pen" style="font-size: 24px; color: white;"></i>
                            </div>
                            <p>Anda akan mengedit alat</p>
                            <p style="font-weight: 700; font-size: 16px; margin-top: 5px;">"${toolName}"</p>
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
                        window.location.href = editUrl;
                    }
                });
            });
        });

        // SweetAlert for Image Preview
        const toolImages = document.querySelectorAll('.tool-image');
        toolImages.forEach(img => {
            img.addEventListener('click', function(e) {
                e.stopPropagation();
                const imgSrc = this.src;
                const toolName = this.dataset.toolName || 'Alat';
                
                Swal.fire({
                    title: `<i class="fas fa-image"></i> ${toolName}`,
                    html: `
                        <div style="text-align: center;">
                            <img src="${imgSrc}" style="max-width: 100%; max-height: 300px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
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

        // Notification button with SweetAlert
        const notificationBtn = document.getElementById('notificationBtn');
        if (notificationBtn) {
            notificationBtn.addEventListener('click', function() {
                Swal.fire({
                    title: '<i class="fas fa-bell"></i> Notifikasi',
                    html: `
                        <div style="text-align: left; max-height: 300px; overflow-y: auto;">
                            <div style="padding: 12px; border-bottom: 1px solid #e9ecef;">
                                <i class="fas fa-plus-circle" style="color: #4cc9f0;"></i>
                                <strong style="margin-left: 10px;">Alat Baru</strong>
                                <p style="font-size: 12px; color: #6c757d; margin-top: 5px; margin-left: 28px;">Bor Listrik ditambahkan - 2 jam lalu</p>
                            </div>
                            <div style="padding: 12px; border-bottom: 1px solid #e9ecef;">
                                <i class="fas fa-edit" style="color: #4361ee;"></i>
                                <strong style="margin-left: 10px;">Alat Diperbarui</strong>
                                <p style="font-size: 12px; color: #6c757d; margin-top: 5px; margin-left: 28px;">Gerinda Tangan - stok diperbarui</p>
                            </div>
                            <div style="padding: 12px;">
                                <i class="fas fa-exclamation-triangle" style="color: #f8961e;"></i>
                                <strong style="margin-left: 10px;">Stok Menipis</strong>
                                <p style="font-size: 12px; color: #6c757d; margin-top: 5px; margin-left: 28px;">Mesin Bor tersisa 2 unit</p>
                            </div>
                        </div>
                    `,
                    icon: 'info',
                    confirmButtonText: 'Tutup',
                    confirmButtonColor: '#4361ee',
                    showCancelButton: true,
                    cancelButtonText: 'Tandai Dibaca',
                    cancelButtonColor: '#6c757d'
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.cancel) {
                        const badge = document.querySelector('.notification-badge');
                        if (badge) {
                            badge.style.display = 'none';
                        }
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Semua notifikasi telah ditandai dibaca',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }
                });
            });
        }

        // User menu with SweetAlert
        const userMenu = document.getElementById('userMenu');
        if (userMenu) {
            userMenu.addEventListener('click', function() {
                @auth
                const userName = "{{ Auth::user()->name }}";
                const userEmail = "{{ Auth::user()->email }}";
                @else
                const userName = "User";
                const userEmail = "user@forent.com";
                @endauth
                
                Swal.fire({
                    title: '<i class="fas fa-user-circle"></i> Akun Saya',
                    html: `
                        <div style="text-align: center;">
                            <div style="width: 70px; height: 70px; background: linear-gradient(135deg, #4361ee, #7209b7); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                                <i class="fas fa-user" style="font-size: 32px; color: white;"></i>
                            </div>
                            <h3 style="font-weight: 700;">${userName}</h3>
                            <p style="color: #6c757d; margin-top: 5px;">${userEmail}</p>
                            <p style="color: #6c757d; font-size: 12px; margin-top: 5px;">Administrator</p>
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
                            title: 'Pengaturan Profil',
                            text: 'Fitur ini sedang dalam pengembangan',
                            icon: 'info',
                            confirmButtonColor: '#4361ee'
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire({
                            title: 'Konfirmasi Logout',
                            text: 'Apakah Anda yakin ingin keluar?',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya, Keluar',
                            cancelButtonText: 'Batal',
                            confirmButtonColor: '#f94144',
                            cancelButtonColor: '#4361ee'
                        }).then((logoutResult) => {
                            if (logoutResult.isConfirmed) {
                                window.location.href = '{{ route("logout") }}';
                            }
                        });
                    }
                });
            });
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
            }
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

        // Keyboard shortcut: Ctrl+K to focus search
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                if (searchInput) {
                    searchInput.focus();
                    Swal.fire({
                        title: 'Pencarian Aktif',
                        text: 'Ketik nama alat yang ingin dicari',
                        icon: 'info',
                        toast: true,
                        position: 'top-end',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            }
        });
    </script>
</body>
</html>