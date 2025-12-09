<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SecurityQuestion extends Model
{
    use HasFactory;

    protected $table = 'AR8974_SECURITY_QUESTION';
    protected $primaryKey = 'question_id';
    public $timestamps = false;

    protected $fillable = ['question_text'];
}
