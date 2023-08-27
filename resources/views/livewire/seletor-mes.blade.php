<div>
    {{--TODO: Formatar HTML CSS--}}
    <span>Escolha ano e mês para visualizar em grade</span>
    {{--Montar select option para cada mes--}}
    <br>
    <br>
    <select wire:model="selectedano" wire:click="filtroAno('ano')" class="bg-primary-500 py-2 px-6 rounded-lg">
        <option value="">Ano</option>
        @foreach($anos as $ano)
            <option wire:key="{{$ano->ano}}">{{$ano->ano}}</option>
        @endforeach
    </select>

    @if(!is_null($meses))
        <select wire:model="meses" class="bg-primary-500 p-2 mx-3 rounded-lg">
            <option value="">Mês</option>
            @foreach($meses as $mes)
                <option wire:key="{{$mes->id}}">{{$mes->do_ano_mes_id}}</option>
            @endforeach
        </select>
    @endif
    <br><br><br><br><br>
    <h3 class="bg-gray-400 py-3 px-3 text-amber-600">Teste de cores</h3>
    <br>
</div>
