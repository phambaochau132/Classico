<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderDetail
 * 
 * @property int $order_detail_id
 * @property string $order_id
 * @property int $product_id
 * @property int $quantity
 * @property float $price
 * 
 * @property Product $product
 * @property Order $order
 *
 * @package App\Models
 */
class OrderDetail extends Model
{
	protected $table = 'order_details';
	protected $primaryKey = 'order_detail_id';
	public $timestamps = false;

	protected $casts = [
		'product_id' => 'int',
		'quantity' => 'int',
		'price' => 'float'
	];

	protected $fillable = [
		'order_id',
		'product_id',
		'quantity',
		'price'
	];

	public function product()
	{
		return $this->belongsTo(Product::class,'product_id', 'product_id');
	}

	public function order()
	{
		return $this->belongsTo(Order::class);
	}
}
