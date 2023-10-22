<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MeuServicoResource\Pages;
use App\Models\Efetivo;
use App\Models\Escala;
use App\Models\Escalado;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Tables\Columns\ViewColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class MeuServicoResource extends Resource
{
    //region RESOURCE CONFIGURATION
    protected static ?string $model = Escalado::class;

    protected static ?string $label = 'Meu Serviço';

    protected static ?string $pluralLabel = 'Meus Serviços';

    protected static ?int $navigationSort = -1;

    protected static ?string $slug = 'meus-servicos';

    protected static ?string $navigationIcon = 'heroicon-s-arrow-uturn-up';

    //protected static ?string $navigationGroup = 'Escalas';

    protected static bool $shouldRegisterNavigation = true;                         //aplica filtro para acesso apenas a usuario registrado em FilamentServiceProvider
    //endregion
    //region FORM
    //endregion

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $user = auth()->user();
                $efetivo = Efetivo::all();
                $efetivo_id = $efetivo->where('user_id', $user->id)->first()->id;
                $query->where('efetivo_id', $efetivo_id);
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

                TextColumn::make('efetivo_trig()')
                    ->default(function (Model $record) : string {
                        return $record->efetivo_trig();
                    })
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
                    ->label('PERMUTA'),

            ])
            ->defaultSort('data', 'asc')
            ->filters([
                //filtro por data
                SelectFilter::make('data')
                    ->options(function () {
                        $data = [];
                        $escalado = Escalado::all()->where('efetivo_id', auth()->user()->efetivo->id);
                        foreach ($escalado as $escalado) {
                            $data[$escalado->data] = Carbon::parse($escalado->data)->format('d/m/Y');
                        }
                        return array_unique($data);
                    })
                    ->multiple()
                    ->label('DATA'),
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
            ])
            ->emptyStateActions([
                //
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
            'index' => Pages\ListMeuServicos::route('/'),
            //'create' => Pages\CreateMeuServico::route('/create'),
            //'edit' => Pages\EditMeuServico::route('/{record}/edit'),
            /*'view' => Pages\ViewEscalado::route('/{record}'),*/
        ];
    }

    public static function getWidgets(): array
    {
        return [
            //
        ];
    }
}
