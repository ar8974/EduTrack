<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $table = 'AR8974_SUBMISSION';
    protected $primaryKey = 'submission_id';
    public $timestamps = false;

    protected $fillable = [
        'assignment_id',
        'student_id',
        'submitted_on',
        'file_path',
        'grade',
        'feedback',
        'graded_by',
    ];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class, 'assignment_id', 'assignment_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'user_id');
    }

    public function grader()
    {
        return $this->belongsTo(User::class, 'graded_by', 'user_id');
    }
}
