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
 * @property int|null $customer_id
 * @property Carbon $order_date
 * @property float|null $total_price
 * @property float|null $status
 * 
 * @property Customer|null $customer
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
		'status' => 'float'
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

	public function payments()
	{
		return $this->hasMany(Payment::class);
	}
}
