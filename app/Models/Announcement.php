<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $table = 'AR8974_ANNOUNCEMENT';
    protected $primaryKey = 'announcement_id';
    public $timestamps = false;

    protected $fillable = [
        'section_id',
        'posted_by',
        'title',
        'message',
        'posted_on',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'section_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'posted_by', 'user_id');
    }
}
