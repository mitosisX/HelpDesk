<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{
    use HasFactory;

    protected $table = 'trackers';
    protected $primaryKey = 'id';
    protected $fillable = ['reference_code', 'tickets_id'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
