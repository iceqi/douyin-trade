<?php

namespace Iceqi\DouYin\Api\Apps\Trade\V2;

use Iceqi\DouYin\Api\Apps\Trade\TradeV2;

class Settings extends TradeV2
{
    public function send()
    {
        $this->title = "配置信息保存";

        $this->_uri = "/settings";
        return $this;
    }

    public function query()
    {        $this->title = "配置信息设置";

        $this->_uri = "/query_settings";
        return $this;
    }
}