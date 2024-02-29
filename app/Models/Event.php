<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'date',
        'location',
        'max_attendees',
        'vip_price',
        'regular_price'
    ];

    public function tickets()
    {


        return $this->hasMany(Ticket::class);
    }
}
