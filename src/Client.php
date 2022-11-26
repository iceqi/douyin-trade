<?php

namespace Iceqi\DouYin;

use Iceqi\DouYin\Api\BaseApis;

class Client
{
    private $_config;
    /**
     * @var \GuzzleHttp\Client
     */
    private $request;
    private $_result;

    public function __construct($options = [])
    {
        $this->_config = $options;
    }

    public function request(BaseApis $baseApis)
    {
        $query = $baseApis->getQuery();
        $client = $this->request = new \GuzzleHttp\Client(["base_uri" => $baseApis->getBaseUrl(), "verify" => false]);
        try {
            $response = $client->request($query["method"], $query["request_uri"], $baseApis->requestOptions());
            if ($response->getStatusCode() == 200) {
                $this->_result["code"] = 200;
                $this->_result["status"] = "success";
                $this->_result["data"] = $response->getBody()->getContents();
            }
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $this->_result["code"] = $e->getResponse()->getStatusCode();
                $this->_result["status"] = "error";
                $this->_result["data"] = $e->getResponse()->getBody()->getContents();
            }
        }
        return $this;

    }

    public function result(){

        return $this->_result;
    }
}