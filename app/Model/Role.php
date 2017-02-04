<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Model\Role
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\User[] $users
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Role whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Role whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Role whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Role extends Model
{
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission')->withTimestamps();
    }
}
