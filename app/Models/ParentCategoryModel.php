<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentCategoryModel extends Model
{
    use HasFactory;
    protected $table = 'parent_category_models';

    public function ParentCat_WithChild()
    {
         return $this->hasMany(ChildCategoryModel::class);
    }

    public function ChildCat_WithSubChild()
    {
        return $this->hasMany(SubChildCategoryModel::class);
    }

}
