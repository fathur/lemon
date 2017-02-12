<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Message
 *
 * @property int $id
 * @property int $from
 * @property int $to
 * @property string $content
 * @property bool $read
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Message whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Message whereFrom($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Message whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Message whereRead($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Message whereTo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Message whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Message extends Model
{

}
