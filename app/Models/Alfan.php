<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alfan extends Model
{
    use HasFactory;

    protected $fillable = [
        "kegiatan",
        "tanggal",
        "isread"
    ];
}
