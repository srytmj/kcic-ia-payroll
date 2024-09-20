<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farebox extends Model
{
    use HasFactory;
    
    protected $table = 'data_farebox';

    protected $guarded = [];
}
