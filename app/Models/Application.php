<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Application extends Model
{
    protected $fillable = [
        'job_listing_id',
        'applicant_id',
        'status',
        'interview_date',
        'interview_time',
        'interview_start_time',
        'interview_end_time',
        'interview_location',
        'meeting_type',
        'interview_notes',
        'rejection_note',
    ];

    protected function casts(): array
    {
        return [
            'interview_date' => 'date',
        ];
    }

    public function jobListing(): BelongsTo
    {
        return $this->belongsTo(JobListing::class);
    }

    public function applicant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'applicant_id');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(ApplicationDocument::class);
    }
}
