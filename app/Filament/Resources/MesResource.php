<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MesResource\Pages;
use App\Filament\Resources\MesResource\RelationManagers;
use App\Models\Mes;
use App\Rules\ExisteMes;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use function Laravel\Prompts\alert;

class MesResource extends Resource
{
    //region RESOURCE CONFIGURATION
    protected static ?string $model = Mes::class;

    protected static ?string $label = 'Mês';

    protected static ?string $pluralLabel = 'Meses';

    protected static ?int $navigationSort = 11;

    protected static ?string $slug = 'meses';

    protected static ?string $navigationIcon = 'heroicon-o-view-columns';

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
                                Forms\Components\Select::make('ano')
                                    ->label('Ano')
                                    ->options([
                                        date('Y') => date('Y'),
                                        date('Y') + 1 => date('Y') + 1,
                                    ])
                                    ->default(date('Y'))
                                    ->reactive()
                                    ->columnSpan(1),
                                Forms\Components\Select::make('do_ano_mes_id')
                                    ->relationship('doAnoMeses', 'nome',
                                        fn(Builder $query) => $query->orderBy('id'))
                                    //checar se já existe um mes cadastrado com o mesmo ano e nome
                                    ->rules(['required', new ExisteMes])
                                    ->label('Nome')
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
                TextColumn::make('ano')
                    ->sortable()
                    ->searchable()
                    ->label('ANO'),
                TextColumn::make('do_ano_mes_id')
                    ->sortable()
                    ->searchable()
                    ->label('MÊS'),
                TextColumn::make('doAnoMeses.nome')
                    ->label(''),

            ])
            ->defaultSort(fn (Builder $query) => $query->orderBy('do_ano_mes_id', 'desc'))
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
            'index' => Pages\ListMes::route('/'),
            'create' => Pages\CreateMes::route('/create'),
            'edit' => Pages\EditMes::route('/{record}/edit'),
            'grid' => Pages\GridMes::route('/{record?}/grade'),

        ];
    }
}
