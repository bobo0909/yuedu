<?php

namespace App\Http\Controllers\login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;

class LoginController extends Controller
{
    public function register(){
        return view('Login/register');
    }
    public function registerto(){
        $data = $_POST;
        unset($data['_token']);
        if ($data['password'] != $data['password2']){
            dd('密码不一致');
        }else{
            unset($data['password2']);
            $data['password'] = md5($data['password']);
        }
        $res=User::insert($data);
        if ($res){
            return redirect("/Login/login");
        }else{
            return redirect("/Login/register");
        }

    }
    public function Login(){
        return view('Login/login');
    }
    public function Loginto(){
     $data=\request()->all();
        if ($data['name'] == ''){
    echo '<script>alert("用户名不能为空");window.location.href="/Login/login";</script>';
    }
        if ($data['password'] == ''){
    echo '<script>alert("密码不能为空");window.location.href="/Login/login";</script>';
    }
         $Info = User::where(['name'=>$data['name']])->first();
        if ($Info == ""){
        echo '<script>alert("用户名不存在");window.location.href="/Login/login";</script>';
    }
        if ($Info['password'] == md5($data['password'])){
              echo '<script>alert("登录成功");window.location.href="/Index/index";</script>';
        }else{
    echo '<script>alert("密码错误");window.location.href="/Login/login";</script>';
        }     
    }
}
