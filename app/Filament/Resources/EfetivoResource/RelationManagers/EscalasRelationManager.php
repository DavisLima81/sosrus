<?php

namespace App\Filament\Resources\EfetivoResource\RelationManagers;

use App\Models\Escala;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EscalasRelationManager extends RelationManager
{
    protected static string $relationship = 'escalas';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('nome')
                    ->relationship('efetivos', 'nome')
                    ->required()
                    ->options(
                        function () {
                            $escalas = Escala::all();
                            $options = [];
                            foreach ($escalas as $escala) {
                                $options[$escala->id] = $escala->getGuarnicaoSiglaAttribute() . ' - ' . $escala->nome;
                            }
                            return $options;
                        }
                    )
                    ->multiple()
                    ->label('Escala'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nome')
            ->columns([
                Tables\Columns\TextColumn::make('nome'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
}
