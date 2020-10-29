<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Key;

use App\Orchid\Layouts\Key\KeyEditLayout;
use Illuminate\Http\Request;
use App\Models\License;
use Illuminate\Support\Facades\DB;
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
    public function query(License $license): array
    {
        return [
            'license_key'       => $license->license_key,
            'product'           => $license->product,
            'name'              => $license->name,
            'company'           => $license->company,
            'instances'         => $license->instances,
            'created_at'        => $license->created_at,
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
                ->icon('trash')
                ->confirm('Schlüssel speichern?')
                ->method('save'),

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
     * @param License $license
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(License $license, Request $request)
    {
        DB::connection('mysql2')->table('licenses')->where('lid', '=', $license->lid)->delete();

        Toast::info(__('Lizenz wurde entfernt!'));

        return redirect()->route('platform.license.license');
    }

    /**
     * @param License $license
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel()
    {
        return redirect()->route('platform.license.license');
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
            'name' => 'required|max:255|String',
            'company' => 'required|max:255|String',
            'instances' => 'required|max:255|Numeric',
            'valid_until' => 'required|Date',
        ]);
        
        
        $license
            ->fill(['product' => $request->get('product'), 'name' => $request->get('name'), 'company' => $request->get('company'), 'instances' => $request->get('instances'), 'valid_until' => $request->get('valid_until')])
            ->save();

        Toast::info(__('Lizenz wurde gespeichert.'));

        return redirect()->route('platform.license.license');
    }
}
