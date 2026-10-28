<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    // Menghubungkan ke tabel 'lowongans' di database
    protected $table = 'lowongans';

    // Mengizinkan kolom-kolom ini diisi melalui form/create
    protected $fillable = [
        'recruiter_id',
        'nama_pekerjaan',
        'deskripsi',
        'alamat',
        'persyaratan',
        'batas_pelamar',
        'rentang_gaji',
        'foto'
    ];
}