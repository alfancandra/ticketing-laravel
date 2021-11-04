<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'ticket_tickets';

    protected $fillable = [
        "nama",
        "pesan",
        "user_id",
        "image"
    ];
}
