<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exam extends Model
{
    use HasFactory;

    protected $table = 'AR8974_EXAM';
    protected $primaryKey = 'exam_id';
    public $timestamps = false;

    protected $fillable = [
        'section_id', 'title', 'exam_date', 'duration_minutes'
    ];

    public function section() {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function questions() {
        return $this->hasMany(Question::class, 'exam_id');
    }
}
