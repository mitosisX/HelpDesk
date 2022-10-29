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
        'title', 'number', 'category', 'department', 'description',
        'due_date', 'priority'
    ];

    public $timestamps = false;

    public function statuses()
    {
        return $this->hasMany(Status::class, 'tickets_id');
    }

    protected function number(): Attribute
    {
        //tk-1000-ACB
        $randNumber = fake()->numberBetween(1000, 9999);
        $randAlpha1 = fake()->randomLetter();

        $fullTicketCode = "tk-{$randNumber}{$randAlpha1}";

        return Attribute::make(
            //set: fn () => "Ticket #" . Ticket::all()->count() + 1
            set: fn () => $fullTicketCode
        );
    }

    public function assignee()
    {
        return $this->hasMany(Assignee::class, 'tickets_id');
    }

    public function reporter()
    {
        return $this->hasMany(Reporter::class, 'tickets_id');
    }

    public function assigner()
    {
        return $this->hasMany(Assignee::class, 'tickets_id');
    }

    public function tags()
    {
        return $this->hasMany(Tags::class, 'tickets_id');
    }

    public function department()
    {
        return $this->hasOne(Department::class);
    }

    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function tracker()
    {
        return $this->hasMany(Tracker::class, 'tickets_id');
    }

    //Get next ticket number to be created
    public static function getTicketNumber()
    {
        $nextTicketNumber = Ticket::all()->count() + 1;
        return $nextTicketNumber;
    }
}
