
# 抖音生活服务开放平台 api

### 使用方法

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

```phpregexp
查询商品草稿数据

$goods = new Iceqi\DouYin\Api\Apps\Life\Goods\Goods();

$result = $goods->setToken($access_token)->product_draft_list()->doQuery()->result();


```

```phpregexp
商铺同步 方法
$supplier = new Iceqi\DouYin\Api\Apps\Poi\V2\Supplier();
$supplier->contact_phone = "xxx";
$supplier->contact_tel	 = "xxx";
$supplier->images	 = ["http://xxx.aaa.com/aaa.jpg"];
$supplier->merchant_uid = xxx;
$supplier->setToken($access_token)->sync();
$result =  $supplier->sync()->result();

```

可能接口文档整理的不全，后续不断更新
