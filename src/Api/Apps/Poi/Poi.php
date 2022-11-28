<?php

namespace Iceqi\DouYin\Api\Apps\Poi;

use Iceqi\DouYin\Api\BaseApis;
use Iceqi\DouYin\Api\Exceptions\BizException;
use Iceqi\DouYin\Api\Exceptions\ServiceException;
use Iceqi\DouYin\Query;

class Poi extends BaseApis
{

    private $base_path = "/poi";
    protected $base_url = "https://open.douyin.com";

    protected $access_token;


    public function setToken($access_token)
    {
        $this->access_token = $access_token;
        return $this;
    }


    protected function setParamsToken()
    {
        $this->setParams("access_token", $this->access_token);
        return $this;
    }

    protected function setHeaderToken()
    {
        $this->setHeader("access-token", $this->access_token);
        return $this;
    }

    public function amap($amap_id)
    {
        $this->_uri = sprintf("/query/");
        $this->setParams("amap_id", $amap_id);
        $this->_method = "GET";
        return $this;
    }

    public function debug()
    {
        $this->debug = true;
        return $this;
    }


    public function requestOptions()
    {
        return ["debug" => $this->debug, "headers" => $this->_headers, "json" => $this->body(), "query" => $this->params()];
    }

    public function body()
    {
        return $this->body;
    }

    public function params()
    {
        return $this->params ? $this->params : [];
    }

    protected function getUri()
    {
        return $this->request_uri = $this->base_path . $this->_uri;
    }


    public function getBaseUrl()
    {
        return $this->base_url;
    }


}