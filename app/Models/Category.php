<?php

namespace App\Models;

use App\Traits\ContentTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use ContentTrait;
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'title',
        'slug',
        'order',
        'content',
        'thumb',
        'is_enabled',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public static function tree()
    {
        $allCategories = Category::query()->active()->get();

        $rootCategories = $allCategories->whereNull('parent_id');

        self::formatTree($rootCategories, $allCategories);

        return $rootCategories;
    }

    private static function formatTree($rootCategories, $allCategories): void
    {
        foreach ($rootCategories as $category) {
            $category->sub_cat = $allCategories->where('parent_id', $category->id)->values();

            if ($category->sub_cat->isNotEmpty()) {
                self::formatTree($category->sub_cat, $allCategories);
            }
        }
    }

    public function link(): string
    {
        return route('category', $this->slug);
    }
}
