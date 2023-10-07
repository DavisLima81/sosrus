<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EscaladoResource\Pages;
use App\Filament\Resources\EscaladoResource\RelationManagers;
use App\Models\Escala;
use App\Models\Escalado;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Tables\Columns\ViewColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EscaladoResource extends Resource
{
    //region RESOURCE CONFIGURATION
    protected static ?string $model = Escalado::class;

    protected static ?string $label = 'Escalado';

    protected static ?string $pluralLabel = 'Escalados';

    protected static ?int $navigationSort = 3;

    protected static ?string $slug = 'escalados';

    protected static ?string $navigationIcon = 'heroicon-s-arrow-uturn-up';

    protected static ?string $navigationGroup = 'Escalas';

    protected static bool $shouldRegisterNavigation = true;                         //aplica filtro para acesso apenas a usuario registrado em FilamentServiceProvider
    //endregion
    //region FORM
    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                //criar campos
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\Select::make('escala_id')
                                    ->relationship('escala', 'nome')
                                    ->options(function () {
                                        $escala_show = [];
                                        $escala = Escala::all();
                                        foreach ($escala as $escala) {
                                            $escala_show[$escala->id] = $escala->guarnicao->sigla . ' - ' . $escala->nome;
                                        }
                                        return $escala_show;
                                    })
                                    ->label('Escala')
                                    ->required()
                                    ->columnSpan(1),
                                Forms\Components\Select::make('efetivo_id')
                                    ->relationship('efetivo', 'trigrama')
                                    ->label('Escala')
                                    ->required()
                                    ->columnSpan(1),
                                Forms\Components\DatePicker::make('data')
                                    ->default('d-m-Y')
                                    ->label('Data')
                                    ->displayFormat('d/m/Y')
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
    //enregion

    public static function table(Table $table): Table
    {
        return $table
                    ->columns([
                        //
                        ViewColumn::make('escala_id')
                            ->view('tables.columns.escalado-escala-guarnicao')
                            ->sortable()
                            ->searchable()
                            ->tooltip('Não usar pesquisa, usar filtro')
                            ->label('GUARNIÇÃO - ESCALA'),

                        TextColumn::make('data')
                            ->date('d/m/Y')
                            ->sortable()
                            ->searchable()
                            ->label('DATA'),

                        TextColumn::make('efetivo_trig()')
                            ->default(function (Model $record) : string {
                                return $record->efetivo_trig();
                            })
                            ->sortable()
                            ->label('TRIG'),

                        TextColumn::make('tem_permuta')
                            ->state(function (Model $record) : string {
                                if ($record->temPermuta() == 1)
                                    return 'SIM';
                                else
                                    return 'NÃO';
                            })
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'SIM' => 'warning',
                                'NÃO' => 'gray',
                            })
                            ->sortable()
                            ->label('PERMUTA'),

                    ])
            ->defaultSort('data', 'asc')
            ->filters([
                SelectFilter::make('escala_id')
                    /*->relationship('escala', 'guarnicao_id')*/
                    ->options(function () {
                        $escala_show = [];
                        $escala = Escala::all();
                        foreach ($escala as $escala) {
                            $escala_show[$escala->id] = $escala->guarnicao->sigla . ' - ' . $escala->nome;
                        }
                        return $escala_show;
                    })
                    ->multiple()
                    ->label('ESCALA'),
                SelectFilter::make('data')
                    ->options(function () {
                        $data = [];
                        $escalado = Escalado::all();
                        foreach ($escalado as $escalado) {
                                $data[$escalado->data] = Carbon::parse($escalado->data)->format('d/m/Y');
                        }
                        return array_unique($data);
                    })
                    ->multiple()
                    ->label('DATA'),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                /*Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),*/
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
            'index' => Pages\ListEscalados::route('/'),
            'create' => Pages\CreateEscalado::route('/create'),
            'edit' => Pages\EditEscalado::route('/{record}/edit'),
            'view' => Pages\ViewEscalado::route('/{record}'),
        ];
    }
}
