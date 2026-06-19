<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Material;
use App\Models\Style;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // CATEGORY
        $chair = Category::where('name', 'Chair')->first();
        $table = Category::where('name', 'Table')->first();
        $sofa = Category::where('name', 'Sofa')->first();
        $bed = Category::where('name', 'Bed')->first();
        $lamp = Category::where('name', 'Lamp')->first();
        $cabinet = Category::where('name', 'Cabinet')->first();
        $dining = Category::where('name', 'Dining Set')->first();
        $shelf = Category::where('name', 'Shelf')->first();

        // MATERIAL
        $wood = Material::where('name', 'Wood')->first();
        $aluminium = Material::where('name', 'Aluminium')->first();
        $metal = Material::where('name', 'Metal')->first();
        $glass = Material::where('name', 'Glass')->first();
        $steel = Material::where('name', 'Steel')->first();
        $marble = Material::where('name', 'Marble')->first();
        $leather = Material::where('name', 'Leather')->first();
        $fabric = Material::where('name', 'Fabric')->first();

        // STYLE
        $minimalist = Style::where('name', 'Minimalist')->first();
        $modern = Style::where('name', 'Modern')->first();
        $scandinavian = Style::where('name', 'Scandinavian')->first();
        $industrial = Style::where('name', 'Industrial')->first();
        $japandi = Style::where('name', 'Japandi')->first();
        $classic = Style::where('name', 'Classic')->first();
        $luxury = Style::where('name', 'Luxury')->first();
        $contemporary = Style::where('name', 'Contemporary')->first();

        Product::create([
            'name' => 'Lemari Pakaian SIRI 3 Pintu',
            'description' => 'Lemari pakaian modern 3 pintu dengan ruang penyimpanan luas.',
            'price' => 5799000,
            'stock' => 10,
            'image' => 'lemari1.jpg',
            'category_id' => $cabinet?->id,
            'material_id' => $wood?->id,
            'style_id' => $minimalist?->id,
        ]);

        Product::create([
            'name' => 'Lemari Pakaian LECCO 2 Pintu',
            'description' => 'Lemari pakaian 2 pintu dengan desain minimalis warna putih.',
            'price' => 3899000,
            'stock' => 8,
            'image' => 'lemari2.jpg',
            'category_id' => $cabinet?->id,
            'material_id' => $metal?->id,
            'style_id' => $modern?->id,
        ]);

        Product::create([
            'name' => 'Lemari Pakaian KATO 3 Pintu',
            'description' => 'Lemari pakaian elegan dengan rak dan gantungan pakaian.',
            'price' => 4999000,
            'stock' => 12,
            'image' => 'lemari3.jpg',
            'category_id' => $cabinet?->id,
            'material_id' => $wood?->id,
            'style_id' => $japandi?->id,
        ]);

        Product::create([
            'name' => 'Heim Studio REKA Lemari Pakaian 2 Pintu',
            'description' => 'Lemari pakaian pintu geser modern yang hemat ruang.',
            'price' => 2899000,
            'stock' => 15,
            'image' => 'lemari4.jpg',
            'category_id' => $cabinet?->id,
            'material_id' => $wood?->id,
            'style_id' => $modern?->id,
        ]);

        Product::create([
            'name' => 'Lemari Pakaian KANOU 2 Pintu',
            'description' => 'Lemari pakaian minimalis dengan kapasitas penyimpanan besar.',
            'price' => 4899000,
            'stock' => 7,
            'image' => 'lemari5.jpg',
            'category_id' => $cabinet?->id,
            'material_id' => $wood?->id,
            'style_id' => $minimalist?->id,
        ]);

        Product::create([
            'name' => 'Lemari Pakaian YASHU 3 Pintu',
            'description' => 'Lemari pakaian modern dengan kombinasi rak multifungsi.',
            'price' => 4199000,
            'stock' => 11,
            'image' => 'lemari6.jpg',
            'category_id' => $cabinet?->id,
            'material_id' => $wood?->id,
            'style_id' => $contemporary?->id,
        ]);

        Product::create([
            'name' => 'Heim Studio RUNA Lemari Pakaian 3 Pintu',
            'description' => 'Lemari pakaian modern dengan desain elegan dan penyimpanan optimal.',
            'price' => 2849000,
            'stock' => 9,
            'image' => 'lemari7.jpg',
            'category_id' => $cabinet?->id,
            'material_id' => $wood?->id,
            'style_id' => $modern?->id,
        ]);

        Product::create([
            'name' => 'Lemari Pakaian MOKU 2 Pintu',
            'description' => 'Lemari pakaian warna coklat dengan tampilan natural.',
            'price' => 2449000,
            'stock' => 14,
            'image' => 'lemari8.jpg',
            'category_id' => $cabinet?->id,
            'material_id' => $wood?->id,
            'style_id' => $scandinavian?->id,
        ]);

        Product::create([
            'name' => 'Lemari Pakaian KEIGO Sliding Cermin',
            'description' => 'Lemari pakaian premium dengan pintu sliding dan cermin.',
            'price' => 6299000,
            'stock' => 5,
            'image' => 'lemari9.jpg',
            'category_id' => $cabinet?->id,
            'material_id' => $glass?->id,
            'style_id' => $luxury?->id,
        ]);

        Product::create([
            'name' => 'Lemari Pakaian RUNA 3 Pintu',
            'description' => 'Lemari pakaian modern dengan penyimpanan maksimal.',
            'price' => 2849000,
            'stock' => 13,
            'image' => 'lemari10.jpg',
            'category_id' => $cabinet?->id,
            'material_id' => $wood?->id,
            'style_id' => $minimalist?->id,
        ]);
    }
}