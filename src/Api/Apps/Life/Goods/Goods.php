<?php

namespace Iceqi\DouYin\Api\Apps\Life\Goods;

use Iceqi\DouYin\Api\Apps\Life\Life;

class Goods extends Life
{

    public function product_save()
    {
        $this->_uri = "/goods/product/save/";
        return $this;
    }

    public function product_online_list()
    {
        $this->_uri = "/goods/product/online/list/";
        $this->_method = "GET";
        $this->setParamsToken();
        return $this;
    }

    public function product_online_get($id)
    {
        $this->_uri = "/goods/product/online/get/";
        $this->_method = "GET";
        $this->setParams("out_ids", $id);
        $this->setParamsToken();
        return $this;
    }

    public function product_draft_list()
    {
        $this->_uri = "/goods/product/draft/list/";
        $this->_method = "GET";
        $this->setParamsToken();
        return $this;
    }

    public function sku_batch_save()
    {
        $this->_uri = "/goods/sku/batch_save/";
        $this->setParamsToken();
        return $this;
    }

    public function operate()
    {
        $this->_uri = "/goods/product/operate/";
        $this->setParamsToken();
        return $this;
    }

    public function goods_stock_sync()
    {
        $this->_uri = "/goods/stock/sync/";
        $this->setParamsToken();
        return $this;
    }

    public function goods_category_get($category_id = 0)
    {
        $this->_uri = "/goods/category/get/";
        $this->setParams("category_id", $category_id);
        $this->setParamsToken();
        $this->_method = "GET";
        return $this;
    }

    public function goods_sku_get($product_id, $sku_out_ids = 0)
    {
        $this->_uri = "/goods/category/get/";
        $this->setParams("sku_out_ids", $sku_out_ids);
        $this->setParams("product_id", $product_id);
        $this->setParamsToken();
        $this->_method = "GET";
        return $this;
    }

    public function getTemplate($category_id, $product_type)
    {
        $this->_uri = "/goods/template/get/";
        $this->setParams("category_id", $category_id);
        $this->setParams("product_type", $product_type);
        $this->setParamsToken();
        $this->_method = "GET";
        return $this;
    }
}