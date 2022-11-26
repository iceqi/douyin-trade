<?php

namespace Iceqi\DouYin\Api\Apps\Oauth;

use Iceqi\DouYin\Api\BaseApis;

class Oauth extends BaseApis
{
    protected $base_path = "/oauth";
    protected $base_url = "https://open.douyin.com";

    public function client_token()
    {
        $this->_uri = "/client_token/";
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