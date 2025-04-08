<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * 
 * @property int $product_id
 * @property string $product_name
 * @property float $price
 * @property int $stock_quantity
 * @property int|null $category_id
 * 
 * @property Category|null $category
 * @property Collection|Cart[] $carts
 * @property Collection|Inventory[] $inventories
 * @property Collection|OrderDetail[] $order_details
 *
 * @package App\Models
 */
class Product extends Model
{
	protected $table = 'products';
	protected $primaryKey = 'product_id';
	public $timestamps = false;

	protected $casts = [
		'price' => 'float',
		'stock_quantity' => 'int',
		'category_id' => 'int'
	];

	protected $fillable = [
		'product_name',
		'price',
		'stock_quantity',
		'category_id'
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function carts()
	{
		return $this->hasMany(Cart::class);
	}

	public function inventories()
	{
		return $this->hasMany(Inventory::class);
	}

	public function order_details()
	{
		return $this->hasMany(OrderDetail::class);
	}
}
