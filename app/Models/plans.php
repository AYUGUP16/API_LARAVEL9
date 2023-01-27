<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class plans extends Model
{
    protected $table='plans';
    protected $fillable=['mrp','validity','total_data','speed','voice','sms','other_addon'];
}
