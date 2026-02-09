<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogAktivitas;
use App\Models\User;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{

    // ===============================
    // INDEX
    // ===============================
    public function index()
    {
        $logs = LogAktivitas::with('user')
            ->orderByDesc('waktu')
            ->paginate(20);

        // Stats
        $totalLogs = LogAktivitas::count();
        $todayLogs = LogAktivitas::whereDate('waktu', today())->count();
        $warningLogs = LogAktivitas::where('aktivitas', 'like', '%warning%')->count();
        $errorLogs = LogAktivitas::where('aktivitas', 'like', '%error%')->count();

        $totalUsers = User::count();
        $activeUsers = User::count();

        $users = User::orderBy('name')->get();

        return view('Admin.Log_aktivitas.index', compact(
            'logs',
            'totalLogs',
            'todayLogs',
            'warningLogs',
            'errorLogs',
            'totalUsers',
            'activeUsers',
            'users'
        ));
    }


    // ===============================
    // CREATE
    // ===============================
    public function create()
    {
        return view('admin.logs.create');
    }


    // ===============================
    // STORE
    // ===============================
    public function store(Request $request)
    {
        $request->validate([
            'aktivitas' => 'required|string|max:255'
        ]);

        LogAktivitas::create([
            'id_user' => auth()->id(),
            'aktivitas' => $request->aktivitas,
            'waktu' => now()
        ]);

        return redirect()
            ->route('admin.logs.index')
            ->with('success', 'Log berhasil ditambahkan');
    }


    // ===============================
    // SHOW
    // ===============================
    public function show(string $id)
    {
        $log = LogAktivitas::findOrFail($id);

        return view('admin.logs.show', compact('log'));
    }


    // ===============================
    // EDIT
    // ===============================
    public function edit(string $id)
    {
        $log = LogAktivitas::findOrFail($id);

        return view('admin.logs.edit', compact('log'));
    }


    // ===============================
    // UPDATE
    // ===============================
    public function update(Request $request, string $id)
    {
        $request->validate([
            'aktivitas' => 'required|string|max:255'
        ]);

        $log = LogAktivitas::findOrFail($id);

        $log->update([
            'aktivitas' => $request->aktivitas
        ]);

        return redirect()
            ->route('admin.logs.index')
            ->with('success', 'Log berhasil diupdate');
    }


    // ===============================
    // DESTROY
    // ===============================
    public function destroy(string $id)
    {
        $log = LogAktivitas::findOrFail($id);
        $log->delete();

        return redirect()
            ->route('admin.logs.index')
            ->with('success', 'Log berhasil dihapus');
    }
}
