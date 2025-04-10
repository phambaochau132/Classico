<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Inventory
 * 
 * @property int $inventory_id
 * @property int|null $product_id
 * @property int $quantity_in_stock
 * @property Carbon $last_updated
 * 
 * @property Product|null $product
 *
 * @package App\Models
 */
class Inventory extends Model
{
	protected $table = 'inventory';
	protected $primaryKey = 'inventory_id';
	public $timestamps = false;

	protected $casts = [
		'product_id' => 'int',
		'quantity_in_stock' => 'int',
		'last_updated' => 'datetime'
	];

	protected $fillable = [
		'product_id',
		'quantity_in_stock',
		'last_updated'
	];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
