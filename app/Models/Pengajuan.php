<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;
    protected $table = 'pengajuan';

    protected $fillable = [
        'nama_siswa',
        'kelas',
        'jenis_kelamin',
        'nama_ayah',
        'nama_ibu',
        'orang_tua_tiada',
        'penghasilan',
        'surat_pernyataan'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id_pengajuan');
    }
}