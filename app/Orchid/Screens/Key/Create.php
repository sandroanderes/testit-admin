<?php

namespace App\Orchid\Screens\Key;


use Orchid\Screen\Screen;

class Create extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Lizenzschlüssel erstellen';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'KeyCreate';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [];
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array
    {
        return [];
    }
}
