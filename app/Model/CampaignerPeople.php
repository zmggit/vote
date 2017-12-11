<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class CampaignerPeople extends Model
{
    //
    use SoftDeletes,Notifiable;
    protected $table='campaigner_people';
}
