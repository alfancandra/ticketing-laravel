<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;

    protected $table = 'ticket_pesans';

    protected $fillable = [
        "ticket_id",
        "nama",
        "pesan"
    ];
}
