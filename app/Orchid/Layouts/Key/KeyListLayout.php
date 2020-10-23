<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Key;

use App\Models\LicenseKey;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Persona;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class KeyListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'license_keys';

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            TD::set('id', __('ID'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (LicenseKey $key) {
                    return $key->id;
                }),

                TD::set('license_key', __('Lizenzschlüssel'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (LicenseKey $key) {
                    return $key->license_key;
                })
                ->render(function (LicenseKey $key) {
                    return Link::make($key->license_key)
                    ->route('platform.key.keys.edit', $key->id);
                }),


            TD::set('product', __('Produkt'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (LicenseKey $key) {
                    return $key->product;
                }),

            TD::set('created_at', __('Erstelldatum'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (LicenseKey $key) {
                    return date('d.m.Y H:i', strtotime($key->created_at));
                }),

            TD::set('id', 'Bearbeiten')
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->cantHide()
                ->render(function (LicenseKey $key) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Button::make(__('Löschen'))
                                ->method('remove')
                                ->confirm(__('Sind Sie sicher, dass Sie diesen Schlüssel löschen möchten?'))
                                ->parameters([
                                    'id' => $key->id,
                                ])
                                ->icon('trash'),
                        ]);
                }),
        ];
    }
}
