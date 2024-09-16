<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
    protected $table = 'assets';
    protected $primaryKey = 'idAsset';
    protected $fillable = 
    [
        'processor',
        'type',
        'ramCapacity',
        'storage',
        'operatingSystem',
        'supplier',
        'ipAddress1',
        'ipAddress2',
        'antivirus',
        'batteryHealth',
        'purchase',
        'notes',
        'image_path',
    ];
    
    public $incrementing = false;
    public $timestamps = false;

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'idAsset');
    }

    public function userAsset()
    {
        return $this->hasOne(UserAsset::class, 'idAsset');
    }
}
