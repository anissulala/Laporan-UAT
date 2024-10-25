<?php

namespace App\Models;

use Eloquent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *  * App\Models\UserRole
 * @mixin Eloquent
 *
 * @property int $id
 * @property int $user_id
 * @property int $role_id
 * @property int $project_id
 * @property null|Carbon $created_at
 * @property null|Carbon $updated_at
 * 
 * @method static Builder|UserRole query()
 */
class UserRole extends Model
{
    protected $fillable = [
        'user_id',
        'role_id',
        'project_id',
    ];

    // Relasi ke tabel users
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke tabel roles
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    // Relasi ke tabel projects
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
