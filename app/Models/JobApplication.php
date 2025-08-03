<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $table = 'job_applications';
    protected $fillable = [
        'job_listing_id',
        'user_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jobListing()
    {
        return $this->belongsTo(JobListing::class);
    }

    public function getApplicantExperienceAttribute()
    {
        return $this->user?->developer?->experience_level;
    }

    public function getApplicantStacksAttribute()
    {
        return $this->user?->stacks
            ->pluck('name')
            ->implode(', ');
    }

}
