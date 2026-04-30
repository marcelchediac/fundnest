<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(){
    {
        $categories = ['Medical', 'Education', 'Emergency', 'Charity'];
        foreach ($categories as $name) {
        Category::create(['name' => $name]);
    }
}
    }
}
