<?php

namespace App\Models;

use Eloquent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;


/**
 * App\Models\TestSuite
 * @mixin Eloquent
 *
 * @property int         $id
 * @property string      $kode
 * @property int         $project_id
 * @property string      $judul
 * @property null|string $ref_tiket
 * @property null|string $url
 * @property null|string $perangkat
 * @property int         $user_id_pic
 * @property int         $user_id_scenario
 * @property int         $user_id_tester
 * @property null|string $batasan
 * @property null|Carbon $tgl_mulai
 * @property null|Carbon $tgl_selesai
 * @property int         $progress
 * @property null|Carbon $created_at
 * @property null|Carbon $updated_at
 *
 * @method static Builder|TestSuite query()
 */
class TestSuite extends Model
{
  
    protected $table = 'test_suite'; // Nama tabel yang digunakan
    protected $casts = [
        'kode'          => 'string',
        'project_id'    => 'integer',
        'judul'         => 'string',
        'ref_tiket'     => 'string',
        'url'           => 'string',
        'perangkat'     => 'string',
        'user_id_pic'   => 'integer',
        'user_id_scenario' => 'integer',
        'user_id_tester' => 'integer',
        'batasan'       => 'string',
        'tgl_mulai'     => 'date',
        'tgl_selesai'   => 'date',
        'progress'      => 'integer',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
    ];

    protected $fillable = [
        'kode',
        'project_id',
        'judul',
        'ref_tiket',
        'url',
        'perangkat',
        'user_id_pic',
        'user_id_scenario',
        'user_id_tester',
        'batasan',
        'tgl_mulai',
        'tgl_selesai',
        'progress',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function testCases(): HasMany
    {
        return $this->hasMany(TestCase::class, 'test_suite_id');
    }

    // Relasi ke tabel users (PIC)
    public function pic(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_pic');
    }

    // Relasi ke tabel users (Scenario)
    public function scenario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_scenario');
    }

    // Relasi ke tabel users (Tester)
    public function tester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_tester');
    }
}
