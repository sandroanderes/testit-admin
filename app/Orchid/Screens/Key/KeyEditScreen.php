<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Key;

use App\Orchid\Layouts\Key\KeyEditLayout;
use Illuminate\Http\Request;
use App\Models\LicenseKey;
use Orchid\Platform\Models\User;
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
    public $permission = 'platform.systems.system';

    /**
     * Query data.
     *
     * @param User $user
     *
     * @return array
     */
    public function query(User $user): array
    {
        $user->load(['roles']);

        return [
            'user'       => $user,
            'permission' => $user->getStatusPermission(),
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
            Button::make(__('Speichern'))
                ->icon('check')
                ->method('save'),

            Button::make(__('Löschen'))
                ->icon('trash')
                ->confirm('Sind Sie sicher, dass Sie diesen Schlüssel löschen möchten?')
                ->method('remove'),
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
     * @param LicenseKey    $key
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(LicenseKey $key, Request $request)
    {
        $request->validate([
            'key.license_key' => 'required|unique:key,'.$key->id,
        ]);

        $permissions = collect($request->get('permissions'))
            ->map(function ($value, $key) {
                return [base64_decode($key) => $value];
            })
            ->collapse()
            ->toArray();

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
    public function remove(LicenseKey $key)
    {
        $key->delete();

        Toast::info(__('Lizenz wurde entfernt!'));

        return redirect()->route('platform.key.keys');
    }
}
