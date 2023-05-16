<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ModelCommonMethodTrait;

class Parking extends Model
{
	use ModelCommonMethodTrait;
	protected $fillable = [
				'id',
				'slot_id',
				'category_id',
				'vehicle_no',
				'barcode',
				'driver_name',
				'driver_mobile',
				'in_time',
				'out_time',
				'amount',
				'paid',
				'status',
				'created_by',
				'modified_by'
			];
	protected $guarded = [];

	protected $casts = [
		'in_time' => 'datetime:m-d-Y H:i:s',
		'out_time' => 'datetime:m-d-Y H:i:s',
	];	

	public function category()
	{
		return $this->belongsTo('App\Models\Category');
	}

	public function create_by()
	{
		return $this->belongsTo('App\User','created_by');
	}

	public function modified()
	{
		return $this->belongsTo('App\User','id','modified_by');
	}

	public function slot()
	{
		return $this->belongsTo('App\Models\CategoryWiseFloorSlot','slot_id');
	}
}
