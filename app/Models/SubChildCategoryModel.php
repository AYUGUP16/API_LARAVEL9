<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubChildCategoryModel extends Model
{
    use HasFactory;
    protected $table = 'sub_child_category_models';

    public function Subchild_With_Childcat()
    {
        return $this->belongsTo(ChildCategoryModel::class,  'subchild_child_id');
        
    }

    public function Subchild_With_Parentcat()
    {
        return $this->belongsTo(ParentCategoryModel::class,  'subchild_parent_id');
        
    }
}
