<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enrollment extends Model
{
    use HasFactory;

    protected $table = 'AR8974_ENROLLMENT';
    protected $primaryKey = 'enrollment_id';
    public $timestamps = false;

    protected $fillable = [
        'section_id', 'student_id', 'enrolled_on', 'final_grade'
    ];

    public function student() {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function section() {
        return $this->belongsTo(Section::class, 'section_id');
    }
}
