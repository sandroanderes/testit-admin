<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use App\Orchid\Layouts\License\DashLicenseListLayout;
use App\Orchid\Layouts\License\DashTestLicenseListLayout;
use App\Orchid\Layouts\Key\KeyFiltersLayout;
use App\Models\TestLicense;
use Orchid\Screen\Actions\Link;
use App\Models\License;
use Orchid\Screen\Screen;
use App\Orchid\Layouts\Dashboard\DashboardMetrics;
use App\Orchid\Layouts\Dashboard\DashboardChartPie;
use Orchid\Support\Facades\Layout;



class PlatformScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Dashboard';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Willkommen in der Test it Lizenzverwaltung.';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'metrics' => [
                ['keyValue' => number_format(License::query()->where('product', 'test-it-lab')->count(), 0)],
                ['keyValue' => number_format(License::query()->where('product', 'test-it-field')->count(), 0)],
                ['keyValue' => number_format(License::query()->count(), 0)],
                ['keyValue' => number_format(TestLicense::query()->count(), 0)],
                ['keyValue' => number_format(License::query()->count()+TestLicense::query()->count(), 0)],
            ],
            'charts' => [
                [
                    'name'   => 'Lizenzstatistiken',
                    'values' => [License::query()->count(), TestLicense::query()->count()],
                    'labels' => ['Produktlizenzen', 'Testlizenzen'],
                ],
            ],
            'licenses' => License::query()
                ->filters()
                ->filtersApplySelection(KeyFiltersLayout::class)
                ->defaultSort('lid', 'asc')
                ->paginate(),
            'test_licenses' => TestLicense::query()
                ->filters()
                ->filtersApplySelection(KeyFiltersLayout::class)
                ->defaultSort('tlid', 'asc')
                ->paginate(),
                
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Website')
                ->href('https://test-it.ch')
                ->icon('globe-alt'),

            Link::make('GitHub')
                ->href('https://github.com/orchidsoftware/platform')
                ->icon('social-github'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): array
    {
        return [
            DashboardMetrics::class,
            DashboardChartPie::class,
            Layout::columns([
                DashLicenseListLayout::class,
                DashTestLicenseListLayout::class,
            ]),
        ];
    }

    public function statistics()
    {
        $licenses = License::query()->count();
        return $licenses;
    }
}
