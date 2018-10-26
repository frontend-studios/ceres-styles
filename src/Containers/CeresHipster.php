<?php

namespace CeresHipster\Containers;

use Plenty\Plugin\Templates\Twig;

class CeresHipster
{
    public function call(Twig $twig):string
    {
        return $twig->render('CeresHipster::CeresHipster');
    }
}
