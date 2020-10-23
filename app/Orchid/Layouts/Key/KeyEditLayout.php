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
                ->type('text')
                ->max(50)
                /* ->required() */
                ->title(__('Lizenzschlüssel'))
                ->disabled(),

            Select::make('product')
                ->title('Produktname')
                ->required()
                ->options([
                    'testit-lab'   => 'Test it lab',
                    'testit-field' => 'Test it field',
                ])
                ->disabled(),
            Input::make('created_at')
                ->type('text')
                ->max(50)
                ->title(__('Erstelldatum'))
                ->disabled(),
        ];
    }
}
