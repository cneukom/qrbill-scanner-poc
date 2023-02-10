<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Device.
 *
 * @property int         $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $seen_at
 * @property Session     $session
 * @property int         $session_id
 *
 * @method static Builder|Device newModelQuery()
 * @method static Builder|Device newQuery()
 * @method static Builder|Device query()
 * @method static Builder|Device unseen()
 * @method static Builder|Device whereCreatedAt($value)
 * @method static Builder|Device whereId($value)
 * @method static Builder|Device whereSeenAt($value)
 * @method static Builder|Device whereUpdatedAt($value)
 * @method static Builder|Device whereSessionId($value)
 *
 * @mixin Eloquent
 */
class Device extends Model
{
    use HasFactory;

    protected $fillable = ['session_id', 'seen_at'];

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function scopeUnseen(Builder $query)
    {
        return $query->whereNull('seen_at');
    }
}
