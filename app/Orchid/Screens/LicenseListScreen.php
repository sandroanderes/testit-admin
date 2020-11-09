<?php

namespace App\Orchid\Screens\License;

use App\Orchid\Layouts\Key\KeyEditLayout;
use App\Orchid\Layouts\Key\KeyFiltersLayout;
use App\Orchid\Layouts\License\LicenseListLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public $description = 'Vergebene Produktlizenzen';

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
        return [
            Button::make(__('Neue Produktlizenz erstellen'))
                ->icon('key')
                ->method('createNew'),
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
            LicenseListLayout::class,

            Layout::modal('oneAsyncModal', [
                KeyEditLayout::class,
            ])->async('asyncGetKey'),
        ];
    }

    public function createNew()
    {
        return redirect()->route('platform.key.keys.create');
    }

    /**
     * @param Request $request
     */
    public function remove(Request $request)
    {
        DB::connection('mysql2')->table('licenses')->where('lid', '=', $request->get('lid'))->delete();

        Toast::info(__('Lizenz wurde entfernt!'));
    }
}
