<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Model\Post
 *
 * @property int $id
 * @property int $author_id
 * @property bool $active
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property string $release_date
 * @property string $cover
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Model\User $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Category[] $categories
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Tag[] $tags
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Post whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Post whereAuthorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Post whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Post whereCover($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Post whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Post whereReleaseDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Post whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Post whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Post whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Post extends Model
{
    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_category')->withTimestamps();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag')->withTimestamps();
    }
}
