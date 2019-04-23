<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
		'nivel',
		'sexo',
		'image',
		'active',
		'loged',
		'id_unity',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	public function filial() {
	 	return $this->belongsTo(\App\Unitys::class, 'id_unity');
	 }

	/*public function roles() {
			return $this->belongsToMany(\App\Role::class)->withTimestamps();
		}

		public function hasPermission(Permission $permission) {
			return $this->hasAnyRoles($permission->roles);
		}

		public function hasAnyRoles($roles) {
			if (is_array($roles) || is_object($roles)) {
				return !!$roles->intersect($this->roles)->count();
			}

			return $this->roles->contains('name', $roles);
	*/

}
