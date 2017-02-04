<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Model\Permission
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Role[] $roles
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Permission whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Permission whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Permission whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Permission whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Permission extends Model
{
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permission')->withTimestamps();
    }
}
