# 百度域名服务 BCD

> 百度智能云文档 [https://cloud.baidu.com/doc/BCD/s/pjwvymihl](https://cloud.baidu.com/doc/BCD/s/pjwvymihl)

## 功能
- [x] 域名列表
- [x] 查询域名解析记录列表
- [x] 更新域名解析记录

## DEMO

```php
// 这里的变量注释名 就是百度文档API总述中的签名认证中的Access Key ID 和 Secret Access Key
// https://cloud.baidu.com/doc/BCD/s/pjwvymihl#%E7%AD%BE%E5%90%8D%E8%AE%A4%E8%AF%81
$access = 'f7be7cbexxxxxxxxxxxxxxxxx7789770';   // Access Key ID
$secret = '29dbe98dxxxxxxxxxxxxxxxxx76a6381';   // Secret Access Key

$bcd = new \Sxin\Baidu\Bcd\Domain($access, $secret);

/*域名列表*/
$res = $bcd->domain();
var_dump($res);
// {"totalCount":1,"result":[{"domain":"jsx6.com",...}]}

/*查询域名解析记录列表*/
$domain = 'jsx6.com';   // json_decode($res)[0]['domain']
$res = $bcd->domain_resolve_list($domain);
var_dump($res);
// {"orderBy":"domain","order":"desc","pageNo":1,"pageSize":10,"totalCount":23,"result":[{"recordId":21311111,"domain":"wiki","view":"DEFAULT","rdtype":"A","ttl":300,"rdata":"104.225.155.118","zoneName":"jsx6.com","status":"RUNNING"}]}

/*更新域名解析记录*/
$body = [
    'domain'   => 'wiki',
    'rdType'   => 'A',
    'view'     => 'DEFAULT',
    'rdata'    => '104.225.155.118',
    'ttl'      => 300,
    'zoneName' => 'jsx6.com',
    'recordId' => 21311111,
];
$res = $bcd->domain_resolve_edit($body);
```

## 联系我

<img src="https://github.com/sxin0/baidu-bcd-domain/assets/29392026/3a570922-9100-4a72-9ad4-41214c5226f1" alt="Image" width="375" height="672">

