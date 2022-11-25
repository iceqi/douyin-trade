<?php

namespace Iceqi\Douyin\Api\Apps\Trade\V2;

use Iceqi\DouYin\Api\Apps\Trade\TradeV2;

class Settle extends TradeV2
{

    public function create(){
        $this->_uri = "/create_settle";
        return $this;
    }

    public function query(){
        $this->_uri = "/query_settle";
        return $this;
    }
}