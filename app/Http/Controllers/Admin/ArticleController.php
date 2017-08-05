<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Article;
use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Article::orderBy('art_id','desc')->paginate(1);

        return view('admin.article.list',compact('data'));
    }
//    public function article_list(){
//        $data=Article::all(['art_id','art_title', 'art_thumb','art_editor','art_addtime','art_tag','art_view']);
//        foreach($data as $k=>$v){
//            $data[$k]['check_id']=$v['art_id'];
//            $data[$k]['art_thumb']='<img src="'.$v['art_thumb'].'" width="88"/>';
//            $data[$k]['art_addtime']=date('Y-m-d H:i:s',$v['art_addtime']);
//        }
//
//        return json_encode($data);
//    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=(new Category())->tree();
        return view('admin.article.add',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input=$request->except(['_token']);
        $rules=[
            'art_title'=>'required',
            'art_content'=>'required',
        ];
        $massage=[
            'art_title.required'=>'文章标题不可为空',//文章标题不可为空
            'art_content.required'=>'内容不可为空',//文章标题不可为空
        ];

        $validator= Validator::make($input,$rules,$massage);

        if ($validator->passes()){
            if($request->file('art_thumb')->isValid()) {
                $file=$request->file('art_thumb');
                $realPath = $file->path();   //临时文件的绝对路径
                $ext = $file->extension();     // 扩展名
                $filename = date('YmdHis') . mt_rand(1000, 9999) . '.' . $ext;
                $path = $file->move(public_path() . '\uploads\images', $filename);
                if($path){
                    $input['art_thumb'] = '/uploads/images/' . $filename;
                }else{
                    return back()->with('errors','图片上传失败');
                }

            }else{
                return back()->with('errors','图片上传出错');
            }
            $input['art_addtime']=time();
            $res=Article::create($input);
            if($res){
                return redirect('admin/article')->with('msg','添加成功');
            }else{
                return back()->with('errors','添加失败');
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
    public function edit($art_id)
    {

        $data=(new Category())->tree();
        $article=Article::find($art_id);

        return view('admin.article.edit',compact('data','article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $art_id)
    {
        $input=$request->except(['_token','_method']);
        $rules=[
            'art_title'=>'required',
            'art_content'=>'required',
        ];
        $massage=[
            'art_title.required'=>'文章标题不可为空',//文章标题不可为空
            'art_content.required'=>'内容不可为空',//文章标题不可为空
        ];

        $validator= Validator::make($input,$rules,$massage);
        if ($validator->passes()){
            if($request->file('art_thumb')->isValid()) {
                $file=$request->file('art_thumb');
                $realPath = $file->path();   //临时文件的绝对路径
                $ext = $file->extension();     // 扩展名
                $filename = date('YmdHis') . mt_rand(1000, 9999) . '.' . $ext;
                $path = $file->move(public_path('') . '\uploads\images', $filename);
                if($path){
                    $input['art_thumb'] = '/uploads/images/' . $filename;
                }else{
                    return back()->with('errors','图片上传失败');
                }

            }else{
                return back()->with('errors','图片上传出错');
            }
            $res=Article::where('art_id',$art_id)->update($input);
            if($res){
                return redirect('admin/article')->with('msg','修改成功');
            }else{
                return back()->with('errors','修改失败');
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
    public function destroy($art_id)
    {

        $res=Article::where('art_id',$art_id)->delete();
        if($res){

            $data=['status'=>1,'msg'=>'删除成功'];
        }else{
            $data=['status'=>0,'msg'=>'删除失败'];
        }
        return $data;
    }
}
