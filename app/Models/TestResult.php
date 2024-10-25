<?php

namespace App\Models;

use Eloquent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\TestResult
 * @mixin Eloquent
 *
 * @property int         $id
 * @property string      $kode
 * @property int         $test_case_id
 * @property int         $user_id_penugasan
 * @property null|string $harapan
 * @property null|string $realisasi
 * @property string      $k_status
 * @property null|Carbon $created_at
 * @property null|Carbon $updated_at
 *
 * @method static Builder|TestResult query()
 */
class TestResult extends Model
{
    use HasFactory;

    /**
     * Cast attributes to native types
     * 
     * @var array
     */

    protected $table = 'test_results';
    protected $casts = [
        'kode'          => 'string',
        'test_case_id'     => 'integer',
        'user_id_penugasan' => 'integer',
        'harapan'          => 'string',
        'realisasi'        => 'string',
        'k_status'         => 'string',
        'created_at'       => 'datetime',
        'updated_at'       => 'datetime',
    ];


    protected $fillable = [
        'kode',
        'test_case_id',
        'user_id_penugasan',
        'harapan',
        'realisasi',
        'k_status',
    ];

    // Relasi ke tabel test_cases
    public function testCase(): BelongsTo
    {
        return $this->belongsTo(TestCase::class);
    }

    // Relasi ke tabel users
    public function userPenugasan(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_penugasan');
    }

    // Relasi ke tabel m_status
    public function status(): BelongsTo
    {
        return $this->belongsTo(MStatus::class, 'k_status', 'k_status');
    }

    // Relasi ke tabel komentar (one-to-many)
    public function komentar(): HasMany
    {
        return $this->hasMany(Komentar::class, 'test_result_id');
    }

    // memisahkan logika pencarian dari controller
    public function scopeSearch($query, $search)
    {
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('kode', 'like', "%{$search}%")
                    ->orWhere('harapan', 'like', "%{$search}%")
                    ->orWhere('realisasi', 'like', "%{$search}%")
                    ->orWhereHas('userPenugasan', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('status', function ($q) use ($search) {
                        $q->where('label', 'like', "%{$search}%");
                    });
            });
        }
        
        return $query;
    }
}
