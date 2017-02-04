<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Model\Tag
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $total_posts
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Post[] $posts
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Tag whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Tag whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Tag whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Tag whereTotalPosts($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Tag extends Model
{
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag')->withTimestamps();

    }
}
