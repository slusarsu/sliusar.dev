<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use App\Services\TagService;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public TagService $tagService;
    public PostService $postService;
    public function __construct(TagService $tagService, PostService $postService)
    {
        $this->tagService = $tagService;
        $this->postService = $postService;
    }

    public function index()
    {
        $tags = $this->tagService->getAll();

        return themeView('tags.index', compact('tags'));
    }

    public function show(Request $request, $slug)
    {
        $tag = $this->tagService->getOneBySlug($slug);

        $posts = $this->postService->getAllByTagSlug($slug, 15);

        return themeView('tags.tag', compact('tag', 'posts'));
    }
}
