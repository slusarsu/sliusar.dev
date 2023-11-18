<?php

namespace App\Services;

use App\Models\Menu;

class MenuService
{
    public static function links(string $hash = '')
    {
        $menu = Menu::query()->where('hash', $hash)->first();

        return $menu ? $menu->links : [];
    }
}
