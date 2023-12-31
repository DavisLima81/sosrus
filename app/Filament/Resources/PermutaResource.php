<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PermutaResource\Pages;
use App\Filament\Resources\PermutaResource\RelationManagers;
use App\Models\Efetivo;
use App\Models\EfetivoEscala;
use App\Models\Escala;
use App\Models\Escalado;
use App\Models\Permuta;
use App\Models\PermutaPrazo;
use App\Rules\NaoConsta;
use App\Rules\NaoVazio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;

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
                                    ->afterStateUpdated(function(callable $set) {
                                        $set('data', null);
                                        $set('sai_efetivo_id', null);
                                        $set('sai_efetivo_trigrama', null);
                                        $set('entra_efetivo_id', null);
                                    })
                                    ->live()
                                    ->required()
                                    ->columnSpan(1),
                                Forms\Components\DatePicker::make('data')
                                    ->default('d-m-Y')
                                    ->label('Data')
                                    ->displayFormat('d/m/Y')
                                    ->afterStateUpdated(function (callable $set, callable $get) {
                                        //region SET TRIGRAMA
                                        $escalado = Escalado::where('escala_id', $get('escala_id'))
                                            ->where('data', $get('data'))
                                            ->first();
                                        $permuta = Permuta::where('escala_id', $get('escala_id'))
                                            ->where('data', $get('data'))
                                            ->latest()
                                            ->first();
                                        if ($permuta) {
                                            $sai_efetivo = Efetivo::where('id', $permuta->entra_efetivo_id)->first();
                                            $set('sai_efetivo_id', $sai_efetivo->id);
                                            $set('sai_efetivo_trigrama', $sai_efetivo->trigrama);
                                        } else if ($escalado) {
                                            $sai_efetivo = Efetivo::where('id', $escalado->efetivo_id)->first();
                                            $set('sai_efetivo_id', $sai_efetivo->id);
                                            $set('sai_efetivo_trigrama', $sai_efetivo->trigrama);
                                        } else {
                                            $set('sai_efetivo_id', '');
                                            $set('sai_efetivo_trigrama', 'N/C');
                                        }
                                        //// endregion
                                        //// region SET NO_PRAZO
                                        $data = $get('data');
                                        $prazo = PermutaPrazo::all()->first()->horas_antecedencia;
                                        $data = Carbon::createFromFormat('Y-m-d', $data);
                                        $data = $data->subHour($prazo);
                                        $hoje = Carbon::now();
                                        if ($data->greaterThanOrEqualTo($hoje)) {
                                            $set('no_prazo', true);
                                        } else {
                                            $set('no_prazo', false);
                                        }
                                        //// endregion
                                    })
                                    ->live()
                                    ->required()
                                    ->columnSpan(1),
                                Forms\Components\TextInput::make('sai_efetivo_trigrama')
                                    ->label('Sai')
                                    ->helperText('N/C: não consta')
                                    ->live()
                                    ->readOnly()
                                    ->required()
                                    ->rules([
                                        new NaoConsta(),
                                    ])
                                    ->columnSpan(1),
                                Forms\Components\Select::make('entra_efetivo_id')
                                    ->options(function (callable $get) {
                                        $sai_efetivo_id = $get('sai_efetivo_id');
                                        $efetivo_escala = EfetivoEscala::where('escala_id', $get('escala_id'))->get();
                                        $efetivos = Efetivo::whereIn('id', $efetivo_escala->pluck('efetivo_id'))->get();
                                        if ($sai_efetivo_id == null) {
                                            return $efetivos->pluck('trigrama', 'id');
                                        } else {
                                            $a[0] = $sai_efetivo_id;
                                            return Efetivo::whereIn('id', $efetivo_escala->pluck('efetivo_id'))->whereNotIn('id', $a)->pluck('trigrama', 'id');
                                        }
                                    })
                                    ->disabled(fn (callable $get) => !$get('data'))
                                    ->label('Entra')
                                    ->live()
                                    ->required()
                                    ->columnSpan(1),
                                //TODO: implementar lógica pra avaliar se está no prazo
                                Forms\Components\Toggle::make('no_prazo')
                                    ->label('Prazo')
                                    ->helperText('Avalia se está no prazo')
                                    ->extraAttributes(['class' => 'toggle toggle-error'])
                                    ->default(false)
                                    ->live()
                                    ->columnSpan(1),
                                Forms\Components\Select::make('autorizador_id')
                                    ->relationship('autorizador', 'trigrama')
                                    ->label('Autorizado por')
                                    ->default(null)
                                    ->required(function (callable $get) {
                                        if ($get('no_prazo' == false))
                                            return true;
                                        else
                                            return false;
                                    })
                                    ->columnSpan(1),
                                Forms\Components\Hidden::make('sai_efetivo_id')
                                    //->relationship('sai_efetivo', 'trigrama')
                                    ->live()
                                    ->required()
                                    ->rules([
                                        'required',
                                        new NaoVazio(),
                                    ])
                                    ->columnSpan(-1),

                                /////////////////////////////

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
                TextColumn::make('data')
                    ->date('d/m/Y')
                    ->sortable()
                    ->searchable()
                    ->label('DATA'),

                ViewColumn::make('escala_id')
                    ->view('tables.columns.escalado-escala-guarnicao')
                    ->sortable()
                    ->searchable()
                    ->tooltip('Não usar pesquisa, usar filtro')
                    ->label('GUARNIÇÃO - ESCALA'),

                TextColumn::make('sai_efetivo.trigrama')
                    ->sortable()
                    ->searchable()
                    ->label('SAI'),

                TextColumn::make('entra_efetivo.trigrama')
                    ->sortable()
                    ->searchable()
                    ->label('ENTRA'),

                TextColumn::make('no_prazo')
                    ->state(function (Model $record) : string {
                        if ($record->no_prazo == 0)
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
                    ->label('NO PRAZO'),

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

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListPermutas::route('/'),
            'create' => Pages\CreatePermuta::route('/create'),
            'edit' => Pages\EditPermuta::route('/{record}/edit'),
        ];
    }
}
