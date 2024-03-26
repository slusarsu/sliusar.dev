<?php

namespace App\Services;

use App\Models\Gallery;

class GalleryService
{
    public static function getAllByPosition(string $position)
    {
        return Gallery::query()->where('position', $position)->active()->get();
    }
    public static function getByHash(string $hash = '')
    {
        return Gallery::query()->where('hash', $hash)->active()->first();
    }

    public static function getByHashItems(string $hash = '')
    {
        $gallery = self::getByHash($hash);
        return $gallery->items;
    }

    public static function getById($id)
    {
        return Gallery::query()->where('hash', $id)->active()->first();
    }
}
