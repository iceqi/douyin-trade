<?php

namespace Iceqi\DouYin\Api\Apps\Ka\Api;

use Iceqi\DouYin\Api\Apps\TouTiao;
use Iceqi\DouYin\Api\Exceptions\BizException;
use Iceqi\Douyin\Api\Exceptions\DouYinException;

class Material extends TouTiao
{
    protected $base_path = "/ka/api";
    protected $access_token;
    private $secret;


    public function add_shop_material()
    {
        $this->title = "提交商铺资质材料";
        $this->_uri = "/add_shop_material";
        $this->getToken();
        return $this;
    }

    public function query_shop_material()
    {
        $this->title = "查询商铺资质材料的状态";
        $this->_uri = "/add_shop_material";
        $this->getToken();
        return $this;
    }

    public function upload_qualification()
    {
        $this->title = "上传资格证";
        $this->setBody("material_type", 7);
        $this->upload_shop_material();
        return $this;
    }

    public function upload_authorise()
    {
        $this->title = "上传授权证书";
        $this->setBody("material_type", 8);
        return $this;
    }

    public function upload_shop_material()
    {
        $this->_uri = "/upload_shop_material";
        $this->getToken();
        return $this;
    }

    public function requestOptions()
    {
        return ["debug" => $this->debug, "headers" => [
        ], "multipart" => $this->multipart()];
    }

    private function multipart()
    {
        $multipartData = [];
        $data = $this->body();

        $i = 0;
        foreach ($data as $k => $row) {
            $multipartData[$i]["name"] = $k;
            $multipartData[$i]["contents"] = $row;
            $i++;
        }
        return $multipartData;
    }

    public function getToken()
    {
        try {

            if (!$this->access_token) {
                $auth = new \Iceqi\DouYin\Api\Apps\Oauth\OpenApi();
                $auth->setAppId($this->getAppId());
                $auth->secret = $this->secret;
                $auth->grant_type = "client_credential";
                $result = $auth->getToken()->doQuery()->result();
                if (isset($result["access_token"]) && $result["access_token"]) {
                    $this->setBody("access_token", $result["access_token"]);
                }
            } else {
                $this->setBody("access_token", $this->access_token);
            }
        } catch (DouYinException $exception) {
            throw new \Exception($this->title . ":" . $exception->getMessage());
        }

    }

    public function setToken($token)
    {
        $this->access_token = $token;

        return $this;
    }


    public function result()
    {
        if ($this->query_result["code"] == 200 && $this->query_result["status"] == "success") {
            if ($this->query_result["data"]) {
                $data = json_decode($this->query_result["data"], true);
                if ($data["err_no"] > 0) {
                    throw new BizException($this->title . "-错误: " . $data["err_tips"]);
                } else {
                    if (isset($data) && $data) {
                        $this->_result = $data["path"];
                    } else {
                        $this->_result = $data["err_tips"];
                    }
                }
            }
        }
        return $this->_result;
    }

    public function setSecret($secret)
    {
        $this->secret = $secret;
        return $this;
    }

    public function setAppId($appId)
    {
        $this->appId = $appId;
        $this->setBody("appid", $appId);
        return $this;
    }

}