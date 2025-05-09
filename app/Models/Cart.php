<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cart
 * 
 * @property int $cart_id
 * @property int|null $customer_id
 * @property int|null $product_id
 * @property int $quantity
 * 
 * @property Customer|null $customer
 * @property Product|null $product
 *
 * @package App\Models
 */
class Cart extends Model
{
	protected $table = 'cart';
	protected $primaryKey = 'cart_id';
	public $timestamps = false;

	protected $casts = [
		'customer_id' => 'int',
		'product_id' => 'int',
		'quantity' => 'int'
	];

	protected $fillable = [
		'customer_id',
		'product_id',
		'quantity'
	];

	public function customer()
	{
		return $this->belongsTo(Customer::class);
	}

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
