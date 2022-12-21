<?php

namespace Iceqi\DouYin\Api\Apps\Trade\V2;

use Iceqi\DouYin\Api\Apps\Trade\TradeV2;

class Cps extends TradeV2
{
    public function query(){
        $this->title = "查询CPS订单信息";
        $this->_uri ="/query_cps";
        return $this;
    }
}