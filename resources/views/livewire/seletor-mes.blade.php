<div class="inline-grid grid-cols-6 gap-1 form-control">
    <div>
        <label class="label">
            <span class="label-text-alt">ANO</span>
        </label>
        <select wire:model="selectedano" wire:click="filtroAno('ano')" class="select select-warning">
            <label for="ano">ANO</label>
            <option value="">Ano</option>
            @if($anos && is_object($anos))
                @foreach($anos as $ano)
                    <option wire:key="{{$ano->ano}}">{{$ano->ano}}</option>
                @endforeach
            @endif
        </select>
    </div>
    <div>
        @if(!is_null($meses))
            <label class="label">
                <span class="label-text-alt">MÊS</span>
            </label>
            <select wire:model="meses" wire:click="selectedMes('selected_mes')" class="select select-warning">
                <option value="">Mês</option>
                @if($meses && is_object($meses))
                    @foreach($meses as $mes)
                        <option wire:key="{{$mes->id}}">{{$mes->do_ano_mes_id}}</option>
                    @endforeach
                @endif

            </select>
        @endif
    </div>
</div>
