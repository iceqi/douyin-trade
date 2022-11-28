<?php

namespace Iceqi\DouYin\Api\Apps\Trade\V2;

use Iceqi\DouYin\Api\Apps\Trade\TradeV2;

class Settle extends TradeV2
{

    public function create()
    {
        $this->title = "创建分账";
        $this->_uri = "/create_settle";
        return $this;
    }

    public function query()
    {
        $this->title = "查询分账";
        $this->_uri = "/query_settle";
        return $this;
    }
}