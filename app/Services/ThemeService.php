<?php

namespace App\Services;

use Storage;

class ThemeService
{
    private array $templatesDirectories;

    public function __construct()
    {
        $this->templatesDirectories = Storage::disk('views')->directories('themes');
    }

    public static function templateRecoursePath(): string
    {
        return SettingService::value('theme');
    }

    public static function themeView(string $bladeName, array $params = [])
    {
        try {
            return view(self::templateRecoursePath() .'/'.$bladeName, $params);
        } catch (\Exception $exception) {
            return redirect('/admin')->with('error', 'Template not found');
        }
    }

    public static function themeSettings(string $templateName): array
    {
        if(empty($templateName)) {
            return [];
        }

        return include resource_path('views/'.$templateName.'/inc/settings.php') ?? [];
    }

    public static function getThemeFunctions(string $templateName)
    {
        if(empty($templateName)) {
            return null;
        }
        return include resource_path('views/'.$templateName.'/inc/functions.php');
    }

    public function getAllTemplatesSettings(): array
    {
        $templates = [];

        foreach ($this->templatesDirectories as $template) {
            $templates[$template] = self::themeSettings($template);
        }

        return $templates;
    }

    public function getAllTemplatesNames(): array
    {
        $templates = [];

        foreach ($this->templatesDirectories as $template) {
            $file = $this->getAllTemplatesSettings($template);

            if(!empty($file[$template]['name'])) {
                $templates[$template] = $file[$template]['name'];
            } else {
                $templates[$template] = $template;
            }
        }

        return $templates;
    }

    public function getCurrentTemplatePageNames(): array
    {
        $templateName = SettingService::value('theme');
        $pagePaths = Storage::disk('templates')->files($templateName.'/pages');
        $templates = [];
        foreach ($pagePaths as $item) {
            $itemArr = explode('/', $item);
            $last = end($itemArr);
            $result = str_replace('.blade.php','',$last);
            $templates[$result] = $result;
        }

        return $templates;
    }
}
