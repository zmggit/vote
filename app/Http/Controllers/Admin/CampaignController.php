<?php

namespace App\Http\Controllers\Admin;

use App\Model\Campaign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CampaignController extends Controller
{
    //
    public function index(Request $request)
    {
        $per_page = $request->get('per_page');
        $weight = $request->get('weight');
        $status = $request->get('status');
        $start_time = $request->get('start_time');
        $end_time = $request->get('end_time');
        $created_at = $request->get('created_at');
        $updated_at = $request->get('updated_at');

        $campaign = Campaign::with('campaigner');

        if ($start_time) {
            $campaign->where('start_time', '>=', $start_time);
        }
        if ($end_time) {
            $campaign->where('end_time', '<=', $end_time);
        }
        if ($created_at) {
            if ($created_at == 0) {
                $campaign->orderBy('created_at', 'desc');
            }
            if ($created_at == 1) {

                $campaign->orderBy('created_at', 'asc');
            }
        }
        if ($updated_at) {
            if ($updated_at == 0) {
                $campaign->orderBy('updated_at', 'desc');
            }
            if ($updated_at == 1) {
                $campaign->orderBy('updated_at', 'asc');
            }
        }


        if ($weight != null) {
            if ($weight == 0) {
                $campaign->orderBy('weight', 'desc');
            }
            if ($weight == 1) {
                $campaign->orderBy('weight', 'asc');
            }
        }
        if ($status != null) {
            if ($status == 0) {
                $campaign->where('status', 0);
            }
            if ($status == 1) {
                $campaign->where('status', 1);
            }
        }
        if ($per_page==null){
            $per_page=8;
            return $campaign->paginate($per_page);
        }else{
            return $campaign->paginate($per_page);
        }

    }

    public function status(Request $request,$id)
    {
        $status=$request->get('status');
      $resoult=Campaign::where('id',$id)->update(
          [
          'status'=>$status]
      );
        if ($resoult){
            return $this->jsonSuccess();
        }else{
            return $this->jsonResponse('1', '修改状态失败');
        }
    }

    public function store(Request $request)
    {
        $campaign=$request->only(['title','start_time','end_time','introduce','standard','process','parktake','information','weight']);
        $resoult=Campaign::create($campaign);
       if ($resoult){
           return $this->jsonSuccess();
       }else{
           return $this->jsonResponse('1', '添加失败');
       }
    }
    public function edit(Request $request,$id)
    {
        $campaign=$request->only(['title','start_time','end_time','introduce','standard','process','parktake','information','weight']);
        $resoult=Campaign::where('id',$id)->update($campaign);
        if ($resoult){
            return $this->jsonSuccess();
        }else{
            return $this->jsonResponse('1', '修改失败');
        }
    }

    public function destroy(Request $request,$id)
    {
     $resoult=Campaign::destroy($id);
        if ($resoult){
            return $this->jsonSuccess();
        }else{
            return $this->jsonResponse('1', '删除失败');
        }
    }

    public function info($id)
    {
        return Campaign::with('campaigner')->where('id',$id)->first();
    }
}
