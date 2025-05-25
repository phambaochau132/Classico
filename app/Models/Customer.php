<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Customer
 * 
 * @property int $customer_id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property string|null $address
 * @property string $avatar
 * @property string|null $gender
 * @property string $password
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Order[] $orders
 *
 * @package App\Models
 */
class Customer extends Model
{
	protected $table = 'customers';
	protected $primaryKey = 'customer_id';

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'email',
		'phone',
		'address',
		'avatar',
		'gender',
		'password'
	];

	public function orders()
	{
		return $this->hasMany(Order::class);
	}
}
