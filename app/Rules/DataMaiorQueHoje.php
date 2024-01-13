<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DataMaiorQueHoje implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //verificar se a data recebida em $attribute é maior que hoje
        $data_recebida = new \Carbon\Carbon($value);
        $hoje = new \Carbon\Carbon();
        if ($data_recebida->lessThan($hoje)) {
            $fail("A data não pode ser anterior a data de hoje");
        }

    }
}
