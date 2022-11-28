<?php

namespace Iceqi\DouYin\Api\Apps\Poi\V2;

use Iceqi\DouYin\Api\Apps\Poi\Poi;

class Supplier extends Poi
{


    public function match()
    {
        $this->title = "商户匹配";
        $this->_uri = "/v2/supplier/match";
        $this->setParamsToken();
        return $this;
    }

    public function sync()
    {
        $this->title = "商户同步";
        $this->setHeaderToken();
        $this->_uri = "/supplier/sync/";
        return $this;
    }

    public function query($supplier_ext_id)
    {
        $this->setHeaderToken();
        $this->setParams("supplier_ext_id", $supplier_ext_id);
        $this->_uri = "/supplier/query";
        $this->_method = "GET";
        return $this;
    }

    public function query_task($supplier_task_ids)
    {
        $this->setHeaderToken();
        $this->setParams("supplier_task_ids", $supplier_task_ids);
        $this->_uri = "/v2/supplier/query/task/";
        $this->_method = "GET";
        return $this;
    }
}