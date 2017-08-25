<?php

namespace App\Http\Controllers;

use App\TutorialVideo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $video = TutorialVideo::find(1);

    	return view('index', compact('video'));
    }
}
