<aside class="sidebar">
    <!-- Header -->
    <div class="sidebar-header">
        <a href="{{ route('petugas.dashboard') }}" class="logo">
            <div class="logo-icon">
                <i class="fas fa-book-open"></i>
            </div>
            <div class="logo-text">
                Lib<span>Track</span>
            </div>
        </a>
    </div>

    <!-- Menu -->
    <nav class="sidebar-nav">
        <!-- Dashboard -->
        <a href="{{ route('petugas.dashboard') }}"
           class="nav-item {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}">
            <div class="nav-icon">
                <i class="fas fa-chalkboard-user"></i>
            </div>
            <div class="nav-text">Dashboard</div>
            <span class="nav-badge">12</span>
        </a>

        <!-- Peminjaman -->

        <!-- Laporan -->
        <a href="{{ route('petugas.laporan') }}"
           class="nav-item {{ request()->routeIs('petugas.laporan') ? 'active' : '' }}">
            <div class="nav-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="nav-text">Laporan</div>
        </a>
    </nav>

    <!-- Footer -->
    <div class="sidebar-footer">
        <div class="user-profile">
            <div class="user-avatar">
                PT
            </div>
            <div class="user-info">
                <div class="user-name">Petugas</div>
                <div class="user-role">Pustakawan</div>
            </div>
            <i class="fas fa-chevron-up" style="color: var(--accent); font-size: 14px;"></i>
        </div>
        
        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <div class="nav-icon">
                    <i class="fas fa-sign-out-alt"></i>
                </div>
                <div class="nav-text">Keluar</div>
            </button>
        </form>
    </div>
</aside>

