<?php

namespace App\Filament\Resources\EscaladoResource\Widgets;

use App\Models\Efetivo;
use App\Models\Escala;
use App\Models\Escalado;
use App\Models\Guarnicao;
use App\Models\Permuta;
use App\Models\User;
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
        $efetivoCount = Efetivo::selectRaw('
            COUNT(*) as total')->first();
        $guarnicaoCount = Guarnicao::selectRaw('
            COUNT(*) as total')->first();
        $userCount = User::selectRaw('
            COUNT(*) as total')->first();

        return [
            Card::make('Usuários do sistema', $userCount->total)
                ->color('citrus')
                ->description('Total'),
            Card::make('Efetivo da OBM', $efetivoCount->total)
                ->color('citrus')
                ->description('Total'),
            Card::make('Guarnições (equipes)', $guarnicaoCount->total)
                ->color('citrus')
                ->description('Total'),
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
