<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    protected $table = 'developers';
    protected $fillable = [
        'user_id',
        'github_url',
        'linkedin_url',
        'experience_level',
        'cv',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stacks()
    {
        return $this->belongsToMany(Stack::class, 'developer_stacks');
    }
}
