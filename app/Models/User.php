<?php

namespace App\Models;

use Eloquent;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\User
 * @mixin Eloquent
 *
 * @property int         $id
 * @property string      $name
 * @property string      $email
 * @property null|Carbon $email_verified_at
 * @property string      $password
 * @property null|string $remember_token
 * @property null|Carbon $created_at
 * @property null|Carbon $updated_at
 *
 * @method static Builder|User query()
 */
class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'name'              => 'string',
        'email'             => 'string',
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
        'remember_token'    => 'string',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
    ];

    // Relasi ke tabel user_roles (one-to-many)
    public function userRoles(): HasMany
    {
        return $this->hasMany(UserRole::class);
    }

    // Relasi ke tabel projects melalui user_roles (many-to-many)
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'user_roles');
    }

    // Relasi ke tabel test_suites (one-to-many)
    public function testSuites(): HasMany
    {
        return $this->hasMany(TestSuite::class, 'user_id_pic');
    }

    // Relasi ke tabel test_cases sebagai tester (one-to-many)
    public function testCases(): HasMany
    {
        return $this->hasMany(TestCase::class, 'user_id_tester');
    }

    // Relasi ke tabel komentar (one-to-many)
    public function komentar(): HasMany
    {
        return $this->hasMany(Komentar::class, 'user_id_penugasan');
    }

    public function testResults(): HasMany
    {
        return $this->hasMany(TestResult::class, 'user_id_penugasan');
    }
}
