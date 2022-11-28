<?php

namespace Iceqi\Douyin\Api\Exceptions;

class DouYinException extends \Exception
{
    protected $errorType;
    protected $typeTitle;

    public function getErrorType()
    {
        return $this->errorType;
    }

    public function getErrorTitle(){
        return $this->typeTitle;
    }

}