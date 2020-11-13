<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Key;

use App\Orchid\Layouts\Key\KeyCreateLayout;
use Illuminate\Http\Request;
use App\Models\License;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;

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
     * @param License $license
     *
     * @return array
     */
    public function query(License $license): array
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
            Layout::view('main.licensekey'),
            KeyCreateLayout::class,
            Layout::view('orchid.scripts'),
        ];
    }

    /**
     * @param License $license
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(License $license, Request $request)
    {
        $request->validate([
            'license_key' => 'required|unique:mysql2.licenses|max:255|String',
            'name' => 'required|max:255|String',
            'company' => 'required|max:255|String',
            'instances' => 'required|max:255|Numeric',
            'valid_until' => 'required|Date',
        ]);
        

        $data = [
            ['license_key' => $request->input('license_key'), 'product' => $request->get('product'), 'name' => $request->get('name'), 'company' => $request->get('company'), 'instances' => $request->get('instances'), 'valid_until' => $request->get('valid_until')],
        ];
        $license::insert($data);

        Toast::info(__('Lizenz wurde gespeichert.'));

        return redirect()->route('platform.license.license');
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
        return redirect()->route('platform.license.license');
    }
}
