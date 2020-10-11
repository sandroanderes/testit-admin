<?php

namespace App\Orchid\Screens\License;

use App\Orchid\Layouts\Key\KeyFiltersLayout;
use App\Orchid\Layouts\License\LicenseListLayout;
use Illuminate\Http\Request;
use App\Models\License;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;

class LicenseListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Produktlizenzen';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Verfügbare (gekaufte) Produktlizenzen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'licenses' => License::query()
                ->filters()
                ->filtersApplySelection(KeyFiltersLayout::class)
                ->defaultSort('lid', 'asc')
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
            LicenseListLayout::class,
        ];
    }
}
