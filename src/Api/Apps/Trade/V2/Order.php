<?php

namespace Iceqi\DouYin\Api\Apps\Trade\V2;

use Iceqi\DouYin\Api\Apps\Trade\TradeV2;

class Order extends TradeV2
{

    public function create(){

        $this->title = "创建订单";
        $this->_uri ="/create_order";
        return $this;
    }
}