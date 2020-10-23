<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\License;

use App\Models\License;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class DashLicenseListLayout extends Table
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
        ];
    }
}
