<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Key;

use Orchid\Platform\Models\Role;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class KeyProductLayout extends Rows
{
    /**
     * Views.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Select::make('key.roles.')
                ->fromModel(Role::class, 'name')
                ->multiple()
                ->title(__('Name role'))
                ->help('Specify which groups this account should belong to'),
        ];
    }
}
