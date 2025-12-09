<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'AR8974_SECTION';
    protected $primaryKey = 'section_id';
    public $timestamps = false;

    protected $fillable = [
        'course_id',
        'term_id',
        'faculty_id',
        'schedule_day',
        'start_time',
        'end_time',
        'room_id',
        'capacity',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'course_id');
    }

    public function term()
    {
        return $this->belongsTo(Term::class, 'term_id', 'term_id');
    }

    public function faculty()
    {
        return $this->belongsTo(User::class, 'faculty_id', 'user_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'room_id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'section_id', 'section_id');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'section_id', 'section_id');
    }
}
