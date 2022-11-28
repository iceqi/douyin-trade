<?php

namespace Iceqi\DouYin\Api\Apps\Trade;

use Iceqi\DouYin\Api\BaseApis;
use Iceqi\DouYin\Api\Exceptions\BizException;
use Iceqi\DouYin\Api\Exceptions\ServiceException;
use Iceqi\DouYin\Query;

class TradeV2 extends BaseApis
{

    protected $timestamp;
    protected $nonce_str;
    protected $body;
    private $base_path = "/api/apps/trade/v2";
    protected $base_url = "https://developer.toutiao.com";

    public function trade($app_id = false)
    {
        $this->appId = $app_id;
        $this->timestamp = time();
        $this->nonce_str = strtoupper($this->nonceStr());
        return $this;
    }

    public function getBaseUrl()
    {
        return $this->base_url;
    }

    public function debug()
    {
        $this->debug = true;
    }

    public function requestOptions()
    {
        return ["debug" => $this->debug, "headers" => [
            "Byte-Authorization" => $this->authorization(),
        ], "json" => $this->body(), "query" => $this->params()];
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
        return $this->request_uri = $this->base_path . $this->_uri;;
    }


    public function authorization()
    {
        $str = sprintf(' SHA256-RSA2048 appid="%s",nonce_str="%s",timestamp="%s",key_version="%s",signature="%s"', $this->appId, $this->nonce_str, $this->timestamp, "1", $this->sign());
        return $str;
    }


    public function sign()
    {
        $text = strtoupper($this->_method) . "\n" . $this->request_uri . "\n" . $this->timestamp . "\n" . $this->nonce_str . "\n" . json_encode($this->body) . "\n";
        $priKey = '-----BEGIN RSA PRIVATE KEY-----
MIIEpAIBAAKCAQEAvbyNqqpWdSmK8aPFaZYPNntajsQdI9XkAntVn8tO1Pqkc1c/
si6+JDmzL1u664vD5pAHobeJmSZWJJo8Q9KY0mlf/pgLQy78fYWt0+FB0Jw/wqmO
Lf5I0CJdblp/AkG1XBWk/Y+mwShdeCEtyTIuAI9jzfxdPhFOD6+AeJrdf3rEPnQF
g53CflG02Qxj0n7qabFSJZlkYUkgfb7pAuf+b6WZtqW39Bp4A2MZ0DX3KfrokhFJ
d8PVt3w2VoRognE4QPLnp4yZgA5N0algjPDjpUL95IHJJDyUlbKM3zo6wAFsnYYb
WNy5CX93byst4vu8332whLw+ISkpxzwrrppEdwIDAQABAoIBAGBTcbjLcclZpei3
tGm+fUqzpW4FsqWW2YNJCldt6D/IX+UOzo+vm2jYwlewwl0DQBm11aoMfBb8l49N
nnrwWBW62blvh4g8OoOfcni3S6qVKOmzGzPOfTjtuXFlEEYdBe4SLwlr/MTjsVBj
x9L1XtV59rmE/fGc53yfJSIVvY4R7fLACShTejp1yq/aNPaYlXWfpjdHGFFNG8om
LmPghOLtEnpwJMqJT81VTh0ctAmNZIeBKq8Yq8RWe0ypjK84QuHN7pifnI6hX0uG
o8nmSU8n0hghpEod+C0vq/fV0MP/FsuIQUl+PaBfk9loH0WdvwmQRkG0aF9FM32t
fnM6q4ECgYEA30O6YF3NvpFVObiEHwNfNew0+6JppTq6AZ90pbvTqhP/bVvh3Gvs
tSXMWb2/E786z9pyMRqNiSiAI2ZYk8ff20Fmo+Gwr+Mk0pbv+9o3Hf8lQ570nI6w
HnlswqZ+3ZgJof5MLt1TYjANcFGlGWeUR5SHUz3APnU4OHLa57lx+O8CgYEA2Y5Y
bCWH2vJ23uxMJ990Tz+1XkbDC/dOU89RRpXwAdmiMTiVNMN4GXs/v77qOvWKvqCO
hT/y0I0+bmHSoUOroV415wXzI8tW0N+z655lqmaF3boLBDzlBNQCoF6DCbzOCXKb
gpj2axxv10fnRHMOSxKVuiVbFSAcYMfI467LHPkCgYB8K63fZKxF/YxZwt5wZS6x
zcIV5Vk+VPAYcPeuKU1qPR8FUmHGdpu6j+AcVSSNNgDekw6Jcswe6VCC36wJ3NMK
nVAZey8KU5kqKlokR1P6MeomtqQy4kTfXgb4JyNN2P4ag1UZh2yVokYHHtFk1K+q
M9gjmqdt1UHEW1SWJhRWLwKBgQDKiqF7nb1Lc6yDgg6smHaaST+7U7nG7Cj6Eesj
Afh+YHWFyZ3vj4PChWImS8GZvnu7WZMWLyEKVFUpQt1r0ap6A1G/kWR5kJd0wq+o
zsDr0aMTeF9FRMQaqJ8BWrw4VpSjaxWokmvn8IOXM5P1wAAwmE7ZDGot0sVYvOck
QdlLUQKBgQCd0AxUlJJxADF5JG1zyJvgGRsrQKqvPl7YAzZOIcy0vsQG4UB7IOSq
gK1+zV8o8l4CCFUC80pmgAhqcRf3+fVZi9Ii0F/Y+1HQJycVZcpU0bLmzKFLB2t3
10w459j3szjfaSUsBaUMeYSar/c/XNC9ojUy3tPQaRN7Aw+hEHqT5g==
-----END RSA PRIVATE KEY-----';
        $privateKey = openssl_get_privatekey($priKey, '');
        openssl_sign($text, $sign, $privateKey, OPENSSL_ALGO_SHA256);
        $sign = base64_encode($sign);
        return $sign;
    }


