<div>
    {{--TODO: Formatar HTML CSS--}}
    <span>Escolha ano e mês para visualizar em grade</span>

    {{--Montar select option para cada mes--}}
    <br>
    <br>
    <select wire:model="selectedano" wire:click="filtroAno('ano')" class="bg-primary-500">
        <option value="">Ano</option>
        @foreach($anos as $ano)
            <option wire:key="{{$ano->ano}}">{{$ano->ano}}</option>
        @endforeach
    </select>

    @if(!is_null($meses))
        <select wire:model="meses" class="bg-primary-500">
            <option value="">Mês</option>
            @foreach($meses as $mes)
                <option wire:key="{{$mes->id}}">{{$mes->do_ano_mes_id}}</option>
            @endforeach
        </select>
    @endif
    <br>
    <br>
    <section name="teste">
        <h1>Teste H1</h1>
        <h2>Teste H2</h2>
        <h3>Teste H3</h3>
    </section>

</div>
