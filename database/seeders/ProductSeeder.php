<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::pluck('id', 'name');

        $products = [

            // ================= MEDICAMENTOS =================
            [
                'name' => 'Paracetamol 500mg',
                'description' => 'Analgésico y antipirético',
                'price' => 1200.00,
                'stock' => 0,
                'min_stock' => 20,
                'category_id' => $categories['Medicamentos'],
            ],
            [
                'name' => 'Ibuprofeno 600mg',
                'description' => 'Antiinflamatorio no esteroideo',
                'price' => 1800.00,
                'stock' => 0,
                'min_stock' => 15,
                'category_id' => $categories['Medicamentos'],
            ],
            [
                'name' => 'Amoxicilina 500mg',
                'description' => 'Antibiótico de amplio espectro',
                'price' => 3500.00,
                'stock' => 0,
                'min_stock' => 10,
                'category_id' => $categories['Medicamentos'],
            ],
            [
                'name' => 'Omeprazol 20mg',
                'description' => 'Protector gástrico',
                'price' => 2100.00,
                'stock' => 0,
                'min_stock' => 15,
                'category_id' => $categories['Medicamentos'],
            ],
            [
                'name' => 'Loratadina 10mg',
                'description' => 'Antihistamínico para alergias',
                'price' => 1600.00,
                'stock' => 0,
                'min_stock' => 20,
                'category_id' => $categories['Medicamentos'],
            ],

            // ================= PERFUMERÍA =================
            [
                'name' => 'Colonia Floral',
                'description' => 'Fragancia fresca de uso diario',
                'price' => 5200.00,
                'stock' => 0,
                'min_stock' => 5,
                'category_id' => $categories['Perfumería'],
            ],
            [
                'name' => 'Crema corporal hidratante',
                'description' => 'Hidratación diaria para piel seca',
                'price' => 2800.00,
                'stock' => 0,
                'min_stock' => 10,
                'category_id' => $categories['Perfumería'],
            ],
            [
                'name' => 'Shampoo neutro',
                'description' => 'Uso diario para todo tipo de cabello',
                'price' => 1900.00,
                'stock' => 0,
                'min_stock' => 15,
                'category_id' => $categories['Perfumería'],
            ],
            [
                'name' => 'Desodorante antitranspirante',
                'description' => 'Protección 48 horas',
                'price' => 2300.00,
                'stock' => 0,
                'min_stock' => 15,
                'category_id' => $categories['Perfumería'],
            ],
            [
                'name' => 'Jabón dermatológico',
                'description' => 'Limpieza suave para piel sensible',
                'price' => 1400.00,
                'stock' => 0,
                'min_stock' => 20,
                'category_id' => $categories['Perfumería'],
            ],

            // ================= HERBORISTERÍA =================
            [
                'name' => 'Té de manzanilla',
                'description' => 'Infusión natural relajante',
                'price' => 900.00,
                'stock' => 0,
                'min_stock' => 20,
                'category_id' => $categories['Herboristería'],
            ],
            [
                'name' => 'Valeriana cápsulas',
                'description' => 'Suplemento natural para el descanso',
                'price' => 2400.00,
                'stock' => 0,
                'min_stock' => 10,
                'category_id' => $categories['Herboristería'],
            ],
            [
                'name' => 'Tilo en saquitos',
                'description' => 'Infusión calmante natural',
                'price' => 850.00,
                'stock' => 0,
                'min_stock' => 15,
                'category_id' => $categories['Herboristería'],
            ],
            [
                'name' => 'Ginkgo biloba',
                'description' => 'Suplemento para la memoria y concentración',
                'price' => 3100.00,
                'stock' => 0,
                'min_stock' => 10,
                'category_id' => $categories['Herboristería'],
            ],
            [
                'name' => 'Aloe vera gel',
                'description' => 'Gel natural para cuidado de la piel',
                'price' => 1800.00,
                'stock' => 0,
                'min_stock' => 15,
                'category_id' => $categories['Herboristería'],
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