    private function nonceStr($length = 32)
    {
        //字符组合
        $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $len = strlen($str) - 1;
        $randstr = '';
        for ($i = 0; $i < $length; $i++) {
            $num = mt_rand(0, $len);
            $randstr .= $str[$num];
        }
        return $randstr;
    }

    public function verifySign($sign)
    {
        $data = $this->timestamp . "\n" . $this->nonce_str . "\n" . json_encode($this->body) . "\n";
        $publicKey = '
-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA3yjUOuqBXU398/UsprJ4
18Gr5Fp6PwLCAmDx7ar+1XAg9gFt32wK1zQqSZVp8QCfD9dn0zODSgFogsZmRbyx
7fRQhpJn9dKwBkChGsAu0EXwngZJ9y1CW78WfS2OazA2QAK8kI9OGnAxNRFE7FiK
IrUbQPU7uDm4MOhNPzxxYl1QYmphXSIWaY9h4FZGckZgx53k4CY6sjrMyh53VZze
3RidIIVyOv01NB86WJ0FC/nhw6+zrC6oM3IsaCsmubQuJCD/8dcu23erCjS918Du
P/S3plTWHd787NM0yH61C1m0E3ZI2gNIoxzVeK0LzzLOSLFPda0UPPayVhv88Krr
zQIDAQAB
-----END PUBLIC KEY-----';
        if (!$publicKey) {
            return null;
        }
        $res = openssl_get_publickey($publicKey);
        $result = (bool)openssl_verify($data, base64_decode($sign), $res, OPENSSL_ALGO_SHA256);
        openssl_free_key($res);
        return $result;  //bool
    }


    public function result()
    {
        if ($this->query_result["code"] == 200 && $this->query_result["status"] == "success") {
            if ($this->query_result["data"]) {
                $data = json_decode($this->query_result["data"], true);

                if ($data["err_no"] > 0) {
                    throw new BizException($this->title . "错误: " . $data["err_tips"]);
                } else {
                    $this->_result = $data["data"];
                }
            }
        }
        return $this->_result;
    }

}