<?php

namespace Iceqi\DouYin\Api\Apps\Life\Goods;

use Iceqi\DouYin\Api\Apps\Life\Life;

class Goods extends Life
{
    /***
     * 创建或更新商品。
     * 对于同一服务商，相同的 out_id 会被认为是同一商品，重复创建会被覆盖。
     * @return $this
     */
    public function product_save()
    {
        $this->title = "创建或更新商品";

        $this->_uri = "/goods/product/save/";
        $this->setParamsToken();
        return $this;
    }

    public function product_online_list()
    {

        $this->title = "获取线上产品列表";
        $this->_uri = "/goods/product/online/list/";
        $this->_method = "GET";
        $this->setParamsToken();
        return $this;
    }


    /***
     * 获取线上产品
     * @param $id
     * @return $this
     */
    public function product_online_get($id)
    {

        $this->title = "获取线上产品";
        $this->_uri = "/goods/product/online/get/";
        $this->_method = "GET";
        $this->setParams("out_ids", $id);
        $this->setParamsToken();
        return $this;
    }

    /***
     * 查看审核以及草稿产品
     * @return $this
     */
    public function product_draft_list()
    {

        $this->title = "查看审核以及草稿产品";
        $this->_uri = "/goods/product/draft/list/";
        $this->_method = "GET";
        $this->setParamsToken();
        return $this;
    }

    public function sku_batch_save()
    {

        $this->title = "批量同步sku 产品";
        $this->_uri = "/goods/sku/batch_save/";
        $this->setParamsToken();
        return $this;
    }

    /***
     * 上下架商品。
     * @return $this
     */
    public function operate()
    {

        $this->title = "上下架商品";
        $this->_uri = "/goods/product/operate/";
        $this->setParamsToken();
        return $this;
    }

    public function goods_stock_sync()
    {

        $this->title = "同步产品库存";
        $this->_uri = "/goods/stock/sync/";
        $this->setParamsToken();
        return $this;
    }

    public function goods_category_get($category_id = 0)
    {

        $this->title = "根据分类获取goods列表";
        $this->_uri = "/goods/category/get/";
        $this->setParams("category_id", $category_id);
        $this->setParamsToken();
        $this->_method = "GET";
        return $this;
    }

    public function goods_sku_get($product_id, $sku_out_ids = 0)
    {

        $this->title = "根据分类获取sku列表";
        $this->_uri = "/goods/category/get/";
        $this->setParams("sku_out_ids", $sku_out_ids);
        $this->setParams("product_id", $product_id);
        $this->setParamsToken();
        $this->_method = "GET";
        return $this;
    }

    public function getTemplate($category_id, $product_type)
    {

        $this->title = "获取分类模板";
        $this->_uri = "/goods/template/get/";
        $this->setParams("category_id", $category_id);
        $this->setParams("product_type", $product_type);
        $this->setParamsToken();
        $this->_method = "GET";
        return $this;
    }

    public function validTemplate($template, $valid_data, $attr = "product_attrs")
    {
        $result = [];
        $template_data = json_decode($template["data"], true);
        $data = $template_data["data"][$attr];
        foreach ($data as $k => $v) {

            if ($v['is_required'] == 1) {
                if (!$valid_data[$v["key"]]) {
                    $result["error"][$v["key"]]= $v["name"] . "不能为空";
                    continue;
                }
            }
            if(isset($valid_data[$v["key"]]) && $valid_data[$v["key"]]){
                if ($v["is_multi"] == 1){
                    $result["data"][$v["key"]] = json_encode($valid_data[$v["key"]]);
                    continue;
                }

                if( in_array($v["value_type"],["BOOL","STRING","INT64"])){
                    $result["data"][$v["key"]] = strval($valid_data[$v["key"]]);
                    continue;
                }

                if($v["value_type"] == "DOUBLE"){
                    $result["data"][$v["key"]] = doubleval($valid_data[$v["key"]]);
                    continue;
                }
            }
        }
        return $result;
    }
}