<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporter extends Model
{
    use HasFactory;
    protected $table = 'reporters';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'email', 'location', 'tickets_id'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
