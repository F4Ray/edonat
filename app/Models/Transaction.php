<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';

    protected $fillable = [
        'id_donatur',
        'id_program_donasi',
        'nominal',
        'metode_pembayaran',
        'tanggal_donasi',
        'titip_doa'
    ];

    /**
     * Get the donatur that owns the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function donatur()
    {
        return $this->belongsTo(Donatur::class, 'id_donatur');
    }
    public function program()
    {
        return $this->belongsTo(ProgramDonasi::class, 'id_program_donasi');
    }
}