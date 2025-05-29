<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Factories\HasFactory;






class SystemUser extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $table = 'system_users';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
        'email',
        'sodienthoai',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token', // nếu có
    ];

    protected $casts = [
        'role_id' => 'integer',
    ];

    // Quan hệ với bảng roles
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }
}
