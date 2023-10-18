<?php

namespace App\Models;

use App\Traits\ContentTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Page extends Model
{
    use HasFactory;
    use ContentTrait;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'short',
        'content',
        'template',
        'custom_fields',
        'thumb',
        'images',
        'is_enabled',
        'seo_title',
        'seo_text_keys',
        'seo_description',
        'views',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
        'custom_fields' => 'array',
        'images' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function link(): string
    {
        return route('page', $this->slug);
    }
}
