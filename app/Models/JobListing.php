<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


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
        return $this->belongsToMany(Technology::class, 'job_listing_technologies');
    }

    public function getStackNameAttribute(){
        return $this->stack?->name;
    }

    public function getCompanyNameAttribute(){
        return $this->user?->recruiter?->company_name;
    }

    public function getCompanyLogoAttribute(){
        return $this->user?->recruiter?->company_logo;
    }

    public function getPostedTimeAttribute()
    {
        if (!$this->created_at) {
            return "Posted recently";
        }

        $diff = $this->created_at->diff(now());

        if ($diff->y > 0) {
            return "Posted " . $diff->y . " " . Str::plural('year', $diff->y) . " ago";
        } elseif ($diff->m > 0) {
            return "Posted " . $diff->m . " " . Str::plural('month', $diff->m) . " ago";
        } elseif ($diff->d > 0) {
            return "Posted " . $diff->d . " " . Str::plural('day', $diff->d) . " ago";
        } elseif ($diff->h > 0) {
            return "Posted " . $diff->h . " " . Str::plural('hour', $diff->h) . " ago";
        } elseif ($diff->i > 0) {
            return "Posted " . $diff->i . " " . Str::plural('minute', $diff->i) . " ago";
        } else {
            return "Posted just now";
        }
    }


    public function applicants()
    {
        return $this->hasMany(JobApplication::class);
    }
}
