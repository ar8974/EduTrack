<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Term extends Model
{
    use HasFactory;

    protected $table = 'AR8974_TERM';
    protected $primaryKey = 'term_id';
    public $timestamps = false;

    protected $fillable = [
        'term_name', 'start_date', 'end_date'
    ];

    public function sections() {
        return $this->hasMany(Section::class, 'term_id');
    }
}
