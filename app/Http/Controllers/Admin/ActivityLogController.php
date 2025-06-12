<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
  
public function index(Request $request)
{
    $logs = ActivityLog::query();

    if ($request->filled('ip')) {
        $logs->where('ip_address', 'like', '%' . $request->ip . '%');
    }

    if ($request->filled('usuario_tipo')) {
        $logs->where('user_type', $request->usuario_tipo);
    }

    if ($request->filled('evento')) {
        $logs->where('event', 'like', '%' . $request->evento . '%');
    }

    if ($request->filled('data_de')) {
        $logs->whereDate('created_at', '>=', $request->data_de);
    }

    if ($request->filled('data_ate')) {
        $logs->whereDate('created_at', '<=', $request->data_ate);
    }

    $logs = $logs->latest()->paginate(20);

    return view('escola.admin.admin.activity_logs.index', compact('logs'));
}

}

