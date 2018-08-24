<?php

namespace App;

use Cloudinary;
use Illuminate\Config\Repository;

class CloudinaryWrapper extends \JD\Cloudder\CloudinaryWrapper {

   /**
    * Cloudinary search.
    *
    * @var \Cloudinary\Search
    */
   protected $search;

   public function __construct(
       Repository $config,
       Cloudinary $cloudinary,
       Cloudinary\Uploader $uploader,
       Cloudinary\Api $api,
       Cloudinary\Search $search
   ) {
       parent::__construct($config, $cloudinary, $uploader, $api);

       $this->search = $search;
   }

   public function getSearch() {
       return $this->search;
   }
}