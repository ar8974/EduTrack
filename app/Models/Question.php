<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected $table = 'AR8974_QUESTION';
    protected $primaryKey = 'question_id';
    public $timestamps = false;

    protected $fillable = [
        'exam_id', 'question_text', 'question_type', 'points'
    ];

    public function exam() {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function options() {
        return $this->hasMany(Option::class, 'question_id');
    }

    public function responses() {
        return $this->hasMany(Response::class, 'question_id');
    }
}
