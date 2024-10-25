<?php

namespace App\Models;

use Eloquent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Role
 * @mixin Eloquent
 *
 * @property int         $id
 * @property string      $nama
 * @property null|Carbon $created_at
 * @property null|Carbon $updated_at
 *
 * @method static Builder|Role query()
 */
class Role extends Model
{
    /**
     * Cast attributes to native types
     * 
     * @var array
     */
    protected $casts = [
        'nama'        => 'string',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];

    protected $fillable = [
        'nama',
    ];

    // Relasi ke tabel user_roles (one-to-many)
    public function userRoles(): HasMany
    {
        return $this->hasMany(UserRole::class);
    }
}
