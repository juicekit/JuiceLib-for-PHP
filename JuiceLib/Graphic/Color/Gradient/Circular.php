<?php

namespace JuiceLib\Graphic\Color\Gradient;

use JuiceLib\Graphic\Color\Color;

class Circular extends Gradient {

    public function __construct(Color $start, Color $end) {
        $this->setStart($start);
        $this->setEnd($end);
    }

}
