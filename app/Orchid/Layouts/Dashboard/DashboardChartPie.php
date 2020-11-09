<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Dashboard;

use Orchid\Screen\Layouts\Chart;

class DashboardChartPie extends Chart
{
    /**
     * @var string
     */
    protected $title = 'Lizenzübersicht';

    /**
     * @var int
     */
    protected $height = 350;

    /**
     * Available options:
     * 'bar', 'line',
     * 'pie', 'percentage'.
     *
     * @var string
     */
    protected $type = 'pie';

    /**
     * @var string
     */
    protected $target = 'charts';
}
