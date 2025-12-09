<?php

namespace App\Http\Controllers;

use App\Models\LoginLog;
use Illuminate\Http\Request;

class LoginLogController extends Controller
{
    public function index() {
        $logs = LoginLog::with('user')->orderBy('login_time', 'desc')->get();
        return view('login_logs.index', compact('logs'));
    }

    public function show(LoginLog $log) {
        return view('login_logs.show', compact('log'));
    }
}
