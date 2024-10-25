<?php

namespace App\Models;

use Eloquent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\TestCase
 * @mixin Eloquent
 *
 * @property int         $id
 * @property string      $kode
 * @property int         $test_suite_id
 * @property string      $judul
 * @property null|string $prakondisi
 * @property null|string $tahap_testing
 * @property null|string $data_input
 * @property int         $progress
 * @property null|Carbon $created_at
 * @property null|Carbon $updated_at
 *
 * @method static Builder|TestCase query()
 */
class TestCase extends Model
{
    use HasFactory;

    /**
     * Cast attributes to native types
     * 
     * @var array
     */
    protected $casts = [
        'kode'          => 'string',
        'test_suite_id'  => 'integer',
        'judul'          => 'string',
        'prakondisi'     => 'string',
        'tahap_testing'  => 'string',
        'data_input'     => 'string',
        'progress'       => 'integer',
        'created_at'     => 'datetime',
        'updated_at'     => 'datetime',
    ];

    protected $table = 'test_cases';
    protected $fillable = [
        'kode',
        'test_suite_id',
        'judul',
        'prakondisi',
        'tahap_testing',
        'data_input',
        'progress',
    ];

    // Relasi ke tabel test_suites
    public function testSuite(): BelongsTo
    {
        return $this->belongsTo(TestSuite::class, 'test_suite_id');
    }

    // Relasi ke tabel test_results (one-to-many)
    public function testResults(): HasMany
    {
        return $this->hasMany(TestResult::class, 'test_case_id');
    }
}
