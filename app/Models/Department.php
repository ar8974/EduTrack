<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    protected $table = 'AR8974_DEPARTMENT';
    protected $primaryKey = 'dept_id';
    public $timestamps = false;

    protected $fillable = ['dept_name', 'description'];

    public function courses() {
        return $this->hasMany(Course::class, 'dept_id');
    }

    public function users() {
        return $this->hasMany(User::class, 'dept_id');
    }
}
