<?php

namespace JornBoerema\BzUserManagement\Filament\Resources\UserResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Support\Facades\Mail;
use JornBoerema\BzUserManagement\Filament\Resources\UserResource;
use JornBoerema\BzUserManagement\Mail\InvitationMail;
use JornBoerema\BzUserManagement\Models\Invitation;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('invite_user')
                ->label(__('bz-user-management::bz-user-management.invite_user'))
                ->modalWidth(MaxWidth::ExtraLarge)
                ->form([
                    TextInput::make('email')
                        ->label(__('bz-user-management::bz-user-management.email'))
                        ->required(),
                ])
                ->action(function ($data) {
                    $invitation = Invitation::create(['email' => $data['email']]);

                    Mail::to($invitation->email)->send(new InvitationMail($invitation));

                    Notification::make('invited_success')
                        ->body(__('bz-user-management::bz-user-management.invite_success'))
                        ->success()
                        ->send();
                }),

            CreateAction::make(),
        ];
    }
}
