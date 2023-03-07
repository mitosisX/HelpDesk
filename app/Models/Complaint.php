<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $table = 'complaints';
    protected $priamryKey = 'complaints_id';
    protected   $fillable = [
        'users_id',
        'tickets_id',
        'message'
    ];
}