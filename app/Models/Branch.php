<?php

namespace App\Models;

use App\Models\Cow;
use App\Models\Cost;
use App\Models\Beef;
use App\Models\Staff;
use App\Models\Buyer;
use App\Models\CowSell;
use App\Models\BeefSell;
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

    // Relation Start
    public function staffs()
    {
        return $this->hasMany(Staff::class);
    }

    public function cows()
    {
        return $this->hasMany(Cow::class);
    }

    public function buyers()
    {
        return $this->hasMany(Cow::class);
    }

    public function cowSells()
    {
        return $this->hasMany(CowSell::class);
    }

    public function beefs()
    {
        return $this->hasMany(Beef::class);
    }

    public function beefSells()
    {
        return $this->hasMany(BeefSell::class);
    }

    public function costs()
    {
        return $this->hasMany(Cost::class);
    }
}