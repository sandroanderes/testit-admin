<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Key;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Select;
use Orchid\Support\Color;

class KeyEditLayout extends Rows
{
    /**
     * Views.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Input::make('license_key')
                ->title('Lizenzschlüssel')
                ->disabled(),

            Select::make('product')
                ->title('Produktname')
                ->required()
                ->options([
                    'test-it-lab'   => 'Test it lab',
                    'test-it-field' => 'Test it field',
                ]),
            Input::make('name')
                ->type('text')
                ->max(255)
                /* ->required() */
                ->title(__('Vor- und Nachname')),
            Input::make('company')
                ->type('text')
                ->max(255)
                /* ->required() */
                ->title(__('Firma')),
            Input::make('instances')
                ->type('number')
                ->max(50)
                /* ->required() */
                ->title(__('Instanzen')),
            Input::make('valid_until')
                ->type('date')
                ->title('Gültig bis')
                ->value('2021-01-01')
        ];
    }
}
