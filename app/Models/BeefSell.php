<?php

namespace App\Models;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeefSell extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'name',
        'quantity',
        'price',
        'payment',
        'due',
        'phone_number',
    ];

    protected $casts = [
        'id'           => 'integer',
        'branch_id'    => 'integer',
        'name'         => 'string',
        'quantity'     => 'string',
        'price'        => 'integer',
        'payment'      => 'integer',
        'due'          => 'integer',
        'phone_number' => 'string',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
        'deleted_at'   => 'datetime',
    ];

    //Relation Start
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }
}
