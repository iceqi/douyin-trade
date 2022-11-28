<?php

namespace Iceqi\DouYin\Api\Apps\Life;

use Iceqi\DouYin\Api\BaseApis;
use Iceqi\DouYin\Api\Exceptions\BizException;
use Iceqi\DouYin\Api\Exceptions\ServiceException;
use Iceqi\DouYin\Query;

class Life extends BaseApis
{
    private $base_path = "/life";
    protected $base_url = "https://open.douyin.com";
    protected $access_token;

    public function setToken($access_token)
    {
        $this->access_token = $access_token;
        return $this;
    }
    public function debug(){
        $this->debug = true;
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

    protected function setParamsToken(){
        $this->setParams("access_token", $this->access_token);
        return $this;
    }

    protected function setHeaderToken(){
        $this->setHeader("access_token", $this->access_token);
        return $this;
    }


    public function doQuery()
    {
        try {
            $this->client = new Query();
            $this->client->request($this);
            $this->query_result = $this->client->result();
            return $this;
        } catch (\Exception $exception) {
            throw new ServiceException($exception->getMessage());
        }
    }

    public function client()
    {
        return $this->client;
    }

    public function result()
    {
        if ($this->query_result["code"] == 200 && $this->query_result["status"] == "success") {
            if ($this->query_result["data"]) {
                $data = json_decode($this->query_result["data"], true)["data"];
                if ($data["error_code"] > 0) {
                    throw new BizException($data["description"]);
                } else {
                    $this->_result = $data;
                }
            }
        }
        return $this->_result;
    }

}