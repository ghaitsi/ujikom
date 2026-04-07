<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Forent - Register | Smart Tool Rental Management</title>
    
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

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        /* Register Container */
        .register-container {
            width: 100%;
            max-width: 500px;
            position: relative;
            z-index: 10;
            animation: fadeInUp 0.6s ease-out;
        }

        /* Register Card */
        .register-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            transition: var(--transition);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .register-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        /* Header */
        .register-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 32px 24px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .register-header::before {
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

        .register-header h1 {
            font-size: 28px;
            font-weight: 800;
            color: white;
            margin-bottom: 8px;
        }

        .register-header p {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.9);
        }

        /* Form Area */
        .register-form {
            padding: 32px;
        }

        /* Form Group */
        .form-group {
            margin-bottom: 20px;
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

        .form-label .required {
            color: var(--danger);
            margin-left: 4px;
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

        .form-input.error {
            border-color: var(--danger);
            animation: shake 0.3s ease;
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

        /* Password Strength Indicator */
        .password-strength {
            margin-top: 8px;
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .strength-bar {
            flex: 1;
            height: 4px;
            background: var(--gray-light);
            border-radius: 4px;
            transition: var(--transition);
        }

        .strength-bar.active {
            background: var(--danger);
        }

        .strength-bar.active.weak {
            background: var(--danger);
        }

        .strength-bar.active.medium {
            background: var(--warning);
        }

        .strength-bar.active.strong {
            background: var(--success);
        }

        .strength-text {
            font-size: 11px;
            color: var(--gray);
            min-width: 60px;
        }

        /* Register Button */
        .register-btn {
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
            margin-top: 8px;
        }

        .register-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.3);
        }

        .register-btn:active {
            transform: translateY(0);
        }

        /* Login Link */
        .login-link {
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid var(--gray-light);
            text-align: center;
        }

        .login-link p {
            font-size: 14px;
            color: var(--gray);
        }

        .login-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
        }

        .login-link a:hover {
            color: var(--secondary);
            text-decoration: underline;
        }

        /* Footer */
        .register-footer {
            margin-top: 24px;
            text-align: center;
        }

        .register-footer p {
            font-size: 12px;
            color: var(--gray);
        }

        /* Terms & Conditions */
        .terms {
            margin: 20px 0;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .terms input {
            margin-top: 2px;
        }

        .terms label {
            font-size: 12px;
            color: var(--gray);
            line-height: 1.4;
        }

        .terms a {
            color: var(--primary);
            text-decoration: none;
        }

        .terms a:hover {
            text-decoration: underline;
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
        }

        /* Responsive */
        @media (max-width: 480px) {
            .register-form {
                padding: 24px;
            }
            
            .register-header {
                padding: 24px;
            }
            
            .register-header h1 {
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

    <div class="register-container">
        <div class="register-card">
            <!-- Header -->
            <div class="register-header">
                <div class="logo-wrapper">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h1>Create Account</h1>
                <p>Join Forent and start managing your tools</p>
            </div>

            <!-- Form Area -->
            <div class="register-form">
                <form method="POST" action="{{ route('register') }}" id="registerForm">
                    @csrf

                    <!-- Name Field -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-user"></i> Full Name
                            <span class="required">*</span>
                        </label>
                        <div class="input-wrapper">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" name="name" id="name" class="form-input" value="{{ old('name') }}" required autofocus placeholder="John Doe">
                        </div>
                        @error('name')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-envelope"></i> Email Address
                            <span class="required">*</span>
                        </label>
                        <div class="input-wrapper">
                            <i class="fas fa-envelope input-icon"></i>
                            <input type="email" name="email" id="email" class="form-input" value="{{ old('email') }}" required placeholder="admin@forent.com">
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
                            <span class="required">*</span>
                        </label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" name="password" id="password" class="form-input" required placeholder="••••••••">
                            <button type="button" class="password-toggle" id="togglePassword">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                        <div class="password-strength" id="passwordStrength">
                            <div class="strength-bar" id="strength1"></div>
                            <div class="strength-bar" id="strength2"></div>
                            <div class="strength-bar" id="strength3"></div>
                            <div class="strength-text" id="strengthText">Weak</div>
                        </div>
                        @error('password')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-lock"></i> Confirm Password
                            <span class="required">*</span>
                        </label>
                        <div class="input-wrapper">
                            <i class="fas fa-check-circle input-icon"></i>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" required placeholder="••••••••">
                            <button type="button" class="password-toggle" id="toggleConfirmPassword">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                        <div id="confirmError" class="error-message" style="display: none;">
                            <i class="fas fa-exclamation-circle"></i> Passwords do not match
                        </div>
                        @error('password_confirmation')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Terms & Conditions -->
                    <div class="terms">
                        <input type="checkbox" name="terms" id="terms" required>
                        <label for="terms">
                            I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                        </label>
                    </div>

                    <!-- Register Button -->
                    <button type="submit" class="register-btn" id="registerBtn">
                        <i class="fas fa-user-plus"></i>
                        Create Account
                    </button>
                </form>

                <!-- Login Link -->
                <div class="login-link">
                    <p>Already have an account? 
                        <a href="{{ route('login') }}">Sign In <i class="fas fa-arrow-right"></i></a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="register-footer">
            <p><i class="fas fa-shield-alt"></i> Secure registration • Your data is protected</p>
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

        // Toggle password visibility for main password
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

        // Toggle password visibility for confirm password
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPasswordInput = document.getElementById('password_confirmation');
        
        if (toggleConfirmPassword && confirmPasswordInput) {
            toggleConfirmPassword.addEventListener('click', function() {
                const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPasswordInput.setAttribute('type', type);
                
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

        // Password strength checker
        function checkPasswordStrength(password) {
            let strength = 0;
            
            if (password.length >= 8) strength++;
            if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;
            
            return strength;
        }

        function updateStrengthIndicator() {
            const password = passwordInput.value;
            const strength = checkPasswordStrength(password);
            
            const bars = [
                document.getElementById('strength1'),
                document.getElementById('strength2'),
                document.getElementById('strength3')
            ];
            const strengthText = document.getElementById('strengthText');
            
            // Reset bars
            bars.forEach(bar => {
                bar.classList.remove('active', 'weak', 'medium', 'strong');
                bar.style.background = 'var(--gray-light)';
            });
            
            if (password.length === 0) {
                strengthText.textContent = '';
                return;
            }
            
            let text = '';
            let colorClass = '';
            
            if (strength === 0 || strength === 1) {
                text = 'Weak';
                colorClass = 'weak';
                bars[0].classList.add('active', 'weak');
            } else if (strength === 2) {
                text = 'Medium';
                colorClass = 'medium';
                bars[0].classList.add('active', 'medium');
                bars[1].classList.add('active', 'medium');
            } else if (strength === 3) {
                text = 'Strong';
                colorClass = 'strong';
                bars[0].classList.add('active', 'strong');
                bars[1].classList.add('active', 'strong');
                bars[2].classList.add('active', 'strong');
            } else if (strength >= 4) {
                text = 'Very Strong';
                colorClass = 'strong';
                bars.forEach(bar => bar.classList.add('active', 'strong'));
            }
            
            strengthText.textContent = text;
        }

        if (passwordInput) {
            passwordInput.addEventListener('input', updateStrengthIndicator);
        }

        // Confirm password validation
        function validateConfirmPassword() {
            const password = passwordInput.value;
            const confirm = confirmPasswordInput.value;
            const confirmError = document.getElementById('confirmError');
            
            if (confirm.length > 0 && password !== confirm) {
                confirmError.style.display = 'flex';
                confirmPasswordInput.classList.add('error');
                return false;
            } else {
                confirmError.style.display = 'none';
                confirmPasswordInput.classList.remove('error');
                return true;
            }
        }

        if (confirmPasswordInput) {
            confirmPasswordInput.addEventListener('input', validateConfirmPassword);
            passwordInput.addEventListener('input', validateConfirmPassword);
        }

        // Form validation
        const registerForm = document.getElementById('registerForm');
        const registerBtn = document.getElementById('registerBtn');
        
        if (registerForm) {
            registerForm.addEventListener('submit', function(e) {
                const name = document.getElementById('name').value.trim();
                const email = document.getElementById('email').value.trim();
                const password = passwordInput.value;
                const confirm = confirmPasswordInput.value;
                const terms = document.getElementById('terms').checked;
                
                let hasError = false;
                
                if (!name) {
                    document.getElementById('name').classList.add('error');
                    hasError = true;
                } else {
                    document.getElementById('name').classList.remove('error');
                }
                
                if (!email) {
                    document.getElementById('email').classList.add('error');
                    hasError = true;
                } else {
                    document.getElementById('email').classList.remove('error');
                }
                
                if (!password) {
                    passwordInput.classList.add('error');
                    hasError = true;
                } else {
                    passwordInput.classList.remove('error');
                }
                
                if (!confirm) {
                    confirmPasswordInput.classList.add('error');
                    hasError = true;
                }
                
                if (password !== confirm) {
                    validateConfirmPassword();
                    hasError = true;
                }
                
                if (!terms) {
                    alert('Please agree to the Terms of Service and Privacy Policy');
                    hasError = true;
                }
                
                if (hasError) {
                    e.preventDefault();
                    alert('Please fill in all required fields correctly.');
                }
            });
        }

        // Auto-focus on name input
        const nameInput = document.getElementById('name');
        if (nameInput) {
            setTimeout(() => {
                nameInput.focus();
            }, 100);
        }

        // Add floating effect to card
        const card = document.querySelector('.register-card');
        if (card) {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-4px)';
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
            });
        }
        
        // Clear error on focus
        const inputs = document.querySelectorAll('.form-input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.classList.remove('error');
            });
        });
    </script>
</body>
</html>