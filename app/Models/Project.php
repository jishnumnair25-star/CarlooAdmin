<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
    'project_name',
    'project_description',
    'subscription_id',
    'status',
    'industry_domain',
    'technology',
    'data_security',
    'compliance'
];

protected $casts = [
    'technology' => 'array',
    'data_security' => 'array',
    'compliance' => 'array',
];
    use HasFactory;
}
