<?php

namespace Bizcloud\MVCTest\Exception;

/**
 * Exception: Controller action not found
 */
class ActionNotFound extends \Exception
{

    /** @inheritdoc */
    public function __construct()
    {
        parent::__construct('Action not found', 404);
    }
}