<?php

namespace Iceqi\Douyin\Api\Exceptions;

class DouYinException extends \Exception
{
    protected $errorType;

    public function getErrorType()
    {
        return $this->errorType;
    }
}