<?php
/*********文件描述*********
 * @last      update 2015/12/4 13:43
 * @author    邹广圆 zouguangyuan@300.cn
 *
 *
 * 功能简介：微信素材管理 创建、删除、修改、获取 临时/永久素材
 * @author    邹广圆 zouguangyuan@300.cn
 * @copyright 中企动力vone+移动研发部
 * @version   2015/12/4 13:43
 */

namespace Weixin\Controller;

use Think\Controller;

class ResourceManagerController extends Controller
{
    public function __construct()
    {
        parent::__construct();
//        $this->cache = \Alibaba::cache();
//        $this->token = $this->cache->get('ACCESS_TOKEN');
    }

//    临时素材创建
    public function tempResourceCreate()
    {
//        $url = 'https://api.weixin.qq.com/cgi-bin/media/upload?access_token=' . $this->token . '&type=image';
//        $file = array(
//            'filename' => '/ace/app/webroot/Public/Weixin/img/doge.jpg',
//            'content-type' => 'image/jpeg',
//            'filelength' => '8488',
//        );
        dump($_SERVER);exit;
//        $data = array(
//            'media' => '/ace/app/webroot/Public/Weixin/img/doge.jpg',
//            'form-data' => $file,
//        );

        $res = json_decode(http($url,json_encode($data),'post',true),true);
        dump($res);
    }
}