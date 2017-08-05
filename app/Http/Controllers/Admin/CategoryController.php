<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=(new Category)->tree();
        return view('admin.category.list')->with('data',$categories);
    }
    /**
     * 修改分类排序
     */
    public function changeSort(){
        $input=Input::all();
        $cate=Category::find($input['cate_id']);
        $cate->cate_sort=$input['cate_sort'];
        $res=$cate->update();
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
        $data=(new Category)->tree();

        return view('admin.category.add',compact('data'));
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
            'cate_name'=>'required',
            'cate_title'=>'required',
        ];
        $massage=[
            'cate_name.required'=>'0',//分类名称不可为空
        ];

        $validator= Validator::make($input,$rules,$massage);
        if ($validator->passes()){
            $res=Category::create($input);
            if($res){
                return redirect('admin/category')->with('msg','1');
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
    public function edit($cate_id)
    {   $data=(new Category)->tree();
        $category=Category::find($cate_id);
        return view('admin.category.edit',compact('category','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($cate_id)
    {
        $input=Input::except('_token','_method');

        $rules=[
            'cate_name'=>'required',
        ];
        $massage=[
            'cate_name.required'=>'0',//分类名称不可为空
        ];

        $validator= Validator::make($input,$rules,$massage);
        if ($validator->passes()){
            $res=Category::where('cate_id',$cate_id)->update($input);
            if($res){
                return redirect('admin/category')->with('msg','1');
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
    public function destroy($cate_id)
    {
        $category=Category::find($cate_id);
        $res=Category::where('cate_id',$cate_id)->delete();
        if($res){
            Category::where('cate_pid',$cate_id)->update(['cate_pid'=>$category->cate_pid]);
            $data=['status'=>1,'msg'=>'删除成功'];
        }else{
            $data=['status'=>0,'msg'=>'删除失败'];
        }
        return $data;
    }
}
