<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'AR8974_ATTENDANCE';
    protected $primaryKey = 'attendance_id';
    public $timestamps = false;

    protected $fillable = [
        'section_id', 'student_id', 'attendance_date', 'status', 'marked_by'
    ];

    public function section() {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function student() {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function markedBy() {
        return $this->belongsTo(User::class, 'marked_by');
    }
}
