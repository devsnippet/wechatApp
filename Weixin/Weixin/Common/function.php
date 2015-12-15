<?php

/**
 * xml转json
 *
 * @param xml string xml文本
 *
 * @return string json文本
 *
 * @author   邹广圆 中企动力移动平台业务部
 * @datetime 2015-12-01 13:30
 */
function xmlToJson($xml)
{
    $xmlObj = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);

    return json_encode($xmlObj);
}

/**
 * 执行curl请求
 *
 * @param string  url    要请求的url地址
 * @param array   param  要携带的参数
 * @param string  method 请求类型 get/post
 * @param boolean weixin 是否为微信请求
 *
 * @return string 返回值为字符串，请求成功返回请求之后获取的值，请求失败返回失败原因
 * @author   邹广圆 中企动力移动平台业务部
 * @datetime 2015-12-02 12:08
 */
function http($url, $param = '', $method = 'get', $weixin = true)
{
    $xhr = curl_init();
    $xhrOpts = array(
        CURLOPT_HEADER         => 0,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL            => $url,
    );

//        判断method
    if ($method == 'get') {
        $xhrOpts[CURLOPT_HTTPGET] = 1;
    } else {
        $xhrOpts[CURLOPT_POST] = 1;
        if($method == 'post' && $param !== ''){
            //    判断是否携带参数
            $xhrOpts[CURLOPT_POSTFIELDS] = $param;
        }
    }

//        判断是否为微信请求
    if ($weixin) {
        $xhrOpts[CURLOPT_SSL_VERIFYPEER] = false;
        $xhrOpts[CURLOPT_SSL_VARIFYHOST] = false;
    }

    curl_setopt_array($xhr, $xhrOpts);
    $res = curl_exec($xhr);
    $dores = $res ? $res : curl_error($xhr);
    curl_close($xhr);

    return $dores;
}

/**
 * @params array  cont   原始数据数组
 * @return string 转为json后且保存为中文的字符串
 */
function chineseStringSave(array $cont){
    array_walk_recursive($cont,function(&$v){
        $v = urlencode($v);
    });

    $res = urldecode(json_encode($cont));
    return $res;
}