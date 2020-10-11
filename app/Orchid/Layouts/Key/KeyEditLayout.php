<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Key;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Select;
use Orchid\Support\Facades\Layout;

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
            Input::make('key.license_key')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Lizenzschlüssel'))
                ->placeholder(__('Lizenzschlüssel')),

            Select::make('select')
                    ->title('Produktname')
                    ->required()
                    ->options(['testit-field', 'testit-lab']),
        ];
    }
}
