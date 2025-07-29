<?php

namespace App\Models;

use App\Notifications\PasswordReset;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'role',
        'otp_code',
        'otp_expires_at',
        'otp_sent_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'otp_expires_at' => 'datetime',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'otp_code' => 'hashed'
        ];
    }

    public function developer()
    {
        return $this->hasOne(Developer::class);
    }

    public function recruiter()
    {
        return $this->hasOne(Recruiter::class);
    }

    public function stacks()
    {
        return $this->belongsToMany(Stack::class, 'developer_stacks');
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class, 'developer_technologies');
    }

    public function jobListings()
    {
        return $this->hasMany(JobListing::class);
    }

    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class);
    }


    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new PasswordReset($token));
    }
}
