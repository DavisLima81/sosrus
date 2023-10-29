<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EscalaAgenda extends Model
/*
 *
 */

{
    use HasFactory;

    protected $table = 'escala_agendas';

    protected $fillable = [
        'id',
        'mes_id',
        'escala_id',
        'created_at',
        'updated_at',
    ];

    public function mes() : BelongsTo
    {
        return $this->belongsTo(Mes::class, 'mes_id', 'id');
    }

    public function getMes($mes_id) {
        $mes = Mes::where('id', $mes_id)->first();
        return $this->mes = $mes;
    }

    public function getEscala($escala_id) {
        $escala = Escala::where('id', $escala_id)->get();
        return $this->escala = $escala;
    }

    public function escala() : BelongsTo
    {
        return $this->belongsTo(Escala::class, 'escala_id', 'id');
    }

    //gera a agenda de eventos para o mês conforme as regras da escala
    public function getAgenda()
    {
        $escala_agenda = new EscalaAgenda();
        $escala = $this->escala;
        $mes = $this->mes;

        if($escala->regime->id == 1) {
            //instancia um evento para cada dia do mes
            for ($i = 1; $i <= $mes->numero_dias; $i++) {
                $evento = new Evento();
                $evento->resumo = $escala->guarnicao->sigla . ' - ' . $escala->nome;
                $evento->descricao = $escala->descricao;
                // $evento->localizacao = $escala->localizacao; TODO: implementar localização da escala
                $evento->inicio = date_create($mes->ano . '-' . $mes->numero . '-' . $i . ' ' . $escala->inicio);
                //$evento->fim = $escala->fim; TODO: implementar função para calcular o fim do evento
                $evento->frequentadores = '[]';
                $evento->lembretes = '[]';
                $evento->evento_tipo = null;
                $evento->status = 1;
                $evento->created = date('Y-m-d H:i:s');
                $evento->updated = date('Y-m-d H:i:s');
                $evento->cor_id = 1;
                $evento->criador_id = auth()->user()->id;
                $evento->organizador = null;
                $evento->fim_indefinido = 0;
                $evento->recorrencia = null;
                $evento->recorrencia_id = null;
                $evento->transparencia = 0;
                $evento->visibilidade = 0;
                $evento->iCalUID = null;
                $evento->sequencia = 0;
                $evento->frequentadores_omitidos = '[]';
                $evento->dia = $i;
                $evento->tipo = 1;

                $escala_agenda->i = $evento;
            }
            return $this->agenda = $escala_agenda;
        }
    }
}
