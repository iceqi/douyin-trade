<?php

namespace Iceqi\DouYin\Api\Apps\Poi;

class Plan extends Poi
{
    public function save()
    {
        $this->title = "保存cps";
        $this->_uri = "/common/plan/save/";
        $this->setHeader("access-token",$this->access_token);
        return $this;
    }

    public function plan_list($spu_id, $page_no = 1, $page_size = 10)
    {
        $this->title = "获取cps";
        $this->_uri = sprintf("/plan/list/?spu_id=%s&page_no=%d&page_size=%d", $spu_id, $page_no, $page_size);

        $this->setHeader("access-token",$this->access_token);
        return $this;
    }
}