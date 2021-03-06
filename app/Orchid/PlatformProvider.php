<?php

namespace App\Orchid;

use Laravel\Scout\Searchable;
use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemMenu;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * @return ItemMenu[]
     */
    public function registerMainMenu(): array
    {
        return [
            /* Dashboard */
            ItemMenu::label('Dashboard')
                ->icon('speedometer')
                ->route('platform.main')
                ->title('Dashboard'),

            /* Lizenzverwaltung */
            ItemMenu::label('Produktlizenzen')
                ->icon('eye')
                ->route('platform.license.license')
                ->title('Lizenzverwaltung'),

            ItemMenu::label('Testlizenzen')
                ->icon('eye')
                ->route('platform.license.testlicense'),

            /* Schlüsselverwaltung */
            ItemMenu::label('Lizenzschlüssel erstellen')
                ->icon('key')
                ->route('platform.key.keys.create')
                ->title('Schlüsselverwaltung'),

            /* ItemMenu::label('Benutzerverwaltung')
                ->title('Einstellungen')
                ->icon('friends')
                ->route('platform.systems.users')
                ->permission('platform.systems.users'),

            ItemMenu::label('Rollenverwaltung')
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles'), */

            /* Webseite */
            ItemMenu::label('Webseite anzeigen')
                ->title('Webseite')
                ->icon('globe')
                ->url('https://test-it.ch'),

            ItemMenu::label('Webseite login')
                ->icon('login')
                ->url('https://test-it.ch/login'),

/* 
            ItemMenu::label('Dropdown menu')
                ->slug('example-menu')
                ->icon('key')
                ->childs(),

            ItemMenu::label('Sub element item 1')
                ->place('example-menu')
                ->icon('bag'),

            ItemMenu::label('Sub element item 2')
                ->place('example-menu')
                ->icon('heart'),

            ItemMenu::label('Advanced Elements')
                ->icon('briefcase')
                ->route('platform.example.advanced'),

            ItemMenu::label('Text Editors')
                ->icon('list')
                ->route('platform.example.editors'),

            ItemMenu::label('Overview layouts')
                ->title('Layouts')
                ->icon('layers')
                ->route('platform.example.layouts'),

            ItemMenu::label('Chart tools')
                ->icon('bar-chart')
                ->route('platform.example.charts'),

            ItemMenu::label('Cards')
                ->icon('grid')
                ->route('platform.example.cards'),

 */
        ];
    }

    /**
     * @return ItemMenu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            ItemMenu::label('Profil')
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemMenu[]
     */
    public function registerSystemMenu(): array
    {
        return [
            ItemMenu::label(__('Access rights'))
                ->icon('lock')
                ->slug('Auth')
                ->active('platform.systems.*')
                ->permission('platform.systems.index')
                ->sort(1000),

            /* ItemMenu::label(__('Allgemein'))
                ->place('Auth')
                ->icon('settings')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->sort(1000)
                ->title(__('Allgemeine Einstellungen')), */

            ItemMenu::label(__('Users'))
                ->place('Auth')
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->sort(1000)
                ->title(__('All registered users')),

            ItemMenu::label(__('Roles'))
                ->place('Auth')
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles')
                ->sort(1000)
                ->title(__('Eine Rolle definiert eine Reihe von Aufgaben, die ein Benutzer, dem die Rolle zugewiesen wurde, ausführen darf. ')),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('Systems'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }

    /**
     * @return Searchable|string[]
     */
    public function registerSearchModels(): array
    {
        return [
            // ...Models
            // \App\Models\User::class
        ];
    }
}
