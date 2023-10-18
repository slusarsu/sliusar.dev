<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

trait ContentTrait
{
    public function scopeActive(Builder $query): void
    {
        $query->where('is_enabled', true)
            ->where('created_at', '<=',Carbon::now());
    }

    public function thumb()
    {
        return !empty($this->thumb) ?  '/storage/'.$this->thumb : $this->thumb;
    }

    public function images(): array
    {
        $images = [];

        if(empty($this->images)) {
            return $images;
        }

        foreach ($this->images as $image) {
            $images[] = '/storage/'.$image;
        }

        return $images;
    }

    public function getDate()
    {
        return $this->created_at->format('d.m.Y H:i');
    }
}
