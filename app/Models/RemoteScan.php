<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RemoteScan
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $session_id
 * @property string $content
 * @method static \Illuminate\Database\Eloquent\Builder|RemoteScan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RemoteScan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RemoteScan query()
 * @method static \Illuminate\Database\Eloquent\Builder|RemoteScan whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RemoteScan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RemoteScan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RemoteScan whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RemoteScan whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $seen_at
 * @property-read \App\Models\Session $session
 * @method static \Illuminate\Database\Eloquent\Builder|RemoteScan whereSeenAt($value)
 * @method static Builder|RemoteScan unseen()
 */
class RemoteScan extends Model
{
    use HasFactory;

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
