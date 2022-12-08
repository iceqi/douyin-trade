<?php

namespace Iceqi\DouYin\Api\Apps\Trade;

use Iceqi\DouYin\Api\Apps\TouTiao;
use Iceqi\DouYin\Api\Exceptions\BizException;

class TradeV2 extends TouTiao
{
    protected $base_path = "/api/apps/trade/v2";

    public function result()
    {
        if ($this->query_result["code"] == 200 && $this->query_result["status"] == "success") {
            if ($this->query_result["data"]) {
                $data = json_decode($this->query_result["data"], true);

                if ($data["err_no"] > 0) {
                    throw new BizException($this->title . "错误: " . $data["err_tips"]);
                } else {
                    if(isset($data["data"])){
                        $this->_result = $data["data"];
                    }
                    else{
                        $this->_result = $data["err_tips"];
                    }
                }
            }
        }
        return $this->_result;
    }

}