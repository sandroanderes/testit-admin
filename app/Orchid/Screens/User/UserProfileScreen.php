<?php

declare(strict_types=1);

namespace App\Orchid\Screens\User;

use App\Orchid\Layouts\User\UserEditLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Orchid\Platform\Models\User;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Password;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class UserProfileScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Profil';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Allgemeine Informationen';

    /**
     * @var User
     */
    protected $user;

    /**
     * Query data.
     *
     * @param Request $request
     *
     * @return array
     */
    public function query(Request $request): array
    {
        $this->user = $request->user();

        return [
            'user' => $this->user,
        ];
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [
            DropDown::make(__('Einstellungen'))
                ->icon('open')
                ->list([
                    ModalToggle::make(__('Passwort ändern'))
                        ->icon('lock-open')
                        ->method('changePassword')
                        ->modal('password'),
                ]),

            Button::make(__('Speichern'))
                ->icon('check')
                ->method('save'),
        ];
    }

    /**
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): array
    {
        return [
            UserEditLayout::class,

            Layout::modal('password', [
                Layout::rows([
                    Password::make('old_password')
                        ->placeholder(__('Geben Sie das aktuelle Passwort ein'))
                        ->required()
                        ->title(__('Altes Passwort'))
                        ->help('Dies ist Ihr derzeit festgelegtes Passwort.'),

                    Password::make('password')
                        ->placeholder(__('Geben Sie das neue Passwort ein'))
                        ->required()
                        ->title(__('Neues Passwort')),

                    Password::make('password_confirmation')
                        ->placeholder(__('Geben Sie das neue Passwort erneut ein'))
                        ->required()
                        ->title(__('Neues Passwort bestätigen'))
                        ->help('Sichere Passwörter sollten mindestens 10 Zeichen lang sein, aus Groß- und Kleinbuchstaben sowie Sonderzeichen bestehen und in keinem Wörterbuch zu finden sein oder mit Ihnen in Verbindung stehen.'),
                ]),
            ])
                ->title(__('Passwort ändern'))
                ->applyButton('Passwort ändern'),
        ];
    }

    /**
     * @param Request $request
     */
    public function save(Request $request)
    {
        $request->validate([
            'user.name'  => 'required|string',
            'user.email' => 'required|unique:users,email,'.$request->user()->id,
        ]);

        $request->user()
            ->fill($request->get('user'))
            ->save();

        Toast::info(__('Das Profil wurde aktualisiert.'));
    }

    /**
     * @param Request $request
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|password:web',
            'password'     => 'required|confirmed',
        ]);

        tap($request->user(), function ($user) use ($request) {
            $user->password = Hash::make($request->get('password'));
        })->save();

        Toast::info(__('Password wurde geändert.'));
    }
}
