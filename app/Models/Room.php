<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    protected $table = 'AR8974_ROOM';
    protected $primaryKey = 'room_id';
    public $timestamps = false;

    protected $fillable = [
        'room_name', 'building', 'capacity'
    ];

    public function sections() {
        return $this->hasMany(Section::class, 'room_id');
    }
}
