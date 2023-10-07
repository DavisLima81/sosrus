<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PermutaPrazoResource\Pages;
use App\Filament\Resources\PermutaPrazoResource\RelationManagers;
use App\Models\PermutaPrazo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Actions\CreateAction;
use Filament\Forms\Components\TextInput;

class PermutaPrazoResource extends Resource
{
    //region RESOURCE CONFIGURATION
    protected static ?string $model = PermutaPrazo::class;

    protected static ?string $label = 'Prazo Permuta';

    protected static ?string $pluralLabel = 'Prazo Permuta';

    protected static ?int $navigationSort = 16;

    protected static ?string $slug = 'prazos-de-permutas';

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    protected static ?string $navigationGroup = 'Gerencial';

    protected static bool $shouldRegisterNavigation = true;
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
                                Forms\Components\Select::make('horas_antecedencia')
                                    ->options([
                                        12 => '12 horas',
                                        24 => '24 horas',
                                        48 => '48 horas',
                                        72 => '72 horas',
                                    ])
                                    ->label('Prazo de antecedência para permuta')
                                    ->required()
                                    ->columnSpan(4),
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
                TextColumn::make('horas_antecedencia')
                    ->label('ANTECEDÊNCIA (h)'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
            ])
            ->emptyStateActions([
                //Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePermutaPrazos::route('/'),
        ];
    }
}
