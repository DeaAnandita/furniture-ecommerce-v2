<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Material;
use App\Models\Style;

class MasterDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Categories
         */
        $categories = [
            'Sofa',
            'Chair',
            'Table',
            'Lamp',
            'Cabinet',
            'Bed',
            'Dining Set',
            'Shelf'
        ];

        foreach ($categories as $category) {

            Category::create([
                'name' => $category
            ]);
        }

        /**
         * Materials
         */
        $materials = [
            'Wood',
            'Aluminium',
            'Metal',
            'Glass',
            'Steel',
            'Marble',
            'Leather',
            'Fabric'
        ];

        foreach ($materials as $material) {

            Material::create([
                'name' => $material
            ]);
        }

        /**
         * Styles
         */
        $styles = [
            'Minimalist',
            'Modern',
            'Scandinavian',
            'Industrial',
            'Japandi',
            'Classic',
            'Luxury',
            'Contemporary'
        ];

        foreach ($styles as $style) {

            Style::create([
                'name' => $style
            ]);
        }
    }
}