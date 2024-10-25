<?php

namespace App\Models;

use Eloquent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\MStatus
 * @mixin Eloquent
 *
 * @property string      $k_status
 * @property null|string $label
 * @property null|Carbon $created_at
 * @property null|Carbon $updated_at
 *
 * @method static Builder|MStatus query()
 */
class MStatus extends Model
{
    use HasFactory;

    /**
     * Cast attributes to native types
     * 
     * @var array
     */
    protected $casts = [
        'k_status'    => 'string',
        'label'       => 'string',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];


    protected $table = 'm_status';  // Menyesuaikan dengan nama tabel
    protected $primaryKey = 'k_status';
    public $incrementing = false; // Karena primary key bukan integer
    protected $keyType = 'string';

    protected $fillable = [
        'k_status',
        'label',
    ];

    // Relasi ke tabel test_results
    public function testResults(): HasMany
    {
        return $this->hasMany(TestResult::class, 'k_status', 'k_status');
    }

    // Relasi ke tabel komentars
    public function komentars(): HasMany
    {
        return $this->hasMany(Komentar::class, 'k_status');
    }
}
