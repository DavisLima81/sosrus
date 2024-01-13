<div class="py-10 px-10">

    <div class="card w-full bg-gray-800 text-white">
        <div class="card-body items-center text-center">
            <h2 class="card-title">DETALHES DO ESCALADO</h2>
            <br><br>
            <p>{{ 'SIGLA:  ' . $this->record->escala->guarnicao->sigla . '/' . $this->record->escala->nome}}</p>
            <p>{{ 'DATA:  ' . $this->record->getEscaladoDia() }}</p>
        </div>
    </div>
    <br>
    <p>{{ 'DESCRIÇÃO:  ' . $this->record->escala->descricao  . '/' . $this->record->escala->guarnicao->descricao}}</p>
    <br>

    <div class="hero bg-base-400">
        <div class="hero-content flex-col lg:flex-row justify-items-start items-start">
            <table class="table">
                <thead>
                <tr>
                    <th class="text-center">DADOS</th>
                    <th class="text-center"></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-primary-600">ORIGINAL:</td>
                    <td class="text-center">{{ $this->record->getEfetivoTrig() }}</td>
                </tr>
                <tr>
                    <td class="text-primary-600">PERMUTA:</td>
                    <td class="text-center">@if($this->record->temPermuta()) SIM @else NÃO @endif</td>
                </tr>
                <tr>
                    <td class="text-primary-600">PERMUTADO:</td>
                    @if($this->record->temPermuta())
                        <td class="text-center">{{ $this->record->efetivo_trig() }}</td>
                    @else
                        <td class="text-center">---</td>
                    @endif
                </tr>
                </tbody>
            </table>
            <div class="divider divider-horizontal text-gray-600"></div>
            <table class="table">
                <thead>
                <tr>
                    <th class="text-center">LEGENDA</th>
                    <th class="text-center"></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-primary-600">ORIGINAL:</td>
                    <td class="text-center">Trigrama do primeiro militar escalado</td>
                </tr>
                <tr>
                    <td class="text-primary-600">PERMUTA:</td>
                    <td class="text-center">Sim ou não. Registra se houve permuta para este escalado</td>
                </tr>
                <tr>
                    <td class="text-primary-600">PERMUTADO:</td>
                    <td class="text-center">Trigrama do militar escalado através da permuta mais recente</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="divider text-gray-600">#######</div>

    @if($this->record->temPermuta())

        <table class="table">
            <thead>
            <tr>
                <th class="text-center">PERMUTAS</th>
                <th class="text-center"></th>
                <th class="text-center"></th>
            </tr>
            </thead>
            <tbody>

            @foreach($this->record->getPermutas() as $permuta)
                <tr>
                    <td class="text-primary-600">SAI: </td>
                    <td>{{$permuta->saiEfetivoTrigrama() }}</td>
                    <td class="text-primary-600">ENTRA: </td>
                    <td>{{ $permuta->entraEfetivoTrigrama() }}</td>
                    <td class="text-primary-600">REGISTRADA:</td>
                    <td>{{ $permuta->created_at->format('d/m/Y - h:i') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
