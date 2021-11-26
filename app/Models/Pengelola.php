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
        'boardinghouses_id',
        
    ];

    // public function boardingHouse()
    // {
    //     return $this->hasOne(BoardingHouse::class, 'pengelola_id', 'id');
    // }
}