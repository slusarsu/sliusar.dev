<?php

use App\Services\CategoryService;
use App\Services\ChunkService;
use App\Services\GalleryService;
use App\Services\SettingService;
use App\Services\ThemeService;
use App\Services\MenuService;
use App\Services\TagService;

function themeView(string $bladeName, array $params = [])
{
    return ThemeService::themeView($bladeName, $params);
}

function themeSettings(): array
{
    return ThemeService::themeSettings(SettingService::value('theme'));
}

function menuHashLinks(string $hash) {
    return MenuService::hashLinks($hash);
}

function menuPositionLinks(string $position) {
    return MenuService::positionLinks($position);
}

function galleryHash(string $hash) {
    return GalleryService::getByHash($hash);
}
function galleryHashItems(string $hash) {
    return GalleryService::getByHashItems($hash);
}

function categories() {
    return CategoryService::getAllParents();
}

function tags() {
    return TagService::getAll();
}
