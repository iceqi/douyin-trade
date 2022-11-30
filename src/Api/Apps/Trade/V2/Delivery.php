<?php

namespace Iceqi\DouYin\Api\Apps\Trade\V2;

use Iceqi\DouYin\Api\Apps\Trade\TradeV2;

class Delivery extends TradeV2
{
    public function push()
    {
        $this->title = "发起核销";

        $this->_uri = "/push_delivery";
        return $this;
    }
}