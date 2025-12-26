<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhotoComment;

class PhotoCommentController extends Controller
{
    public function destroy(PhotoComment $photoComment)
    {
        $photoComment->delete();

        return back()->with('status', 'Reactie verwijderd.');
    }
}
