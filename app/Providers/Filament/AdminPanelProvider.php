<?php

namespace App\Providers\Filament;

use App\Services\SettingService;
use BezhanSalleh\FilamentGoogleAnalytics\Widgets\PageViewsWidget;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
//            ->registration()
            ->colors([
                'primary' => Color::Blue,
            ])
            ->brandName(SettingService::value('site_name'))
            ->sidebarCollapsibleOnDesktop()
            ->profile()
            ->maxContentWidth('full')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
                PageViewsWidget::class,
//                \BezhanSalleh\FilamentGoogleAnalytics\Widgets\VisitorsWidget::class,
//                \BezhanSalleh\FilamentGoogleAnalytics\Widgets\ActiveUsersOneDayWidget::class,
//                \BezhanSalleh\FilamentGoogleAnalytics\Widgets\ActiveUsersSevenDayWidget::class,
//                \BezhanSalleh\FilamentGoogleAnalytics\Widgets\ActiveUsersTwentyEightDayWidget::class,
//                \BezhanSalleh\FilamentGoogleAnalytics\Widgets\SessionsWidget::class,
//                \BezhanSalleh\FilamentGoogleAnalytics\Widgets\SessionsDurationWidget::class,
//                \BezhanSalleh\FilamentGoogleAnalytics\Widgets\SessionsByCountryWidget::class,
//                \BezhanSalleh\FilamentGoogleAnalytics\Widgets\SessionsByDeviceWidget::class,
//                \BezhanSalleh\FilamentGoogleAnalytics\Widgets\MostVisitedPagesWidget::class,
//                \BezhanSalleh\FilamentGoogleAnalytics\Widgets\TopReferrersListWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
