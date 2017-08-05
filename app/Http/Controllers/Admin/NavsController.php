<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Navs;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class NavsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Navs::orderBy('nav_sort','asc')->get();
        return view('admin.navs.list')->with('data',$data);
    }
    /**
     * 修改分类排序
     */
    public function changeSort(){

        $input=Input::all();
        $link=Navs::find($input['nav_id']);
        $link->nav_sort=$input['nav_sort'];
        $res=$link->update();
        if($res){
            $msg=[
                'status'=>1,
                'msg'=>'修改成功'
            ];
        }else{
            $msg=[
                'status'=>0,
                'msg'=>'修改失败'
            ];
        }
        return $msg;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.navs.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input=Input::except('_token');
        $rules=[
            'nav_name'=>'required',

        ];
        $massage=[
            'nav_name.required'=>'0',//分类名称不可为空
        ];

        $validator= Validator::make($input,$rules,$massage);
        if ($validator->passes()){
            $res=Navs::create($input);
            if($res){
                return redirect('admin/navs')->with('msg','1');
            }else{
                return back()->with('msg','0');
            }
        }else{
            return back()->withErrors($validator);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nav_id)
    {
        $nav=Navs::find($nav_id);
        return view('admin.navs.edit',compact('nav'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nav_id)
    {
        $input=Input::except(['_token','_method']);
        $rules=[
            'nav_name'=>'required',

        ];
        $massage=[
            'nav_name.required'=>'0',//分类名称不可为空
        ];

        $validator= Validator::make($input,$rules,$massage);
        if ($validator->passes()){

            $res=Navs::where('nav_id',$nav_id)->update($input);
            if($res){
                return redirect('admin/navs')->with('msg','1');
            }else{
                return back()->with('msg','0');
            }
        }else{
            return back()->withErrors($validator);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=Navs::where('nav_id',$id)->delete();
        if($res){

            $data=['status'=>1,'msg'=>'删除成功'];
        }else{
            $data=['status'=>0,'msg'=>'删除失败'];
        }
        return $data;
    }
}
