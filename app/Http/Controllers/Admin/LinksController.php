<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Links;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Links::orderBy('link_sort','asc')->get();
        return view('admin.links.list')->with('data',$data);
    }
    /**
     * 修改分类排序
     */
    public function changeSort(){

        $input=Input::all();
        $link=Links::find($input['link_id']);
        $link->link_sort=$input['link_sort'];
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

        return view('admin.links.add');
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
            'link_name'=>'required',

        ];
        $massage=[
            'link_name.required'=>'0',//分类名称不可为空
        ];

        $validator= Validator::make($input,$rules,$massage);
        if ($validator->passes()){
            $res=Links::create($input);
            if($res){
                return redirect('admin/links')->with('msg','1');
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
    public function edit($link_id)
    {
        $link=Links::find($link_id);
        return view('admin.links.edit',compact('link'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $link_id)
    {
        $input=Input::except(['_token','_method']);
        $rules=[
            'link_name'=>'required',

        ];
        $massage=[
            'link_name.required'=>'0',//分类名称不可为空
        ];

        $validator= Validator::make($input,$rules,$massage);
        if ($validator->passes()){

            $res=Links::where('link_id',$link_id)->update($input);
            if($res){
                return redirect('admin/links')->with('msg','1');
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
        $res=Links::where('link_id',$id)->delete();
        if($res){

            $data=['status'=>1,'msg'=>'删除成功'];
        }else{
            $data=['status'=>0,'msg'=>'删除失败'];
        }
        return $data;
    }
}
