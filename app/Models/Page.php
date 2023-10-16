<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;

class Page extends Model
{
    use HasFactory;

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

    public function scopeActive(Builder $query): void
    {
        $query->where('is_enabled', true)
            ->where('created_at', '<=',Carbon::now());
    }

    public function getDate()
    {
        return $this->created_at->format('d.m.Y H:i');
    }
}
