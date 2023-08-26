<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuarnicaoResource\Pages;
use App\Filament\Resources\GuarnicaoResource\RelationManagers;
use App\Models\Guarnicao;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GuarnicaoResource extends Resource
{
    //region RESOURCE CONFIGURATION
    protected static ?string $model = Guarnicao::class;

    protected static ?string $label = 'Guarnição';

    protected static ?string $pluralLabel = 'Guarnições';

    protected static ?int $navigationSort = 12;

    protected static ?string $slug = 'guarnicoes';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

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
                            ->unique(ignoreRecord: true)
                            ->extraInputAttributes(['style' => 'text-transform:uppercase'])
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('nome')
                            ->label('Nome')
                            ->required()
                            ->maxLength(100)
                            ->columnSpan(3),
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
                    ->label('SIGLA'),

                TextColumn::make('nome')
                    ->sortable()
                    ->searchable()
                    ->label('NOME'),

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
            'index' => Pages\ListGuarnicaos::route('/'),
            'create' => Pages\CreateGuarnicao::route('/create'),
            'edit' => Pages\EditGuarnicao::route('/{record}/edit'),
        ];
    }
}
