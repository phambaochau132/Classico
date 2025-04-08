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
 * @property int $order_id
 * @property int|null $customer_id
 * @property Carbon $order_date
 * @property float|null $total_price
 * 
 * @property Customer|null $customer
 * @property Collection|OrderDetail[] $order_details
 * @property Collection|Payment[] $payments
 *
 * @package App\Models
 */
class Order extends Model
{
	protected $table = 'orders';
	protected $primaryKey = 'order_id';
	public $timestamps = false;

	protected $casts = [
		'customer_id' => 'int',
		'order_date' => 'datetime',
		'total_price' => 'float'
	];

	protected $fillable = [
		'customer_id',
		'order_date',
		'total_price'
	];

	public function customer()
	{
		return $this->belongsTo(Customer::class);
	}

	public function order_details()
	{
		return $this->hasMany(OrderDetail::class);
	}

	public function payments()
	{
		return $this->hasMany(Payment::class);
	}
}
