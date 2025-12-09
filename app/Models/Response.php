<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Response extends Model
{
    use HasFactory;

    protected $table = 'AR8974_RESPONSE';
    protected $primaryKey = 'response_id';
    public $timestamps = false;

    protected $fillable = [
        'question_id', 'student_id', 'selected_option_id', 
        'answer_text', 'score'
    ];

    public function question() {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function student() {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function selectedOption() {
        return $this->belongsTo(Option::class, 'selected_option_id');
    }
}
