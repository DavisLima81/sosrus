<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EfetivoResource\Pages;
use App\Filament\Resources\EfetivoResource\RelationManagers;
use App\Models\Efetivo;
use App\Models\Especialidade;
use App\Models\Quadro;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
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
                                    ->options(Quadro::all()->pluck('sigla', 'id')->toArray())
                                    ->label('Quadro')
                                    ->reactive()
                                    ->afterStateUpdated(fn (callable $set) => $set('especialidade_id', null))
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
                                    ->label('Condição')
                                    ->required()
                                    ->columnSpan(1),
                                Forms\Components\DatePicker::make('data_nascimento')
                                    ->default('d-m-Y')
                                    ->label('Nascimento')
                                    ->displayFormat('d/m/Y')
                                    ->required()
                                    ->columnSpan(1),
                                Forms\Components\Select::make('user_id')
                                    ->relationship('user', 'email')
                                    ->label('Usuário')
                                    ->nullable()
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
                TextColumn::make('trigrama')
                    ->sortable()
                    ->searchable()
                    ->label('TRIG'),

                TextColumn::make('precedencia.sigla')
                    ->sortable()
                    ->searchable()
                    ->label('POSTO/GRAD'),

                TextColumn::make('nome_guerra')
                    ->sortable()
                    ->searchable()
                    ->label('GUERRA'),

                TextColumn::make('user.email')
                    ->sortable()
                    ->searchable()
                    ->label('USUÁRIO'),
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
