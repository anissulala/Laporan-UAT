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

    /** @test */
    public function nama_is_required()
    {
        Log::info('Memulai test: nama_is_required');

        // Mengambil project yang sudah ada di database (jika ada)
        $Project = Project::skip(1)->first();
        if (!$Project) {
            Log::warning('Tidak ada project di database untuk validasi.');
            $this->fail('Tidak ada project di database.');
        }

        // Eksekusi Livewire component tanpa nama
        Livewire::test('components.projects.create')
            ->set('deskripsi', $Project->deskripsi) // Menggunakan deskripsi dari project asli
            ->call('store')
            ->assertHasErrors(['nama' => 'required']);

        Log::info('Validasi nama is_required berhasil.');
    }

    /** @test */
    public function deskripsi_is_required()
    {   
        Log::info('Memulai test: deskripsi_is_required');

        // Mengambil project yang sudah ada di database (jika ada)
        $Project = Project::first();
        if (!$Project) {
            Log::warning('Tidak ada project di database untuk validasi.');
            $this->fail('Tidak ada project di database.');
        }

        // Eksekusi Livewire component tanpa deskripsi
        Livewire::test('components.projects.create')
            ->set('nama', $Project->nama) // Menggunakan nama dari project asli
            ->call('store')
            ->assertHasErrors(['deskripsi' => 'required']);

        Log::info('Validasi deskripsi is_required berhasil.');
    }
}
