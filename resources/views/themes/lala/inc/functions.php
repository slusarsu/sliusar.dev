<?php

use App\Services\CustomFieldService;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

CustomFieldService::setCustomFields('about', [
    RichEditor::make('custom_fields.education')
        ->columnSpan('full'),

    Repeater::make('custom_fields.jobs')->schema([
        TextInput::make('position'),
        TextInput::make('company'),
        RichEditor::make('description')
            ->columnSpan('full'),
        DatePicker::make('start_date')->format('d M Y'),
        DatePicker::make('end_date')->format('d M Y'),
        TextInput::make('period'),
        Select::make('technologies')->multiple()->options([
            'PHP' => 'PHP',
            'MySQL' => 'MySQL',
            'Laravel' => 'Laravel',
            'CSS' => 'CSS',
            'HTML' => 'HTML',
            'JavaScript' => 'JavaScript',
            'Bootstrap' => 'Bootstrap',
            'LiveWire' => 'LiveWire',
            'Vue 2' => 'Vue 2',
            'Alpine js' => 'Alpine js',
            'jQuery' => 'jQuery',
            'Linux' => 'Linux',
            'OS' => 'OS',
            'Network' => 'Network',
            'Computer Science' => 'Computer Science',
            'SCL PLC programming' => 'SCL PLC programming',
            '.Net' => '.Net',
            '.Net Core' => '.Net Core',
            'C#' => 'C#',
            'MSSQL' => 'MSSQL',
            'ASP .NET' => 'ASP .NET',
            'Angular.js' => 'Angular.js',
            'Wordpress' => 'Wordpress',
            'Joomla' => 'Joomla',
            'Hosting' => 'Hosting',
            'OpenCart' => 'OpenCart',
            'CMS' => 'CMS',
            'Docker' => 'Docker',
            'Elasticsearch' => 'Elasticsearch',
            'OAuth' => 'OAuth',
            'SSO' => 'SSO',
        ])->columnSpan('full'),
    ])
        ->reorderableWithButtons()
        ->collapsible()
        ->columns(2)
]);
