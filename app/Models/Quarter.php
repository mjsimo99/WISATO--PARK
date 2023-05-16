<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quarter extends Model
{
    use ModelCommonMethodTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'level',
        'remarks',
        'status'
    ];

    public function slots()
    {
        return $this->hasMany('App\Models\CategoryWiseFloorSlot');
    }

    public function active_parking()
    {
        return $this->hasOneThrough('App\Models\Parking', 'App\Models\CategoryWiseFloorSlot', 'quarter_id', 'slot_id')->whereNull('out_time');
    }
}
