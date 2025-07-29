<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recruiter extends Model
{
    protected $table = 'recruiters';
    protected $fillable = [
        'user_id',
        'company_name',
        'company_logo',
        'location',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
