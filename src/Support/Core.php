<?php

namespace Sxin\Baidu\Bcd\Support;

abstract class Core
{
    protected $access;
    protected $secret;


    protected function x_bce_date()
    {
        return gmdate("Y-m-d\TH:i:s\Z");
    }

    protected function authorization($x_bce_date, $url, $method, $query = [])
    {
        $authStringPrefix = 'bce-auth-v1/' . $this->access . '/' . $x_bce_date . '/1800';
        $signingKey = hash_hmac('sha256', $authStringPrefix, $this->secret);
        $parse = parse_url($url);
        if (empty($query)) {
            $query = '';
        } else {
            $query = http_build_query($query);
        }
        $canonicalRequest = "$method\n{$parse['path']}\n{$query}\nhost:{$parse['host']}\nx-bce-date:" . urlencode($x_bce_date);
        $signature = hash_hmac('sha256', $canonicalRequest, $signingKey);
        return $authStringPrefix . '/host;x-bce-date/' . $signature;
    }

    protected function curl(string $url, string $method, array $query, array $body, array $header)
    {
        $ch = curl_init();
        if (!empty($query)) {
            $url .= '?' . http_build_query($query);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        if (!empty($body)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));

        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $headerNew = [];
        foreach ($header as $key => $val) {
            $headerNew[] = $key . ':' . $val;
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headerNew);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}