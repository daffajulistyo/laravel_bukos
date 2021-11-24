<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'sender',
        'to',
        'message',
        'boardinghouses_id',
        'users_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function boardingHouses()
    {
        return $this->belongsTo(BoardingHouse::class, 'boardinghouses_id','id');
    }
    
}
