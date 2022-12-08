<?php

namespace Iceqi\DouYin\Api\Apps\Poi;

use Iceqi\DouYin\Api\Apps\DouYin;
use Iceqi\DouYin\Api\BaseApis;
use Iceqi\DouYin\Api\Exceptions\BizException;
use Iceqi\DouYin\Api\Exceptions\ServiceException;
use Iceqi\DouYin\Query;

class Poi extends DouYin
{

    protected $base_path = "/poi";

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
        $this->title = "Amap查询";
        $this->_uri = "/query/";
        $this->setParams("amap_id", $amap_id);
        $this->_method = "GET";
        $this->setHeaderToken();
        return $this;
    }

    public function debug()
    {
        $this->debug = true;
        return $this;
    }

    protected function getUri()
    {
        return $this->request_uri = $this->base_path . $this->_uri;
    }

    public function getBaseUrl()
    {
        return $this->base_url;
    }

    public function requestOptions()
    {
        return ["debug" => $this->debug, "headers" => $this->_headers, "json" => $this->body(), "query" => $this->params()];
    }


    public function params()
    {
        return $this->params ? $this->params : [];
    }




}