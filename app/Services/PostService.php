<?php

namespace App\Services;

use App\Models\Post;
use App\Services\AdmService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class PostService
{

    public function getAll(?int $paginationCount = 10): LengthAwarePaginator
    {
        return Post::query()
            ->active()
            ->with(['category', 'tags'])
            ->orderBy('created_at', 'desc')
            ->paginate($paginationCount);
    }

    public function getOneBySlug($slug)
    {
        $post = Post::query()->where('slug', $slug)
            ->active()
            ->with(['category', 'tags'])
            ->first();

        if($post) {
            $post->increment('views');
            $post->save();
        }

        return $post;
    }

    public function getAllByCategorySlug($slug, ?int $paginationCount = 10)
    {
        return Post::query()
            ->with(['category', 'tags'])
            ->active()
            ->whereHas('category', function (Builder $query) use ($slug){
                $query->where('slug', $slug);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($paginationCount);
    }

    public function getAllByTagSlug($slug, ?int $paginationCount = 10)
    {
        return Post::query()
            ->with(['category', 'tags'])
            ->active()
            ->whereHas('tags', function (Builder $query) use ($slug){
                $query->where('slug', $slug);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($paginationCount);
    }

    public static function popularPosts(?int $paginationCount = 5, ?string $categorySlug = '')
    {
        $post = Post::query()->active()->locale();

        if(!empty($categorySlug)) {
            $post = $post->whereHas('category', function (Builder $query) use ($categorySlug){
                $query->where('slug', $categorySlug);
            });
        }

        return $post->with(['category', 'tags'])->orderBy('views', 'desc')->paginate($paginationCount);
    }

    public function searchByPhrase(string $phrase, ?int $paginationCount = 10)
    {
        return Post::query()
            ->active()
            ->where('title', 'like', '%'.$phrase.'%')
            ->orWhere('content', 'like', '%'.$phrase.'%')
            ->orWhere('short', 'like', '%'.$phrase.'%')
            ->with(['category', 'tags'])
            ->orderBy('created_at', 'desc')
            ->paginate($paginationCount);
    }
}
