<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'AR8974_USER';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password_hash',
        'role_id', 'dept_id', 'is_active', 'created_at'
    ];

    public function role() {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function department() {
        return $this->belongsTo(Department::class, 'dept_id');
    }

    public function enrollments() {
        return $this->hasMany(Enrollment::class, 'student_id');
    }
}
