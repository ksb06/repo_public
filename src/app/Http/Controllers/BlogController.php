<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;

class BlogController extends Controller
{
    //
    public function detail(?Blogs $blog)
    {
        if ($blog->exists && $blog->user_id !== Auth::id()) {
            return redirect()->back()->withErrors(new MessageBag([__('Not privilege')]));
        }
        return View::make('blog', [
            'blog' => $blog ?? new Blogs,
        ]);
    }

    public function register(?Blogs $blog)
    {
        $blog = $blog ?? new Blogs;
        if ($blog->exists && $blog->user_id !== Auth::id()) {
            return redirect()->back()->withErrors(new MessageBag([__('Not privilege')]));
        }
        $input = Request::all([$blog->exists ? null : 'post_date', 'title', 'content']);
        if (($error = Validator::make($input, [
            'post_date' => $blog->exists ? ['prohibited'] : ['required', 'date_format:Y/m/d', ''],
            'title'     => ['required', 'max:255'],
            'content'   => ['required'],
        ]))->fails()) {
            return redirect()->back()->withErrors($error);
        }

        $blog->post_date    = $blog->post_date ?? $input['post_date'];
        $blog->title        = $input['title'];
        $blog->content      = $input['content'];
        $blog->user_id      = Auth::id();
        $blog->save();

        return redirect()->route('home');
    }

    public function delete(Blogs $blog)
    {
        if (empty($blog) || ($blog->exists && $blog->user_id !== Auth::id())) {
            return redirect()->back()->withErrors(new MessageBag([__('Not privilege')]));
        }
        $blog->delete();
        
        return redirect()->route('home');
    }
}
