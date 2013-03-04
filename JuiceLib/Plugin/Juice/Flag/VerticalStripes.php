<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Graphic\Color\Color,
    JuiceLib\Integer,
    JuiceLib\Exception\IllegalArgumentException,
    JuiceLib\Collections\ArrayList;

abstract class VerticalStripes extends StripedFlag {

    protected function stripeWidth() {
        return Integer::init($this->getWidth() / $this->getStripeCount())->toInt();
    }

    protected function addStripes(ArrayList $colors) {

        if (!($colors->getType() instanceof Color)) {
            throw new IllegalArgumentException();
        }

        $this->image()->resize($this->getStripeCount() * $this->stripeWidth(), $this->getHeight());

        $count = $colors->size();

        for ($i = 0; $i < $this->getStripeCount(); $i++) {
            $this->image()->addRectangle($i * $this->stripeWidth(), 0, $this->stripeWidth(), $this->getHeight(), $colors->get($i % $count));
        }
    }

}