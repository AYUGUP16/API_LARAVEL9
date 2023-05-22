<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subscription;

class plans extends Model
{
     // protected $primarykey='id';
    protected $table = 'plans';
    protected $fillable = ['mrp','status' ,'validity', 'total_data', 'speed', 'voice', 'sms', 'other_addon', 'subs_id'];

    //  public function getsubs(){
    //     return $this->hasMany(Subscription::class,'id');


    // }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
