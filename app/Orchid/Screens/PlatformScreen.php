<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use App\Orchid\Layouts\Examples\MetricsExample;
use Orchid\Support\Facades\Layout;

class PlatformScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Dashboard';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Willkommen in der Test it Lizenzverwaltung.';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'metrics' => [
                ['keyValue' => number_format(6851, 0), 'keyDiff' => 10.08],
                ['keyValue' => number_format(24668, 0), 'keyDiff' => -30.76],
                ['keyValue' => number_format(65661, 2), 'keyDiff' => 3.84],
                ['keyValue' => number_format(10000, 0), 'keyDiff' => -169.54],
                ['keyValue' => number_format(1454887.12, 2), 'keyDiff' => 0.2],
            ],
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Website')
                ->href('https://test-it.ch')
                ->icon('globe-alt'),

            Link::make('GitHub')
                ->href('https://github.com/orchidsoftware/platform')
                ->icon('social-github'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): array
    {
        return [
            MetricsExample::class,
            Layout::view('main.dashboard'),
        ];
    }
}
