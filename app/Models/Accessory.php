<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accessory extends Model
{
    use HasFactory;
    protected $table = 'accessories';
    protected $primaryKey = 'modelNumber';
    protected $fillable = [
        'category',
        'supplier', 
        'purchase',
        'qty',
        'notes',
        'image',
    ];
    
    public $incrementing = false;
    public $timestamps = false;

    public function userAccessories()
    {
        return $this->hasMany(UserAccessory::class, 'modelNumber');
    }

}
