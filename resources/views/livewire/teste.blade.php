
    {{-- Be like water. --}}

        <div>
            <label class="label">
                <span class="label-text-alt">ANO</span>
            </label>
            <select id="ano" wire:model="ano" wire:click="selecionouAno({{$ano}})" class="select select-warning">

                <label for="ano">ANO</label>
                <option value="">Ano</option>
                @if($anos && is_object($anos))
                    @foreach($anos as $ano)
                        <option wire:key="{{$ano->ano}}">{{$ano->ano}}</option>
                    @endforeach
                @endif
            </select>
        </div>

