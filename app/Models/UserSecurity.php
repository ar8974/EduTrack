<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserSecurity extends Model
{
    use HasFactory;

    protected $table = 'AR8974_USER_SECURITY';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'question_id', 'answer_hash'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function question() {
        return $this->belongsTo(SecurityQuestion::class, 'question_id');
    }
}
