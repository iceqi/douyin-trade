<?php

namespace Iceqi\DouYin\Api\Apps;

use Iceqi\DouYin\Api\BaseApis;

class DouYin extends BaseApis
{
    protected $base_url = "https://open.douyin.com";
    protected $base_path;
    protected $jsonData = false;

    public function BodyToJson(){
        $this->jsonData = true;
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

    protected function getUri()
    {
        return $this->request_uri = $this->base_path . $this->_uri;
    }


    public function getBaseUrl()
    {
        return $this->base_url;
    }

    public function debug()
    {
        $this->debug = true;
        return $this;
    }


}