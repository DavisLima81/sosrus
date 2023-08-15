<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EscalaTipoResource\Pages;
use App\Filament\Resources\EscalaTipoResource\RelationManagers;
use App\Models\EscalaTipo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EscalaTipoResource extends Resource
{
    //region RESOURCE CONFIGURATION
    protected static ?string $model = EscalaTipo::class;

    protected static ?string $label = 'Tipo de escalas';

    protected static ?string $pluralLabel = 'Tipos de escalas';

    protected static ?int $navigationSort = 12;

    protected static ?string $slug = 'escala-tipos';

    protected static ?string $navigationIcon = 'heroicon-s-calendar-days';

    protected static ?string $navigationGroup = 'Gerencial';

    protected static bool $shouldRegisterNavigation = true;                         //aplica filtro para acesso apenas a usuario registrado em FilamentServiceProvider
    //endregion

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('nome')
                            ->label('Nome')
                            ->required()
                            ->maxLength(100)
                            ->columnSpan(4),
                        Forms\Components\TextInput::make('descricao')
                            ->label('Descrição')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(4),
                    ])
                    ->columns([
                        'sm' => 3,
                        'lg' => 4,
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('nome')
                    ->sortable()
                    ->searchable()
                    ->label('NOME'),

                /*TextColumn::make('descricao')
                    ->sortable()
                    ->searchable()
                    ->label('Descrição'),*/
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListEscalaTipos::route('/'),
            'create' => Pages\CreateEscalaTipo::route('/create'),
            'edit' => Pages\EditEscalaTipo::route('/{record}/edit'),
        ];
    }
}
