<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PagesModel;

class PagesController extends Controller
{
    //
    public function editpages($pagename){        
        $pagecontent = PagesModel::where('page_name', $pagename)->get();        
        return view('admin/pages/edit-content', compact('pagecontent'));
    }
}
