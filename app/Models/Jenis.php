<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'boardinghouses_id',
        
    ];

    // public function boardingHouses()
    // {
    //     return $this->belongsTo(BoardingHouse::class, 'boardinghouses_id','id');
    // }
}
