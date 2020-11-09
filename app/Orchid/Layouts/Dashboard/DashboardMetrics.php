<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Dashboard;

use Orchid\Screen\Layouts\Metric;

class DashboardMetrics extends Metric
{
    /**
     * @var string
     */
    protected $title = 'Aktuelle Statistiken';

    /**
     * @var string
     */
    protected $target = 'metrics';

    /**
     * @var array
     */
    protected $labels = [
        'Test it lab Lizenzen',
        'Test it field Lizenzen',
        'Total Produktlizenzen',
        'Testlizenzen',
        'Total alle Lizenzen',
    ];
}
