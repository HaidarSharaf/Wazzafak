<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stack extends Model
{
    protected $table = 'stacks';
    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'developer_stack');
    }

    public function jobListings()
    {
        return $this->hasMany(JobListing::class);
    }
}
