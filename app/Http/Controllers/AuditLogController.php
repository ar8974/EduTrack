<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index() {
        $logs = AuditLog::with('user')->orderBy('action_time', 'desc')->get();
        return view('audit_logs.index', compact('logs'));
    }

    public function show(AuditLog $log) {
        return view('audit_logs.show', compact('log'));
    }
}
