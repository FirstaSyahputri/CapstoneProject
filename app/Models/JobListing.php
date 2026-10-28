<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobListing extends Model
{
    protected $fillable = [
        'recruiter_id',
        'title',
        'description',
        'address',
        'quota',
        'salary',
        'status',
        'icon',
    ];

    protected function casts(): array
    {
        return [
            'quota' => 'integer',
            'status' => 'boolean',
        ];
    }

    public function recruiter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recruiter_id');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    public function syaratDokumen(): HasMany
    {
        return $this->hasMany(SyaratDokumen::class, 'job_listing_id');
    }

    public function getPersyaratanAttribute(): string
    {
        return $this->syaratDokumen()
            ->pluck('nama_dokumen')
            ->implode(', ');
    }
}