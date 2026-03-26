@extends('layouts.sidebarpetugas')

<style>
    /* ===== DARK THEME PREMIUM ===== */
    :root {
        --primary: #6366f1;
        --primary-dark: #4f46e5;
        --primary-light: #818cf8;
        --secondary: #a855f7;
        --secondary-light: #c084fc;
        --success: #10b981;
        --success-light: #34d399;
        --warning: #f59e0b;
        --danger: #ef4444;
        --danger-light: #f87171;
        
        --bg-primary: #0f172a;
        --bg-secondary: #1e293b;
        --bg-card: #1e293b;
        --bg-card-hover: #2d3a4f;
        --bg-table-header: #020617;
        --bg-table-row: #1e293b;
        --bg-table-row-hover: #2d3a4f;
        --bg-badge: rgba(99, 102, 241, 0.15);
        
        --text-primary: #f8fafc;
        --text-secondary: #e2e8f0;
        --text-muted: #94a3b8;
        --text-dim: #64748b;
        
        --border-color: #334155;
        --border-light: rgba(255, 255, 255, 0.05);
        
        --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.3);
        --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.4);
        --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.5);
        
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 16px;
        --radius-xl: 20px;
        --radius-full: 9999px;
        
        --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        background: var(--bg-primary);
        color: var(--text-primary);
        line-height: 1.6;
        min-height: 100vh;
    }

    /* ===== MAIN CONTENT ===== */
    .main-content {
        flex: 1;
        margin-left: 280px;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        background: radial-gradient(circle at 50% 50%, #1a2635, #0f172a);
        animation: fadeIn 0.6s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* ===== HEADER PREMIUM ===== */
    .header {
        background: rgba(30, 41, 59, 0.8);
        backdrop-filter: blur(20px);
        padding: 0 32px;
        height: 80px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid var(--border-light);
        box-shadow: var(--shadow-md);
        position: sticky;
        top: 0;
        z-index: 90;
    }

    .header-title {
        font-size: 28px;
        font-weight: 800;
        background: linear-gradient(135deg, #fff, var(--primary-light));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        position: relative;
        padding-left: 24px;
        letter-spacing: -0.5px;
    }

    .header-title::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 6px;
        height: 32px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: var(--radius-full);
        box-shadow: 0 0 15px rgba(99, 102, 241, 0.5);
    }

    .header-title i {
        margin-right: 12px;
        color: var(--primary-light);
    }

    /* ===== CONTENT WRAPPER ===== */
    .content-wrapper {
        flex: 1;
        padding: 32px;
        max-width: 1400px;
        margin: 0 auto;
        width: 100%;
    }

    /* ===== INFO CARD ===== */
    .info-card {
        background: linear-gradient(145deg, var(--bg-card), var(--bg-table-header));
        border-radius: var(--radius-lg);
        padding: 20px 24px;
        margin-bottom: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: 1px solid var(--border-light);
        box-shadow: var(--shadow-md);
    }

    .info-date {
        display: flex;
        align-items: center;
        gap: 12px;
        color: var(--text-muted);
        font-size: 14px;
    }

    .info-date i {
        color: var(--primary-light);
        font-size: 16px;
    }

    .info-date strong {
        color: white;
        font-weight: 700;
    }

    .btn-pdf {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        padding: 14px 28px;
        background: linear-gradient(135deg, var(--danger), #b91c1c);
        color: white;
        border: none;
        border-radius: var(--radius-full);
        font-weight: 700;
        font-size: 15px;
        cursor: pointer;
        transition: var(--transition);
        box-shadow: var(--shadow-md);
        border: 1px solid rgba(255, 255, 255, 0.1);
        letter-spacing: 0.5px;
    }

    .btn-pdf:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px -6px rgba(239, 68, 68, 0.5);
        gap: 16px;
        background: linear-gradient(135deg, #b91c1c, var(--danger));
    }

    .btn-pdf i {
        font-size: 18px;
    }

    /* ===== DASHBOARD CARD PREMIUM ===== */
    .dashboard-card {
        background: var(--bg-card);
        border-radius: var(--radius-xl);
        padding: 28px;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border-light);
        backdrop-filter: blur(10px);
        animation: slideUp 0.6s ease;
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        padding-bottom: 20px;
        border-bottom: 2px solid rgba(99, 102, 241, 0.2);
    }

    .card-title {
        font-size: 22px;
        font-weight: 700;
        color: white;
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .card-title i {
        color: var(--primary-light);
        font-size: 24px;
    }

    .card-title::before {
        content: '';
        width: 6px;
        height: 28px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: var(--radius-full);
        box-shadow: 0 0 15px rgba(99, 102, 241, 0.5);
    }

    .card-badge {
        background: rgba(99, 102, 241, 0.15);
        color: var(--primary-light);
        padding: 8px 16px;
        border-radius: var(--radius-full);
        font-size: 14px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        border: 1px solid rgba(99, 102, 241, 0.3);
    }

    /* ===== TABLE PREMIUM ===== */
    .table-container {
        overflow-x: auto;
        border-radius: var(--radius-lg);
        background: var(--bg-table-header);
        border: 1px solid var(--border-light);
        margin-top: 8px;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
        min-width: 1000px;
    }

    .data-table thead {
        background: linear-gradient(135deg, #020617, #0f172a);
    }

    .data-table th {
        padding: 18px 20px;
        text-align: left;
        color: var(--text-secondary);
        font-weight: 600;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        white-space: nowrap;
        border-bottom: 2px solid var(--primary);
    }

    .data-table tbody tr {
        background: var(--bg-table-row);
        transition: var(--transition);
        border-bottom: 1px solid var(--border-color);
    }

    .data-table tbody tr:hover {
        background: var(--bg-table-row-hover);
    }

    .data-table td {
        padding: 16px 20px;
        color: var(--text-secondary);
        vertical-align: middle;
    }

    /* ===== USER AVATAR ===== */
    .user-avatar {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 13px;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        flex-shrink: 0;
    }

    .user-info {
        display: flex;
        flex-direction: column;
    }

    .user-name {
        font-weight: 600;
        color: white;
    }

    .user-email {
        font-size: 11px;
        color: var(--text-dim);
    }

    /* ===== ID BADGE ===== */
    .id-badge {
        display: inline-block;
        padding: 4px 10px;
        background: var(--bg-badge);
        color: var(--primary-light);
        border-radius: var(--radius-full);
        font-weight: 600;
        font-size: 12px;
        border: 1px solid rgba(99, 102, 241, 0.3);
        font-family: 'Monaco', monospace;
    }

    /* ===== STATUS BADGES ===== */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: var(--radius-full);
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-menunggu {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.15), rgba(245, 158, 11, 0.05));
        color: #fcd34d;
        border: 1px solid rgba(245, 158, 11, 0.3);
    }

    .status-dipinjam {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.15), rgba(168, 85, 247, 0.05));
        color: var(--primary-light);
        border: 1px solid rgba(99, 102, 241, 0.3);
    }

    .status-selesai {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.15), rgba(16, 185, 129, 0.05));
        color: var(--success-light);
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .status-terlambat {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(239, 68, 68, 0.05));
        color: var(--danger-light);
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    /* ===== DATE BADGE ===== */
    .date-badge {
        display: flex;
        flex-direction: column;
    }

    .date-main {
        font-weight: 600;
        color: white;
        font-size: 13px;
    }

    .date-sub {
        font-size: 11px;
        color: var(--text-dim);
        margin-top: 2px;
    }

    /* ===== ALAT BADGE ===== */
    .alat-badge {
        display: flex;
        flex-direction: column;
    }

    .alat-name {
        font-weight: 600;
        color: white;
    }

    .alat-id {
        font-size: 11px;
        color: var(--text-dim);
    }

    /* ===== SUMMARY FOOTER ===== */
    .summary-footer {
        margin-top: 28px;
        padding-top: 20px;
        border-top: 1px solid var(--border-color);
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: var(--text-muted);
        font-size: 14px;
        flex-wrap: wrap;
        gap: 16px;
    }

    .summary-stats {
        display: flex;
        gap: 24px;
        flex-wrap: wrap;
    }

    .summary-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .summary-item i {
        color: var(--primary-light);
    }

    .summary-value {
        font-weight: 700;
        color: white;
    }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        text-align: center;
        padding: 60px 40px;
        background: linear-gradient(145deg, var(--bg-card), var(--bg-table-header));
        border-radius: var(--radius-xl);
        border: 1px dashed var(--border-color);
    }

    .empty-icon {
        width: 100px;
        height: 100px;
        margin: 0 auto 24px;
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(168, 85, 247, 0.1));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        color: var(--primary-light);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.05); opacity: 0.8; }
    }

    .empty-state h3 {
        font-size: 24px;
        font-weight: 700;
        color: white;
        margin-bottom: 12px;
    }

    .empty-state p {
        color: var(--text-dim);
        font-size: 15px;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 1200px) {
        .main-content { margin-left: 0; }
    }

    @media (max-width: 768px) {
        .header { padding: 0 20px; height: 70px; }
        .header-title { font-size: 22px; }
        .content-wrapper { padding: 20px; }
        .dashboard-card { padding: 20px; }
        .info-card { flex-direction: column; gap: 16px; align-items: flex-start; }
        .btn-pdf { width: 100%; justify-content: center; }
        .card-header { flex-direction: column; align-items: flex-start; gap: 12px; }
        .summary-footer { flex-direction: column; align-items: flex-start; }
    }

    @media (max-width: 480px) {
        .content-wrapper { padding: 16px; }
        .dashboard-card { padding: 16px; }
        .header-title { font-size: 20px; }
        .user-avatar { width: 32px; height: 32px; font-size: 12px; }
        .data-table td, .data-table th { padding: 12px; }
        .status-badge { padding: 4px 10px; font-size: 11px; }
        .summary-stats { flex-direction: column; gap: 8px; }
    }

    /* ===== PRINT STYLES - KHUSUS PDF ===== */
    @media print {
        @page {
            size: A4 landscape;
            margin: 1.5cm;
        }
        
        body {
            background: white;
            color: black;
        }
        
        .main-content {
            margin-left: 0;
            background: white;
        }
        
        .header {
            background: white;
            color: black;
            border-bottom: 2px solid #6366f1;
            box-shadow: none;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        
        .header-title {
            color: #1e293b;
            background: none;
            -webkit-text-fill-color: #1e293b;
        }
        
        .header-title::before {
            background: #6366f1;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        
        .content-wrapper {
            padding: 0;
        }
        
        .info-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            box-shadow: none;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        
        .btn-pdf {
            display: none !important;
        }
        
        .dashboard-card {
            background: white;
            border: 1px solid #e2e8f0;
            box-shadow: none;
            padding: 20px;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        
        .card-title {
            color: #1e293b;
        }
        
        .card-badge {
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #cbd5e1;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        
        .data-table thead {
            background: #1e293b;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        
        .data-table th {
            color: white;
            border-bottom: 2px solid #6366f1;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        
        .data-table td {
            color: #1e293b;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .user-avatar {
            background: #6366f1;
            color: white;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        
        .user-name {
            color: #0f172a;
        }
        
        .user-email {
            color: #64748b;
        }
        
        .alat-name {
            color: #0f172a;
        }
        
        .alat-id {
            color: #64748b;
        }
        
        .date-main {
            color: #0f172a;
        }
        
        .id-badge {
            background: #eef2ff;
            color: #4f46e5;
            border: 1px solid #c7d2fe;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        
        .status-menunggu {
            background: #fef3c7;
            color: #b45309;
            border: 1px solid #fcd34d;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        
        .status-dipinjam {
            background: #e0f2fe;
            color: #0369a1;
            border: 1px solid #7dd3fc;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        
        .status-selesai {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #6ee7b7;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        
        .status-terlambat {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fca5a5;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        
        .summary-footer {
            border-top: 1px solid #e2e8f0;
            color: #475569;
        }
        
        .summary-value {
            color: #0f172a;
        }
        
        .sidebar-toggle,
        .sidebar {
            display: none !important;
        }
        
        a, button {
            display: none !important;
        }
    }

    /* ===== CUSTOM SCROLLBAR ===== */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    ::-webkit-scrollbar-track {
        background: var(--bg-primary);
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, var(--primary), var(--secondary));
        border-radius: var(--radius-full);
    }
</style>

<div class="app-container">
    @include('layouts.sidebarpetugas')

    <div class="main-content">
        <!-- Header Premium -->
        <header class="header">
            <div class="header-title">
                <i class="fas fa-file-pdf"></i>
                Laporan Peminjaman & Pengembalian
            </div>
        </header>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            @php
                $laporan = App\Models\Peminjaman::with(['user', 'alat'])
                    ->orderBy('created_at', 'desc')
                    ->get();
                
                $totalPeminjaman = $laporan->count();
                $totalDipinjam = $laporan->where('status', 'dipinjam')->count();
                $totalSelesai = $laporan->where('status', 'dikembalikan')->count();
                $totalTerlambat = $laporan->where('status', 'terlambat')->count();
                $tanggalCetak = now()->locale('id')->isoFormat('dddd, D MMMM Y');
            @endphp

            <!-- Info Card dengan Tombol PDF -->
            <div class="info-card">
                <div class="info-date">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Tanggal Cetak: <strong>{{ $tanggalCetak }}</strong></span>
                    <i class="fas fa-clock" style="margin-left: 16px;"></i>
                    <span>{{ now()->format('H:i') }} WIB</span>
                </div>
                <button class="btn-pdf" onclick="window.print()">
                    <i class="fas fa-file-pdf"></i>
                    Cetak Laporan PDF
                </button>
            </div>

            <!-- Dashboard Card -->
            <section class="dashboard-card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-file-alt"></i>
                        Data Laporan Transaksi
                    </div>
                    <div class="card-badge">
                        <i class="fas fa-database"></i>
                        Total: {{ $laporan->count() }} Data
                    </div>
                </div>

                <!-- Table Container -->
                <div class="table-container">
                    @if($laporan->count() > 0)
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">No</th>
                                    <th style="width: 80px;">ID</th>
                                    <th>Peminjam</th>
                                    <th>Alat</th>
                                    <th>Tgl Pinjam</th>
                                    <th>Rencana Kembali</th>
                                    <th>Tgl Dikembalikan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($laporan as $index => $item)
                                <tr>
                                    <td>
                                        <span class="id-badge">{{ $index + 1 }}</span>
                                    </td>
                                    <td>
                                        <span class="id-badge">#{{ $item->id_peminjaman }}</span>
                                    </td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 12px;">
                                            <div class="user-avatar">
                                                {{ strtoupper(substr($item->user->name ?? 'U', 0, 1)) }}
                                            </div>
                                            <div class="user-info">
                                                <span class="user-name">{{ $item->user->name ?? '-' }}</span>
                                                <span class="user-email">{{ $item->user->email ?? '' }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="alat-badge">
                                            <span class="alat-name">{{ $item->alat->nama_alat ?? '-' }}</span>
                                            <span class="alat-id">ID: {{ $item->alat->id_alat ?? '' }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="date-badge">
                                            <span class="date-main">
                                                {{ $item->tanggal_pinjam 
                                                    ? \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d/m/Y') 
                                                    : '-' }}
                                            </span>
                                            <span class="date-sub">
                                                {{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('H:i') : '' }}
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="date-badge">
                                            <span class="date-main">
                                                {{ $item->tanggal_rencana_kembali 
                                                    ? \Carbon\Carbon::parse($item->tanggal_rencana_kembali)->format('d/m/Y') 
                                                    : '-' }}
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="date-badge">
                                            <span class="date-main">
                                                {{ $item->tanggal_kembali 
                                                    ? \Carbon\Carbon::parse($item->tanggal_kembali)->format('d/m/Y') 
                                                    : '-' }}
                                            </span>
                                            <span class="date-sub">
                                                {{ $item->tanggal_kembali 
                                                    ? \Carbon\Carbon::parse($item->tanggal_kembali)->format('H:i') 
                                                    : '' }}
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($item->status == 'menunggu')
                                            <span class="status-badge status-menunggu">
                                                <i class="fas fa-hourglass-half"></i>
                                                Menunggu
                                            </span>

                                        @elseif ($item->status == 'dipinjam')
                                            <span class="status-badge status-dipinjam">
                                                <i class="fas fa-clock"></i>
                                                Dipinjam
                                            </span>

                                        @elseif ($item->status == 'selesai')
                                            <span class="status-badge status-selesai">
                                                <i class="fas fa-check-circle"></i>
                                                Selesai
                                            </span>

                                        @elseif ($item->status == 'ditolak')
                                            <span class="status-badge status-ditolak">
                                                <i class="fas fa-times-circle"></i>
                                                Ditolak
                                            </span>

                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <h3>Tidak Ada Data Laporan</h3>
                            <p>Belum ada peminjaman yang tercatat dalam sistem.</p>
                        </div>
                    @endif
                </div>

                <!-- Summary Footer -->
                @if($laporan->count() > 0)
                    <div class="summary-footer">
                        <div class="summary-stats">
                            <div class="summary-item">
                                <i class="fas fa-box"></i>
                                <span>Total: <span class="summary-value">{{ $totalPeminjaman }}</span></span>
                            </div>
                            <div class="summary-item">
                                <i class="fas fa-check-circle" style="color: var(--success);"></i>
                                <span>Selesai: <span class="summary-value">{{ $totalSelesai }}</span></span>
                            </div>
                            <div class="summary-item">
                                <i class="fas fa-clock" style="color: var(--primary);"></i>
                                <span>Dipinjam: <span class="summary-value">{{ $totalDipinjam }}</span></span>
                            </div>
                            <div class="summary-item">
                                <i class="fas fa-exclamation-triangle" style="color: var(--danger);"></i>
                                <span>Terlambat: <span class="summary-value">{{ $totalTerlambat }}</span></span>
                            </div>
                        </div>
                        <div>
                            <i class="fas fa-print"></i>
                            Dicetak: {{ now()->format('d/m/Y H:i') }}
                        </div>
                    </div>
                @endif
            </section>
        </div>
    </div>
</div>

<!-- Script untuk Cetak PDF -->
<script>
    (function() {
        'use strict';

        // Tombol Cetak PDF - menggunakan window.print()
        const printBtn = document.querySelector('.btn-pdf');
        if (printBtn) {
            printBtn.addEventListener('click', function(e) {
                e.preventDefault();
                window.print();
            });
        }

        // Tambahkan watermark untuk preview PDF
        window.onbeforeprint = function() {
            // Menambahkan footer otomatis saat print
            console.log('Mencetak laporan...');
        };

        console.log('🖨️ Laporan siap dicetak PDF');
    })();
</script>

<!-- Font Awesome 6 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- Google Fonts Inter -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">