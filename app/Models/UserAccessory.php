<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccessory extends Model
{
    use HasFactory;
    protected $table = 'user_accessories';
    protected $primaryKey = null;
    protected $fillable = [
        'nik', 
        'username', 
        'modelNumber', 
        'category', 
        'startDate'];
        // protected $casts = [
        //     'category' => 'array',
        // ];
        public $incrementing = false;
        public $timestamps = false;
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'nik');
    }

    public function accessory()
    {
        return $this->belongsTo(Accessory::class, 'modelNumber');
    }
    // public function accessories()
    // {
    //     return $this->belongsToMany(Accessory::class)
    //         ->withPivot('qty', 'status')
    //         ->withTimestamps();
    // }
}
