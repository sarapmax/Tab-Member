<?php

namespace App\Http\Controllers;

use App\TutorialVideo;
use Illuminate\Http\Request;

class TutorialVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $video = TutorialVideo::find(1);
//
        return view('tutorial_video.index', compact('video'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'video' => 'required'
        ]);

        $tutorialVideo = TutorialVideo::find($id);

        if($request->hasFile('video')){
//            unlink('video/' . $tutorialVideo->video);
            $video = $request->file('video');

            $videoName = $video->getClientOriginalName();

            $video->move('video/', $videoName);

            $tutorialVideo->video = $videoName;

            $tutorialVideo->save();

            alert()->success('อัพโหลดวีดีโอสอนใช้งานเรียบร้อยแล้ว', 'สำเร็จ !')->persistent('ปิด');
        }else {
            alert()->error('พบข้อผิดพลาดบางอย่าง', 'ผิดพลาด')->persistent('ปิด');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
