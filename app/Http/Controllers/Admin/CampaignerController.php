<?php

namespace App\Http\Controllers\Admin;

use App\Model\Campaign;
use App\Model\Campaigner;
use App\Model\CampaignerPeople;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CampaignerController extends Controller
{
    public function index(Request $request)
    {
        $per_page=$request->get('per_page');
        $count=CampaignerPeople::count();

        if ($count==0){
            $campaigner=Campaigner::with(['campaign']);
            if ($per_page==null){
                $per_page=8;
                return $campaigner->orderBy('created_at','desc')->paginate($per_page);
            }else{
                return $campaigner->orderBy('created_at','desc')->paginate($per_page);
            }
        }else{
            $campaigner=Campaigner::with(['campaign','people']);
            if ($per_page==null){
                $per_page=8;
                return $campaigner->orderBy('created_at','desc')->paginate($per_page);
            }else{
                return $campaigner->orderBy('created_at','desc')->paginate($per_page);
            }
        }

    }

    public function store(Request $request)
    {
          $campaigner=$request->only(['head_image','name','introduce','campaign_id']);
          $resoult=Campaigner::create($campaigner);
        if ($resoult){
            return $this->jsonSuccess();
        }else {
            return $this->jsonResponse('1', '添加失败');
        }


        }
    public function edit(Request $request,$id)
    {
        $campaigner=$request->only(['head_image','name','introduce','campaign_id']);
        $resoult=Campaigner::where('id',$id)->update($campaigner);
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
            return $this->jsonResponse('1', '修改失败');
        }
    }

    public function info($id)
    {
        return Campaign::with(['campaign'])->where('id',$id)->first();
    }
}
