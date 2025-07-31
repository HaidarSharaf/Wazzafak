<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    protected $table = 'technologies';
    protected $fillable = ['name', 'icon', 'color'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'developer_technology');
    }

    public function jobListings()
    {
        return $this->belongsToMany(JobListing::class, 'job_listing_technologies');
    }
}
