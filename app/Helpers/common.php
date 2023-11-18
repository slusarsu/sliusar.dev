<?php

use App\Services\CategoryService;
use App\Services\MenuService;

function menuLinks(string $hash) {
    return MenuService::links($hash);
}

function categories() {
    return CategoryService::getAllParents();
}
