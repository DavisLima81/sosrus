<?php

namespace App\Livewire;

use App\Models\Efetivo;
use App\Models\Escala;
use App\Models\Escalado;
use App\Models\Guarnicao;
use Livewire\Component;
use App\Models\MeuServico;

class ShowCalendarioMeuServicos extends Component
{
    public array $events = [];

    public function mount()
    {
        $this->events = $this->fetchEvents();
    }

    public function render()
    {
        return view('livewire.show-calendario-meu-servicos');
    }

    public function getEfetivo() {
        $efetivo = Efetivo::where('user_id', auth()->user()->id)->first();
        if($efetivo)
            return $this->efetivo = $efetivo;
        else
            throw new \Exception('Efetivo não encontrado');
    }

    public function getEscalados()
    {
        $efetivo = $this->getEfetivo();
        $escalados = Escalado::where('efetivo_id', $efetivo->id)->get();
        return $this->escalados = $escalados;
    }

    public function getMeuServicos()
    {
        $efetivo = $this->getEfetivo();
        $escalados = $this->getEscalados();
        $escalas = [];

        //TODO: criar uma função para normalizar 'inicio' e 'fim' para o formato 'Y-m-d H:i:s'
        foreach($escalados as $escalado)
        {
            $escala = Escala::where('id', $escalado->escala_id)->first();
            $escalas[] = $escala;
            $escala['fim'] = (int) substr_replace($escala->inicio, '', 2, 2) + $escala->duracao;
            $escala['fim'] = substr_replace(substr_replace($escala['fim'], ':00', 2), ':00', 5);
            $escala['end'] = $escalado->data . 'T' . $escala['fim'];
            $escala['start'] = $escalado->data . 'T' . substr_replace(substr_replace($escala->inicio, ':', 2, 0), ':00', 5);
            $escala['nome'] = $escala->guarnicao->sigla . '-' . $escala->nome;
            $escala['id'] = $escalado->id;

        }
        return $escalas;
    }

    public function fetchEvents(): array
    {

        $events = [
            [
                'title' => 'AMD-CMD',
                'start' => '2023-11-05T08:00:00',
                'end' => '2023-11-05T14:00:00',
                'url' => env('APP_URL'),
                'shouldOpenUrlInNewTab' => false,
            ],
            [
                'title' => 'AMD-CMD',
                'start' => '2023-11-06T08:00:00',
                'end' => '2023-11-06T14:00:00',
                'url' => env('APP_URL'),
                'shouldOpenUrlInNewTab' => false,
            ],
        ];
        //dd($events);
        return $events;
    }
}
