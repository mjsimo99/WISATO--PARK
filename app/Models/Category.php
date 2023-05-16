<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use ModelCommonMethodTrait;
    protected $fillable = [
        'id',
        'type',
        'description',
        'status',
        'created_by',
        'modified_by'
    ];

    protected $guarded = [];

    public function parking()
    {
        return $this->hasMany('App\Models\Parking');
    }

    public function tariff()
    {
        return $this->hasMany('App\Models\Tariff');
    }
   
    public function slots()
    {
        return $this->hasMany('App\Models\CategoryWiseFloorSlot');
    }

    public function active_parking(){
        return $this->hasOneThrough('App\Models\Parking', 'App\Models\CategoryWiseFloorSlot', 'category_id', 'slot_id')->whereNull('out_time');
    }
}
