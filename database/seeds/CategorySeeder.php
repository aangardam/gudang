<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            [
                'code' => 'Jeans',
                'name' => 'Celana Jeans'
            ],
            [
                'code' => 'Chino',
                'name' => 'Celana Chino'
            ],
            [
                'code' => 'Fanel',
                'name' => 'Kemeja Fanel'
            ],
            [
                'code' => 'kemeja',
                'name' => 'Kemeja Polos'
            ],
            [
                'code' => 'Sweater',
                'name' => 'Swater'
            ],
            [
                'code' => 'Jaket',
                'name' => 'Jaket'
            ],
            [
                'code' => 'Dompet',
                'name' => 'Dompet'
            ],
        ];
        foreach ($category as $key => $value) {
            $category = Category::create($value);
        }
    }
}
