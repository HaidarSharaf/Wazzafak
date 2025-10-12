<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Vinkla\Hashids\Facades\Hashids;


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
        'experience',
        'status',
        'rejection_message',
        'is_disclosed',
    ];

    public function getRouteKey()
    {
        return Hashids::encode($this->id);
    }

    public function resolveRouteBinding($value, $field = null)
    {
        $decoded = Hashids::decode($value);
        return $this->where('id', $decoded[0] ?? 0)->firstOrFail();
    }

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
        return $this->belongsToMany(Technology::class, 'job_listing_technologies', 'job_listing_id', 'technology_id');
    }

    public function jobApplications(){
        return $this->hasMany(JobApplication::class);
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

    public function getCompanyLocationAttribute(){
        return $this->user?->recruiter?->location;
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

    public function getApplicationCountAttribute()
    {
        return $this->jobApplications()->count();
    }

    public static function getLocations()
    {
        return [
            'Remote' => 'Remote',
            'Hybrid' => 'Hybrid',
            'OnSite' => 'OnSite',
        ];
    }

    public static function getExperienceLevels()
    {
        return [
            'Intern' => 'Intern',
            'Junior' => 'Junior',
            'Mid-level' => 'Mid-level',
            'Senior' => 'Senior',
            'Tech-lead' => 'Tech-lead',
        ];
    }


    public function applicants()
    {
        return $this->hasMany(JobApplication::class);
    }
}
