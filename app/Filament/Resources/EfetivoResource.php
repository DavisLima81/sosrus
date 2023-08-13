<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EfetivoResource\Pages;
use App\Filament\Resources\EfetivoResource\RelationManagers;
use App\Models\Efetivo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EfetivoResource extends Resource
{
    protected static ?string $model = Efetivo::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpan(3),
                                Forms\Components\TextInput::make('trigrama')
                                    ->label('Trigrama')
                                    ->required()
                                    ->rule('size:3')
                                    ->maxLength(3)
                                    ->extraInputAttributes(['style' => 'text-transform:uppercase'])
                                    ->columnSpan(1),
                                Forms\Components\Select::make('precedencia_id')
                                    ->relationship('precedencia', 'nome')
                                    ->label('Precedência')
                                    ->required()
                                    ->columnSpan(1),
                                Forms\Components\TextInput::make('nome_guerra')
                                    ->label('Guerra')
                                    ->required()
                                    ->maxLength(100)
                                    ->columnSpan(2),
                                Forms\Components\Select::make('quadro_id')
                                    ->relationship('quadro', 'sigla')
                                    ->label('Quadro')
                                    ->required()
                                    ->columnSpan(1),
                                Forms\Components\Select::make('especialidade_id')
                                    ->relationship('especialidade', 'sigla')
                                    ->label('Especialidade')
                                    ->required()
                                    ->columnSpan(1),
                                Forms\Components\Select::make('subunidade_id')
                                    ->relationship('subunidade', 'sigla')
                                    ->label('OBM')
                                    ->required()
                                    ->columnSpan(1),Forms\Components\Select::make('funcao_id')
                                    ->relationship('funcao', 'nome')
                                    ->label('Função')
                                    ->required()
                                    ->columnSpan(1),
                                Forms\Components\Select::make('secao_id')
                                    ->relationship('secao', 'sigla')
                                    ->label('Seção')
                                    ->required()
                                    ->columnSpan(1),
                                Forms\Components\Select::make('status_id')
                                    ->relationship('status', 'nome')
                                    ->label('Seção')
                                    ->required()
                                    ->columnSpan(1),
                                Forms\Components\DatePicker::make('nascimento')
                                    ->default('d-m-Y')
                                    ->label('Nascimento')
                                    ->format('d/m/Y')
                                    ->required()
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
            'index' => Pages\ListEfetivos::route('/'),
            'create' => Pages\CreateEfetivo::route('/create'),
            'edit' => Pages\EditEfetivo::route('/{record}/edit'),
        ];
    }
}
