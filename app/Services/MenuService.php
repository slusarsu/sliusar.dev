<?php

namespace App\Services;

use App\Models\Menu;

class MenuService
{
    public static function hashLinks(string $hash = '')
    {
        $menu = Menu::query()->where('hash', $hash)->first();

        return $menu ? $menu->links : [];
    }

    public static function positionLinks(string $position = '')
    {
        $menu = Menu::query()->where('position', $position)->where('is_enabled', 1)->first();

        return $menu ? $menu->links : [];
    }
}
