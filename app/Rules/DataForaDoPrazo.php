<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DataForaDoPrazo implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //verificar se a data recebida em $attribute está de acordo com o prazo de antecedência
        $data_recebida = new \Carbon\Carbon($value);
        $hoje = new \Carbon\Carbon();
        //pegar o prazo em horas do banco de dados (PermutaPrazo)
        $prazo = \App\Models\PermutaPrazo::first();
        //colocar o prazo em horas, somar a data de hoje e colocar no formato de data
        $prazo = $prazo->horas_antecedencia;
        $data_hora_limite = $hoje->addHours($prazo);

        if ($data_recebida->lessThan($data_hora_limite)) {
            $fail("Esta permuta está fora do prazo de $prazo horas de antecedência");
        }
    }
}
