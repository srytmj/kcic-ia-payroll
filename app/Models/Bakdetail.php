<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bakdetail extends Model
{
    use HasFactory;

    protected $table = 'dokumen_bak_detail';

    protected $guarded = [];


    // Relasi ke DokumenBak
    public function dokumenBak()
    {
        return $this->belongsTo(Bak::class, 'dokumen_bak_id');
    }
}
