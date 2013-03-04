<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Collections\ArrayList;

abstract class StripedFlag extends Flag {

    protected function build() {
        $this->addStripes($this->getStripes());
    }

    abstract protected function getStripeCount();

    abstract protected function getStripes();

    abstract protected function addStripes(ArrayList $colors);
}