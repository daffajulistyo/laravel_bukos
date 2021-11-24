<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardingHouse extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'location',
        'description',
        'price',
        'discount',
        'pengelola_id',
        'years',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'boardinghouses_id' , 'id');
    }

    public function jenis()
    {
        return $this->hasMany(Jenis::class, 'boardinghouses_id' , 'id');
    }

    public function type()
    {
        return $this->hasMany(Type::class, 'boardinghouses_id' , 'id');
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'boardinghouses_id' , 'id');
    }

    public function chats()
    {
        return $this->hasMany(Chat::class, 'boardinghouses_id' , 'id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'boardinghouses_id' , 'id');
    }

    public function pengelola()
    {
        return $this->hasOne(Pengelola::class, 'boardinghouses_id' , 'id');
    }

    public function fotoKos()
    {
        return $this->hasMany(FotoKos::class, 'boardinghouses_id' , 'id');
    }

    public function fotoKamars()
    {
        return $this->hasMany(FotoKamar::class, 'boardinghouses_id' , 'id');
    }

    public function fasilitas()
    {
        return $this->hasMany(Fasilitas::class, 'boardinghouses_id' , 'id');
    }

    public function peraturans()
    {
        return $this->hasMany(Peraturan::class, 'boardinghouses_id' , 'id');
    }


}
