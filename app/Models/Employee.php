<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $primaryKey = 'nik';
    protected $fillable = ['phone'];
    
    public $incrementing = false;
    public $timestamps = false;

    public function userAsset()
    {
        return $this->hasOne(UserAsset::class, 'nik');
    }

    public function userAccessories()
    {
        return $this->hasMany(UserAccessory::class, 'nik');
    }
}
