<?php

namespace App\Models;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cow extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'price',
        'type',
        'tag',
        'caste',
        'weight',
        'transport',
        'hasil',
        'color',
        'buy_date',
        'age',
        'description',
        'status',
        'flag',
    ];

    protected $casts = [
        'id'          => 'integer',
        'branch_id'   => 'integer',
        'price'       => 'integer',
        'type'        => 'string',
        'tag'         => 'string',
        'caste'       => 'string',
        'weight'      => 'string',
        'transport'   => 'integer',
        'hasil'       => 'integer',
        'color'       => 'string',
        'buy_date'    => 'datetime',
        'age'         => 'string',
        'description' => 'string',
        'status'      => 'string',
        'flag'        => 'string',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
        'deleted_at'  => 'datetime',
    ];

    //Relation Start
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }
}
