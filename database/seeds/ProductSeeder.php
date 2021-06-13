<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lists = array(
            'Rice',
            'Pig',
            'Cattle',
            'Cows milk',
            'Chicken',
            'Maize (Corn)',
            'Wheat',
            'Soybeans',
            'Eggs',
            'Potatoes',
            'Vegetables',
            'Tomatoes',
            'Sugarcane',
            'Grapes',
            'Seed Cotton',
            'Buffalo milk',
            'Cotton lint',
            'Apples',
            'Onions',
            'Sheep',
            'Cucumbers and Gherkins',
            'Garlic',
            'Bananas',
            'Goat',
            'Oil palm fruit',
            'Cassava (yuca)',
            'Palm oil',
            'Watermelons',
            'Rapeseed',
            'Mangos',
            'Mangosteens',
            'Guavas',
            'Eggs',
            'Groundnuts',
            'Chilis and peppers',
            'Sweet Potatoes',
            'Barley',
            'Oranges',
            'Eggplants (aubergines)',
            'Olives',
            'Sunflower seeds',
            'Tangerines',
            'Mandarins',
            'Clementines',
            'Satsumas',
            'Cabbages and other brassicas',
            'Spinach',
            'Strawberries',
            'Peaches',
            'nectarines',
            'Tobacco',
            'Coffee',
            'Lettuce',
            'Rubber',
            'Tea',
            'Peas'
        );

        foreach ($lists as $list){
            $data = new Product();
            $data->name = stringSlug($list);
            $data->display_name = $list;
            $data->save();
        }
    }
}
