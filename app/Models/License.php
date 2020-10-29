<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Orchid\Access\UserAccess;
use Orchid\Filters\Filterable;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;

class License extends Model
{
    use Notifiable, UserAccess, AsSource, Filterable, Chartable, HasFactory;
    protected $connection = 'mysql2';
    protected $primaryKey = 'lid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'license_key',
        'name',
        'company',
        'product',
        'instances',
        'valid_until',
        'updated_at',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'lid',
        'license_key',
        'name',
        'company',
        'product',
        'instances',
        'valid_until',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'lid',
        'license_key',
        'name',
        'company',
        'product',
        'instances',
        'valid_until',
        'created',
    ];
}
