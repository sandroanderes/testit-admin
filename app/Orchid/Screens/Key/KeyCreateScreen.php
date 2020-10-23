<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Key;

use App\Orchid\Layouts\Key\KeyCreateLayout;
use Illuminate\Http\Request;
use App\Models\LicenseKey;
use Orchid\Platform\Models\User;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class KeyCreateScreen extends Screen
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
    public $description = 'Neue Lizenz erstellen';

    /* *
     * @var string
     */
    public $permission = 'platform.systems.index';

    /**
     * Query data.
     *
     * @param User $user
     *
     * @return array
     */
    public function query(User $user): array
    {
        return [];
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make(__('Speichern'))
                ->icon('check')
                ->method('save'),

            Button::make(__('Abbrechen'))
                ->icon('left')
                ->confirm('Sind Sie sicher, dass Sie diesen Vorgang abbrechen möchten?')
                ->method('cancel'),
        ];
    }

    /**
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): array
    {
        return [
            KeyCreateLayout::class,
        ];
    }

    /**
     * @param LicenseKey    $key
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(LicenseKey $key, Request $request)
    {
        $request->validate([
            'license_key' => 'required|unique:mysql2.license_keys|max:255|String',
        ]);

        $data = [
            ['license_key' => $request->get('license_key'), 'product' => $request->get('product')],
        ];
        $key::insert($data);

        Toast::info(__('Lizenz wurde gespeichert.'));

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
