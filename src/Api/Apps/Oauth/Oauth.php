<?php

namespace Iceqi\DouYin\Api\Apps\Oauth;

use Iceqi\DouYin\Api\Apps\DouYin;
use Iceqi\DouYin\Api\BaseApis;
use Iceqi\DouYin\Api\Exceptions\BizException;
use Iceqi\DouYin\Api\Exceptions\ServiceException;
use Iceqi\DouYin\Query;

class Oauth extends DouYin
{
    protected $base_path = "/oauth";

    public function client_token()
    {
        $this->title = "获取客户端token";
        $this->_uri = "/client_token/";
        return $this;
    }


    public function body()
    {
        return $this->body;
    }

    public function params()
    {
        return $this->params ? $this->params : [];
    }


    public function requestOptions()
    {
        return ["debug" => false, "headers" => $this->_headers, "json" => $this->body()];
    }

    protected function getUri()
    {
        return $this->request_uri = $this->base_path . $this->_uri;;
    }

    public function getBaseUrl()
    {
        return $this->base_url;
    }


}