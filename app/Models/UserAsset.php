<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAsset extends Model
{
    use HasFactory;
    protected $table = 'user_assets';
    protected $fillable = [
        'status',
    ];
    public $incrementing = false;
    public $timestamps = false;

    
    public function asset()
    {
        return $this->belongsTo(Asset::class, 'idAsset');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'nik');
    }
}