<style>
    :root {
        --primary: #2c5f8a;
        --primary-dark: #1e3a5f;
        --primary-light: #4a7c9e;
        --secondary: #6b4c7a;
        --secondary-light: #8b6b9a;
        --accent: #d4a373;
        --success: #2d6a4f;
        --warning: #e9c46a;
        --danger: #e76f51;
        --dark: #2d3e50;
        --darker: #1a2a3a;
        --light: #fef9e8;
        --gray: #8a9ba8;
        --gray-light: #e8e0d0;
        --sidebar-bg: linear-gradient(180deg, #1e3a5f 0%, #162b3d 100%);
        --radius-sm: 10px;
        --radius-md: 16px;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
    }

    /* Animations */
    @keyframes shine {
        0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
        100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 0.8; }
        50% { transform: scale(1.05); opacity: 1; }
    }

    /* Premium Sidebar */
    .sidebar {
        width: 280px;
        background: var(--sidebar-bg);
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        display: flex;
        flex-direction: column;
        box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15);
        z-index: 100;
        transition: var(--transition);
        border-right: 1px solid rgba(255, 255, 255, 0.06);
        overflow-y: auto;
    }

    .sidebar::-webkit-scrollbar {
        width: 5px;
    }

    .sidebar::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.05);
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: var(--accent);
        border-radius: 3px;
    }

    .sidebar-header {
        padding: 28px 24px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        position: relative;
        overflow: hidden;
    }

    .sidebar-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--accent), transparent);
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 14px;
        text-decoration: none;
        position: relative;
        z-index: 1;
    }

    .logo-icon {
        width: 44px;
        height: 44px;
        background: linear-gradient(135deg, var(--secondary), var(--accent));
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 22px;
        font-weight: 700;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
        transition: var(--transition);
    }

    .logo:hover .logo-icon {
        transform: rotate(10deg) scale(1.05);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .logo-text {
        font-size: 26px;
        font-weight: 700;
        font-family: 'Playfair', serif;
        color: #e8e0d0;
        letter-spacing: -0.5px;
    }

    .logo-text span {
        color: var(--accent);
    }

    .sidebar-nav {
        flex: 1;
        padding: 24px 0;
    }

    .nav-item {
        display: flex;
        align-items: center;
        padding: 12px 24px;
        color: rgba(232, 224, 208, 0.75);
        text-decoration: none;
        transition: var(--transition);
        margin: 3px 12px;
        border-radius: var(--radius-sm);
        position: relative;
        overflow: hidden;
        gap: 14px;
    }

    .nav-item::before {
        content: '';
        position: absolute;
        left: -100%;
        top: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.05), transparent);
        transition: left 0.6s ease;
    }

    .nav-item:hover::before {
        left: 100%;
    }

    .nav-item:hover {
        color: #fef9e8;
        background: rgba(255, 255, 255, 0.04);
        transform: translateX(6px);
    }

    .nav-item.active {
        color: #fef9e8;
        background: rgba(212, 163, 115, 0.12);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        border-left: 3px solid var(--accent);
    }

    .nav-icon {
        font-size: 18px;
        width: 24px;
        text-align: center;
        transition: var(--transition);
        color: rgba(232, 224, 208, 0.7);
    }

    .nav-item.active .nav-icon {
        color: var(--accent);
    }

    .nav-item:hover .nav-icon {
        transform: scale(1.1);
        color: var(--accent);
    }

    .nav-text {
        font-size: 14px;
        font-weight: 500;
        flex: 1;
    }

    .nav-badge {
        background: var(--accent);
        color: var(--dark);
        font-size: 11px;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 20px;
        min-width: 24px;
        text-align: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .nav-badge.late {
        background: var(--danger);
        color: white;
    }

    .sidebar-footer {
        padding: 16px;
        border-top: 1px solid rgba(255, 255, 255, 0.06);
        background: rgba(0, 0, 0, 0.15);
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 14px;
        padding: 12px 14px;
        border-radius: var(--radius-sm);
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.06);
        transition: var(--transition);
        cursor: pointer;
    }

    .user-profile:hover {
        background: rgba(255, 255, 255, 0.07);
        transform: translateY(-1px);
        border-color: rgba(212, 163, 115, 0.3);
    }

    .user-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--secondary), var(--accent));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 15px;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
        position: relative;
        overflow: hidden;
    }

    .user-avatar::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.08), transparent);
        transform: rotate(45deg);
        animation: shine 3s infinite linear;
    }

    .user-info {
        flex: 1;
    }

    .user-name {
        font-size: 13px;
        font-weight: 600;
        color: #fef9e8;
        margin-bottom: 3px;
    }

    .user-role {
        font-size: 10px;
        color: var(--accent);
        font-weight: 500;
        letter-spacing: 0.5px;
    }

    /* Logout Button */
    .logout-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        padding: 11px 16px;
        background: rgba(231, 111, 81, 0.1);
        color: rgba(231, 111, 81, 0.85);
        border: 1px solid rgba(231, 111, 81, 0.2);
        border-radius: var(--radius-sm);
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
        gap: 10px;
    }

    .logout-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.05), transparent);
        transition: left 0.6s ease;
    }

    .logout-btn:hover::before {
        left: 100%;
    }

    .logout-btn:hover {
        background: rgba(231, 111, 81, 0.18);
        color: var(--danger);
        transform: translateY(-1px);
        box-shadow: 0 3px 10px rgba(231, 111, 81, 0.2);
        border-color: rgba(231, 111, 81, 0.35);
    }

    .logout-btn .nav-icon {
        margin-right: 10px;
        font-size: 14px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .sidebar {
            width: 260px;
            transform: translateX(-100%);
        }
        
        .sidebar.open {
            transform: translateX(0);
        }
        
        .sidebar-header {
            padding: 22px 20px;
        }
        
        .logo-icon {
            width: 38px;
            height: 38px;
            font-size: 18px;
        }
        
        .logo-text {
            font-size: 22px;
        }
    }
</style>

<script>
    // Auto highlight active menu item
    document.addEventListener('DOMContentLoaded', function() {
        const currentPath = window.location.pathname;
        
        // Logout button confirmation
        const logoutBtn = document.querySelector('.logout-btn');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', function(e) {
                if (!confirm('Apakah Anda yakin ingin keluar dari sistem perpustakaan?')) {
                    e.preventDefault();
                }
            });
        }
        
        // User profile click (optional)
        const userProfile = document.querySelector('.user-profile');
        if (userProfile) {
            userProfile.addEventListener('click', function() {
                window.location.href = "{{ route('profile.edit') }}";
            });
        }
        
        // Update badge animation for pending loans
        const pendingBadge = document.querySelector('.nav-badge');
        if (pendingBadge && parseInt(pendingBadge.textContent) > 0) {
            pendingBadge.style.animation = 'pulse 2s infinite';
        }
    });
</script>