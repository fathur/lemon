<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Model\Category
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $total_posts
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Post[] $posts
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Category whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Category whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Category whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Category whereTotalPosts($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_category')->withTimestamps();

    }
}
