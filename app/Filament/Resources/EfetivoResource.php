<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EfetivoResource\Pages;
use App\Filament\Resources\EfetivoResource\RelationManagers;
use App\Models\Efetivo;
use App\Models\Escala;
use App\Models\Especialidade;
use App\Models\Quadro;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EfetivoResource extends Resource
{
    //region RESOURCE CONFIGURATION
    protected static ?string $model = Efetivo::class;

    protected static ?string $label = 'Efetivo';

    protected static ?string $pluralLabel = 'Efetivos';

    protected static ?int $navigationSort = 10;

    protected static ?string $slug = 'efetivos';

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    protected static ?string $navigationGroup = 'Gerencial';

    protected static bool $shouldRegisterNavigation = true;                         //aplica filtro para acesso apenas a usuario registrado em FilamentServiceProvider
    //endregion

    //region FORM
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Dados do efetivo militar')
                    ->icon('heroicon-m-identification')
                    ->schema([
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
                                            ->unique(ignoreRecord: true)
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
                                            ->label('Nome de guerra')
                                            ->required()
                                            ->maxLength(100)
                                            ->columnSpan(2),
                                        Forms\Components\Select::make('quadro_id')
                                            ->options(Quadro::all()->pluck('sigla', 'id')->toArray())
                                            ->label('Quadro')
                                            ->reactive()
                                            ->afterStateUpdated(fn (callable $set) => $set('especialidade_id', null))
                                            ->required()
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('rg')
                                            ->label('RG')
                                            ->rules('numeric')
                                            ->mask('99999')
                                            ->placeholder('99999')
                                            ->minLength(5)
                                            ->maxLength(99999)
                                            ->required()
                                            ->columnSpan(1),
                                        Forms\Components\Select::make('especialidade_id')
                                            ->options(function (callable $get) {
                                                $quadro = Quadro::find($get('quadro_id'));
                                                if (!$quadro) {
                                                    return Especialidade::all()->pluck('nome', 'id')->toArray();
                                                }
                                                return $quadro->especialidades->pluck('nome', 'id')->toArray();
                                            })
                                            ->disabled(fn (callable $get) => !$get('quadro_id'))
                                            ->label('Especialidade')
                                            ->required()
                                            ->columnSpan(1),
                                        Forms\Components\DatePicker::make('data_nascimento')
                                            ->default('d-m-Y')
                                            ->label('Nascimento')
                                            ->displayFormat('d/m/Y')
                                            ->required()
                                            ->columnSpan(1),
                                        Forms\Components\Select::make('status_id')
                                            ->relationship('status', 'nome')
                                            ->label('Condição')
                                            ->required()
                                            ->columnSpan(1),
                                    ])
                                    ->columns([
                                        'sm' => 3,
                                        'lg' => 4,
                                    ]),
                            ]),
                    ]),
                Section::make('Classificação, função e escalas')
                    ->icon('heroicon-m-arrow-trending-up')
                    ->schema([
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\Select::make('subunidade_id')
                                    ->relationship('subunidade', 'sigla')
                                    ->label('OBM')
                                    ->required()
                                    ->columnSpan(1),
                                Forms\Components\Select::make('funcao_id')
                                    ->relationship('funcao', 'nome')
                                    ->label('Função')
                                    ->required()
                                    ->columnSpan(2),
                                Forms\Components\Select::make('secao_id')
                                    ->relationship('secao', 'sigla')
                                    ->label('Seção')
                                    ->required()
                                    ->columnSpan(1),
                                Select::make('escala_id')
                                    ->relationship('escalas', 'nome')
                                    ->required()
                                    ->options(
                                        function () {
                                            $escalas = Escala::all();
                                            $options = [];
                                            foreach ($escalas as $escala) {
                                                $options[$escala->id] = $escala->getGuarnicaoSiglaAttribute() . ' - ' . $escala->nome;
                                            }
                                            return $options;
                                        })
                                    ->multiple()
                                    ->helperText('Selecione a(s) escala(s) a que o militar concorre')
                                    ->label('Escala(s) do militar')
                                    ->columnSpan(4),

                            ])
                            ->columns([
                                'sm' => 3,
                                'lg' => 4,
                            ]),
                    ]),
                Section::make('Usuário')
                    ->description('Registro de usuário associado ao militar')
                    ->icon('heroicon-o-lock-closed')
                    ->schema([
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\Select::make('user_id')
                                    ->relationship('user', 'email')
                                    ->label('Usuário')
                                    ->nullable()
                                    ->unique(ignoreRecord: true)
                                    ->columnSpan(2),
                            ])
                            ->columns([
                                'sm' => 3,
                                'lg' => 4,
                            ]),
                    ])
            ]);
    }
    //enregion

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('status.sigla')
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'DISP' => 'success',
                        'FERI' => 'danger',
                        'LMED' => 'danger',
                        'LMPA' => 'danger',
                        'LUTO' => 'danger',
                        'LESP' => 'danger',
                        'LTIP' => 'danger',
                        'CRSO' => 'danger',
                    })
                    ->searchable()
                    ->label('STATUS'),

                TextColumn::make('precedencia.sigla')
                    ->sortable()
                    ->searchable()
                    ->label('P/GRAD'),

                TextColumn::make('trigrama')
                    ->sortable()
                    ->searchable()
                    ->label('TRIG'),

                TextColumn::make('nome_guerra')
                    ->sortable()
                    ->searchable()
                    ->label('GUERRA'),

                TextColumn::make('user.email')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color('gray')
                    ->label('USUÁRIO'),
            ])
            ->defaultSort('trigrama', 'asc')
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
            //RelationManagers\EscalasRelationManager::class,
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
