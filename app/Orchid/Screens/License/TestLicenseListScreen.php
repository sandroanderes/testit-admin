<?php

namespace App\Orchid\Screens\License;

use App\Orchid\Layouts\Key\KeyFiltersLayout;
use App\Orchid\Layouts\License\TestLicenseListLayout;
use Illuminate\Http\Request;
use App\Models\TestLicense;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;

class TestLicenseListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Testlizenzen';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Verfügbare Testlizenzen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
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
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array
    {
        return [
            TestLicenseListLayout::class,
        ];
    }
}
