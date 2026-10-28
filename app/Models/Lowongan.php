<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lowongan extends Model
{
    protected $table = 'lowongans';

    protected $fillable = [
        'nama_pekerjaan',
        'deskripsi',
        'alamat',
        'kuota',
        'gaji',
        'status',
        'icon',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
            'kuota' => 'integer',
        ];
    }

    public function syaratDokumen(): HasMany
    {
        return $this->hasMany(SyaratDokumen::class, 'lowongan_id');
    }

    // Membantu halaman daftar yang menampilkan persyaratan sebagai teks.
    public function getPersyaratanAttribute(): string
    {
        if ($this->relationLoaded('syaratDokumen')) {
            return $this->syaratDokumen
                ->pluck('nama_dokumen')
                ->implode(', ');
        }

        return $this->syaratDokumen()
            ->pluck('nama_dokumen')
            ->implode(', ');
    }
}