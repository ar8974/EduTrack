<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscussionThread extends Model
{
    protected $table = 'AR8974_DISCUSSION_THREAD';
    protected $primaryKey = 'thread_id';
    public $timestamps = false;

    protected $fillable = [
        'section_id',
        'created_by',
        'title',
        'created_on',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'section_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'user_id');
    }

    public function posts()
    {
        return $this->hasMany(DiscussionPost::class, 'thread_id', 'thread_id');
    }
}
