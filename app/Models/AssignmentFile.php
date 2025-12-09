<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssignmentFile extends Model
{
    use HasFactory;

    protected $table = 'AR8974_ASSIGNMENT_FILE';
    protected $primaryKey = 'file_id';
    public $timestamps = false;

    protected $fillable = [
        'assignment_id', 'file_path', 'uploaded_on'
    ];

    public function assignment() {
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }
}
