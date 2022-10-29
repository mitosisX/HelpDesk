<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assigner extends Model
{
    use HasFactory;

    protected $table = 'asigners';

    protected $fillable = ['users_id', 'tickets_id'];
}
