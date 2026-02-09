<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Forent - Tambah Kategori</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
        /* ===== VARIABLES & RESET ===== */
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
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
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
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            max-width: 800px;
            margin: 0 auto;
            animation: fadeIn 0.6s ease forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-header {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid rgba(67, 97, 238, 0.1);
        }

        .form-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .form-title::before {
            content: '';
            width: 8px;
            height: 24px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 4px;
        }

        /* ===== FORM STYLES ===== */
        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark);
            font-size: 14px;
        }

        .form-label span {
            color: var(--danger);
            margin-left: 4px;
        }

        .form-input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid var(--gray-light);
            border-radius: var(--radius-md);
            font-size: 15px;
            color: var(--dark);
            background: white;
            transition: var(--transition);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.1);
        }

        .form-input.error {
            border-color: var(--danger);
            box-shadow: 0 0 0 4px rgba(249, 65, 68, 0.1);
        }

        .form-text {
            margin-top: 6px;
            font-size: 13px;
            color: var(--gray);
        }

        /* ===== BUTTONS ===== */
        .form-actions {
            display: flex;
            gap: 16px;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid var(--gray-light);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 28px;
            border-radius: var(--radius-md);
            font-weight: 600;
            font-size: 15px;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            white-space: nowrap;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }

        .btn-secondary {
            background: var(--gray-light);
            color: var(--dark);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        /* ===== ALERTS ===== */
        .alert {
            padding: 16px 20px;
            border-radius: var(--radius-md);
            margin-bottom: 24px;
            border: 2px solid transparent;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .alert-danger {
            background: rgba(249, 65, 68, 0.1);
            border-color: rgba(249, 65, 68, 0.2);
            color: var(--danger);
        }

        .alert-success {
            background: rgba(76, 201, 240, 0.1);
            border-color: rgba(76, 201, 240, 0.2);
            color: var(--success);
        }

        .alert ul {
            margin: 8px 0 0 0;
            padding-left: 20px;
        }

        .alert li {
            margin-bottom: 4px;
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
                padding: 30px;
            }
            
            .form-actions {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .header-title {
                font-size: 22px;
            }
            
            .form-card {
                padding: 20px;
            }
            
            .form-title {
                font-size: 20px;
            }
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="app-container" id="appContainer">
        @include('layouts.sidebar')

        <main class="main-content" id="mainContent">
            <header class="header">
                <h1 class="header-title animate__animated animate__fadeIn">Tambah Kategori</h1>
                <div class="header-actions">
                    <a href="{{ route('admin.kategori.index') }}" class="btn" style="background: var(--gray-light); color: var(--dark); padding: 10px 20px;">
                        <i class="fas fa-arrow-left"></i> Kembali
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
                        <h2 class="form-title">
                            <i class="fas fa-plus-circle"></i>
                            Form Tambah Kategori
                        </h2>
                        <p style="color: var(--gray); margin-top: 8px; font-size: 14px;">
                            Isi form berikut untuk menambahkan kategori baru.
                        </p>
                    </div>

                    <form action="{{ route('admin.kategori.store') }}" method="POST" id="kategoriForm">
                        @csrf
                        
                        <div class="form-group">
                            <label for="nama_kategori" class="form-label">
                                Nama Kategori <span>*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-input @error('nama_kategori') error @enderror" 
                                name="nama_kategori" 
                                id="nama_kategori" 
                                value="{{ old('nama_kategori') }}" 
                                placeholder="Masukkan nama kategori"
                                required
                                autofocus
                            >
                            @error('nama_kategori')
                                <div style="color: var(--danger); font-size: 13px; margin-top: 6px;">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                            <div class="form-text">
                                Nama kategori harus unik dan deskriptif.
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Kategori
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
            
            // Form validation
            form.addEventListener('submit', function(e) {
                const namaValue = namaInput.value.trim();
                
                if (!namaValue) {
                    e.preventDefault();
                    showError(namaInput, 'Nama kategori wajib diisi');
                    return false;
                }
                
                if (namaValue.length < 2) {
                    e.preventDefault();
                    showError(namaInput, 'Nama kategori minimal 2 karakter');
                    return false;
                }
                
                if (namaValue.length > 255) {
                    e.preventDefault();
                    showError(namaInput, 'Nama kategori maksimal 255 karakter');
                    return false;
                }
                
                // Show loading state
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
                submitBtn.disabled = true;
                
                return true;
            });
            
            // Real-time validation
            namaInput.addEventListener('input', function() {
                const value = this.value.trim();
                
                if (!value) {
                    showError(this, 'Nama kategori wajib diisi');
                } else if (value.length < 2) {
                    showError(this, 'Nama kategori minimal 2 karakter');
                } else if (value.length > 255) {
                    showError(this, 'Nama kategori maksimal 255 karakter');
                } else {
                    clearError(this);
                }
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
            
            // Confirmation before leaving page if form has changes
            let formChanged = false;
            const formInputs = form.querySelectorAll('input, textarea, select');
            
            formInputs.forEach(input => {
                input.addEventListener('input', () => {
                    formChanged = true;
                });
            });
            
            window.addEventListener('beforeunload', function(e) {
                if (formChanged) {
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
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>