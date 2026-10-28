<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Lowongan yang dibuat oleh recruiter.
     */
    public function jobListings()
    {
        return $this->hasMany(JobListing::class, 'recruiter_id');
    }

    /**
     * Lamaran yang dikirim oleh kandidat.
     */
    public function applications()
    {
        return $this->hasMany(Application::class, 'applicant_id');
    }

    /**
     * Riwayat pengalaman kerja kandidat.
     */
    public function experiences()
    {
        return $this->hasMany(CandidateExperience::class, 'user_id');
    }
}