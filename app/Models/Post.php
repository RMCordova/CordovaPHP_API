<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'employeesdetails';

    protected $fillable = [
        'name',
        'address',
        'email'
    ];
}
