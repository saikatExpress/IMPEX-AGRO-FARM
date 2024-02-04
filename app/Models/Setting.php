<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name',
        'project_title',
        'project_logo',
    ];

    protected $casts = [
        'id'            => 'integer',
        'project_name'  => 'string',
        'project_title' => 'string',
        'project_logo'  => 'string',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];
}