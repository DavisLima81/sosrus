<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EscalaTipoResource\Pages;
use App\Filament\Resources\EscalaTipoResource\RelationManagers;
use App\Models\EscalaTipo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EscalaTipoResource extends Resource
{
    protected static ?string $model = EscalaTipo::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
            'index' => Pages\ListEscalaTipos::route('/'),
            'create' => Pages\CreateEscalaTipo::route('/create'),
            'edit' => Pages\EditEscalaTipo::route('/{record}/edit'),
        ];
    }    
}
