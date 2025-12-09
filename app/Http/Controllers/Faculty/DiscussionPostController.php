<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DiscussionPost;
use Illuminate\Support\Facades\Session;

class DiscussionPostController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['thread_id'=>'required','message'=>'required']);
        DiscussionPost::create(array_merge($request->all(), ['user_id'=>Session::get('user_id')]));
        return back()->with('success','Post added.');
    }

    public function update(Request $request, DiscussionPost $post)
    {
        $post->update($request->only('message'));
        return back()->with('success','Post updated.');
    }

    public function destroy(DiscussionPost $post)
    {
        $post->delete();
        return back()->with('success','Post deleted.');
    }
}
