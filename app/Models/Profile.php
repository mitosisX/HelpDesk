<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profiles';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'name', 'location', 'email',
        'users_id', 'departments_id'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
