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
 * @property int|null $order_id
 * @property string $payment_method
 * @property string $payment_status
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
		'order_id' => 'int'
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
