<div class="py-10 px-10">

    <div class="card w-full bg-gray-800 text-white">
        <div class="card-body items-center text-center">
            <h2 class="card-title">DETALHES DO ESCALADO</h2>
            <p>{{ $this->record->escala->guarnicao->sigla . ' - ' . $this->record->escala->nome  . ' - ' .  $this->record->getEscaladoDia() }}</p>
        </div>
    </div>
    <br><br>

<p class="text-white">
    <strong class="text-primary-400">ORIGINAL:</strong> {{ strval($this->record->getEfetivoTrig()) }}
    <br>
    <strong class="text-primary-400">PERMUTA:</strong> @if($this->record->temPermuta()) SIM @else NÃO @endif
    <br>
    @if($this->record->temPermuta())
        <strong class="text-primary-400">PERMUTADO:</strong> {{ strval($this->record->efetivo_trig()) }}
        <br>
        <br>
    <hr>
    <h1 class="py-3"><strong class="text-primary-400">PERMUTAS</strong></h1>
    <p class="text-white py-2">
        @foreach($this->record->getPermutas() as $permuta)
            <strong class="text-primary-400">REGISTRADA:</strong> {{ $permuta->created_at->format('d/m/Y') }}
            <br>
            <strong class="text-primary-400">SAI:</strong> {{$permuta->saiEfetivoTrigrama() }}
            <br>
            <strong class="text-primary-400">ENTRA:</strong> {{ $permuta->entraEfetivoTrigrama() }}
            <br>
        @endforeach
    </p>
    @endif

</div>
