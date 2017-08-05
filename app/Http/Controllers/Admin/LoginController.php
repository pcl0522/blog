<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
require_once '../resources/org/code/Code.class.php';
class LoginController extends CommonController
{

    /**
     * 登录
     */
    public function login(){
        if($input=Input::all()){
            $code=new \Code();
            if(strtoupper($input['code'])!=$code->get()){

                return back()->with('msg','验证码错误！');
            }
            $admin=Admin::first();
            if($input['username']!=$admin->username||$input['password']!=Crypt::decrypt($admin->password)){
                return back()->with('msg','用户名或密码错误！');
            }
            session(['admin'=>$admin]);
            return redirect('admin/index');

        }else{
            return view('admin.login');
        }

    }


    public function code(){//验证码
        $code=new \Code;
        $code->make();
    }

}
