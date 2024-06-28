<?php

namespace JornBoerema\BzUserManagement\Filament\Resources\UserResource\Pages;

use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Validation\Rules\Password;
use JornBoerema\BzUserManagement\Filament\Resources\UserResource;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('reset_password')
                ->form([
                    TextInput::make('password')
                        ->label(__('filament-panels::pages/auth/register.form.password.label'))
                        ->password()
                        ->required()
                        ->rule(Password::default())
                        ->same('confirm_password')
                        ->validationAttribute(__('filament-panels::pages/auth/register.form.password.validation_attribute')),
                    TextInput::make('confirm_password')
                        ->label(__('filament-panels::pages/auth/register.form.password_confirmation.label'))
                        ->password()
                        ->required()
                        ->dehydrated(false),
                ])
                ->action(function (array $data, User $record) {
                    $record->password = $data['password'];
                    $record->save();

                    Notification::make('reset_password_success')
                        ->body('Password successfully reset!')
                        ->success()
                        ->send();
                }),

            DeleteAction::make(),
        ];
    }
}
