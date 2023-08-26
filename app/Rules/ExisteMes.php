<?php

namespace App\Rules;

use App\Models\Mes;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ExisteMes implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $mes = Mes::where('do_ano_mes_id', $value)->where('ano', date('Y'))->get();;
        if ($mes && $mes->count() > 0) {
            $fail("o mês $value já está cadastrado para o ano atual");
        }
        $mes = Mes::where('do_ano_mes_id', $value)->where('ano', date('Y') + 1)->get();;
        if ($mes && $mes->count() > 0) {
            $fail("o mês $value já está cadastrado para o ano atual");
        }
    }
}
