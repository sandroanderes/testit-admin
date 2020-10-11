<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\License;

use App\Models\License;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Persona;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class LicenseListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'licenses';

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            TD::set('tlid', __('ID'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (License $license) {
                    return $license->lid;
                }),

                TD::set('license_key', __('Lizenzschlüssel'))
                ->sort()
                ->render(function (License $license) {
                    return $license->license_key;
                }),


            TD::set('product', __('Produkt'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (License $license) {
                    return $license->product;
                }),

            TD::set('name', __('Name'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (License $license) {
                    return $license->name;
                }),

            TD::set('company', __('Firma'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (License $license) {
                    return $license->company;
                }),

            TD::set('instances', __('Instanzen'))
                ->sort()
                ->render(function (License $license) {
                    return $license->instances;
                }),

            TD::set('created', __('Erstelldatum'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (License $license) {
                    return date('d.m.Y H:i', strtotime($license->created));
                }),
        ];
    }
}
