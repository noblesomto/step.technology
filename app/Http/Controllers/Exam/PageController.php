<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {   
        $title = config('global.site_name') . " | " . config('global.site_title');
        return view('exam.frontend.index', compact('title',));
    }
}
