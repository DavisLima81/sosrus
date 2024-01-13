<?php

namespace App\Filament\Resources\PermutaResource\Pages;

use App\Filament\Resources\PermutaResource;
use App\Models\Efetivo;
use App\Models\EfetivoEscala;
use App\Models\Escala;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListPermutas extends ListRecords
{
    protected static string $resource = PermutaResource::class;

    public function getSubheading(): ?string
    {
        $auth_user = Auth::user();
        $user_efetivo = Efetivo::where('user_id', $auth_user->id)->pluck('id');
        $escalas = EfetivoEscala::where('efetivo_id', $user_efetivo)->pluck('escala_id');
        $escala_show = [];
        if (($auth_user->hasRole('super_admin') || ($auth_user->hasRole('admin'))) == false) {
            $escalas = Escala::whereIn('id', $escalas)->get();
            foreach ($escalas as $escala) {
                $escala_show[$escala->id] = $escala->guarnicao->sigla . '/' . $escala->nome;
            }
            $lista = implode('; ', $escala_show);
            $minhas_escalas = "Minhas escalas: $lista.";
        } else {
            $minhas_escalas = "Minhas escalas: Todas.";
        }
        return __($minhas_escalas);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
