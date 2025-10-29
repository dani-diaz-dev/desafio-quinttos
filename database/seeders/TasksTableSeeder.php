<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tasks')->insert([
            [
                'title' => 'Crear proyecto',
                'description' => 'Instalar Laravel y dependencias',
                'status' => 'Completada',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Cambiar lampara',
                'description' => 'Cambiar lamparita quemada en el patio',
                'status' => 'Pendiente',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
