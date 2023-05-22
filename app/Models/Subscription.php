<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\plans;


class Subscription extends Model
{


      protected $table='subscription';
    protected $fillable=['subscription'];

   // public function subscription()
   //  {
   //      return $this->belongsTo(plans::class);
   //  }

}
