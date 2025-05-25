<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Delivery
 * 
 * @property int $delivery_id
 * @property string $order_id
 * @property string $name
 * @property string $phone
 * @property string $address
 * 
 * @property Order $order
 *
 * @package App\Models
 */
class Delivery extends Model
{
	protected $table = 'delivery';
	protected $primaryKey = 'delivery_id';
	public $timestamps = false;

	protected $fillable = [
		'order_id',
		'name',
		'phone',
		'address'
	];

	public function order()
	{
		return $this->belongsTo(Order::class);
	}
}
