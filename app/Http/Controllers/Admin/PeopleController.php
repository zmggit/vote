<?php

namespace App\Http\Controllers\Admin;

use App\Model\Campaigner;
use App\Model\CampaignerPeople;
use App\Model\People;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PeopleController extends Controller
{
    public function index(Request $request)
    {
        $per_page=$request->get('per_page');
        $count=CampaignerPeople::count();
 if ($count==0){
     if ($per_page==null){
         $per_page=8;
         return People::orderBy('created_at','desc')->paginate($per_page);
     }else{
         return People::orderBy('created_at','desc')->paginate($per_page);
     }
 }else{
     if ($per_page==null){
         $per_page=8;
         return People::orderBy('created_at','desc')->with('campaigner')->paginate($per_page);
     }else{
         return People::orderBy('created_at','desc')->with('campaigner')->paginate($per_page);
     }

 }


    }
    public function store(Request $request)
    {
      $people=$request->only(['open_id','name','head_image','num']);
      $resoult=People::create($people);
        if ($resoult){
            return $this->jsonSuccess();
        }else {
            return $this->jsonResponse('1', '添加失败');
        }
    }
    public function edit(Request $request,$id)
    {
        $people=$request->only(['open_id','name','head_image','num']);
        $resoult=People::where('id',$id)->update(
            $people
        );
        if ($resoult){
            return $this->jsonSuccess();
        }else {
            return $this->jsonResponse('1', '修改失败');
        }
    }

    public function destroy(Request $request,$id)
    {
        $resoult=Campaigner::destroy($id);
        if ($resoult){
            return $this->jsonSuccess();
        }else {
            return $this->jsonResponse('1', '删除失败');
        }
    }
}
