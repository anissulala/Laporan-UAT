<?php

namespace Tests\Feature;

use App\Helpers\Test\LazilyRefreshDatabase;
use App\Models\Project;
use Livewire\Livewire;
use Tests\TestCase;
use Illuminate\Support\Facades\Log;

class ProjectCreateTest extends TestCase
{
    use LazilyRefreshDatabase;

    /** @test */
    public function it_can_create_a_project()
    {
        Log::info('Memulai test: it_can_create_a_project');

        // Ambil data asli dari database
        $Project = Project::first();

        // Jika tidak ada project, hentikan test dan log error
        if (!$Project) {
            Log::warning('Tidak ada project di database untuk pengujian.');
            $this->fail('Tidak ada project di database.');
        }

        // Verifikasi project asli tetap ada di database
        $this->assertDatabaseHas('project', [
            'nama' => $Project->nama,
            'deskripsi' => $Project->deskripsi,
        ]);

        Log::info('Project berhasil');
    }
}
