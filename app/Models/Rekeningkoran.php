<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekeningkoran extends Model
{
    use HasFactory;

    protected $table = 'dokumen_rekeningkoran';

    protected $guarded = [];
}
