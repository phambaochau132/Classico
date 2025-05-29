<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * 
 * @property string $order_id
 * @property int $customer_id
 * @property Carbon $order_date
 * @property float $total_price
 * @property int $status
 * 
 * @property Customer $customer
 * @property Collection|Delivery[] $deliveries
 * @property Collection|OrderDetail[] $order_details
 * @property Collection|Payment[] $payments
 *
 * @package App\Models
 */
class Order extends Model
{
	protected $table = 'orders';
	protected $primaryKey = 'order_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'customer_id' => 'int',
		'order_date' => 'datetime',
		'total_price' => 'float',
		'status' => 'int'
	];

	protected $fillable = [
		'customer_id',
		'order_date',
		'total_price',
		'status'
	];

	public function customer()
	{
		return $this->belongsTo(Customer::class);
	}

	public function deliveries()
	{
		return $this->hasMany(Delivery::class);
	}

	// public function order_details()
	// {
	// 	return $this->hasMany(OrderDetail::class,'order_id','order_id');
	// }
	public function orderDetails()
{
    return $this->hasMany(OrderDetail::class,'order_id','order_id');
}

	public function payment()
	{
		return $this->hasOne(Payment::class,'order_id','order_id');
	}
	public function delivery()
	{
		return $this->hasOne(Delivery::class, 'order_id', 'order_id');
	}
}
