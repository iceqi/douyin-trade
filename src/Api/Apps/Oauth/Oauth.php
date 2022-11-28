<?php

namespace Iceqi\DouYin\Api\Apps\Oauth;

use Iceqi\DouYin\Api\BaseApis;
use Iceqi\DouYin\Api\Exceptions\BizException;
use Iceqi\DouYin\Api\Exceptions\ServiceException;
use Iceqi\DouYin\Query;

class Oauth extends BaseApis
{
    protected $base_path = "/oauth";
    protected $base_url = "https://open.douyin.com";
    private $_result;
    private $query_result;
    private $client;

    public function client_token()
    {
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