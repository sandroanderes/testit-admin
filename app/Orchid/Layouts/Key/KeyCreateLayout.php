<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Key;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Select;
use Orchid\Support\Facades\Layout;

class KeyCreateLayout extends Rows
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
                ->placeholder(__('VQCRC-J4GTW-T8XQW-RX6QG-4HVG4')),

            Select::make('product')
                    ->title('Produktname')
                    ->required()
                    ->options([
                        'testit-lab'   => 'Test it lab',
                        'testit-field' => 'Test it field',
                    ]),
        ];
    }
}
