<?php

namespace App\Services;

use App\Models\Page;

class PageService
{
    public static function getListOfPageTemplates(): array
    {
        return AdmService::getViewBladeFileNames(SettingService::value('theme').'/pages');
    }

    public static function getPageTemplateName(string $templateName): string
    {
        $template = $templateName;

        $templates = self::getListOfPageTemplates();

        if(!in_array($templateName, $templates)) {
            $template = 'page';
        }

        if(!in_array('page', $templates)) {
            abort(404);
        }

        return $template;
    }

    public function getOneBySlug(string $slug): object|null
    {
        $page = Page::query()->where('slug', $slug)->active()->first();

        if($page) {
            $page->increment('views');
            $page->save();
        }

        return $page;
    }
}
