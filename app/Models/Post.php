<?php

namespace App\Models;

use App\Traits\ContentTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Post extends Model
{
    use HasFactory;
    use ContentTrait;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'short',
        'content',
        'custom_fields',
        'is_enabled',
        'thumb',
        'images',
        'seo_title',
        'seo_text_keys',
        'seo_description',
        'views',
        'created_at'
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
        'images' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tags(): MorphToMany
    {
        return $this->MorphToMany(Tag::class, 'taggable');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function link(): string
    {
        return route('post', $this->slug);
    }
}
