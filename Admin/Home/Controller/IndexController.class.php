<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends Controller
{
//    主页显示
    public function index()
    {
        if (session('user')) {
            $this->display('Index/index');
        } else {
            $this->display('Index/login');
        }
    }

//    登录执行
    public function login()
    {
        $userLogin = D('User');
        $usr = I('post.username');
        $pwd = I('post.pwd');
        $where['username'] = $usr;
        $where['password'] = $pwd;
        $field = array('level');
        $qx = $userLogin->where($where)->field($field)->select(); // 获取权限级别
        var_dump($qx);
    }

//    用户创建
    public function create()
    {
        $pwd = 'createuserbymrz';
        if (I('get.s') == $pwd) {
            $this->display('Index/create');
        } else {
            $this->error('非法操作！', '/');
        }
    }

//    用户创建执行
    public function doCreate()
    {
        $user = D('User');          // UserModel

        $data['username'] = I('post.username');  // username 用户名
        $data['password'] = $this->passwordEncrypt(I('post.password'));  // password 密码
        $data['level'] = I('post.level');   // level    用户级别
        $data['create_time'] = time();

//        判断用户是否创建成功
        if ($user->create($data)) {
            if ($user->add()) {
                $this -> ajaxReturn(array('res' => 1));
            } else {
                $this -> ajaxReturn(array('res' => 0));
            }
        }else{
            $this -> ajaxReturn(array('res' => 2));
        }
    }

//  密码重置
    public function repwd()
    {
        echo '密码重置';
//        $this -> display('Index/Forgot');
    }

//    密码创建
    private function passwordEncrypt($pwd)
    {
        return md5(md5(trim($pwd)));
    }
}