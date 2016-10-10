<?php/** * Created by PhpStorm. * User: xiaomo * Date: 2016/8/25 * Time: 13:51 */namespace Home\Controller;use Think\Controller;class UserController extends Controller{    public function index()    {        $this->redirect('User/login');    }    /*     * 登录     */    public function login()    {        // 从cookie中读取用户名        $login = cookie('log_login');        if ($login) {            session("user", explode('|', $login)[0]);            $this->redirect('Index/index');        } else $this->display();    }    public function checkLogin()    {        if (!isset($_POST['user']) || !isset($_POST['psw']) || !isset($_POST['remember'])) exit("GG");        // 检查用户名密码        $user = $_POST['user'];        $psw = $_POST['psw'];        $where['user'] = array('eq', "$user");        $msg = M('user')->where($where)->find();        if (empty($msg)) exit('{"err": 0, "message": "用户名不存在"}');        if ($msg['psw'] == $psw) { // 登录成功            if ($_POST['remember'] == "true") cookie('log_login', $user . '|' . $psw, 3600 * 24 * 7);            session("user", $user);            // 登录成功跳转url            $redirectUrl = '/log/Home/Index/index';            if (session('redirect_to')) {                $redirectUrl = session('redirect_to');                session('redirect_to', null);            }            echo '{"err": 1, "redirect_to": "' . $redirectUrl . '"}';        } else echo '{"err": 0, "message": "密码不正确"}';    }    /*     * 注册     */    public function register()    {        $this->display();    }    public function checkRegister()    {        if (!isset($_POST['user']) || !isset($_POST['psw'])) exit("GG");        // 检查用户名是否存在        $where['user'] = array('eq', "{$_POST['user']}");        $msg = M('user')->where($where)->select();        if (!empty($msg)) exit("注册失败，用户名已被占用");        // 注册        $data['user'] = $_POST['user'];        $data['psw'] = $_POST['psw'];        $result = M("user")->add($data);        if ($result > 0) echo "success";        else echo "注册失败，用户名已被占用";    }    /*     * 退出     */    public function logout()    {        cookie("log_login", null);        session(null);        $this->redirect('User/login');    }}