<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengelola extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'phone_num',
        
    ];

    // public function boardingHouse()
    // {
    //     return $this->belongsTo(BoardingHouse::class, 'pengelola_id', 'id');
    // }
}