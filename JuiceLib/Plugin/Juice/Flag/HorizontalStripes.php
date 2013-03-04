<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Graphic\Color\Color,
    JuiceLib\Integer,
    JuiceLib\Exception\IllegalArgumentException,
    JuiceLib\Collections\ArrayList;

abstract class HorizontalStripes extends StripedFlag {

    protected function build() {
        $this->addStripes($this->getStripes());
    }

    protected function stripeHeight() {
        return Integer::init($this->getHeight() / $this->getStripeCount())->toInt();
    }

    protected function addStripes(ArrayList $colors) {

        if (!($colors->getType() instanceof Color)) {
            throw new IllegalArgumentException();
        }

        $this->image()->resize($this->getWidth(), $this->getStripeCount() * $this->stripeHeight());

        $count = $colors->size();

        for ($i = 0; $i < $this->getStripeCount(); $i++) {
            $this->image()->addRectangle(0, $i * $this->stripeHeight(), $this->getWidth(), $this->stripeHeight(), $colors->get($i % $count));
        }
    }

}