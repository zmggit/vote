<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class People extends Model
{
    //
    use SoftDeletes,Notifiable;
    public $incrementing=false;
    protected $table='people';
    protected $primaryKey='open_id';
    protected $fillable=['open_id','name','head_image','num'];

    public function campaigner()
    {
        return $this->belongsToMany('App\Model\Campaigner','people_id','campaigner_id');
    }
}
