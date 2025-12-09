<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Option extends Model
{
    use HasFactory;

    protected $table = 'AR8974_OPTION';
    protected $primaryKey = 'option_id';
    public $timestamps = false;

    protected $fillable = [
        'question_id', 'option_text', 'is_correct'
    ];

    public function question() {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
