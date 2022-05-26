<?php

namespace Bizcloud\MVCTest\Controller;

use Bizcloud\MVCTest\AbstractController;

/**
 *
 */
class IndexController extends AbstractController
{
    /**
     * @return void
     */
    public function IndexAction()
    {
        $this->render('index');
    }

}