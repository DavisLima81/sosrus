<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EscalaAgendaResource\Pages;
use App\Filament\Resources\EscalaAgendaResource\RelationManagers;
use App\Models\EscalaAgenda;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EscalaAgendaResource extends Resource
{
    protected static ?string $model = EscalaAgenda::class;

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
            'index' => Pages\ListEscalaAgenda::route('/'),
            'create' => Pages\CreateEscalaAgenda::route('/create'),
            'edit' => Pages\EditEscalaAgenda::route('/{record}/edit'),
            'view' => Pages\ViewEscalaAgenda::route('/{mes_id}/{escala_id}/view'),
        ];
    }
}
