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

    public function setAppId($appId)
    {
        $this->appId = $appId;
        return $this;
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

    public function getQuery()
    {
        $this->_requestInfo ["request_uri"] = $this->getUri();
        $this->_requestInfo["method"] = $this->_method;
        return $this->_requestInfo;
    }



}