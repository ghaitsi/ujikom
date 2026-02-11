<aside class="sidebar">
    <!-- Header -->
    <div class="sidebar-header">
        <a href="{{ route('petugas.dashboard') }}" class="logo">
            <div class="logo-icon">
                <i class="fas fa-tools"></i>
            </div>
            <div class="logo-text">
                For<span>ent</span>
            </div>
        </a>
    </div>

    <!-- Menu -->
    <nav class="sidebar-nav">
        <!-- Dashboard -->
        <a href="{{ route('petugas.dashboard') }}"
           class="nav-item {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}">
            <div class="nav-icon">
                <i class="fas fa-home"></i>
            </div>
            <div class="nav-text">Dashboard</div>
            <span class="nav-badge">12</span>
        </a>

        <!-- Menyetujui Peminjaman -->
        <a href="{{ route('petugas.dashboard') }}"
           class="nav-item">
            <div class="nav-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="nav-text">Menyetujui Peminjaman</div>
            <span class="nav-badge">5</span>
        </a>

        <!-- Memantau Pengembalian -->
        <a href="{{ route('petugas.dashboard') }}"
           class="nav-item">
            <div class="nav-icon">
                <i class="fas fa-eye"></i>
            </div>
            <div class="nav-text">Memantau Pengembalian</div>
            <span class="nav-badge late">3</span>
        </a>

        <!-- Laporan -->
        <a href="{{ route('petugas.laporan') }}"
           class="nav-item {{ request()->routeIs('petugas.laporan') ? 'active' : '' }}">
            <div class="nav-icon">
                <i class="fas fa-print"></i>
            </div>
            <div class="nav-text">Mencetak Laporan</div>
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
                <div class="user-role">Petugas</div>
            </div>
            <i class="fas fa-chevron-up" style="color: var(--primary-light); font-size: 14px;"></i>
        </div>
        
        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <div class="nav-icon">
                    <i class="fas fa-sign-out-alt"></i>
                </div>
                <div class="nav-text">LOGOUT</div>
            </button>
        </form>
    </div>
</aside>

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
        --sidebar-bg: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);
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

    /* Minimal Sidebar */
    .sidebar {
        width: 280px;
        background: var(--sidebar-bg);
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        display: flex;
        flex-direction: column;
        box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
        z-index: 100;
        transition: var(--transition);
        border-right: 1px solid rgba(255, 255, 255, 0.05);
    }

    .sidebar-header {
        padding: 32px 24px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        position: relative;
        overflow: hidden;
    }

    .sidebar-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--primary), transparent);
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 16px;
        text-decoration: none;
        position: relative;
        z-index: 1;
    }

    .logo-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(67, 97, 238, 0.4);
        transition: var(--transition);
    }

    .logo:hover .logo-icon {
        transform: rotate(15deg) scale(1.1);
        box-shadow: 0 6px 20px rgba(67, 97, 238, 0.6);
    }

    .logo-text {
        font-size: 28px;
        font-weight: 800;
        color: white;
        letter-spacing: -0.5px;
    }

    .logo-text span {
        background: linear-gradient(135deg, var(--primary-light), var(--success));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .sidebar-nav {
        flex: 1;
        padding: 32px 0;
        overflow-y: auto;
    }

    .sidebar-nav::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar-nav::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.05);
    }

    .sidebar-nav::-webkit-scrollbar-thumb {
        background: var(--primary);
        border-radius: 3px;
    }

    .nav-item {
        display: flex;
        align-items: center;
        padding: 16px 24px;
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        transition: var(--transition);
        margin: 4px 16px;
        border-radius: var(--radius-sm);
        position: relative;
        overflow: hidden;
    }

    .nav-item::before {
        content: '';
        position: absolute;
        left: -100%;
        top: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        transition: left 0.6s ease;
    }

    .nav-item:hover::before {
        left: 100%;
    }

    .nav-item:hover {
        color: white;
        background: rgba(255, 255, 255, 0.05);
        transform: translateX(8px);
    }

    .nav-item.active {
        color: white;
        background: linear-gradient(135deg, rgba(67, 97, 238, 0.2), rgba(114, 9, 183, 0.1));
        box-shadow: 0 4px 12px rgba(67, 97, 238, 0.2);
        border-left: 4px solid var(--primary);
    }

    .nav-icon {
        font-size: 20px;
        margin-right: 16px;
        width: 24px;
        text-align: center;
        transition: var(--transition);
    }

    .nav-item:hover .nav-icon {
        transform: scale(1.2);
        color: var(--primary-light);
    }

    .nav-text {
        font-size: 15px;
        font-weight: 500;
        flex: 1;
    }

    .nav-badge {
        background: var(--primary);
        color: white;
        font-size: 12px;
        font-weight: 600;
        padding: 4px 8px;
        border-radius: 10px;
        min-width: 24px;
        text-align: center;
    }

    .nav-badge.late {
        background: var(--danger);
    }

    .sidebar-footer {
        padding: 24px;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
        background: rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(10px);
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 20px;
        padding: 16px;
        border-radius: var(--radius-sm);
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.08);
        transition: var(--transition);
        cursor: pointer;
    }

    .user-profile:hover {
        background: rgba(255, 255, 255, 0.08);
        transform: translateY(-2px);
    }

    .user-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 18px;
        box-shadow: 0 4px 12px rgba(67, 97, 238, 0.4);
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
        background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        transform: rotate(45deg);
        animation: shine 3s infinite linear;
    }

    .user-info {
        flex: 1;
    }

    .user-name {
        font-size: 15px;
        font-weight: 600;
        color: white;
        margin-bottom: 4px;
    }

    .user-role {
        font-size: 13px;
        color: var(--primary-light);
        font-weight: 500;
    }

    /* Logout Button */
    .logout-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, rgba(249, 65, 68, 0.15), rgba(247, 37, 133, 0.1));
        color: rgba(249, 65, 68, 0.9);
        border: 1px solid rgba(249, 65, 68, 0.2);
        border-radius: var(--radius-sm);
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
        border: none;
    }

    .logout-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        transition: left 0.6s ease;
    }

    .logout-btn:hover::before {
        left: 100%;
    }

    .logout-btn:hover {
        background: linear-gradient(135deg, rgba(249, 65, 68, 0.25), rgba(247, 37, 133, 0.2));
        color: var(--danger);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(249, 65, 68, 0.3);
        border-color: rgba(249, 65, 68, 0.3);
    }

    .logout-btn .nav-icon {
        margin-right: 10px;
        font-size: 17px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .sidebar {
            width: 250px;
        }
        
        .sidebar-header {
            padding: 24px 20px;
        }
        
        .logo-icon {
            width: 40px;
            height: 40px;
            font-size: 20px;
        }
        
        .logo-text {
            font-size: 24px;
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
                if (!confirm('Apakah Anda yakin ingin logout?')) {
                    e.preventDefault();
                }
            });
        }
        
        // User profile click (optional)
        const userProfile = document.querySelector('.user-profile');
        if (userProfile) {
            userProfile.addEventListener('click', function() {
                alert('Menu profil pengguna akan ditampilkan di sini');
            });
        }
    });
</script>