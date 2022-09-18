<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    use HasFactory;
    protected $table = 'distribution';

    protected $fillable = [
        'id_program_donasi',
        'id_penerima',
        'nominal',
        'waktu',
        'dilakukan_oleh',
    ];

    /**
     * Get the donatur that owns the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function penerima()
    {
        return $this->belongsTo(Pengajuan::class, 'id_penerima');
    }
    public function program()
    {
        return $this->belongsTo(ProgramDonasi::class, 'id_program_donasi');
    }
}