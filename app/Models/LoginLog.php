<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoginLog extends Model
{
    use HasFactory;

    protected $table = 'AR8974_LOGIN_LOG';
    protected $primaryKey = 'log_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'login_time', 'ip_address', 'device_info'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
