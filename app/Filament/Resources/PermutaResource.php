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
use App\Rules\DataForaDoPrazo;
use App\Rules\DataMaiorQueHoje;
use App\Rules\LogadoNaoPermutado;
use App\Rules\NaoConsta;
use App\Rules\NaoVazio;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

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
                                        $auth_user = Auth::user();
                                        $auth_efetivo_id = Auth::user()->efetivo()->first()->id;
                                        $efetivo_escala = EfetivoEscala::where('efetivo_id', $auth_efetivo_id)->get();
                                        if (($auth_user->hasRole('super_admin')) || ($auth_user->hasRole('admin'))){
                                            $escala = Escala::all();
                                        } else {
                                            $escala = Escala::whereIn('id', $efetivo_escala->pluck('escala_id'))->get();
                                        }
                                        foreach ($escala as $escala) {
                                            $escala_show[$escala->id] = $escala->guarnicao->sigla . ' - ' . $escala->nome;
                                        }
                                        return $escala_show;
                                    })
                                    ->label('Escala')
                                    ->afterStateUpdated(function(callable $set) {
                                        $set('data', null);
                                        $set('sai_efetivo_id', null);
                                        $set('sai_efetivo_rg', null);
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
                                        //region SET rg
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
                                            $set('sai_efetivo_rg', $sai_efetivo->rg);
                                        } else if ($escalado) {
                                            $sai_efetivo = Efetivo::where('id', $escalado->efetivo_id)->first();
                                            $set('sai_efetivo_id', $sai_efetivo->id);
                                            $set('sai_efetivo_rg', $sai_efetivo->rg);
                                        } else {
                                            $set('sai_efetivo_id', '');
                                            $set('sai_efetivo_rg', 'N/C');
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
                                    ->rules([
                                        new DataForaDoPrazo(),
                                    ])
                                    ->required()
                                    ->columnSpan(1),

                                Forms\Components\TextInput::make('sai_efetivo_rg')
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
                                        $auth_user = Auth::user();
                                        $auth_efetivo_id = Auth::user()->efetivo()->first()->id;
                                        $efetivo_escala = EfetivoEscala::where('escala_id', $get('escala_id'))->get();
                                        $efetivos = Efetivo::whereIn('id', $efetivo_escala->pluck('efetivo_id'))->get();

                                        if (($auth_user->hasRole('super_admin')) || ($auth_user->hasRole('admin'))){
                                            if ($sai_efetivo_id == null) {
                                                return $efetivos->pluck('rg', 'id');
                                            }   else {
                                                $a[0] = $sai_efetivo_id;
                                                return Efetivo::whereIn('id', $efetivo_escala->pluck('efetivo_id'))->whereNotIn('id', $a)->pluck('rg', 'id');
                                            }
                                        } else {
                                            if ($sai_efetivo_id == null) {
                                                return $efetivos->pluck('rg', 'id');
                                            } else if (($sai_efetivo_id != null) && ($sai_efetivo_id != $auth_efetivo_id)) {
                                                $a[0] = $sai_efetivo_id;
                                                return Efetivo::where('id', $auth_efetivo_id)->pluck('rg', 'id');
                                            } else {
                                                $a[0] = $sai_efetivo_id;
                                                return Efetivo::whereIn('id', $efetivo_escala->pluck('efetivo_id'))->whereNotIn('id', $a)->pluck('rg', 'id');
                                            }
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
                                    ->relationship('autorizador', 'rg')
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
                                    //->relationship('sai_efetivo', 'rg')
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
            //CHECA CREDENCIAIS e exibe registros conforme
            ->query(function () {
                $auth_user = Auth::user();
                $user_efetivo = Efetivo::where('user_id', $auth_user->id)->pluck('id');
                $escalas = EfetivoEscala::where('efetivo_id', $user_efetivo)->pluck('escala_id');
                if (($auth_user->hasRole('super_admin') || ($auth_user->hasRole('admin'))) == false) {
                    //filtrar tabela exibindo apenas escalas do efetivo logado
                    return Permuta::whereIn('escala_id', $escalas);
                }
                return Permuta::where('entra_efetivo_id', 'like', '%')->orwhere('sai_efetivo_id', 'like', '%');
            })
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
                    ->label('GRN/ESCALA'),

                TextColumn::make('sai_efetivo_rg')
                    ->default(function (Model $record) : string {
                        return $record->sai_efetivo()->first()->rg;
                    })
                    ->label('SAI (rg)')
                    ->tooltip('Não usar pesquisa, usar filtro'),

                TextColumn::make('sai_efetivo_nome')
                    ->default(function (Model $record) : string {
                        return $record->sai_efetivo()->first()->nome_guerra;
                    })
                    ->label('SAI (guerra)')
                    ->tooltip('Não usar pesquisa, usar filtro'),

                TextColumn::make('entra_efetivo_rg')
                    ->default(function (Model $record) : string {
                        return $record->entra_efetivo()->first()->rg;
                    })
                    ->label('ENTRA (rg)')
                    ->tooltip('Não usar pesquisa, usar filtro'),

                TextColumn::make('entra_efetivo_nome')
                    ->default(function (Model $record) : string {
                        return $record->entra_efetivo()->first()->nome_guerra;
                    })
                    ->label('ENTRA (guerra)')
                    ->tooltip('Não usar pesquisa, usar filtro'),

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
                    ->label('PRAZO'),

            ])
            ->defaultSort('data', 'asc')
            ->filters([
                //TODO: implementar mesmos filtros, e mesmos que em EscaladoResource
                Filter::make('escala_id')
                    /*->relationship('escala', 'guarnicao_id')*/
                    ->form([
                        Select::make('escala_id')
                            ->options(function () {
                                $escala_show = [];
                                $escala = Escala::all();
                                foreach ($escala as $escala) {
                                    $escala_show[$escala->id] = $escala->guarnicao->sigla . '/' . $escala->nome;
                                }
                                return $escala_show;
                            })
                            ->label('ESCALA')
                            ->multiple(),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        //dd($data['escala_id']);
                        return $query
                            ->where(
                                $data['escala_id'],
                                fn (Builder $query, $escala_id): Builder => $query->whereIn('escala_id', $escala_id
                            ));
                        //->whereIn('escala_id', $data['escala_id']);
                    })
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

    public function checarUserPermutado($id)
    {
        $user = Auth::user();
        $permuta = Permuta::find($id);
        if ($user->id == $permuta->sai_efetivo_id || $user->id == $permuta->entra_efetivo_id) {
            return true;
        } else {
            return false;
        }
    }
}
