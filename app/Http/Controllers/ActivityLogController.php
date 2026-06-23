<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index()
    {
        // Pastikan hanya admin yang bisa melihat log jika diperlukan,
        // namun untuk saat ini jika user punya akses, biarkan
        if (!auth()->user()->isAdmin()) {
            abort(403, 'ANDA TIDAK PUNYA AKSES UNTUK MELIHAT LOG AKTIVITAS.');
        }

        $logs = ActivityLog::with('user')->latest()->get();
        return view('activity-log.index', compact('logs'));
    }
}
