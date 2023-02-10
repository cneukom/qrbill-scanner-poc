<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Session.
 *
 * @property int                     $id
 * @property Carbon|null             $created_at
 * @property Carbon|null             $updated_at
 * @property string                  $token
 * @property Collection|RemoteScan[] $remoteScans
 * @property int|null                $remote_scans_count
 * @property Collection|RemoteScan[] $devices
 * @property int|null                $devices_count
 *
 * @method static Builder|Session newModelQuery()
 * @method static Builder|Session newQuery()
 * @method static Builder|Session query()
 * @method static Builder|Session whereCreatedAt($value)
 * @method static Builder|Session whereId($value)
 * @method static Builder|Session whereToken($value)
 * @method static Builder|Session whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Session extends Model
{
    protected $fillable = ['token'];

    public function remoteScans()
    {
        return $this->hasMany(RemoteScan::class);
    }

    public function devices()
    {
        return $this->hasMany(RemoteScan::class);
    }
}
