<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Forent - Login | Smart Tool Rental Management</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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
            --card-bg: rgba(255, 255, 255, 0.98);
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.06);
            --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 16px 40px rgba(0, 0, 0, 0.12);
            --radius-sm: 12px;
            --radius-md: 20px;
            --radius-lg: 28px;
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
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated Background Elements */
        .bg-elements {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
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

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        /* Login Container */
        .login-container {
            width: 100%;
            max-width: 460px;
            position: relative;
            z-index: 10;
            animation: fadeInUp 0.6s ease-out;
        }

        /* Login Card */
        .login-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            transition: var(--transition);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .login-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        /* Header */
        .login-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 32px 24px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: pulse 8s ease-in-out infinite;
        }

        .logo-wrapper {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 70px;
            height: 70px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            backdrop-filter: blur(8px);
            margin-bottom: 20px;
            transition: var(--transition);
        }

        .logo-wrapper:hover {
            transform: scale(1.05);
            background: rgba(255, 255, 255, 0.25);
        }

        .logo-wrapper i {
            font-size: 36px;
            color: white;
        }

        .login-header h1 {
            font-size: 28px;
            font-weight: 800;
            color: white;
            margin-bottom: 8px;
        }

        .login-header p {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.9);
        }

        /* Form Area */
        .login-form {
            padding: 32px;
        }

        /* Session Status */
        .session-status {
            background: linear-gradient(135deg, rgba(76, 201, 240, 0.1), rgba(76, 201, 240, 0.05));
            border-left: 3px solid var(--success);
            padding: 12px 16px;
            border-radius: var(--radius-sm);
            margin-bottom: 24px;
            font-size: 14px;
            color: var(--success);
            font-weight: 500;
            animation: fadeInUp 0.4s ease;
        }

        /* Form Group */
        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .form-label i {
            color: var(--primary);
            margin-right: 8px;
            font-size: 14px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            font-size: 16px;
            transition: var(--transition);
            pointer-events: none;
        }

        .form-input {
            width: 100%;
            padding: 14px 16px 14px 48px;
            border: 2px solid var(--gray-light);
            border-radius: var(--radius-sm);
            font-size: 15px;
            color: var(--dark);
            background: white;
            transition: var(--transition);
            outline: none;
        }

        .form-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.1);
        }

        .form-input:focus + .input-icon {
            color: var(--primary);
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--gray);
            font-size: 16px;
            transition: var(--transition);
        }

        .password-toggle:hover {
            color: var(--primary);
        }

        .error-message {
            margin-top: 8px;
            font-size: 12px;
            color: var(--danger);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .error-message i {
            font-size: 12px;
        }

        /* Remember Me & Forgot Password */
        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .checkbox-wrapper input {
            display: none;
        }

        .custom-checkbox {
            width: 20px;
            height: 20px;
            border: 2px solid var(--gray-light);
            border-radius: 6px;
            margin-right: 10px;
            position: relative;
            transition: var(--transition);
            background: white;
        }

        .checkbox-wrapper input:checked + .custom-checkbox {
            background: var(--primary);
            border-color: var(--primary);
        }

        .checkbox-wrapper input:checked + .custom-checkbox::after {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 11px;
            color: white;
        }

        .checkbox-text {
            font-size: 14px;
            color: var(--gray);
        }

        .forgot-link {
            font-size: 14px;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .forgot-link:hover {
            color: var(--secondary);
            text-decoration: underline;
        }

        /* Login Button */
        .login-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            border-radius: var(--radius-sm);
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.3);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        /* Demo Credentials */
        .demo-credentials {
            margin-top: 24px;
            padding: 16px;
            background: linear-gradient(135deg, rgba(67, 97, 238, 0.05), rgba(114, 9, 183, 0.05));
            border-radius: var(--radius-sm);
            border: 1px solid rgba(67, 97, 238, 0.1);
        }

        .demo-title {
            font-size: 12px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .demo-content {
            font-size: 12px;
            color: var(--gray);
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .demo-content p {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .demo-content i {
            width: 20px;
            color: var(--primary);
        }

        /* Register Link */
        .register-link {
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid var(--gray-light);
            text-align: center;
        }

        .register-link p {
            font-size: 14px;
            color: var(--gray);
        }

        .register-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
        }

        .register-link a:hover {
            color: var(--secondary);
            text-decoration: underline;
        }

        /* Footer */
        .login-footer {
            margin-top: 24px;
            text-align: center;
        }

        .login-footer p {
            font-size: 12px;
            color: var(--gray);
        }

        /* Dark Mode Support */
        @media (prefers-color-scheme: dark) {
            body {
                background: linear-gradient(135deg, #0f0f1a 0%, #1a1a2e 100%);
            }
            
            :root {
                --card-bg: rgba(31, 41, 55, 0.98);
                --gray-light: #374151;
                --gray: #9ca3af;
                --dark: #f3f4f6;
            }
            
            .form-input {
                background: #1f2937;
                border-color: #374151;
                color: #f3f4f6;
            }
            
            .form-input:focus {
                border-color: var(--primary);
            }
            
            .custom-checkbox {
                background: #1f2937;
                border-color: #374151;
            }
            
            .demo-credentials {
                background: rgba(67, 97, 238, 0.1);
            }
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-form {
                padding: 24px;
            }
            
            .login-header {
                padding: 24px;
            }
            
            .login-header h1 {
                font-size: 24px;
            }
            
            .logo-wrapper {
                width: 60px;
                height: 60px;
            }
            
            .logo-wrapper i {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <!-- Animated Background -->
    <div class="bg-elements" id="bgElements"></div>

    <div class="login-container">
        <div class="login-card">
            <!-- Header -->
            <div class="login-header">
                <div class="logo-wrapper">
                    <i class="fas fa-tools"></i>
                </div>
                <h1>Forent</h1>
                <p>Smart Tool Rental Management</p>
            </div>

            <!-- Form Area -->
            <div class="login-form">
                <!-- Session Status -->
                @if(session('status'))
                <div class="session-status">
                    <i class="fas fa-check-circle"></i> {{ session('status') }}
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf

                    <!-- Email Field -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-envelope"></i> Email Address
                        </label>
                        <div class="input-wrapper">
                            <i class="fas fa-envelope input-icon"></i>
                            <input type="email" name="email" class="form-input" value="{{ old('email') }}" required autofocus placeholder="admin@forent.com">
                        </div>
                        @error('email')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-lock"></i> Password
                        </label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" name="password" id="password" class="form-input" required placeholder="••••••••">
                            <button type="button" class="password-toggle" id="togglePassword">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="form-options">
                        <label class="checkbox-wrapper">
                            <input type="checkbox" name="remember" id="remember">
                            <span class="custom-checkbox"></span>
                            <span class="checkbox-text">Remember me</span>
                        </label>
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">
                            Forgot password?
                        </a>
                        @endif
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="login-btn">
                        <i class="fas fa-arrow-right-to-bracket"></i>
                        Sign In
                    </button>
                </form>

                <!-- Demo Credentials -->
                <div class="demo-credentials">
                    <div class="demo-title">
                        <i class="fas fa-flask"></i> Demo Credentials
                    </div>
                    <div class="demo-content">
                        <p><i class="fas fa-envelope"></i> Email: admin@forent.com</p>
                        <p><i class="fas fa-lock"></i> Password: password</p>
                    </div>
                </div>

                <!-- Register Link -->
                <div class="register-link">
                    <p>Don't have an account? 
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}">Create Account <i class="fas fa-arrow-right"></i></a>
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="login-footer">
            <p><i class="fas fa-shield-alt"></i> Secure login powered by Forent</p>
            <p style="margin-top: 8px;">© {{ date('Y') }} Forent. All rights reserved.</p>
        </div>
    </div>

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

        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        
        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                const icon = this.querySelector('i');
                if (type === 'text') {
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        }

        // Auto-focus on email input
        const emailInput = document.querySelector('input[name="email"]');
        if (emailInput) {
            setTimeout(() => {
                emailInput.focus();
            }, 100);
        }

        // Form validation
        const loginForm = document.getElementById('loginForm');
        if (loginForm) {
            loginForm.addEventListener('submit', function(e) {
                const email = document.querySelector('input[name="email"]').value.trim();
                const password = document.querySelector('input[name="password"]').value;
                
                if (!email || !password) {
                    e.preventDefault();
                    alert('Please fill in both email and password fields.');
                }
            });
        }

        // Add floating effect to card
        const card = document.querySelector('.login-card');
        if (card) {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-4px)';
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
            });
        }
    </script>
</body>
</html>