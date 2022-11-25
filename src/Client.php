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
        $config = [
            'appid' => 'tt08867e3b97b8ee8001', //AppID
            'secret' => '482c1661421d091397de0ae9fbd7f60913a9ad07', //AppSecret
            'salt' => '47jJYnYODbT782WPD0FlAHS5b4J8IeTYcsNGGtmX', //支付密钥值
            'notify_url' => '', //支付回调地址
            'thirdparty_id' => '', //第三方平台服务商 id，非服务商模式留空，暂时用不上
            'merchant_id' => '70948675039435021170', //商户号
            'commission' => '0.6', //抖音平台技术服务费，小程序平台在分账接点收取，已包含支付手续费
        ];
        $this->_config = array_merge($options, $config);
    }

    public function request(BaseApis $baseApis)
    {
        $query = $baseApis->getQuery();
        $client = $this->request = new \GuzzleHttp\Client(["base_uri" => $baseApis->getBaseUrl(), "verify" => false]);
        try {
            $response = $client->request($query["method"], $query["request_uri"], ["debug" => false, "headers" => [
                "Byte-Authorization" => $baseApis->authorization(),
            ], "json" => $baseApis->body(), "query" => $baseApis->params()]);
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