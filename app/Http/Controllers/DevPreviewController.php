<?php

namespace App\Http\Controllers;

class DevPreviewController extends Controller
{
    public function styleGuide()
    {
        $title = 'Style Guide (dev preview) | ' . config('global.site_name');

        return view('dev.style-guide', compact('title'));
    }
}
