<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RubricScore extends Model
{
    use HasFactory;

    protected $table = 'AR8974_RUBRIC_SCORE';
    protected $primaryKey = 'rubric_score_id';
    public $timestamps = false;

    protected $fillable = [
        'rubric_id', 'submission_id', 'score', 'comments'
    ];

    public function rubric() {
        return $this->belongsTo(Rubric::class, 'rubric_id');
    }

    public function submission() {
        return $this->belongsTo(Submission::class, 'submission_id');
    }
}
