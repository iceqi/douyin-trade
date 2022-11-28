<?php

namespace Iceqi\DouYin\Api\Exceptions;

class BizException extends DouYinException
{
    protected $errorType = "biz";

    protected $typeTitle = "业务端服务异常";
}