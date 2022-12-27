<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';
    protected $primaryKey = 'id';
    protected $fillable = [
        'description', 'categories_id',
        'due_date', 'priority', 'assigned_by',
        'assigned_to', 'status', 'reported_by'
    ];

    //public $timestamps = false;

    public function reporter()
    {
        return $this->hasOne(User::class, 'id', 'reported_by');
    }

    public function assigner()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function tags()
    {
        return $this->hasMany(Tags::class, 'tickets_id');
    }

    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function tracker()
    {
        return $this->hasOne(Tracker::class, 'tickets_id');
    }

    //Get next ticket number to be created
    public static function getTicketNumber()
    {
        $nextTicketNumber = Ticket::max('id') + 1;
        return $nextTicketNumber;
    }
}
