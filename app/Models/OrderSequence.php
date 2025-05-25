<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderSequence
 * 
 * @property Carbon $order_date
 * @property int $sequence
 *
 * @package App\Models
 */
class OrderSequence extends Model
{
	protected $table = 'order_sequences';
	protected $primaryKey = 'order_date';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'order_date' => 'datetime',
		'sequence' => 'int'
	];

	protected $fillable = [
		'sequence'
	];
}
