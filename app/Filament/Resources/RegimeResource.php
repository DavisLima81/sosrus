<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegimeResource\Pages;
use App\Filament\Resources\RegimeResource\RelationManagers;
use App\Models\Regime;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RegimeResource extends Resource
{
//region RESOURCE CONFIGURATION
    protected static ?string $model = Regime::class;

    protected static ?string $label = 'Regime';

    protected static ?string $pluralLabel = 'Regimes';

    protected static ?int $navigationSort = 13;

    protected static ?string $slug = 'regimes';

    protected static ?string $navigationIcon = 'heroicon-s-adjustments-vertical';

    protected static ?string $navigationGroup = 'Gerencial';

    protected static bool $shouldRegisterNavigation = true;                         //aplica filtro para acesso apenas a usuario registrado em FilamentServiceProvider
    //endregion

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('sigla')
                            ->label('Sigla')
                            ->required()
                            ->length(3)
                            ->rule('size:3')
                            ->extraInputAttributes(['style' => 'text-transform:uppercase'])
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('nome')
                            ->label('Nome')
                            ->required()
                            ->maxLength(100)
                            ->columnSpan(2),
                        Forms\Components\TextInput::make('carga')
                            ->label('Carga (h)')
                            ->required()
                            ->maxLength(3)
                            ->numeric()
                            ->columnSpan(1),
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
                TextColumn::make('sigla')
                    ->sortable()
                    ->searchable()
                    ->label('SIGLA')
                    ->sortable('desc')
                    ->searchable(),

                TextColumn::make('nome')
                    ->sortable()
                    ->searchable()
                    ->label('NOME'),

                TextColumn::make('carga')
                    ->sortable()
                    ->searchable()
                    ->label('CARGA (h)'),

                /*TextColumn::make('descricao')
                    ->sortable()
                    ->searchable()
                    ->extraCellAttributes(['class' => 'width-1/8'])
                    ->label('Descrição'),*/
            ])
            ->defaultSort('sigla', 'asc')
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
            'index' => Pages\ListRegimes::route('/'),
            'create' => Pages\CreateRegime::route('/create'),
            'edit' => Pages\EditRegime::route('/{record}/edit'),
        ];
    }
}
