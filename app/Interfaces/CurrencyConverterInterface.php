<?php

namespace App\Interfaces;

interface CurrencyConverterInterface {
    
    public function convert($from, $to, $amount);

}