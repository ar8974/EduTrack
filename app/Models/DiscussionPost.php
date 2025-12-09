<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscussionPost extends Model
{
    protected $table = 'AR8974_DISCUSSION_POST';
    protected $primaryKey = 'post_id';
    public $timestamps = false;

    protected $fillable = [
        'thread_id',
        'user_id',
        'message',
        'posted_on',
    ];

    public function thread()
    {
        return $this->belongsTo(DiscussionThread::class, 'thread_id', 'thread_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
