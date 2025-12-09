<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AuditLog extends Model
{
    use HasFactory;

    protected $table = 'AR8974_AUDIT_LOG';
    protected $primaryKey = 'audit_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'action', 'entity', 'entity_id', 'action_time'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
