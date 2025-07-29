<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    protected $table = 'job_listings';
    protected $fillable = [
        'user_id',
        'stack_id',
        'title',
        'description',
        'salary',
        'location',
        'status',
        'rejection_message',
        'is_disclosed',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stack()
    {
        return $this->belongsTo(Stack::class);
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class, 'job_listing_technology');
    }

    public function applicants()
    {
        return $this->hasMany(JobApplication::class);
    }
}
