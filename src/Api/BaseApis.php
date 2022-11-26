<?php

namespace Iceqi\DouYin\Api;

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

    protected $_headers = [];

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

}