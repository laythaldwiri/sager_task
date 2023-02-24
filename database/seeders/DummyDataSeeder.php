<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = Hash::make('12345678');

        // ======================================================================
        // =========================== Category Section =========================
        // ======================================================================
        for ($i = 1; $i <= 20; $i++) {
            Category::create([
                'name' => 'Category ' . $i,
                'status' => 1, // 1 => Active
            ]);
        }

        // ======================================================================
        // =========================== Product Section ==========================
        // ======================================================================
        for ($i = 1; $i <= 1000; $i++) {
            Product::create([
                'name' => 'Product ' . $i,
                'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quae dicta consequuntur veniam soluta eum debitis quo inventore et dolorum qui quis eius, natus deserunt aperiam molestias fugit nostrum expedita facilis!',
                'price' => rand(1, 50),
                'quantity' => rand(1, 100),
                'image' => null,
                'status' => 1, // 1 => Active
                'created_by' => 1,
            ]);

            CategoryProduct::create([
                'category_id' => rand(1, 20),
                'product_id' => $i,
            ]);
        }

        // ======================================================================
        // =========================== Customer Section =========================
        //=======================================================================
        for ($i = 1; $i <= 100; $i++) {
            Customer::create([
                'name' => 'Customer ' . $i,
                'email' => 'customer_' . $i . '@sager.com',
                'password' => $password,
                'status' => 1, // 1 => Active
            ]);
        }
    }
}
