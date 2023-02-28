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
        return ["debug" => $this->debug, "headers" => $this->_headers, "body" =>$this->jsonData ?  json_encode($this->body(),JSON_UNESCAPED_UNICODE) : $this->body(), "query" => $this->params()];
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
        $this->setHeader("Content-Type", 'application/json');
        $this->setParams("access_token", $this->access_token);
        return $this;
    }

    protected function setHeaderToken()
    {
        $this->setHeader("access_token", $this->access_token);
        return $this;
    }


    public function jscode2session(){

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
        if($this->debug){
            echo  "<pre>";
            print_r($this->query_result);die;
        }
        if ($this->query_result["code"] == 200 && $this->query_result["status"] == "success") {
            if ($this->query_result["data"]) {
                $data = json_decode($this->query_result["data"], true);
                if(isset($data["base"])){
                    if (isset($data["base"]["biz_code"]) && $data["base"]["biz_code"] > 0) {
                        throw new BizException($data["base"]["biz_msg"]);
                    }

                    if (isset($data["base"]["gateway_code"]) && $data["base"]["gateway_code"] > 0) {
                        throw new ServiceException($data["base"]["gateway_msg"]);
                    }
                }

                if (isset($data["data"]) && $data["data"]) {
                    if(isset($data["data"]["error_code"]) && $data["data"]["error_code"] >0){
                        throw new ServiceException($data["data"]["description"]);
                    }
                    if(isset($data["category_tree_infos"]) || isset($data["category_list"]) ){
                        $this->_result = isset($data["category_tree_infos"]) ? $data["category_tree_infos"] : $data["category_list"]  ;
                    }
                    else{
                        $this->_result = $data["data"];
                    }
                } else {
                    $this->_result = $data["base"];
                }
            }
        }
        return $this->_result;
    }

}
