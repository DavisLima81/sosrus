<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EscalaResource\Pages;
use App\Filament\Resources\EscalaResource\RelationManagers;
use App\Models\Efetivo;
use App\Models\Escala;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\BooleanColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Support\RawJs;

class EscalaResource extends Resource
{
    //region RESOURCE CONFIGURATION
    protected static ?string $model = Escala::class;

    protected static ?string $label = 'Escala';

    protected static ?string $pluralLabel = 'Escalas';

    protected static ?int $navigationSort = 2;

    protected static ?string $slug = 'escalas';

    protected static ?string $navigationIcon = 'heroicon-o-map';

    protected static ?string $navigationGroup = 'Escalas';

    protected static bool $shouldRegisterNavigation = true;                         //aplica filtro para acesso apenas a usuario registrado em FilamentServiceProvider
    //endregion

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Dados da escala')
                    ->icon('heroicon-o-map')
                    ->schema([
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\Section::make()
                                    ->schema([
                                        Forms\Components\Select::make('escala_tipo_id')
                                            ->relationship('escala_tipo', 'nome')
                                            ->label('Tipo de escala')
                                            ->required()
                                            ->columnSpan(1),
                                        Forms\Components\Select::make('guarnicao_id')
                                            ->relationship('guarnicao', 'sigla')
                                            ->label('Guarnição')
                                            ->required()
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('nome')
                                            ->label('Nome')
                                            ->required()
                                            ->rule('max:10')
                                            ->maxLength(10)
                                            ->extraInputAttributes(['style' => 'text-transform:uppercase'])
                                            ->placeholder('Máx 10 carac.')
                                            ->columnSpan(2),
                                        Forms\Components\TextInput::make('descricao')
                                            ->label('Descrição')
                                            ->required()
                                            ->rule('max:155')
                                            ->maxLength(155)
                                            ->placeholder('Descreva a escala. Máx 155 carac.')
                                            ->columnSpan(4),
                                        Forms\Components\Select::make('regime_id')
                                            ->relationship('regime', 'nome')
                                            ->label('Regime')
                                            ->required()
                                            ->columnSpan(2),
                                        Forms\Components\Select::make('inicio')
                                            ->options(['0600' => '06:00', '0800' => '08:00', '1200' => '12:00',
                                                '1800' => '18:00', '2000' => '20:00'])
                                            ->label('Início')
                                            ->rule('max:4')
                                            ->required()
                                            ->columnSpan(1),
                                        Forms\Components\Select::make('duracao')
                                            ->options([4 => '04', 8 => '08', 12 => '12',
                                                24 => '24'])
                                            ->label('Duração (h)')
                                            ->rule('max:2')
                                            ->required()
                                            ->columnSpan(1),
                                        Forms\Components\toggle::make('ativo')
                                            ->label('Ativo')
                                            ->default(true)
                                            ->extraAttributes(['class' => 'toggle toggle-error'])
                                            ->columnSpan(1),
                                    ])
                                    ->columns([
                                        'sm' => 3,
                                        'lg' => 4,

                                    ]),
                            ]),
                    ]),
                Section::make('Militares desta escala')
                    ->icon('heroicon-o-user-group')
                    ->schema([
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\Section::make()
                                    ->schema([
                                        Select::make('efetivo_id')
                                            ->relationship('efetivos', 'trigrama')
                                            ->options(
                                                function () {
                                                    $efetivo = Efetivo::all()->pluck('trigrama', 'id');
                                                    return $efetivo;
                                                    })
                                            ->required()
                                            ->multiple()
                                            ->helperText('Selecione o(s) militar(es) desta escala.')
                                            ->label('Militares desta escala')
                                            ->columnSpan(4),
                                    ])
                                    ->columns([
                                        'sm' => 3,
                                        'lg' => 4,

                                    ]),
                            ]),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('regime.nome')
                    ->sortable()
                    ->searchable()
                    ->label('REGIME'),
                TextColumn::make('guarnicao.sigla')
                    ->sortable()
                    ->searchable()
                    ->label('GUARNIÇÃO'),

                TextColumn::make('nome')
                    ->sortable()
                    ->searchable()
                    ->label('ESCALA'),

                TextColumn::make('duracao')
                    ->sortable()
                    ->searchable()
                    ->label('DURAÇÃO (h)'),
                BooleanColumn::make('ativo')
                    ->sortable()
                    ->searchable()
                    ->label('ATIVA'),
            ])
            ->defaultSort('nome')
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
            'index' => Pages\ListEscalas::route('/'),
            'create' => Pages\CreateEscala::route('/create'),
            'edit' => Pages\EditEscala::route('/{record}/edit'),
        ];
    }
}
