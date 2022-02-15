<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Session
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $token
 * @method static \Illuminate\Database\Eloquent\Builder|Session newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Session newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Session query()
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RemoteScan[] $remoteScans
 * @property-read int|null $remote_scans_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RemoteScan[] $devices
 * @property-read int|null $devices_count
 */
class Session extends Model
{
    use HasFactory;

    public function remoteScans()
    {
        return $this->hasMany(RemoteScan::class);
    }

    public function devices()
    {
        return $this->hasMany(RemoteScan::class);
    }
}
