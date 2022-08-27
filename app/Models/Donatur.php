<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donatur extends Model
{
    use HasFactory;
    protected $table = 'donatur';

    protected $fillable = [
        'nama',
        'telepon',
        'jenis_kelamin',
        'alamat'
    ];

    public function user()
    {
        return $this->hasOne(Donatur::class, 'id_profile');
    }
}