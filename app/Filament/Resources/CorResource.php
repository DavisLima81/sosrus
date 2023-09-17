<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CorResource\Pages;
use App\Filament\Resources\CorResource\RelationManagers;
use App\Models\Cor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CorResource extends Resource
{

    //region RESOURCE CONFIGURATION
    protected static ?string $model = Cor::class;

    protected static ?string $label = 'Cor';

    protected static ?string $pluralLabel = 'Cores';

    protected static ?int $navigationSort = 40;

    protected static ?string $slug = 'cors';

    protected static ?string $navigationIcon = 'heroicon-o-paint-brush';

    protected static ?string $navigationGroup = 'Auxiliares';

    protected static bool $shouldRegisterNavigation = true;                         //aplica filtro para acesso apenas a usuario registrado em FilamentServiceProvider
    //endregion

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('nome')
                            ->label('Nome')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->columnSpan(3),
                        Forms\Components\ColorPicker::make('hexadecimal')
                            ->label('Exadecimal da cor')
                            ->required()
                            ->columnSpan(1),
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
                TextColumn::make('nome')
                    ->sortable()
                    ->searchable()
                    ->label('NOME'),
                ColorColumn::make('hexadecimal')
                    ->sortable()
                    ->searchable()
                    ->label('AMOSTRA'),
            ])->defaultSort('nome', 'asc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
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
            'index' => Pages\ListCors::route('/'),
            'create' => Pages\CreateCor::route('/create'),
            'edit' => Pages\EditCor::route('/{record}/edit'),
        ];
    }
}
