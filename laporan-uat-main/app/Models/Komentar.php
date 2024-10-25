<?php

namespace App\Models;

use Eloquent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Komentar
 * @mixin Eloquent
 *
 * @property int         $id
 * @property int         $test_result_id
 * @property int         $user_id_penugasan
 * @property string      $k_status
 * @property null|string $komentar
 * @property null|Carbon $tgl_komentar
 * @property null|string $old_assignee
 * @property null|string $new_assignee
 * @property null|string $old_status
 * @property null|string $new_status
 * @property null|boolean $is_edited 
 * @property null|Carbon $created_at
 * @property null|Carbon $updated_at
 *
 * @method static Builder|Komentar query()
 */
class Komentar extends Model
{
    use HasFactory;

    protected $table = 'komentar';
    protected $casts = [
        'test_result_id'   => 'integer',
        'user_id_penugasan' => 'integer',
        'k_status'         => 'string',
        'komentar'         => 'string',
        'tgl_komentar'     => 'date',
        'old_assignee'     => 'string',
        'new_assignee'     => 'string',
        'old_status'       => 'string',
        'new_status'       => 'string',
        'is_edited'        => 'boolean', 
        'created_at'       => 'datetime',
        'updated_at'       => 'datetime',
    ];


    protected $fillable = [
        'test_result_id',
        'user_id_penugasan',
        'k_status',
        'komentar',
        'tgl_komentar',
        'old_assignee',   
        'new_assignee',    
        'old_status',      
        'new_status',  
        'is_edited',
    ];

    // Relasi ke tabel test_results
    public function testResult(): BelongsTo
    {
        return $this->belongsTo(TestResult::class, 'test_result_id');
    }

    // Relasi ke tabel users
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_penugasan');
    }

    // Relasi ke tabel m_status
    public function status(): BelongsTo
    {
        return $this->belongsTo(MStatus::class,  'k_status');
    }
}
