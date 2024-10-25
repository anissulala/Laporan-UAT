<?php

namespace App\Models;

use Eloquent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Project
 * @mixin Eloquent
 *
 * @property int         $id
 * @property string      $nama
 * @property null|string $deskripsi
 * @property null|Carbon $created_at
 * @property null|Carbon $updated_at
 * 
 * @method static Builder|Project query()
 */
class Project extends Model
{
    protected $table = 'project'; // Nama tabel yang digunakan
    protected $casts = [
        'nama'       => 'string',
        'deskripsi'  => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
   

    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    // Relasi ke tabel test_suites (one-to-many)
    public function testSuites(): HasMany
    {
        return $this->hasMany(TestSuite::class, 'project_id');
    }

    // Relasi ke tabel user_roles (one-to-many)
    public function userRoles(): HasMany
    {
        return $this->hasMany(UserRole::class);
    }

    // Relasi ke tabel users melalui user_roles (many-to-many)
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles');
    }
}
