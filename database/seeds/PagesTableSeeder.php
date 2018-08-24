<?php
use App\Pages;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pages::create([
        	'name'		=>	'About Us',
        	'slug'		=>	'about-us',
        	'description'=>	'This is About us page'
        ]);
        Pages::create([
        	'name'		=>	'How It Works',
        	'slug'		=>	'how-it-works',
        	'description'=>	'This is home page'
        ]);
        Pages::create([
        	'name'		=>	'Terms & Conditions',
        	'slug'		=>	'terms-conditions',
        	'description'=>	'This is T&C page'
        ]);
        Pages::create([
        	'name'		=>	'Privacy Policy',
        	'slug'		=>	'privacy-policy',
        	'description'=>	'This is privacy privacy-policy page'
        ]);
        Pages::create([
        	'name'		=>	'Payment Mentods',
        	'slug'		=>	'payment-methods',
        	'description'=>	'This is payment-methods page'
        ]);
    }
}
