<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildCategoryModel extends Model
{
    use HasFactory;
    protected $table = 'child_category_models';

    public function ParentCat()
    {
        return $this->belongsTo(ParentCategoryModel::class,  'parent_cat');
    }
}
