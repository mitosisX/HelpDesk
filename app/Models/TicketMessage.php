<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketMessage extends Model
{
    use HasFactory;

    protected $table = 'ticket_messages';
    protected $primaryKey = 'id';
    protected $fillable = ['users_id', 'tickets_id','message'];

    public function user(){
        return $this->hasOne(User::class, 'users_id');
    }

    public function ticket(){
        return $this->hasOne(Ticket::class, 'users_id');
    }
}
