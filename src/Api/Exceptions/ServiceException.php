<?php

namespace Iceqi\DouYin\Api\Exceptions;

class ServiceException extends DouYinException
{
    protected $errorType = "service";
    protected $typeTitle = "网关服务异常";

}