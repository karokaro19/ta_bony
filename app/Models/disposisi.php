<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class disposisi extends Model
{
    use HasFactory;

    protected $fillable = [
        'tujuan',
        'id_suratmasuk',
        'batas_waktu',
        'status_baca',
        'catatatan',
    ];	
	
    public function fk_surat()
    {
        // 
        return $this->belongsTo(surat::class, 'id_suratmasuk');
    }	

    public function fk_tujuan()
    {
        // 
        return $this->belongsTo(jabatan::class, 'tujuan');
    }	
	
}
