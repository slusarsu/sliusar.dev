<?php

use App\Services\CategoryService;
use App\Services\MenuService;
use App\Services\TagService;

function menuLinks(string $hash) {
    return MenuService::links($hash);
}

function categories() {
    return CategoryService::getAllParents();
}

function tags() {
    return TagService::getAll();
}

function menu(string $hash = '') {
    return MenuService::links($hash);
}
