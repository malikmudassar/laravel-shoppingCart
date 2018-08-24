<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
        	'name'		=>	'Product 1',
        	'slug'		=>	'product-1',
        	'details'	=>	'Sub Heading or Product - 1',
        	'price'		=>	'20',
        	'description'=>	'This is description of product-1 and related stuff to product-1'
        ]);
        Product::create([
        	'name'		=>	'Product 2',
        	'slug'		=>	'product-2',
        	'details'	=>	'Sub Heading or Product - 2',
        	'price'		=>	'25',
        	'description'=>	'This is description of product-2 and related stuff to product-2'
        ]);
        Product::create([
        	'name'		=>	'Product 3',
        	'slug'		=>	'product-3',
        	'details'	=>	'Sub Heading or Product - 1',
        	'price'		=>	'20',
        	'description'=>	'This is description of product-1 and related stuff to product-1'
        ]);
        Product::create([
        	'name'		=>	'Product 4',
        	'slug'		=>	'product-4',
        	'details'	=>	'Sub Heading or Product - 1',
        	'price'		=>	'20',
        	'description'=>	'This is description of product-1 and related stuff to product-1'
        ]);
        Product::create([
        	'name'		=>	'Product 5',
        	'slug'		=>	'product-5',
        	'details'	=>	'Sub Heading or Product - 1',
        	'price'		=>	'20',
        	'description'=>	'This is description of product-1 and related stuff to product-1'
        ]);
    }
}
