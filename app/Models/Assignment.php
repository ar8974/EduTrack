<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Assignment extends Model
{
    use HasFactory;

    protected $table = 'AR8974_ASSIGNMENT';
    protected $primaryKey = 'assignment_id';
    public $timestamps = false;

    protected $fillable = [
        'section_id',
        'title',
        'description',
        'due_date',
        'total_points',
        'is_team_based'
    ];

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function files()
    {
        return $this->hasMany(AssignmentFile::class, 'assignment_id');
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class, 'assignment_id');
    }

    public function rubrics()
    {
        return $this->hasMany(Rubric::class, 'assignment_id');
    }
}
