<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(Request $request)
    {
        $posts = $this->postService->getAll(15);

        return view('template.posts.index', compact('posts'));
    }

    public function show(Request $request, $slug)
    {
        $post = $this->postService->getOneBySlug($slug);

        if(!$post) {
            return redirect('/');
        }

        $thumb = $post->thumb();
        $images = $post->images();

        return view('template.posts.post', compact('post', 'thumb', 'images'));
    }

    public function search(Request $request)
    {
        $phrase = $request->get('s');


        if(!$phrase) {
            return redirect('/');
        }

        $posts = $this->postService->searchByPhrase($phrase, 15);


        return view('template.posts.search', compact('posts', 'phrase'));
    }
}
