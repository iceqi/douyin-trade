<?php

namespace Iceqi\DouYin\Api\Apps\Trade\V2;

use Iceqi\DouYin\Api\Apps\Trade\TradeV2;

class Refund extends  TradeV2
{
    public function create(){
        $this->_uri ="/create_refund";
        return $this;
    }

    public function merchant_audit_callback(){
        $this->_uri ="/merchant_audit_callback";
    }

    public function query(){
        $this->_uri ="/query_refund";
    }
}