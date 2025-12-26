<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\PhotoComment;
use Illuminate\Http\Request;

class PhotoCommentController extends Controller
{
    public function store(Request $request, Photo $photo)
    {
        
        $request->validate([
            'body' => ['required', 'string', 'max:2000'],
        ]);

       
        PhotoComment::create([
            'user_id'  => $request->user()->id,
            'photo_id' => $photo->id,
            'body'     => $request->input('body'),
        ]);

        return back();
    }
}
