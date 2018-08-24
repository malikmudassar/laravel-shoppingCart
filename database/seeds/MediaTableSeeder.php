<?php

use App\Media;
use Illuminate\Database\Seeder;

class MediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Media::create([
            'page'		    =>	'home',
            'header'		=>	'1530735875.jpg',
            'image1'	    =>	'1529998520image1.jpg',
            'image2'	    =>	'1529998236image2.jpg',
            'image3'	    =>	'1529998237image3.jpg',
            'created_at'	=>	date("Y-m-d H:i:s"),
            'updated_at'	=>	date("Y-m-d H:i:s"),
            'lg_image1'	    =>	'Home_NL_Carciofini.png',
            'lg_image2'	    =>	'Home_NL_Laboratorio.png'
        ]);
    }
}
