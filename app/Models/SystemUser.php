<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SystemUser
 * 
 * @property int $user_id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property int|null $role_id
 * 
 * @property Role|null $role
 *
 * @package App\Models
 */
class SystemUser extends Model
{
	protected $table = 'system_users';
	protected $primaryKey = 'user_id';
	public $timestamps = false;

	protected $casts = [
		'role_id' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'username',
		'password',
		'email',
		'role_id'
	];

	public function role()
	{
		return $this->belongsTo(Role::class);
	}
}
