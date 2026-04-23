<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LibTrack - Tambah Genre Buku</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800|playfair:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
        /* ===== VARIABLES & RESET ===== */
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
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5e6ca 0%, #e8d5b7 100%);
            color: var(--dark);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ===== LAYOUT ===== */
        .app-container {
            display: flex;
            min-height: 100vh;
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

        /* ===== HEADER ===== */
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
            font-weight: 800;
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

        /* Back Button */
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.9);
            color: var(--primary);
            padding: 10px 20px;
            border-radius: var(--radius-md);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: var(--transition);
            border: 2px solid #d4a373;
        }

        .back-btn:hover {
            background: white;
            border-color: var(--secondary);
            color: var(--secondary);
            transform: translateX(-4px);
        }

        /* ===== CONTENT ===== */
        .content-wrapper {
            flex: 1;
            padding: 40px;
        }

        /* ===== FORM CARD ===== */
        .form-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            padding: 40px;
            box-shadow: var(--shadow-md);
            border: 1px solid #d4a373;
            backdrop-filter: blur(10px);
            max-width: 700px;
            margin: 0 auto;
            animation: fadeIn 0.6s ease forwards;
            position: relative;
            overflow: hidden;
        }

        .form-card::before {
            content: '📖';
            position: absolute;
            bottom: -20px;
            right: -20px;
            font-size: 100px;
            opacity: 0.05;
            pointer-events: none;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-header {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid rgba(142, 68, 173, 0.2);
            text-align: center;
        }

        .form-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 8px 20px rgba(142, 68, 173, 0.3);
        }

        .form-icon i {
            font-size: 32px;
            color: white;
        }

        .form-title {
            font-size: 28px;
            font-weight: 800;
            font-family: 'Playfair', serif;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .form-subtitle {
            color: var(--gray);
            font-size: 14px;
        }

        /* ===== FORM STYLES ===== */
        .form-group {
            margin-bottom: 28px;
        }

        .form-label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: var(--dark);
            font-size: 14px;
        }

        .form-label i {
            color: var(--secondary);
            margin-right: 8px;
        }

        .form-label span {
            color: var(--danger);
            margin-left: 4px;
        }

        .form-input {
            width: 100%;
            padding: 16px 18px;
            border: 2px solid #d4a373;
            border-radius: var(--radius-md);
            font-size: 15px;
            color: var(--dark);
            background: white;
            transition: var(--transition);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--secondary);
            box-shadow: 0 0 0 4px rgba(142, 68, 173, 0.1);
        }

        .form-input.error {
            border-color: var(--danger);
            background: rgba(231, 76, 60, 0.05);
        }

        .form-text {
            margin-top: 8px;
            font-size: 13px;
            color: var(--gray);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .form-text i {
            font-size: 12px;
            color: var(--secondary);
        }

        /* Genre Preview */
        .genre-preview {
            margin-top: 20px;
            padding: 20px;
            background: rgba(142, 68, 173, 0.05);
            border-radius: var(--radius-md);
            text-align: center;
            border: 1px dashed #d4a373;
            transition: var(--transition);
        }

        .genre-preview.hidden {
            display: none;
        }

        .preview-label {
            font-size: 12px;
            color: var(--gray);
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .preview-badge {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 10px 24px;
            border-radius: 40px;
            color: white;
            font-weight: 600;
            font-size: 14px;
            box-shadow: 0 4px 12px rgba(142, 68, 173, 0.3);
        }

        .preview-badge i {
            font-size: 16px;
        }

        /* ===== BUTTONS ===== */
        .form-actions {
            display: flex;
            gap: 16px;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid rgba(142, 68, 173, 0.2);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 14px 28px;
            border-radius: var(--radius-md);
            font-weight: 600;
            font-size: 15px;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            flex: 1;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: 0 4px 12px rgba(142, 68, 173, 0.3);
        }

        .btn-secondary {
            background: white;
            color: var(--dark);
            border: 2px solid #d4a373;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(142, 68, 173, 0.4);
            gap: 14px;
        }

        .btn-secondary:hover {
            background: var(--gray-light);
            transform: translateY(-2px);
            border-color: var(--secondary);
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        /* ===== ALERTS ===== */
        .alert {
            padding: 16px 20px;
            border-radius: var(--radius-md);
            margin-bottom: 24px;
            border-left: 4px solid;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .alert-danger {
            background: rgba(231, 76, 60, 0.1);
            border-left-color: var(--danger);
            color: var(--danger);
        }

        .alert-success {
            background: rgba(39, 174, 96, 0.1);
            border-left-color: var(--success);
            color: var(--success);
        }

        .alert ul {
            margin: 8px 0 0 0;
            padding-left: 20px;
        }

        .alert li {
            margin-bottom: 4px;
        }

        /* Suggested Genres */
        .suggested-genres {
            margin-top: 20px;
        }

        .suggested-title {
            font-size: 12px;
            color: var(--gray);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .suggested-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .suggested-item {
            background: rgba(142, 68, 173, 0.1);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            color: var(--secondary);
            cursor: pointer;
            transition: var(--transition);
            border: 1px solid transparent;
        }

        .suggested-item:hover {
            background: var(--secondary);
            color: white;
            transform: translateY(-2px);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1200px) {
            .main-content {
                margin-left: 0;
                width: 100%;
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
            
            .form-card {
                padding: 30px 24px;
            }
            
            .form-actions {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
            }
            
            .form-title {
                font-size: 24px;
            }
        }

        @media (max-width: 480px) {
            .header-title {
                font-size: 22px;
            }
            
            .form-card {
                padding: 24px 20px;
            }
            
            .form-icon {
                width: 55px;
                height: 55px;
            }
            
            .form-icon i {
                font-size: 24px;
            }
            
            .form-title {
                font-size: 22px;
            }
            
            .back-btn span {
                display: none;
            }
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="app-container" id="appContainer">
        @include('layouts.sidebar')

        <main class="main-content" id="mainContent">
            <header class="header">
                <h1 class="header-title animate__animated animate__fadeIn">Tambah Genre Buku</h1>
                <div class="header-actions">
                    <a href="{{ route('admin.kategori.index') }}" class="back-btn">
                        <i class="fas fa-arrow-left"></i>
                        <span>Kembali</span>
                    </a>
                </div>
            </header>

            <div class="content-wrapper">
                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="alert alert-danger animate__animated animate__fadeIn">
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                            <i class="fas fa-exclamation-circle"></i>
                            <strong>Terjadi kesalahan!</strong>
                        </div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Success Message -->
                @if(session('success'))
                    <div class="alert alert-success animate__animated animate__fadeIn">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <i class="fas fa-check-circle"></i>
                            <strong>Sukses!</strong> {{ session('success') }}
                        </div>
                    </div>
                @endif

                <!-- Form Card -->
                <div class="form-card">
                    <div class="form-header">
                        <div class="form-icon">
                            <i class="fas fa-tag"></i>
                        </div>
                        <h2 class="form-title">Tambah Genre Baru</h2>
                        <p class="form-subtitle">Isi form berikut untuk menambahkan genre buku baru ke perpustakaan</p>
                    </div>

                    <form action="{{ route('admin.kategori.store') }}" method="POST" id="kategoriForm">
                        @csrf
                        
                        <div class="form-group">
                            <label for="nama_kategori" class="form-label">
                                <i class="fas fa-bookmark"></i>
                                Nama Genre <span>*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-input @error('nama_kategori') error @enderror" 
                                name="nama_kategori" 
                                id="nama_kategori" 
                                value="{{ old('nama_kategori') }}" 
                                placeholder="Contoh: Fiksi, Non-Fiksi, Sains, Sejarah..."
                                required
                                autofocus
                            >
                            @error('nama_kategori')
                                <div style="color: var(--danger); font-size: 13px; margin-top: 6px;">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-lightbulb"></i>
                                Nama genre harus unik dan deskriptif untuk memudahkan pengelompokan buku.
                            </div>
                        </div>

                        <!-- Live Preview -->
                        <div class="genre-preview hidden" id="genrePreview">
                            <div class="preview-label">
                                <i class="fas fa-eye"></i> Live Preview
                            </div>
                            <div class="preview-badge" id="previewBadge">
                                <i class="fas fa-tag"></i>
                                <span id="previewText">Genre</span>
                            </div>
                        </div>

                        <!-- Suggested Genres -->
                        <div class="suggested-genres">
                            <div class="suggested-title">
                                <i class="fas fa-lightbulb"></i>
                                Genre yang sering digunakan:
                            </div>
                            <div class="suggested-list">
                                <span class="suggested-item" data-genre="Fiksi">📖 Fiksi</span>
                                <span class="suggested-item" data-genre="Non-Fiksi">📚 Non-Fiksi</span>
                                <span class="suggested-item" data-genre="Sains">🔬 Sains</span>
                                <span class="suggested-item" data-genre="Sejarah">🏛️ Sejarah</span>
                                <span class="suggested-item" data-genre="Biografi">👤 Biografi</span>
                                <span class="suggested-item" data-genre="Filsafat">💭 Filsafat</span>
                                <span class="suggested-item" data-genre="Psikologi">🧠 Psikologi</span>
                                <span class="suggested-item" data-genre="Teknologi">💻 Teknologi</span>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-save"></i> Simpan Genre
                            </button>
                            <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('kategoriForm');
            const namaInput = document.getElementById('nama_kategori');
            const submitBtn = document.getElementById('submitBtn');
            const genrePreview = document.getElementById('genrePreview');
            const previewText = document.getElementById('previewText');
            
            let formChanged = false;
            
            // Live preview functionality
            function updatePreview() {
                const value = namaInput.value.trim();
                if (value.length > 0) {
                    genrePreview.classList.remove('hidden');
                    previewText.textContent = value;
                } else {
                    genrePreview.classList.add('hidden');
                }
            }
            
            namaInput.addEventListener('input', function() {
                formChanged = true;
                updatePreview();
                
                const value = this.value.trim();
                
                // Real-time validation
                if (!value) {
                    showError(this, 'Nama genre wajib diisi');
                } else if (value.length < 2) {
                    showError(this, 'Nama genre minimal 2 karakter');
                } else if (value.length > 100) {
                    showError(this, 'Nama genre maksimal 100 karakter');
                } else {
                    clearError(this);
                }
            });
            
            // Suggested genre click
            document.querySelectorAll('.suggested-item').forEach(item => {
                item.addEventListener('click', function() {
                    const genre = this.getAttribute('data-genre');
                    namaInput.value = genre;
                    namaInput.dispatchEvent(new Event('input'));
                    namaInput.focus();
                });
            });
            
            // Form validation
            form.addEventListener('submit', function(e) {
                const namaValue = namaInput.value.trim();
                
                if (!namaValue) {
                    e.preventDefault();
                    showError(namaInput, 'Nama genre wajib diisi');
                    namaInput.focus();
                    return false;
                }
                
                if (namaValue.length < 2) {
                    e.preventDefault();
                    showError(namaInput, 'Nama genre minimal 2 karakter');
                    namaInput.focus();
                    return false;
                }
                
                if (namaValue.length > 100) {
                    e.preventDefault();
                    showError(namaInput, 'Nama genre maksimal 100 karakter');
                    namaInput.focus();
                    return false;
                }
                
                // Show loading state
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
                submitBtn.disabled = true;
                
                return true;
            });
            
            // Helper functions
            function showError(input, message) {
                input.classList.add('error');
                
                let errorDiv = input.parentElement.querySelector('.error-message');
                if (!errorDiv) {
                    errorDiv = document.createElement('div');
                    errorDiv.className = 'error-message';
                    errorDiv.style.color = 'var(--danger)';
                    errorDiv.style.fontSize = '13px';
                    errorDiv.style.marginTop = '6px';
                    errorDiv.style.display = 'flex';
                    errorDiv.style.alignItems = 'center';
                    errorDiv.style.gap = '6px';
                    input.parentElement.appendChild(errorDiv);
                }
                
                errorDiv.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
            }
            
            function clearError(input) {
                input.classList.remove('error');
                const errorDiv = input.parentElement.querySelector('.error-message');
                if (errorDiv) {
                    errorDiv.remove();
                }
            }
            
            // Auto-focus on first input
            if (namaInput && !namaInput.value) {
                namaInput.focus();
            }
            
            // Initialize preview if there's old value
            if (namaInput.value.trim()) {
                updatePreview();
            }
            
            // Confirmation before leaving page if form has changes
            const formInputs = form.querySelectorAll('input, textarea, select');
            
            formInputs.forEach(input => {
                input.addEventListener('input', () => {
                    formChanged = true;
                });
            });
            
            window.addEventListener('beforeunload', function(e) {
                if (formChanged && !form.submitted) {
                    e.preventDefault();
                    e.returnValue = '';
                }
            });
            
            // Cancel button confirmation
            const cancelBtn = document.querySelector('a[href*="kategori.index"]');
            if (cancelBtn) {
                cancelBtn.addEventListener('click', function(e) {
                    if (formChanged) {
                        if (!confirm('Anda memiliki perubahan yang belum disimpan. Yakin ingin keluar?')) {
                            e.preventDefault();
                        }
                    }
                });
            }
            
            // Enter key submit handling
            namaInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter' && this.value.trim().length >= 2) {
                    e.preventDefault();
                    submitBtn.click();
                }
            });
        });
        
        // Add styles for error messages
        const style = document.createElement('style');
        style.textContent = `
            .error-message {
                color: var(--danger) !important;
                font-size: 13px !important;
                margin-top: 6px !important;
                display: flex !important;
                align-items: center !important;
                gap: 6px !important;
            }
            .hidden {
                display: none !important;
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>