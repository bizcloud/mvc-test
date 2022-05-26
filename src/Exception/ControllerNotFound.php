<?php

namespace Bizcloud\MVCTest\Exception;

/**
 * Exception: Controller not found
 */
class ControllerNotFound extends \Exception
{

    /** @inheritdoc */
    public function __construct()
    {
        parent::__construct('Controller not found', 404);
    }

}