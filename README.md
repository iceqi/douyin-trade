
# 抖音生活服务开放平台 api

### 使用方法

```phpregexp
获取token 方法

$oauth = new \Iceqi\DouYin\Api\Apps\Oauth\Oauth();
$oauth->grant_type = "xxx";
$oauth->client_key = "xxx";
$oauth->client_secret = "xxx";
$oauth->client_token();
$result = (new \Iceqi\DouYin\Client())->request($oauth)->result();
    
```

```phpregexp
查询商品草稿数据

$goods = new Iceqi\DouYin\Api\Apps\Life\Goods\Goods();

$goods->setToken($access_token)->product_draft_list();

$result = (new \Iceqi\DouYin\Client())->request($goods)->result();

```

```phpregexp
商铺同步 方法
$supplier = new Iceqi\DouYin\Api\Apps\Poi\V2\Supplier();
$supplier->contact_phone = "xxx";
$supplier->contact_tel	 = "xxx";
$supplier->images	 = ["http://xxx.aaa.com/aaa.jpg"];
$supplier->merchant_uid = ["http://xxx.aaa.com/aaa.jpg"];
$supplier->setToken($access_token)->sync();
$result = (new \Iceqi\DouYin\Client())->request($supplier)->result();

```

可能接口文档整理的不全，后续不断更新
