<?php

namespace Iceqi\DouYin\Api\Apps\Life;

use Iceqi\DouYin\Api\Apps\DouYin;
use Iceqi\DouYin\Api\BaseApis;
use Iceqi\DouYin\Api\Exceptions\BizException;
use Iceqi\DouYin\Api\Exceptions\ServiceException;
use Iceqi\DouYin\Query;

class Life extends DouYin
{
    protected $base_path = "/life";
    protected $access_token;

    public function setToken($access_token)
    {
        $this->access_token = $access_token;
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

    protected function setParamsToken()
    {
        $this->setParams("access_token", $this->access_token);
        return $this;
    }

    protected function setHeaderToken()
    {
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
                $data = json_decode($this->query_result["data"], true);

                if ($data["base"]["biz_code"] > 0) {
                    throw new BizException($data["base"]["biz_msg"]);
                }

                if ($data["base"]["gateway_code"] > 0) {
                    throw new ServiceException($data["base"]["gateway_msg"]);
                }

                if (isset($data["data"]) && $data["data"]) {
                    $this->_result = $data["data"];

                } else {
                    $this->_result = $data["base"];
                }
            }
        }
        return $this->_result;
    }

}