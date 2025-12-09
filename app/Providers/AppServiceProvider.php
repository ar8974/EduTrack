<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Message; 
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {}

    public function boot(): void
    {
        if (config('database.default') !== 'dw_sqlite') {
            DB::connection('dw_sqlite')->statement('PRAGMA foreign_keys = ON;');
        } else {
            DB::statement('PRAGMA foreign_keys = ON;');
        }

        view()->composer('layouts.app', function ($view) {
            $messages = Message::orderBy('MESSAGE_ID', 'desc')->limit(5)->get();
            $view->with('topbarMessages', $messages);
            $view->with('topbarMessageCount', $messages->count());
        });
    }

    public function up()
    {}
}
