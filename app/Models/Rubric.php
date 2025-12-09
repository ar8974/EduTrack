<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rubric extends Model
{
    use HasFactory;

    protected $table = 'AR8974_RUBRIC';
    protected $primaryKey = 'rubric_id';
    public $timestamps = false;

    protected $fillable = [
        'assignment_id', 'criterion', 'max_score'
    ];

    public function assignment() {
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }

    public function scores() {
        return $this->hasMany(RubricScore::class, 'rubric_id');
    }
}
