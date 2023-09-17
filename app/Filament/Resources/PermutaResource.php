<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PermutaResource\Pages;
use App\Filament\Resources\PermutaResource\RelationManagers;
use App\Models\Permuta;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PermutaResource extends Resource
{
    //region RESOURCE CONFIGURATION
    protected static ?string $model = Permuta::class;

    protected static ?string $label = 'Permuta';

    protected static ?string $pluralLabel = 'Permutas';

    protected static ?int $navigationSort = 4;

    protected static ?string $slug = 'permutas';

    protected static ?string $navigationIcon = 'heroicon-s-arrows-right-left';

    protected static ?string $navigationGroup = 'Escalas';

    protected static bool $shouldRegisterNavigation = true;                         //aplica filtro para acesso apenas a usuario registrado em FilamentServiceProvider
    //endregion

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListPermutas::route('/'),
            'create' => Pages\CreatePermuta::route('/create'),
            'edit' => Pages\EditPermuta::route('/{record}/edit'),
        ];
    }
}
