<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * 
 * @property int $product_id
 * @property string $product_name
 * @property string $product_photo
 * @property string $product_description
 * @property float $price
 * @property int $stock_quantity
 * @property int|null $category_id
 * @property int $product_view
 * @property Carbon $create_at
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
		'category_id' => 'int',
		'product_view' => 'int',
		'create_at' => 'datetime'
	];

	protected $fillable = [
		'product_name',
		'product_photo',
		'product_description',
		'price',
		'stock_quantity',
		'category_id',
		'product_view',
		'create_at'
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
