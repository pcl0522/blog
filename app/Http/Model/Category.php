<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='category';
    protected $primaryKey='cate_id';
    public $timestamps=false;
    protected $guarded=[];

    public function tree(){
        $categories=$this->orderBy('cate_sort','asc')->get();

        return $this->getTree($categories);
    }

    public function getTree($data,$arr=array(),$pid=0,$len=0){
        $len++;
        foreach($data as $k=>$v){
            if($v['cate_pid']==$pid){
                for($i=0;$i<$len-1;$i++){
                    $v['cate_name']='|- '.$v['cate_name'];
                }
                $arr[]=$v;
                $arr=$this->getTree($data,$arr,$v['cate_id'],$len);
            }
        }

        return $arr;
    }

}
