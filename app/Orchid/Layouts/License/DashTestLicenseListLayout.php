<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\License;

use App\Models\TestLicense;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class DAshTestLicenseListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'test_licenses';

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
                ->render(function (TestLicense $test_license) {
                    return $test_license->tlid;
                }),

            TD::set('udid', __('UDID'))
                ->sort()
                ->render(function (TestLicense $test_license) {
                    return $test_license->udid;
                }),

            TD::set('product', __('Produkt'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (TestLicense $test_license) {
                    return $test_license->product;
                }),
        ];
    }
}
