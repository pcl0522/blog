<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class IndexController extends CommonController
{
    public function index()
    {
        return view('admin.index');
    }
    public function logout()
    {
        session(['admin'=>null]);
        return redirect('admin/login');
    }
    public function indexInfo()
    {
        return view('admin.index_info');
    }

    /**
     * 修改密码
     */
    public function updatepwd()
    {
        if($input=Input::all()){

            $rules=[
                'password'=>'required|between:6,20|confirmed',
            ];
            $massage=[
                'password.required'=>'0',//新密码不能为空
                'password.between'=>'1',//新密码长度必须在6－20位之间
                'password.confirmed'=>'2'//新密码长度必须在6－20位之间
            ];
           $validator= Validator::make($input,$rules,$massage);
            if ($validator->passes()){
                $admin=Admin::first();
                $_password=Crypt::decrypt($admin->password);

                if($input['password_old']==$_password){
                    $admin->password=Crypt::encrypt($input['password']);

                    if($admin->update()) return back()->with('msg','0');//
                }else{
                    return back()->withErrors('4');//原密码错误
                }

            }else{

                return back()->withErrors($validator);

            }
        }else{
            return view('admin.update_password');
        }

    }
}
