<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Campaigner extends Model
{
    //
    use SoftDeletes,Notifiable;
    protected $table='campaigner';
    protected $primaryKey='id';
    protected $fillable=['head_image','name','introduce','campaign_id'];

    public function campaign()
    {
        return $this->belongsTo('App\Model\Campaign','campaign_id','id');
    }

    public function people()
    {
        return $this->belongsToMany('App\Model\CampaignerPeople','campaigner_people','campaigner_id','people_id');
    }
}
