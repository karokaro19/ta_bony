<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class surat extends Model
{
    use HasFactory;
	
    protected $fillable = [
        'jenis_surat',
        'no_surat',
        'perihal',
        'tanggal_surat',
        'tanggal_diterima',
        'ringkasan',
        'keterangan',
        'file_lampiran',
        'pengirim',
        'no_surat_pemohon',
        'tanggal_pemohon',
        'tanggal_usul',
        'jenis_permohonan',
        'status',
        'foto_unggahan',
    ];		
	
}
