<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Efetivo;
use App\Models\Escala;

class MeuServico extends Model
{
    use HasFactory;

    public $efetivo;
    public $escalados;
    public $meu_servicos;

    //criar funcção constructor para instanciar esta classe
    public function __construct()
    {
        $user_id = auth()->user()->id;
        $this->efetivo = $this->getEfetivo($user_id);
        $this->escalados = $this->getEscalados();
        $this->meu_servicos = $this->getMeuServicos();
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
        $escalados = Escalado::with('escala', 'escala.guarnicao')->where('efetivo_id', $efetivo->id)->get();
        return $this->escalados = $escalados;
    }

    public function getMeuServicos()
    {
        $efetivo = $this->getEfetivo();
        $escalados = $this->getEscalados();
        //dd($escalados[0]->escala->escala_tipo_id);

        $meu_servicos = [];

        $count = count($escalados);
        for ($i=0; $i < $count; $i++) {
            $meu_servicos[$i]['id'] = $i;
            $meu_servicos[$i]['title'] = $escalados[$i]->escala->nome . '-' . $escalados[$i]->escala->guarnicao->sigla;
            $meu_servicos[$i]['start'] = $escalados[$i]->data . 'T' . substr_replace(substr_replace($escalados[$i]->escala->inicio, ':', 2, 0), ':00', 5);
            $meu_servicos[$i]['end'] = $escalados[$i]->data . 'T' . '23:59:59';
            $meu_servicos[$i]['allDay'] = false;

            if ($escalados[$i]->escala->escala_tipo_id == 1){
                $meu_servicos[$i]['backgroundColor'] = '#02edf5';
            }
            if ($escalados[$i]->escala->escala_tipo_id == 2){
                $meu_servicos[$i]['backgroundColor'] = '#f50206';
            }
            if ($escalados[$i]->escala->escala_tipo_id == 3){
                $meu_servicos[$i]['backgroundColor'] = '#f5f102';
            }
            if ($escalados[$i]->escala->escala_tipo_id == 4){
                $meu_servicos[$i]['backgroundColor'] = '#4f02f5';
            }

        }
        return $meu_servicos;
    }

}
