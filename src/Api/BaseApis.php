<?php

namespace Iceqi\DouYin\Api;

use Iceqi\DouYin\Api\Exceptions\BizException;
use Iceqi\DouYin\Api\Exceptions\ServiceException;
use Iceqi\DouYin\Query;

class BaseApis
{

    protected $params;
    protected $_uri;
    protected $_requestInfo;
    protected $_method = "POST";
    protected $request_uri;
    protected $appId;
    protected $body;
    protected $debug = false;
    protected $title = "";
    protected $client;

    protected $_headers = [];

    protected $_result;
    protected $query_result;

    public function setAppId($appId)
    {
        $this->appId = $appId;
        return $this;
    }


    protected function setHeader($key, $value)
    {
        $this->_headers[$key] = $value;
        return $this;
    }

    protected function setBody($name, $value){

        $this->body[$name] = $value;
    }

    public function __set($name, $value)
    {
        if (strtoupper($this->_method) == "POST") {
            $this->body[$name] = $value;
        } else {
            $this->params[$name] = $value;
        }
        return $this;
    }

    protected function setParams($name, $value){
        $this->params[$name] = $value;
    }

    public function getQuery()
    {
        $this->_requestInfo ["request_uri"] = $this->getUri();
        $this->_requestInfo["method"] = $this->_method;
        return $this->_requestInfo;
    }

    public function requestOptions()
    {

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
                    throw new BizException($this->title . "错误: " .$data["description"]);
                } else {
                    $this->_result = $data;
                }
            }
        }
        return $this->_result;
    }
}