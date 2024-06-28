<?php

namespace JornBoerema\BzUserManagement\Filament\Resources;

use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use JornBoerema\BzUserManagement\Filament\Resources\UserResource\Pages;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $slug = 'users';
    protected static ?string $navigationIcon = 'heroicon-s-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('bz-user-management::bz-user-management.name'))
                    ->required(),

                TextInput::make('email')
                    ->label(__('bz-user-management::bz-user-management.email'))
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->disabledOn('edit'),

                TextInput::make('password')
                    ->label(__('filament-panels::pages/auth/register.form.password.label'))
                    ->password()
                    ->required()
                    ->rule(Password::default())
                    ->same('confirm_password')
                    ->validationAttribute(__('filament-panels::pages/auth/register.form.password.validation_attribute'))
                    ->visibleOn('create'),

                TextInput::make('confirm_password')
                    ->label(__('filament-panels::pages/auth/register.form.password_confirmation.label'))
                    ->password()
                    ->required()
                    ->dehydrated(false)
                    ->visibleOn('create'),

                Select::make('roles')
                    ->label(__('bz-user-management::bz-user-management.roles'))
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->label('')
                    ->size(40)
                    ->defaultImageUrl(fn (User $record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->name) . '&color=FFFFFF&background=09090b')
                    ->circular(),

                TextColumn::make('name')
                    ->label(__('bz-user-management::bz-user-management.name'))
                    ->description(fn (User $record) => $record->email)
                    ->searchable()
                    ->sortable(),

                TextColumn::make('roles.name')
                    ->label(__('bz-user-management::bz-user-management.roles'))
                    ->limitList(3)
                    ->formatStateUsing(fn ($state): string => Str::headline($state))
                    ->badge(),

                TextColumn::make('updated_at')
                    ->label(__('bz-user-management::bz-user-management.updated_at'))
                    ->datetime('d-m-Y H:i'),

                TextColumn::make('created_at')
                    ->label(__('bz-user-management::bz-user-management.created_at'))
                    ->datetime('d-m-Y H:i'),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email'];
    }

    public static function getNavigationLabel(): string
    {
        return __('bz-user-management::bz-user-management.users');
    }

    public static function getPluralLabel(): string
    {
        return __('bz-user-management::bz-user-management.users');
    }

    public static function getLabel(): ?string
    {
        return __('bz-user-management::bz-user-management.user');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('bz-user-management::bz-user-management.nav_group');
    }
}
