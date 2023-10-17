<?php

namespace App\Filament\Resources\EscaladoResource\Widgets;

use App\Models\Escala;
use App\Models\Escalado;
use App\Models\Permuta;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EscaladoOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected function getCards(): array
    {
        $escaladoCount = Escalado::selectRaw('
            COUNT(*) as total')->first();
        $escalaCount = Escala::selectRaw('
            COUNT(*) as total')->first();
        $permutaCount = Permuta::selectRaw('
            COUNT(*) as total')->first();

        return [
            Card::make('Serviços registrados', $escaladoCount->total)
                ->color('primary')
                ->description('Total'),
            Card::make('Escalas registradas', $escalaCount->total)
                ->color('primary')
                ->description('Total'),
            Card::make('Permutas registradas', $permutaCount->total)
                ->color('primary')
                ->description('Total'),
        ];
    }
}
