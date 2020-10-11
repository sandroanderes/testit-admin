<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\License;

use App\Models\TestLicense;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Persona;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class TestLicenseListLayout extends Table
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

            TD::set('ip', __('IP'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (TestLicense $test_license) {
                    return $test_license->ip;
                }),

            TD::set('device_information', __('Geräteinformationen'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (TestLicense $test_license) {
                    return $test_license->device_information;
                }),

            TD::set('created', __('Erstelldatum'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (TestLicense $test_license) {
                    return date('d.m.Y H:i', strtotime($test_license->created));
                }),
        ];
    }
}
