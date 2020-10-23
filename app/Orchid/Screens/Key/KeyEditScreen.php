<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Key;

use App\Orchid\Layouts\Key\KeyEditLayout;
use App\Models\LicenseKey;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class KeyEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Lizenz';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Details zur ausgewählten Lizenz';

    /**
     * @var string
     */
    public $permission = 'platform.systems.index';

    /**
     * Query data.
     *
     * @param LicenseKey $key
     *
     * @return array
     */
    public function query(LicenseKey $key): array
    {
        /* $key->load(['roles']); */

        return [
            'license_key'       => $key->license_key,
            'product'       => $key->product,
            'created_at'       => $key->created_at,
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
            Button::make(__('Löschen'))
                ->icon('trash')
                ->confirm('Sind Sie sicher, dass Sie diesen Schlüssel löschen möchten?')
                ->method('remove'),

            Button::make(__('Abbrechen'))
                ->icon('left')
                ->method('cancel'),
        ];
    }

    /**
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): array
    {
        return [
            KeyEditLayout::class,
        ];
    }

    /**
     * @param LicenseKey $key
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(LicenseKey $key)
    {
        $key->delete();

        Toast::info(__('Lizenz wurde entfernt!'));

        return redirect()->route('platform.key.keys');
    }

    /**
     * @param LicenseKey $key
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel()
    {
        return redirect()->route('platform.key.keys');
    }
}
