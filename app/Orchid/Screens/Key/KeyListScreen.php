<?php

namespace App\Orchid\Screens\Key;

use App\Orchid\Layouts\Key\KeyEditLayout;
use App\Orchid\Layouts\Key\KeyFiltersLayout;
use App\Orchid\Layouts\Key\KeyListLayout;
use Illuminate\Http\Request;
use App\Models\LicenseKey;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;

class KeyListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Lizenzschlüssel';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Verfügbare Lizensschlüssel';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'license_keys' => LicenseKey::query()
                ->filters()
                ->filtersApplySelection(KeyFiltersLayout::class)
                ->defaultSort('id', 'asc')
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
        return [
            Button::make(__('Neue Lizenz generieren'))
                ->icon('key')
                ->href(route('platform.key.keys.create')),
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array
    {
        return [
            KeyListLayout::class,

            Layout::modal('oneAsyncModal', [
                KeyEditLayout::class,
            ])->async('asyncGetKey'),
        ];
    }
}
