<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Integer,
    JuiceLib\Graphic\Color\Hex;

class PuertoRico extends Cuba {
    
    protected function getTriangleColor() {
        return new Hex("#0050F0");
    }

    protected function getStripeColor() {
        return new Hex("#ED0000");
    }

    protected function calculateHeight($w) {
        return Integer::init($w / 1.5)->toInt();
    }

    protected function calculateWidth($h) {
        return Integer::init($h * 1.5)->toInt();
    }

}
