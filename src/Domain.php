<?php

namespace Sxin\Baidu\Bcd;

use Sxin\Baidu\Bcd\Support\Core;

class Domain extends Core
{
    public function __construct(string $access, string $secret)
    {
        $this->access = $access;
        $this->secret = $secret;
    }


    /**
     * 更新域名解析记录
     * https://cloud.baidu.com/doc/BCD/s/4jwvymhs7#%E6%9B%B4%E6%96%B0%E5%9F%9F%E5%90%8D%E8%A7%A3%E6%9E%90%E8%AE%B0%E5%BD%95
     * @param array $body
     * @return bool|string
     */
    public function domain_resolve_edit(array $body)
    {
        $url = 'https://bcd.baidubce.com/v1/domain/resolve/edit';
        $method = 'POST';
        $x_bce_date = $this->x_bce_date();
        $header = [
            'x-bce-date'    => $x_bce_date,
            'Authorization' => $this->authorization($x_bce_date, $url, $method),
            'Content-Type'  => 'application/json; charset=utf-8'
        ];
        return $this->curl($url, $method, [], $body, $header);
    }


    /**
     * 查询域名解析记录列表
     * https://cloud.baidu.com/doc/BCD/s/4jwvymhs7#%E6%9F%A5%E8%AF%A2%E5%9F%9F%E5%90%8D%E8%A7%A3%E6%9E%90%E8%AE%B0%E5%BD%95%E5%88%97%E8%A1%A8
     * @param string $domain
     * @param $pageNo
     * @param $pageSize
     * @return bool|string
     */
    public function domain_resolve_list(string $domain, int $pageNo = 1, int $pageSize = 10)
    {
        $url = 'https://bcd.baidubce.com/v1/domain/resolve/list';
        $method = 'POST';
        $x_bce_date = $this->x_bce_date();
        $body = [
            'domain'   => $domain,
            'pageNo'   => $pageNo,
            'pageSize' => $pageSize,
        ];
        $header = [
            'x-bce-date'    => $x_bce_date,
            'Authorization' => $this->authorization($x_bce_date, $url, $method),
            'Content-Type'  => 'application/json; charset=utf-8'
        ];
        return $this->curl($url, $method, [], $body, $header);
    }


    /**
     * 域名列表
     * https://cloud.baidu.com/doc/BCD/s/4jwvymhs7#%E5%9F%9F%E5%90%8D%E5%88%97%E8%A1%A8
     * @param int $pageNo
     * @param int $pageSize
     * @param array $query
     * @return bool|string
     */
    public function domain(int $pageNo = 1, int $pageSize = 10, array $query = [])
    {
        $url = 'https://bcd.baidubce.com/v2/domain';
        $method = 'GET';
        $query['pageNo'] = $pageNo;
        $query['pageSize'] = $pageSize;
        $x_bce_date = $this->x_bce_date();
        $header = [
            'x-bce-date'    => $x_bce_date,
            'Authorization' => $this->authorization($x_bce_date, $url, $method, $query),
        ];
        return $this->curl($url, $method, $query, [], $header);
    }

}