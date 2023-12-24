<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_name',
        'slug',
        'branch_email',
        'branch_address',
        'branch_image',
        'status',
        'flag',
    ];

    protected $casts = [
        'id'             => 'integer',
        'branch_name'    => 'string',
        'slug'           => 'string',
        'branch_email'   => 'string',
        'branch_address' => 'string',
        'branch_image'   => 'string',
        'status'         => 'string',
        'flag'           => 'string',
        'created_at'     => 'datetime',
        'updated_at'     => 'datetime',
        'deleted_at'     => 'datetime'
    ];
}