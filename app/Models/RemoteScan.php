<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\RemoteScan.
 *
 * @property int         $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int         $session_id
 * @property string      $content
 * @property string|null $seen_at
 * @property Session     $session
 *
 * @method static Builder|RemoteScan newModelQuery()
 * @method static Builder|RemoteScan newQuery()
 * @method static Builder|RemoteScan query()
 * @method static Builder|RemoteScan unseen()
 * @method static Builder|RemoteScan whereContent($value)
 * @method static Builder|RemoteScan whereCreatedAt($value)
 * @method static Builder|RemoteScan whereId($value)
 * @method static Builder|RemoteScan whereSessionId($value)
 * @method static Builder|RemoteScan whereUpdatedAt($value)
 * @method static Builder|RemoteScan whereSeenAt($value)
 *
 * @mixin Eloquent
 */
class RemoteScan extends Model
{
    protected $fillable = ['session_id', 'content', 'seen_at'];

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function scopeUnseen(Builder $query)
    {
        return $query->whereNull('seen_at');
    }
}
