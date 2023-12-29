<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EscaladoResource\Pages;
use App\Filament\Resources\EscaladoResource\RelationManagers;
use App\Filament\Resources\EscaladoResource\Widgets\EscaladoOverview;
use App\Models\Efetivo;
use App\Models\EfetivoEscala;
use App\Models\Escala;
use App\Models\Escalado;
use Carbon\Carbon;
use Doctrine\DBAL\Query;
use Doctrine\DBAL\Query\QueryBuilder as DoctrineQueryBuilder;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Filament\Tables\Columns\ViewColumn;
use http\QueryString;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\Widgets\UserOverview;
use Illuminate\Support\Facades\Auth;

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
                                    ->live()
                                    ->afterStateUpdated(fn (callable $set) => $set('efetivo_id', null))
                                    ->label('Escala')
                                    ->required()
                                    ->columnSpan(1),
                                Forms\Components\Select::make('efetivo_id')
                                    ->options(function (callable $get) {
                                        $escala = Escala::find($get('escala_id'));
                                        $efetivo_show = [];
                                        if(!$escala){
                                            $efetivos = Efetivo::all();
                                            foreach ($efetivos as $efetivo) {
                                                $efetivo_show[$efetivo->id] = $efetivo->trigrama . ' - ' . $efetivo->rg;
                                            }
                                            return $efetivo_show;
                                        }
                                        $efetivo_escala = EfetivoEscala::where('escala_id', $get('escala_id'))->get();
                                        $efetivos = Efetivo::whereIn('id', $efetivo_escala->pluck('efetivo_id'))->get();
                                        foreach ($efetivos as $efetivo) {
                                            $efetivo_show[$efetivo->id] = $efetivo->trigrama . ' - ' . $efetivo->rg;
                                        } return $efetivo_show;
                                    })
                                    ->disabled(fn (callable $get) => !$get('escala_id'))
                                    ->label('Escalado')
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

    //region TABLEQUERY adjust
    protected function getTableQuery(): Builder
    {
        $authUser = Auth::user();
        $user_efetivo = Efetivo::where('user_id', $authUser->id)->pluck('id');
        if (($authUser->hasRole('super_admin') || ($authUser->hasRole('admin'))) == false) {
            //filtrar tabela exibindo apenas escalas do efetivo logado
            return Escalado::where('efetivo_id', $user_efetivo);
        }
        return Escalado::all();
    }
    //endregion

    //region TABLE
    public static function table(Table $table): Table
    {
        return $table
            //TODO: checar credenciais para exibir todos escalados
            ->query(function () {
                $authUser = Auth::user();
                $user_efetivo = Efetivo::where('user_id', $authUser->id)->pluck('id');
                if (($authUser->hasRole('super_admin') || ($authUser->hasRole('admin'))) == false) {
                    //filtrar tabela exibindo apenas escalas do efetivo logado
                    return Escalado::where('efetivo_id', $user_efetivo);
                }
                return Escalado::where('efetivo_id', 'like', '%');
            })
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

                TextColumn::make('efetivo_rg()')
                    ->default(function (Model $record) : string {
                        return $record->efetivo_rg();
                    })
                    ->label('RG'),

                TextColumn::make('efetivo_nome_guerra()')
                    ->default(function (Model $record) : string {
                        return $record->efetivo_nome_guerra();
                    })
                    ->label('GUERRA'),

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

                Filter::make('data_mes_atual')
                    ->query(function (Builder $query) {
                        $query->whereMonth('data', Carbon::now()->format('m'));
                    })
                    ->default(true)
                    ->label('MÊS ATUAL'),

                //TODO: CRIAR O FILTRO DE MES BASEADO NO VALOR SELECIONADO NO SELECT
                //TODO: PAREI O ESTUDO EM
                // https://filamentphp.com/docs/3.x/tables/filters/query-builder#date-constraints
                // VER CUSTOM OPERATORS

                /*SelectFilter::make('is_month')
                    ->options(function () {
                        $month = [];
                        $escalado = Escalado::all();
                        foreach ($escalado as $escalado) {
                            $month[$escalado->data] = Carbon::parse($escalado->data)->format('m');
                        }
                        return array_unique($month);
                    })
                    ->query(function (Builder $query) {
                        $query->whereMonth('data', $get);
                    })
                    ->label('MÊS'),*/
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
    //endregion

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

    public static function getWidgets(): array
    {
        return [
            EscaladoOverview::class,
        ];
    }
}
