<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'AR8974_COURSE';
    protected $primaryKey = 'course_id';
    public $timestamps = false;

    protected $fillable = [
        'course_code',
        'course_name',
        'description',
        'faculty_id',
        'dept_id',
    ];

    public function professor()
    {
        return $this->belongsTo(User::class, 'faculty_id', 'user_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id', 'dept_id');
    }

    public function sections()
    {
        return $this->hasMany(Section::class, 'course_id', 'course_id');
    }
}
