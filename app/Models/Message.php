<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $table = 'AR8974_MESSAGE';
    protected $primaryKey = ['message_id', 'sent_year'];
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'message_id', 'sender_id', 'receiver_id', 'subject', 'body', 'sent_on'
    ];

    public function sender() {
        return $this->belongsTo(User::class, 'sender_id', 'user_id');
    }

    public function receiver() {
        return $this->belongsTo(User::class, 'receiver_id', 'user_id');
    }
}
