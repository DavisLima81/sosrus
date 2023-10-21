<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    //region RESOURCE CONFIGURATION
    protected static ?string $model = User::class;

    protected static ?string $label = 'Usuário';

    protected static ?string $pluralLabel = 'Usuários';

    protected static ?int $navigationSort = 50;

    protected static ?string $slug = 'usuarios';

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationGroup = 'Acesso';

    protected static bool $shouldRegisterNavigation = true;                         //aplica filtro para acesso apenas a usuario registrado em FilamentServiceProvider
    //endregion

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //form fields
                Forms\Components\TextInput::make('name')
                    ->autofocus()
                    ->required()
                    ->label('Nome'),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->label('Email'),
                // Using Select Component
                Forms\Components\Select::make('roles')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->rules(['array', 'max:1'])
                    ->preload()
                    ->searchable(),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->label('Senha'),
                Forms\Components\TextInput::make('password_confirmation')
                    ->password()
                    ->required()
                    ->label('Confirmação de Senha'),
            ])
            ->columns(2);
    }

    public static function relations(): array
    {
        return [
            RelationManagers\EfetivoRelationManager::class,
        ];
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                //
                TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->label('NOME'),

                TextColumn::make('email')
                    ->sortable()
                    ->searchable()
                    ->label('EMAIL'),
            ])
            ->defaultSort('name', 'asc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
