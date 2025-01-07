<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Desarrollo Web']);
        Category::create(['name' => 'Marketing Digital']);
        Category::create(['name' => 'Diseño Gráfico']);
        Category::create(['name' => 'Programación y Software']);
        Category::create(['name' => 'Negocios y Emprendimiento']);
        Category::create(['name' => 'Finanzas Personales']);
        Category::create(['name' => 'Fotografía y Video']);
        Category::create(['name' => 'Idiomas']);
        Category::create(['name' => 'Ciencia y Tecnología']);
        Category::create(['name' => 'Habilidades de Comunicación']);
        Category::create(['name' => 'Liderazgo y Gestión']);
        Category::create(['name' => 'Salud y Bienestar']);
        Category::create(['name' => 'Creatividad y Escritura']);
        Category::create(['name' => 'Cocina y Gastronomía']);
        Category::create(['name' => 'Arte y Manualidades']);
        Category::create(['name' => 'Música e Instrumentos']);
        Category::create(['name' => 'Desarrollo Personal']);
        Category::create(['name' => 'Cuidado del Medio Ambiente']);
        Category::create(['name' => 'Preparación para Exámenes']);
        Category::create(['name' => 'Robótica e Inteligencia Artificial']);
    }
}
