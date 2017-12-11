<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Campaign extends Model
{
    //
    use SoftDeletes,Notifiable;
    protected $table='campaign';
    protected $primaryKey='id';
    protected $fillable=['title','start_time','end_time','introduce','standard','process','parktake','information','status','weight'];

    public function campaigner()
    {
        return $this->hasMany('App\Model\Campaigner','campaign_id','id');
    }
}
