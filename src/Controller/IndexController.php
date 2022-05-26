<?php

namespace Bizcloud\MVCTest\Controller;

use Bizcloud\MVCTest\AbstractController;

class IndexController extends AbstractController
{
    public function IndexAction()
    {
        $this->render('index');

    }

}