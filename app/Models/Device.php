<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Device
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $seen_at
 * @method static \Illuminate\Database\Eloquent\Builder|Device newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Device newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Device query()
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereSeenAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $session_id
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereSessionId($value)
 * @property-read \App\Models\Session $session
 * @method static Builder|Device unseen()
 */
class Device extends Model
{
    use HasFactory;

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function scopeUnseen(Builder $query)
    {
        return $query->whereNull('seen_at');
    }
}
