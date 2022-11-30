
# 抖音生活服务开放平台 api

### 使用方法

# 验证（Token）
```phpregexp
获取token 方法
try {


    $oauth = new \Iceqi\DouYin\Api\Apps\Oauth\Oauth();
    $oauth->grant_type = "client_credential";
    $oauth->client_key = "xxx";
    $oauth->client_secret = "xxx";
    $result = $oauth->client_token()->doQuery()->result();


    print_r($result);die;

} catch (\Iceqi\Douyin\Api\Exceptions\DouYinException $exception) {
 
    Log::error($exception->getMessage()  . '接口异常');

}
    
```


# 商户（Supplier）
```phpregexp
商铺同步 方法
$suppler = (new \Iceqi\DouYin\Api\Apps\Poi\V2\Supplier());
$suppler->supplier_ext_id = xxx;
$suppler->status = 1;
$suppler->name = xxx;
$suppler->shopid = xxx;
$suppler->type =  xxx;
$suppler->poi_id =  xxx;
$suppler->attributes = (object)[];
$result = $suppler->setToken($this->DouYinToken())->sync()->doQuery()->result();
```

# 商品（Goods）
```phpregexp
查询商品草稿数据

$goods = new Iceqi\DouYin\Api\Apps\Life\Goods\Goods();

$result = $goods->setToken($access_token)->product_draft_list()->doQuery()->result();


```

# 交易（Trade）
```phpregexp
订单退款
如果是交易（Trade）接口则必须要传appid 无需传递token
$refund = new \Iceqi\DouYin\Api\Apps\Trade\V2\Refund();
$refund->trade("appid");
$refund->out_order_no = $data["out_order_no"];
$refund->out_refund_no = $data["out_refund_no"];
$refund->order_entry_schema = ["path" => "pages/paymentSucess/paymentSucess"];
$refund->notify_url = "xxx";
$refund->item_order_detail = $data["item_order_list"];
```


可能接口文档整理的不全，后续不断更新
