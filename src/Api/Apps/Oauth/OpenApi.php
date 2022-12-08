<?php

namespace Iceqi\DouYin\Api\Apps\Oauth;

use Iceqi\DouYin\Api\Apps\TouTiao;
use Iceqi\DouYin\Api\Exceptions\BizException;
use Iceqi\DouYin\Api\Exceptions\ServiceException;

class OpenApi extends TouTiao
{
    protected $base_path = "/api/apps/v2";

    public function requestOptions()
    {
        return ["debug" => $this->debug, "headers" => $this->_headers, "json" => $this->body()];
    }

    public function setAppId($appId)
    {
        $this->setBody("appid", $appId);
        return $this;
    }

    public function getToken()
    {
        $this->title = "获取TouTiao-OpenApi-Token";

        $this->_uri = "/token";
        return $this;
    }

    public function result()
    {
        if ($this->query_result["code"] == 200 && $this->query_result["status"] == "success") {
            if ($this->query_result["data"]) {
                $data = json_decode($this->query_result["data"], true);
                if (isset($data["base"]) && $data["base"]["biz_code"] > 0) {
                    throw new BizException($this->title . "-错误: " . $data["base"]["biz_msg"]);
                }
                if (isset($data["base"]) && $data["base"]["gateway_code"] > 0) {
                    throw new ServiceException($this->title . "-错误: " . $data["base"]["gateway_msg"]);
                }
                if (isset($data["err_no"]) && $data["err_no"] > 0) {
                    throw new BizException($this->title . "-错误: " . $data["err_tips"]);
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