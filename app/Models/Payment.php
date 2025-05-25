<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Payment
 * 
 * @property int $payment_id
 * @property string|null $order_id
 * @property int $payment_method
 * @property int $payment_status
 * 
 * @property Order|null $order
 *
 * @package App\Models
 */
class Payment extends Model
{
	protected $table = 'payments';
	protected $primaryKey = 'payment_id';
	public $timestamps = false;

	protected $casts = [
		'payment_method' => 'int',
		'payment_status' => 'int'
	];

	protected $fillable = [
		'order_id',
		'payment_method',
		'payment_status'
	];

	public function order()
	{
		return $this->belongsTo(Order::class);
	}
}
