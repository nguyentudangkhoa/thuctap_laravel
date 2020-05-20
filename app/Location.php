<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Location extends Model
{
    //
    public $table="location";
    public $fillable=['location_name','parent_id'];
    public function House(){
        return $this->hasMany('App\House','id_Location','id');
    }
}
