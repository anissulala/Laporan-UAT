<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    // Menetapkan model yang akan digunakan oleh factory ini
    protected $model = Project::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->sentence(3), //Faker untuk membuat data acak.
            'deskripsi' => $this->faker->paragraph,
        ];
    }
}