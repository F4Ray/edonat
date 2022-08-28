<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramDonasi extends Model
{
    use HasFactory;
    protected $table = 'program_donasi';

    protected $fillable = [
        'nama',
        'keterangan',
        'dana_terkumpul'
    ];
    public function donatur()
    {
        return $this->belongsToMany(Donatur::class, 'program_donasi_donatur', 'id_program_donasi', 'id_donatur');
    }
}