<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeriadoResource\Pages;
use App\Filament\Resources\FeriadoResource\RelationManagers;
use App\Models\Feriado;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FeriadoResource extends Resource
{
    //region RESOURCE CONFIGURATION
    protected static ?string $model = Feriado::class;

    protected static ?string $label = 'Feriado';

    protected static ?string $pluralLabel = 'Feriados';

    protected static ?int $navigationSort = 12;

    protected static ?string $slug = 'feriados';

    protected static ?string $navigationIcon = 'heroicon-o-face-smile';

    protected static ?string $navigationGroup = 'Gerencial';

    protected static bool $shouldRegisterNavigation = true;                         //aplica filtro para acesso apenas a usuario registrado em FilamentServiceProvider
    //endregion


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //criar campos
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('nome')
                                    ->label('Nome')
                                    ->columnSpan(3),
                                Forms\Components\DatePicker::make('data')
                                    ->label('Data')
                                    ->displayFormat('d/m/Y')
                                    ->columnSpan(1),
                            ])
                            ->columns([
                                'sm' => 3,
                                'lg' => 4,
                            ]),
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
                TextColumn::make('data')
                    ->sortable()
                    ->searchable()
                    ->date('d/m/Y')
                    ->label('DATA'),
            ])->defaultSort('data')
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
            'index' => Pages\ListFeriados::route('/'),
            'create' => Pages\CreateFeriado::route('/create'),
            'edit' => Pages\EditFeriado::route('/{record}/edit'),
        ];
    }
}
