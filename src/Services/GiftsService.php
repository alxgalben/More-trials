<?php
namespace App\Services;

class GiftsService {

    public $gifts = ['flowers', 'car' ,'money', 'piano'];
    public function __construct() {
        shuffle($this -> gifts);
    }

}